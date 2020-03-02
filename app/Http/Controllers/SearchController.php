<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Moderl
use App\User;
use App\Sale;
use App\Favorite;

//DB
use DB;

class SearchController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
    }


    public function VistaSearch()
    {

    	$animal     = array();
    	$animalsrow = Sale::join('animals', 'sales.animal_id', '=', 'animals.animal_id')
    						->join('breeds', 'sales.breed_id', '=', 'breeds.breed_id')
	                        //->join('colors', 'sales.color_id', '=', 'colors.color_id')
	                        ->join('genders', 'sales.gender_id', '=', 'genders.gender_id')
                            ->join('cities', 'sales.city', '=', 'cities.id_ciudad')
	    					->select('sales.*', 
		    							'animals.name as animal_name', 
	                                    'breeds.name as breeds_name', 
	                                    //'colors.name as colors_name', 
	                                    'genders.name as gender_name',
                                        'cities.*')->get();

        if ($animalsrow->count() > 0) {
            $ban = 0;
            foreach ($animalsrow as $animalrow) {
                $animal[$ban]["animal_name"] = $animalrow->animal_name;
                $animal[$ban]["img"]         = $this->primerImagenProducto( $animalrow->user_id, $animalrow->animal_id, $animalrow->sale_id );
                $animal[$ban]["nickname"]    = $animalrow->nickname;
                //$animal[$ban]["colors_name"]    = $animalrow->colors_name;
                $animal[$ban]["breeds_name"]    = $animalrow->breeds_name;
                $animal[$ban]["gender_name"]    = $animalrow->gender_name;
                $animal[$ban]["price"]    		= $animalrow->price;
                $animal[$ban]["user_id"]        = $animalrow->user_id;

                $animal[$ban]["price_filtro"]   = str_replace(",", "", $animalrow->price);

                $animal[$ban]["animal_id"]      = $animalrow->animal_id;
                $animal[$ban]["breed_id"]       = $animalrow->breed_id;
                $animal[$ban]["color_id"]       = $animalrow->color_id;
                $animal[$ban]["age_id"]         = $animalrow->age_id;
                $animal[$ban]["gender_id"]      = $animalrow->gender_id;
                $animal[$ban]["discipline_id"]  = $animalrow->discipline_id;
                $animal[$ban]["description"]    = $animalrow->description;
                $animal[$ban]["state"]          = $animalrow->state;
                $animal[$ban]["adress"]         = $animalrow->ciudad.", ".$animalrow->estado;
                $ban++;
            }
        }



        $animals = DB::table("animals")->get();
        $breeds = DB::table("breeds")->get();
        $colors = DB::table("colors")->get();
        $genders = DB::table("genders")->get();
        $disciplines = DB::table("disciplines")->get();
        $estados    = DB::table("cities")->groupBy("estado")->get();
        $misFavoritos   = $this->getFavorites(auth()->user()->user_id);


    	return view('site.vista', compact("animal", "animals", "breeds", "colors", "genders", "disciplines", "estados", "misFavoritos"));
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
                 $favoriteArray[$cont]["price"]         = $favoritefull->price;
                $favoriteArray[$cont]["img"]           = $this->primerImagenProducto( $favoritefull->user_id, $favoritefull->animal_id, $favoritefull->sale_id );
                $cont++;
            }

            return $favoriteArray;

        }

       return false;
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
}
