<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Mail\SendMsjQualify;
use Illuminate\Support\Facades\Mail;

//Moderl
use App\User;
use App\Sale;
use App\Favorite;

//DB
use DB;

class MyaccountController extends Controller
{

	public function __construct()
	{
		$this->middleware("auth");
        $this->middleware("ScoreReviewIds", ["only" => "scoreQualify"]);
	}
    
    public function index()
    {
        $animal     = array();
    	$animalsrow = Sale::where('user_id', auth()->user()->user_id)
    					->join('animals', 'sales.animal_id', '=', 'animals.animal_id')
    					->select('sales.*', 'animals.name as animal_name')
    					->get();

        if ($animalsrow->count() > 0) {
            $ban = 0;
            foreach ($animalsrow as $animalrow) {
                $animal[$ban]["animal_name"] = $animalrow->animal_name;
                $animal[$ban]["img"]         = $this->primerImagenProducto( auth()->user()->user_id, $animalrow->animal_id, $animalrow->sale_id );
                $animal[$ban]["nickname"]    = $animalrow->nickname;
                $animal[$ban]["disabled"]    = $animalrow->disabled;
                $animal[$ban]["sold"]        = $animalrow->sold;
                $animal[$ban]["sale_id"]  = $animalrow->sale_id;
                $ban++;
            }
        }


        //CHAT
        $token_sala = DB::table("chats_rooms")->where([
                            ["chats_rooms.user_id", auth()->user()->user_id],
                        ])->orWhere([
                            ["chats_rooms.user_two_id", auth()->user()->user_id],
                        ])->get();

        //return response()->json($token_sala);
        
        $conta     = 0;
        $listado   = null;

        foreach ($token_sala as $sala) {
            $chat       = DB::table("messages")->where("chat_id", $sala->chat_id)->orderBy('id', 'desc')->first();
            $chat_list  = false;
            
            if ($chat != null) {
                $chat_list = true;
            }

            if ($sala->user_id == auth()->user()->user_id) {
                $user_chat = DB::table("users")->where("user_id", $sala->user_two_id)->first();
            }
            else {
                $user_chat = DB::table("users")->where("user_id", $sala->user_id)->first();
            }

            if ($chat_list) {
                $listado[$conta] = array("nombre_user" => $user_chat->name, "ultimo_mensaje" => $chat->message, "fecha" => $chat->created_at, "token" => $sala->token_chat, "username" => $user_chat->username);
                $conta++;
            }
        }

        //return response()->json($listado);
        $misFavoritos   = $this->getFavorites(auth()->user()->user_id);
        $estados        = DB::table("cities")->groupBy("estado")->get();
        $notificaciones = $this->getNotify();

    	return view("site.myaccount", compact("animal", "misFavoritos", "listado", "estados", "notificaciones"));
    }


    public function getNotify()
    {
        if (auth()->check()) {
        
            $noti = DB::table("notifications")->where("user_id", auth()->user()->user_id)->get();
            $i = 0;
            $arrNot = null;
            
            if ($noti != null) {        
                foreach ($noti as $notify) {
                    $usuario = DB::table("users")->where("user_id", $notify->other_user_id)->first();
                    $arrNot[$i]["nombre_usuario"] = $usuario->username;
                    $arrNot[$i]["img_user"] = $usuario->urlImg;
                    $arrNot[$i]["typo_not"] = $notify->typo_notify_id;
                    $arrNot[$i]["time"] = $notify->created_at;
                    $i++;
                }
            }

            return $arrNot;

        }

        return null;
    }


    public function qualify(Request $request)
    {
        if (!$request->has("contador")) {
            return response()->json(["message" => "error", "input" => "input_contador_require"]);
        }

        if (!$request->has("username")) {
            return response()->json(["message" => "error", "input" => "input_username_require"]);
        }

        if (!is_numeric($request->contador)) {
            return response()->json(["message" => "error", "input" => "input_contador_numeric"]);
        }

        if (!$request->has("animal_id")) {
            return response()->json(["message" => "error", "input" => "input_animal_id_require"]);
        }

        $user_calificado    = DB::table("users")->where("username", $request->username)->first();
        $animal             = DB::table("sales")->where("nickname", $request->animal_id)->where("user_id", auth()->user()->user_id)->first();

        //Fecha
        date_default_timezone_set('America/Mexico_City');
        $date = date('Y-m-d', time());

        DB::beginTransaction();
        $save_ratings = DB::table("ratings")->insert([
                            "user_id" => auth()->user()->user_id,
                            "rating" => $request->contador,
                            "calificado_id" => $user_calificado->user_id,
                            "sale_id" => $animal->sale_id,
                            "created_at" => $date,
                            "updated_at" => $date,
                        ]);

        if ($save_ratings) {
            //INSERTAR PARA QUE EL COMPRADOR CALIFIQUE AL VENDEDOR
            $save_r_vendedor = DB::table("ratings")->insert([
                                "user_id" => $user_calificado->user_id,
                                "calificado_id" => auth()->user()->user_id,
                                "sale_id" => $animal->sale_id,
                                "created_at" => $date,
                                "updated_at" => $date,
                            ]);

            if ($save_r_vendedor) {
                DB::commit();
                DB::table("sales")->where("sale_id", $animal->sale_id)->where("user_id", auth()->user()->user_id)->update(["sold" => 1]);
                $usuario_calificado = DB::table("users")->where("user_id", $user_calificado->user_id)->first();
                Mail::to("853e9296af-b1cadc@inbox.mailtrap.io")->send(new SendMsjQualify($usuario_calificado, auth()->user()->username, $animal->nickname));

                return response()->json(["message" => "ok"]);
            }

            DB::rollback();
            return response()->json(["message" => "error"]);
        }

        DB::rollback();
        return response()->json(["message" => "error"]);
    }


    public function scoreQualify($sale_id, $calificado_id)
    {
        $username   = base64_decode($calificado_id);
        $sale_id    = $sale_id;
        $notificaciones = $this->getNotify();

        return view("site.qualify", compact("username", "sale_id", "notificaciones"));
    }


    public function qualifyForm(Request $request)
    {
        if (!$request->has("contador")) {
            return redirect()->back()->with("session_error", "A problem occurred try again later");
        }

        if (!$request->has("username")) {
           return redirect()->back()->with("session_error", "A problem occurred try again later");
        }

        if (!is_numeric($request->contador)) {
            return redirect()->back()->with("session_error", "A problem occurred try again later");
        }

        if (!$request->has("animal_id")) {
            return redirect()->back()->with("session_error", "A problem occurred try again later");
        }

        $user_calificado    = DB::table("users")->where("username", $request->username)->first();
        $animal             = DB::table("sales")->where("nickname", $request->animal_id)->first();

        //Fecha
        date_default_timezone_set('America/Mexico_City');
        $date = date('Y-m-d', time());

        if ($animal == null) {
            return redirect()->back()->with("session_error", "A problem occurred try again later");
        }

        if ($user_calificado == null) {
            return redirect()->back()->with("session_error", "A problem occurred try again later");
        }


        DB::beginTransaction();
        $rating = DB::table("ratings")
                        ->where("user_id", auth()->user()->user_id)
                        ->where("calificado_id", $user_calificado->user_id)
                        ->where("sale_id", $animal->sale_id)
                        ->update(["rating" => $request->contador, "created_at" => $date, "updated_at" => $date]);

        if ($rating) {
            DB::commit();
            return redirect()->route("myaccount")->with("session_succes-qualify", "Was rated correctly");
        }


        DB::rollback();
        return redirect()->back()->with("session_error", "A problem occurred try again later");
        
    }

    public function EditProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required','string','max:255','unique:users,username,'.auth()->user()->user_id.',user_id'],
            'email' => ['required','string','email','max:255','unique:users,email,'.auth()->user()->user_id.',user_id'],
            'password' => ['nullable','string','min:8'],
            'name' => ['required','string','max:255'],
            'phone' => ['required','string','max:255'],
            'address' => ['required','string','max:300'],
            'postal' => ['required','string','max:10'],
            'state' => ['required','string','max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 202);
        }

        DB::beginTransaction();

        $users                  = User::find(auth()->user()->user_id);
        $users->username        = $request->username;
        $users->email           = $request->email;

        if ($request->has("password")) {
            $users->password        = bcrypt($request->password);
        }

        $users->name            = $request->name;
        $users->phone           = $request->phone;
        $users->address         = $request->address;
        $users->cp_zip          = $request->postal;
        $users->state           = $request->state;

        if ($users->save()) {
            DB::commit();
            return response()->json(["message" => "ok"], 202);
        }

        DB::rollback();
        return response()->json(["message" => "off"], 202);
    }



    public function SaveSettings(Request $request)
    {
        if ($request->has('email_favorite') && 
            $request->has('email_update') && 
            $request->has('receive_text')) 
        {


             $validator = Validator::make($request->all(), [
                'email_favorite' => ['required','boolean'],
                'email_update' => ['required','boolean'],
                'receive_text' => ['required','boolean'],
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 202);
            }

            $usuario = User::find(auth()->user()->user_id);
            $request->email_favorite == 1 ? $usuario->email_favorite = 1 : $usuario->email_favorite = 0;
            $request->email_update == 1 ? $usuario->email_update = 1 : $usuario->email_update = 0;
            $request->receive_text == 1 ? $usuario->receive_text = 1 : $usuario->receive_text = 0;

            if ($usuario->save()) {
                return response()->json(["message"=>"ok"], 202);
            }

            return response()->json(["message"=>"error_save"], 202);
        }
    }


    public function primerImagenProducto($usuario, $categoria, $producto)
    {
        $directory= base_path()."/storage/app/public/images/".$usuario."/".$categoria."/".$producto;
        if (is_dir($directory)) {
            $dirint = dir($directory);
            $primero = "";

            while (($archivo = $dirint->read()) !== false)
            {
                if (preg_match("{gif}", $archivo) || preg_match("{jpeg}", $archivo) || preg_match("{png}", $archivo) || preg_match("{jpg}", $archivo) || preg_match("{webp}", $archivo)){
                    $primero = $archivo;
                    break;
                }
            }
            $dirint->close();


            return $usuario."/".$categoria."/".$producto."/".$primero;
        }
       
        return false;
    }


    public function SaveImgMyaccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'upload' => ['required', 'mimes:jpg,jpeg,png']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 202);
        }

        if ($request->hasFile("upload")) {


            DB::beginTransaction();
            $users = User::find(auth()->user()->user_id);

            if ($users->urlImg != null) {
                $name_img = basename($users->urlImg);
                Storage::delete("images/".auth()->user()->user_id."/perfil/".$name_img);
            }

            if ( $url = $this->uploadImg($request) ) {

                $users->urlImg = $url;

                if ($users->save()) {
                     DB::commit();
                     return response()->json(["message" => "ok"], 202);
                }

                DB::rollback();
                return response()->json(["message" => "error_save"], 202);
            }
            DB::rollback();
            return response()->json(["message" => "error_upload"], 202);
        }
        DB::rollback();
        return response()->json(["message" => "error_file"], 202);
    }



    public function removeAnimal(Request $request)
    {

        if ($request->has("idAnimal")) {
            
            $sale       = Sale::where("nickname", $request->idAnimal)->first();
            $idAnimal   = $sale->sale_id;
            if ($sale->user_id == auth()->user()->user_id) {
                if ($sale->delete()) {
                    DB::beginTransaction();
                    Favorite::where("sale_id", $idAnimal)->delete();

                    //ELIMINAR IMAGENES Y CARPETA
                    $directory = 'images/'.auth()->user()->user_id.'/'.$sale->animal_id.'/'.$idAnimal.'/';
                    $files = Storage::allFiles($directory);
                    if (Storage::delete($files)) {
                        Storage::deleteDirectory($directory);
                        DB::commit();
                        return response()->json(["message" => "ok"]);
                    }

                    DB::rollback();
                    return response()->json(["message" => "not_delete"]);
                }
                return response()->json(["message" => "not_delete"]);
            }

            return response()->json(["message" => "not_user_animal"]);
        }
        
        return response()->json(["message" => "not_parameters"]);
    }



    public function getFavorites($user_id)
    {
        $favorite = Favorite::where("user_id", $user_id)->get();
        $favoriteArray = array();

        if ($favorite->count() > 0) {
            $cont = 0;
            foreach ($favorite as $favorites) {
                $favoritefull = Sale::where("sale_id", $favorites->sale_id)
                                    ->where("disabled", 0)
                                    ->join('animals', 'sales.animal_id', '=', 'animals.animal_id')
                                    ->select('sales.*', 'animals.name as animal_name')
                                    ->first();

                if ($favoritefull != null) {
                
                    $favoriteArray[$cont]["animal_name"]  = $favoritefull->animal_name;
                    $favoriteArray[$cont]["nickname"]      = $favoritefull->nickname;
                    $favoriteArray[$cont]["img"]           = $this->primerImagenProducto( $favoritefull->user_id, $favoritefull->animal_id, $favoritefull->sale_id );
                    $cont++;
                }
            }

            return $favoriteArray;

        }

       return false;
    }



    public function uploadImg($request)
    {
        try {
            $rootImg = $request->file('upload')->store("images/".auth()->user()->user_id."/perfil/");
            return $rootImg;
        }
        catch(Exception $e) {
            \Log::error('La imagen '.$request->file('upload')->getClientOriginalName()." no se guardo correctamente: error: ".$e->getMessage());
            return false;
        }
    }



    public function PostAgain(Request $request)
    {
        if (!$request->has("id_animal")) {
            return response()->json(["message" => "error", "input" => "not_parameters"]);
        }

        $animal = DB::table("Sales")->where("nickname", $request->id_animal)->where("user_id", auth()->user()->user_id)->first();

        if ($animal != null) {
             DB::table("Sales")->where("nickname", $request->id_animal)->where("user_id", auth()->user()->user_id)->update(["sold" => 0]);
             //MAIL
             return response()->json(["message" => "ok"]);
        }

        return response()->json(["message" => "error", "input" => "not_animal"]);

    }

}
