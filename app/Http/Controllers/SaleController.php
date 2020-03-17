<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $this->middleware("auth", ["except" => ["show", "SearchAnimal"]]);
        $this->middleware("ValidateProfileFinSale", ["except" => ["show", "SearchAnimal"]]);
        $this->middleware("RestrictedAccessExpired", ["only" => ["show"]]);
        $this->middleware("RestringUpdateSale", ["only" => "updatePlan", "PageUpdatePlan"]);
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
        $animals    = DB::table("animals")->get();
        $type       = DB::table("types")->get();
        $size       = DB::table("sizes")->get();
        $categories = DB::table("categories")->get();
        $breeds     = DB::table("breeds")->get();
        $colors     = DB::table("colors")->get();
        $genders    = DB::table("genders")->get();
        $class      = DB::table("class")->get();
        $disciplines = DB::table("disciplines")->get();
        $estados    = DB::table("cities")->groupBy("estado")->get();

        return view('site.sale', compact("animals", "breeds", "colors", "genders", "disciplines", "estados", "class", "categories", "type", "size"));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (request("animals") == 1) {
            
            $validator = Validator::make($request->all(), [
                "animals" => "required|max:2",
                "animals" => "numeric",
                "breeds" => "required|max:4",
                "breeds" => "numeric",
                "ages" => "required|max:2",
                "ages" => "numeric",
                "vaccinations" => "required|max:2",
                "vaccinations" => "numeric",
                "horns" => "required|max:2",
                "horns" => "numeric",
                "categories" => "required|max:2",
                "categories" => "numeric",
                "weight" => "required",
                "conditions" => "required",
                "number_of_head" => "required|max:2",
                "number_of_head" => "numeric",
                "price" => "required|max:255",
                "description" => "required",
                "city" => "required|numeric",
                "region" => "required|numeric",
                "zip" => "required|numeric",
                "zip" => "max:5",
                "country" => "required|max:255",
                "phone_number" => "required|numeric",
                "phone_number" => "min:10|max:13"
            ]);
        }

        else if (request("animals") == 2) {

            $validator = Validator::make($request->all(), [
                "animals" => "required|max:2",
                "animals" => "numeric",
                "breeds" => "required|max:4",
                "breeds" => "numeric",
                "colors" => "required|max:2",
                "colors" => "numeric",
                "genders" => "required|max:2",
                "genders" => "numeric",
                "ages" => "required|max:2",
                "ages" => "numeric",
                "discipline" => "required|max:2",
                "temperament" => "required|max:2",
                "price" => "required|max:255",
                "description" => "required",
                "city" => "required|numeric",
                "region" => "required|numeric",
                "zip" => "required|numeric",
                "zip" => "max:5",
                "country" => "required|max:255",
                "phone_number" => "required|numeric",
                "phone_number" => "min:10|max:13"
            ]);
        }

        else if (request("animals") == 3) {

            $validator = Validator::make($request->all(), [
                "animals" => "required|max:2",
                "animals" => "numeric",
                "breeds" => "required|max:2",
                "breeds" => "numeric",
                "genders" => "required|max:2",
                "genders" => "numeric",
                "ages" => "required|max:2",
                "ages" => "numeric",
                "class" => "required|max:2",
                "class" => "numeric",
                "horns" => "required|max:2",
                "horns" => "numeric",
                "weight" => "required",
                "number_of_head" => "required|max:2",
                "number_of_head" => "numeric",
                "price" => "required|max:255",
                "description" => "required",
                "city" => "required|numeric",
                "region" => "required|numeric",
                "zip" => "required|numeric",
                "zip" => "max:5",
                "country" => "required|max:255",
                "phone_number" => "required|numeric",
                "phone_number" => "min:10|max:13"
            ]);
        }

        else if (request("animals") == 4) {

            $validator = Validator::make($request->all(), [
                "animals" => "required|max:2",
                "animals" => "numeric",
                "breeds" => "required|max:2",
                "breeds" => "numeric",
                "genders" => "required|max:2",
                "genders" => "numeric",
                "ages" => "required|max:2",
                "ages" => "numeric",
                "class" => "required|max:2",
                "class" => "numeric",
                "type" => "required|max:2",
                "type" => "numeric",
                "horns" => "required|max:2",
                "horns" => "numeric",
                "weight" => "required",
                "number_of_head" => "required|max:2",
                "number_of_head" => "numeric",
                "price" => "required|max:255",
                "description" => "required",
                "city" => "required|numeric",
                "region" => "required|numeric",
                "zip" => "required|numeric",
                "zip" => "max:5",
                "country" => "required|max:255",
                "phone_number" => "required|numeric",
                "phone_number" => "min:10|max:13"
            ]);
        }

        else if (request("animals") == 5) {

            $validator = Validator::make($request->all(), [
                "animals" => "required|max:2",
                "animals" => "numeric",
                "breeds" => "required|max:2",
                "breeds" => "numeric",
                "genders" => "required|max:2",
                "genders" => "numeric",
                "ages" => "required|max:2",
                "ages" => "numeric",
                "class" => "required|max:2",
                "class" => "numeric",
                "weight" => "required",
                "number_of_head" => "required|max:2",
                "number_of_head" => "numeric",
                "price" => "required|max:255",
                "description" => "required",
                "city" => "required|numeric",
                "region" => "required|numeric",
                "zip" => "required|numeric",
                "zip" => "max:5",
                "country" => "required|max:255",
                "phone_number" => "required|numeric",
                "phone_number" => "min:10|max:13"
            ]);
        }

        else if (request("animals") == 6) {

            $validator = Validator::make($request->all(), [
                "animals" => "required|max:2",
                "animals" => "numeric",
                "breeds" => "required|max:2",
                "breeds" => "numeric",
                "colors" => "required|max:2",
                "colors" => "numeric",
                "genders" => "required|max:2",
                "genders" => "numeric",
                "ages" => "required|max:2",
                "ages" => "numeric",
                "size" => "required|max:2",
                "size" => "numeric",
                "price" => "required|max:255",
                "description" => "required",
                "city" => "required|numeric",
                "region" => "required|numeric",
                "zip" => "required|numeric",
                "zip" => "max:5",
                "country" => "required|max:255",
                "phone_number" => "required|numeric",
                "phone_number" => "min:10|max:13"
            ]);
        }

        else if (request("animals") == 7) {

            $validator = Validator::make($request->all(), [
                "animals" => "required|max:2",
                "animals" => "numeric",
                "breeds" => "required|max:2",
                "breeds" => "numeric",
                "colors" => "required|max:2",
                "colors" => "numeric",
                "genders" => "required|max:2",
                "genders" => "numeric",
                "ages" => "required|max:2",
                "ages" => "numeric",
                "size" => "required|max:2",
                "size" => "numeric",
                "declawed" => "required|max:2",
                "declawed" => "numeric",
                "price" => "required|max:255",
                "description" => "required",
                "city" => "required|numeric",
                "region" => "required|numeric",
                "zip" => "required|numeric",
                "zip" => "max:5",
                "country" => "required|max:255",
                "phone_number" => "required|numeric",
                "phone_number" => "min:10|max:13"
            ]);
        }


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

        if (request("animals") == 1) {
            $sale->breed_id         = request("breeds");
            $sale->age_id           = request("ages");
            $sale->vaccinations     = request("vaccinations");
            $sale->horns            = request("horns");
            $sale->weight           = request("weight");
            $sale->conditions       = request("conditions");
            $sale->number_of_head   = request("number_of_head");
            $sale->categorie_id    = request("categories");
        }

        else if (request("animals") == 2) {
            $sale->breed_id         = request("breeds");
            $sale->color_id         = request("colors");
            $sale->gender_id        = request("genders");
            $sale->age_id           = request("ages");
            $sale->discipline_id    = request("discipline");
            $sale->temperament      = request("temperament");
        }

        else if (request("animals") == 3) {
            $sale->breed_id         = request("breeds");
            $sale->gender_id        = request("genders");
            $sale->age_id           = request("ages");
            $sale->class_id         = request("class");
            $sale->horns            = request("horns");
            $sale->weight           = request("weight");
            $sale->number_of_head   = request("number_of_head");
        }

        else if (request("animals") == 4) {
            $sale->breed_id         = request("breeds");
            $sale->gender_id        = request("genders");
            $sale->age_id           = request("ages");
            $sale->type_id          = request("type");
            $sale->class_id         = request("class");
            $sale->horns            = request("horns");
            $sale->weight           = request("weight");
            $sale->number_of_head   = request("number_of_head");
        }

        else if (request("animals") == 5) {
            $sale->breed_id         = request("breeds");
            $sale->gender_id        = request("genders");
            $sale->age_id           = request("ages");
            $sale->class_id         = request("class");
            $sale->weight           = request("weight");
            $sale->number_of_head   = request("number_of_head");
        }

        else if (request("animals") == 6) {
            $sale->breed_id         = request("breeds");
            $sale->gender_id        = request("genders");
            $sale->color_id         = request("colors");
            $sale->age_id           = request("ages");
            $sale->size_id         = request("size");
        }

        else if (request("animals") == 7) {
            $sale->breed_id         = request("breeds");
            $sale->gender_id        = request("genders");
            $sale->color_id         = request("colors");
            $sale->age_id           = request("ages");
            $sale->size_id         = request("size");
            $sale->declawed        = request("declawed");
        }

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

        if ($request->has("hompage") || $request->has("hompage2")) {
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

        $animalprincipal = DB::table('sales')->where('nickname', $id)->first();

        if ($animalprincipal->animal_id == 1) {
            
            $animal =   DB::table('sales')
                        ->join('animals', 'sales.animal_id', '=', 'animals.animal_id')
                        ->join('breeds', 'sales.breed_id', '=', 'breeds.breed_id')
                        ->join('categories', 'sales.categorie_id', '=', 'categories.categorie_id')
                        ->join('users', 'sales.user_id', '=', 'users.user_id')
                        ->select('sales.*', 
                                    'animals.name as animal_name', 
                                    'breeds.name as breeds_name',  
                                    'categories.name as categories_name',
                                    'users.username as user_name',
                                    'users.urlImg')
                        ->where('nickname', $id)->first();
        }

        else if ($animalprincipal->animal_id == 2) {

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
                                    'users.username as user_name',
                                    'users.urlImg')
                        ->where('nickname', $id)->first();
        }

        else if ($animalprincipal->animal_id == 3) {

            $animal =   DB::table('sales')
                        ->join('animals', 'sales.animal_id', '=', 'animals.animal_id')
                        ->join('breeds', 'sales.breed_id', '=', 'breeds.breed_id')
                        ->join('class', 'sales.class_id', '=', 'class.class_id')
                        ->join('genders', 'sales.gender_id', '=', 'genders.gender_id')
                        ->join('users', 'sales.user_id', '=', 'users.user_id')
                        ->select('sales.*', 
                                    'animals.name as animal_name', 
                                    'breeds.name as breeds_name', 
                                    'class.name as class_name', 
                                    'genders.name as gender_name',
                                    'users.username as user_name',
                                    'users.urlImg')
                        ->where('nickname', $id)->first();
        }

        else if ($animalprincipal->animal_id == 4) {

            $animal =   DB::table('sales')
                        ->join('animals', 'sales.animal_id', '=', 'animals.animal_id')
                        ->join('breeds', 'sales.breed_id', '=', 'breeds.breed_id')
                        ->join('class', 'sales.class_id', '=', 'class.class_id')
                        ->join('genders', 'sales.gender_id', '=', 'genders.gender_id')
                        ->join('types', 'sales.type_id', '=', 'types.type_id')
                        ->join('users', 'sales.user_id', '=', 'users.user_id')
                        ->select('sales.*', 
                                    'animals.name as animal_name', 
                                    'breeds.name as breeds_name', 
                                    'class.name as class_name', 
                                    'genders.name as gender_name',
                                    'types.name as types_name',
                                    'users.username as user_name',
                                    'users.urlImg')
                        ->where('nickname', $id)->first();
        }

        else if ($animalprincipal->animal_id == 5) {

            $animal =   DB::table('sales')
                        ->join('animals', 'sales.animal_id', '=', 'animals.animal_id')
                        ->join('breeds', 'sales.breed_id', '=', 'breeds.breed_id')
                        ->join('class', 'sales.class_id', '=', 'class.class_id')
                        ->join('genders', 'sales.gender_id', '=', 'genders.gender_id')
                        ->join('users', 'sales.user_id', '=', 'users.user_id')
                        ->select('sales.*', 
                                    'animals.name as animal_name', 
                                    'breeds.name as breeds_name', 
                                    'class.name as class_name', 
                                    'genders.name as gender_name',
                                    'users.username as user_name',
                                    'users.urlImg')
                        ->where('nickname', $id)->first();
        }

        else if ($animalprincipal->animal_id == 6) {

            $animal =   DB::table('sales')
                        ->join('animals', 'sales.animal_id', '=', 'animals.animal_id')
                        ->join('breeds', 'sales.breed_id', '=', 'breeds.breed_id')
                        ->join('colors', 'sales.color_id', '=', 'colors.color_id')
                        ->join('genders', 'sales.gender_id', '=', 'genders.gender_id')
                        ->join('sizes', 'sales.size_id', '=', 'sizes.size_id')
                        ->join('users', 'sales.user_id', '=', 'users.user_id')
                        ->select('sales.*', 
                                    'animals.name as animal_name', 
                                    'breeds.name as breeds_name', 
                                    'colors.name as colors_name', 
                                    'genders.name as gender_name',
                                    'sizes.name as sizes_name',
                                    'users.username as user_name',
                                    'users.urlImg')
                        ->where('nickname', $id)->first();
        }

        else if ($animalprincipal->animal_id == 7) {

            $animal =   DB::table('sales')
                        ->join('animals', 'sales.animal_id', '=', 'animals.animal_id')
                        ->join('breeds', 'sales.breed_id', '=', 'breeds.breed_id')
                        ->join('colors', 'sales.color_id', '=', 'colors.color_id')
                        ->join('genders', 'sales.gender_id', '=', 'genders.gender_id')
                        ->join('sizes', 'sales.size_id', '=', 'sizes.size_id')
                        ->join('users', 'sales.user_id', '=', 'users.user_id')
                        ->select('sales.*', 
                                    'animals.name as animal_name', 
                                    'breeds.name as breeds_name', 
                                    'colors.name as colors_name', 
                                    'genders.name as gender_name',
                                    'sizes.name as sizes_name',
                                    'users.username as user_name',
                                    'user.urlImg')
                        ->where('nickname', $id)->first();
        }
        

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
        //dd($request);
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


    public function updatePlan($id)
    {
        return view("site.renovate", compact("id"));
    }


    public function PageUpdatePlan(Request $request, $id)
    {


        //VALIDAR EL PLAN
        $validator2 = Validator::make($request->all(), [
            "planSelect" => "required|numeric",
            "planSelect" => "max:2"
        ]);

        if ($validator2->fails()) {
            return redirect("/plan/".$id)->withErrors($validator2, "paso2")->withInput();
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


        //OBTENER EL REGISTRO DEL ANIMAL
        $saleGet    = Sale::where("nickname", $id)->first();
        $sale       = Sale::find($saleGet->sale_id);



        //SABER QUE PLAN TIENE PARA RECORTAR LA CANTIDAD DE IMAGENES
        $directory = 'images/'.auth()->user()->user_id.'/'.$sale->animal_id.'/'.$sale->sale_id.'/';
        $files = Storage::allFiles($directory);


        if (request("planSelect") == 1) {
            if (count($files) > 1) {
                $counta = count($files) - 2;
                for ($i=0; $i <= $counta; $i++) { 
                    Storage::delete($files[$i]);
                }
            }
        }
        else if (request("planSelect") == 2) {
            if (count($files) > 5) {
                $counta = count($files) - 6;
                for ($i=0; $i <= $counta; $i++) { 
                    Storage::delete($files[$i]);
                }
            }
        }




        $precio = 0;
        if ($request->has("hompage") || $request->has("hompage2")) {
            $sale->homepage = 1;
            $precio = 20;
        }
        else {
             $sale->homepage = 0;
        }


        if ($request->animal_id == 6) {
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

        //UPDATE
        $sale->plan_id      = request("planSelect");
        $sale->date_init    = $date;
        $sale->date_end     = $fechafinal;
        $sale->disabled     = 0;


        //PAGAR CON STRIPE
        if ($sale->save()) {
            if ($precio > 0 && $request->has("stripeToken")) {
                if ($this->stripePost(request("stripeToken"), $precio)) {
                    DB::commit();
                    return redirect("/myaccount")->with('status.success', '1');
                }

                DB::rollback();
                return redirect("/myaccount")->with('status.error.pago', '1');
            }

            DB::commit();
            return redirect("/myaccount")->with('status.success', '1');
        }

    }


    public function SearchState(Request $request)
    {
        if ($request->has('estado')) {
            
           $codigo = DB::table('cities')
                        ->where('id_estado', $request->estado)
                        ->get();

            if ($codigo) {
               return response()->json(['message' => 'ok', 'result' => $codigo]);
              
            }

            return response()->json(['message' => 'not']);
        }

        return response()->json(['message' => 'not parameters']);
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


    public function SearchAnimal(Request $request)
    {
        if ($request->has('animal')) {

            $breed      = null;
            $genders    = null;
            $size       = null;
            $color      = null;
            $class      = null;

            $breed  = DB::table('breeds')
                        ->where('animal_id', $request->animal)
                        ->get();

            $genders = DB::table('genders')
                        ->where('animal_id', $request->animal)
                        ->get();

            $color  = DB::table('colors')
                        ->where('animal_id', $request->animal)
                        ->get();


             $class = DB::table('class')
                        ->where('animal_id', $request->animal)
                        ->get();


            $result = array("breeds" => $breed, 
                            "genders" => $genders, 
                            "color" => $color, "class" => $class);

            return response()->json(['message' => 'ok', "result" => $result]);
        }

        return response()->json(['message' => 'not parameters']);
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
                    "amount" => $precio * 100,
                    "currency" => "USD",
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

        if (!auth()->check()) {
            return false;
        }

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
