<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//Moderl
use App\User;
use App\Sale;
use App\favorite;

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
                $ban++;
            }
        }

        $misFavoritos = $this->getFavorites(auth()->user()->user_id);

    	return view("site.myaccount", compact("animal", "misFavoritos"));
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


    public function getFavorites($user_id)
    {
        $favorite = favorite::where("user_id", $user_id)->get();
        $favoriteArray = array();

        if ($favorite->count() > 0) {
            $cont = 0;
            foreach ($favorite as $favorites) {
                $favoritefull = Sale::where("sale_id", $favorites->sale_id)
                                    ->join('animals', 'sales.animal_id', '=', 'animals.animal_id')
                                    ->select('sales.*', 'animals.name as animal_name')
                                    ->first();

                $favoriteArray[$cont]["animal_name"]  = $favoritefull->animal_name;
                $favoriteArray[$cont]["nickname"]      = $favoritefull->nickname;
                $favoriteArray[$cont]["img"]           = $this->primerImagenProducto( $favoritefull->user_id, $favoritefull->animal_id, $favoritefull->sale_id );
                $cont++;
            }

            return $favoriteArray;

        }

       return false;
    }
}
