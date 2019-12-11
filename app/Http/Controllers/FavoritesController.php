<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorite;
use DB;

class FavoritesController extends Controller
{
    public function addFavorite(Request $request) {

    	if ($request->has('idProducto')) {
            
           $product = DB::table('sales')->where('nickname', $request->idProducto)->first();

            if ($product) {
                
                $favorite = new Favorite();
                $favorite->user_id = auth()->user()->user_id;
                $favorite->sale_id = $product->sale_id;

                if ($favorite->save()) {
                    return response()->json(['message' => 'ok']);
                }

                return response()->json(['message' => 'not_save']);
              
            }

            return response()->json(['message' => 'not']);
        }

        return response()->json(['message' => 'not parameters']);
    }
}
