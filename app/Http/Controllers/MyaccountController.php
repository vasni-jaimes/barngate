<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Moderl
use App\User;
use App\Sale;

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

    	return view("site.myaccount", compact("animal"));
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
