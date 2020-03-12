<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Moderl
use App\User;
use App\Sale;
use App\Contact;

use Validator;
use DB;


class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $topAnimals = $this->TopAnimals();
        return view('site.index', ['blog' => $this->blog(), 'topAnimals' => $topAnimals]);
    }

    public function blog()
    {
        $items = [];
        $url = "https://blog.barngate.com/feed/";
        $oXml = simplexml_load_file($url);
        if ($oXml[0] != 'Service unavailable.') {
            for ($i = 0; $i <= 2; $i++) {
                $item = $oXml->channel->item[$i];
                $items[] = [
                    "link" => $item->link,
                    "image" => $item->image,
                    "title" => strip_tags($item->title),
                    "content" => strip_tags($item->description),
                    "date" => explode(" ", $item->pubDate)
                ];
            }
        }

        return $items;
    }


    public function TopAnimals()
    {
        $homepage = Sale::where("homepage", 1)
                        ->join('animals', 'sales.animal_id', '=', 'animals.animal_id')
                        ->where("sales.disabled", 0)
                        ->select('sales.*', 'animals.name as animal_name')
                        ->limit(15)
                        ->get();

        $ArrayTopAnimals = array();
        $cont            = 0;

        foreach ($homepage as $homepageObj) {
            $ArrayTopAnimals[$cont]["animal_name"] = $homepageObj->animal_name;
            $ArrayTopAnimals[$cont]["img"]         = $this->primerImagenProducto( $homepageObj->user_id, $homepageObj->animal_id, $homepageObj->sale_id );
            $ArrayTopAnimals[$cont]["nickname"]    = $homepageObj->nickname;
            $ArrayTopAnimals[$cont]["animal_id"]   = $homepageObj->animal_id;
            $cont++;
        }

        return $ArrayTopAnimals;
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




    public function ContactSend(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "first_name" => "required|max:100",
            "last_name" => "required|max:100",
            "email_contact" => "required|max:50",
            "phone" => "required|max:20",
            "phone" => "numeric",
            "questions" => "required|max:300"
        ]);

        if ($validator->fails()) {
            return redirect("contact")->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        $contact                = new Contact();
        $contact->first_name    = $request->first_name;
        $contact->last_name     = $request->last_name;
        $contact->email         = $request->email_contact;
        $contact->phone         = $request->phone;
        $contact->questions     = $request->questions;

        if ( $contact->save() ) {

            DB::commit();
            return back()->with('status.success', "1");
        }

        return back()->withInput()->with('status.error', "1");

    }

}
