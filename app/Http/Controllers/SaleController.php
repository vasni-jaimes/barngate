<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Moderl
use App\User;
use App\Sale;
use App\Favorite;

//DB
use DB;

//
use Session;
use Stripe;
use Validator;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $animals = DB::table("animals")->get();
        $breeds = DB::table("breeds")->get();
        $colors = DB::table("colors")->get();
        $genders = DB::table("genders")->get();
        $disciplines = DB::table("disciplines")->get();

        return view('site.sale', compact("animals", "breeds", "colors", "genders", "disciplines"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "animals" => "required|max:2",
            "breeds" => "required|max:2",
            "colors" => "required|max:2",
            "genders" => "required|max:2",
            "ages" => "required|max:2",
            "discipline" => "required|max:2",
            "temperament" => "required|max:2",
            "price" => "required|max:255",
            "description" => "required",
            "city" => "required|max:255",
            "region" => "required|max:255",
            "zip" => "required|numeric",
            "zip" => "max:5",
            "country" => "required|max:255",
            "phone_number" => "required|numeric",
            "phone_number" => "min:10|max:13"
        ]);

        if ($validator->fails()) {
            return redirect("sale")->withErrors($validator, "paso1")->withInput();
        }

        $validator2 = Validator::make($request->all(), [
            "planSelect" => "required|numeric",
            "planSelect" => "max:2"
        ]);

        if ($validator2->fails()) {
            return redirect("sale")->withErrors($validator2, "paso2")->withInput();
        }


        if (request("planSelect") == 3) {
            $validator3 = Validator::make($request->all(), [
                "url-videos" => "required|max:255"
            ]);

            if ($validator3->fails()) {
                return redirect("sale")->withErrors($validator3, "paso3")->withInput();
            }
        }


        
        //Fecha del plan
        date_default_timezone_set('America/Mexico_City');
        $date = date('Y-m-d', time());

        //GUARDAR FECHA PARA LOS DATOS
        if (request("planSelect") == 1) {
            $fechafinal = strtotime ( '+1 month' , strtotime ( $date ) ) ;
            $fechafinal = date ( 'Y-m-j' , $fechafinal );
        }
        else if (request("planSelect") == 2) {
            $fechafinal = strtotime ( '+3 month' , strtotime ( $date ) ) ;
            $fechafinal = date ( 'Y-m-j' , $fechafinal );
        }
        else if (request("planSelect") == 3) {
            $fechafinal = strtotime ( '+6 month' , strtotime ( $date ) ) ;
            $fechafinal = date ( 'Y-m-j' , $fechafinal );
        }



        DB::beginTransaction();

        $sale                   = new Sale();
        $sale->user_id          = auth()->user()->user_id;
        $sale->animal_id        = request("animals");
        $sale->breed_id         = request("breeds");
        $sale->color_id         = request("colors");
        $sale->gender_id        = request("genders");
        $sale->age_id           = request("ages");
        $sale->discipline_id    = request("discipline");
        $sale->temperament      = request("temperament");
        $sale->price            = request("price");
        $sale->description      = request("description");
        $sale->city             = request("city");
        $sale->state            = request("region");
        $sale->zip              = request("zip");
        $sale->country          = request("country");
        $sale->phone_number     = request("phone_number");
        $sale->plan_id          = request("planSelect");
        $sale->date_init        = $date;
        $sale->date_end         = $fechafinal;

        if (request("planSelect") == 3) {
            $sale->video = request("url-videos");
        }

        $precio = 0;

        if ($request->has("hompage") || $request->has("hompage")) {
            $sale->homepage = 1;
            $precio = 20;
        }
        else {
             $sale->homepage = 0;
        }


        if (request("animals") == 6) {
            if (request("planSelect") == 2) {
                $precio += 5;
            }
            else if (request("planSelect") == 3) {
                $precio += 10;
            }
        }
        else {
            if (request("planSelect") == 2) {
                $precio += 10;
            }
            else if (request("planSelect") == 3) {
                $precio += 20;
            }
        }

        if ($sale->save()) {

            $sale->nickname = $this->getNickname($sale->sale_id);
            $sale->save();

            if ($request->has("filepond")) {
                for ($i=0; $i <= count($request->get('filepond')) - 1; $i++) {
                    try {
                        $this->uploadImg($request, $i, $sale->sale_id);
                    } 
                    catch(Exception $e) {
                        DB::rollback();
                        \Log::error("No se guardo correctamente la imagen: error: ".$e->getMessage());
                    }
                }

                if ($precio > 0 && $request->has("stripeToken")) {
                    if ($this->stripePost(request("stripeToken"), $precio)) {
                        DB::commit();
                        return back()->with('status.success', '1');
                    }

                    DB::rollback();
                    return back()->with('status.error.pago', '1');

                }

                DB::commit();
                return back()->with('status.success', '1');
            }
            else {
                DB::rollback();
                return back()->withInput()->with('status.error.not.file', 'The field is required');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $animal =   DB::table('sales')
                        ->join('animals', 'sales.animal_id', '=', 'animals.animal_id')
                        ->join('breeds', 'sales.breed_id', '=', 'breeds.breed_id')
                        ->join('colors', 'sales.color_id', '=', 'colors.color_id')
                        ->join('genders', 'sales.gender_id', '=', 'genders.gender_id')
                        ->join('disciplines', 'sales.discipline_id', '=', 'disciplines.discipline_id')
                        ->join('users', 'sales.user_id', '=', 'users.user_id')
                        ->select('sales.*', 
                                    'animals.name as animal_name', 
                                    'breeds.name as breeds_name', 
                                    'colors.name as colors_name', 
                                    'genders.name as gender_name',
                                    'disciplines.name as desc_name',
                                    'users.username as user_name')
                        ->where('nickname', $id)->first();

        $favorite = $this->getFavoriteProduct($animal->sale_id, $animal->user_id);
        $todasImg = $this->todasImagenesProducto($animal->user_id, $animal->animal_id, $animal->sale_id);
        return view("site.principal", compact("animal", "todasImg", "favorite"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function uploadImg($request, $i, $sale_id)
    {
        $jsonImg     = json_decode($request->get("filepond")[$i]);
        $imgDecode   = base64_decode($jsonImg->data);
        $extencion   = explode("/", $jsonImg->type);
        $imageName   = str_random(10).time().'.'.trim($extencion[1]);
        $path        = "images/".auth()->user()->user_id."/".$request->get("animals")."/".$sale_id;

        if ($extencion[1] == "jpg" || $extencion[1] == "jpeg" || $extencion[1] == "png") {
            \Storage::makeDirectory($path, 0777, true);
            \Storage::put($path. "/" . $imageName, $imgDecode);
        }  
    }



    public function todasImagenesProducto($usuario, $categoria, $producto)
    {
        $directory= base_path()."/storage/app/public/images/".$usuario."/".$categoria."/".$producto;
        if (is_dir($directory)) {
            $dirint = dir($directory);
            $todas = Array();
            while (($archivo = $dirint->read()) !== false)
            {
                if (preg_match("{gif}", $archivo) || preg_match("{jpeg}", $archivo) || preg_match("{png}", $archivo) || preg_match("{jpg}", $archivo) || preg_match("{webp}", $archivo)){
                    $todas[] = $usuario."/".$categoria."/".$producto."/".$archivo;
                }
            }
            $dirint->close();
            return $todas;
        }

        return false;
    }

  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost($stripeToken, $precio)
    {
        try {

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            Stripe\Charge::create ([
                    "amount" => 100 * $precio,
                    "currency" => "MXN",
                    "source" => $stripeToken,
                    "description" => "Test payment from itsolutionstuff.com." 
            ]);   

            return true;

        } catch (\Exception $e) {
            \Log::error("Error al pagaar con stripe: ".$e->getMessage());
            redirect("sale")->withInput()->with("card_errors", $e->getMessage());
            return false;
        }
    }


    public function getNickname($id)
    {
        return "MLM=".base64_encode($id).time();
    }


    public function getFavoriteProduct($idsale, $userid)
    {
        if ($userid == auth()->user()->user_id) {
           return true;
        }

        $favorito = Favorite::where(['sale_id' => $idsale, 'user_id' => auth()->user()->user_id])->first();
        if ($favorito !== null) {
            return true;
        }

        return false;
    }
}
