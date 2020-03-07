<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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
                $animal[$ban]["disabled"]  = $animalrow->disabled;
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
        
        $conta = 0;
        $listado = null;
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
                $listado[$conta] = array("nombre_user" => $user_chat->name, "ultimo_mensaje" => $chat->message, "fecha" => $chat->created_at, "token" => $sala->token_chat);
                $conta++;
            }
        }

        //return response()->json($listado);


        $misFavoritos = $this->getFavorites(auth()->user()->user_id);
    	return view("site.myaccount", compact("animal", "misFavoritos", "listado"));
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
            'country' => ['required','string','max:255'],
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
        $users->country         = $request->country;

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
            $request->has('receive_text')) {


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
            
            $sale = Sale::find($request->idAnimal);
            if ($sale->user_id == auth()->user()->user_id) {
                if ($sale->delete()) {
                    return response()->json(["message" => "ok"]);
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
}
