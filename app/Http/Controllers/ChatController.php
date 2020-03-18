<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Pusher;
use DB;

class ChatController extends Controller
{
	function __construct()
	{
		$this->middleware("auth");
		$this->middleware("CheckChatId", ["only" => ["index"]]);
	}
    
    public function index(Request $request)
    {
    	$channel = $request->user_id;

    	//OBTENER LOS DATOS DEL USUARIO CON EL QUE CHATEA EL USUARIO DE LA SESSION ACTUAL
    	$user_client = DB::table("chats_rooms")->where("token_chat", $channel)->first();
    	if ($user_client->user_id == auth()->user()->user_id) {
    		$user_chat = DB::table("users")->where("user_id", $user_client->user_two_id)->first();
    	}
    	else {
    		$user_chat = DB::table("users")->where("user_id", $user_client->user_id)->first();
    	}

    	//MENSAJES DE CHAT
    	$msn_chat = DB::table("messages")->where("chat_id", $user_client->chat_id)->get();
      $notificaciones = $this->getNotify();

		return view("site.chat", compact("channel", "user_chat", "msn_chat", "notificaciones"));

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


    public function messagesChat(Request $request)
    {
    	if (!$request->has("message") || !$request->has("canal") || !$request->has("socket_id")) {
    		return response()->json(["message" => "error"], 202);
    	}

    	date_default_timezone_set('America/Mexico_City');
        $date = date('Y-m-d h:i:s', time());

    	$options = array(
		    'cluster' => 'us2',
		    'useTLS' => true
		);

		$pusher = new Pusher(
		    'fa91802443afec1d96ac',
		    '0900c57c923b2096ffcd',
		    '955993',
		    $options
  		);

  		$data['mensaje'] = $request->message;
  		$data['hora'] = $date;
  		$evento = $request->canal."-message";
  		if ( $pusher->trigger($request->canal, $evento, $data, $request->socket_id) ) {

  			$canal = DB::table("chats_rooms")->where("token_chat", $request->canal)->first();

            //NOTIFICACIONES DE CHAT
            $primerMsj = DB::table("messages")->where("chat_id", $canal->chat_id)->first();
            if ($primerMsj == null) {
                DB::table("notifications")->insert([
                    "user_id" => $canal->user_two_id,
                    "typo_notify_id" => 1,
                    "other_user_id" => auth()->user()->user_id,
                    "created_at" => $date,
                ]);
            }

  			DB::table("messages")->insert([
  				"chat_id" => $canal->chat_id,
  				"user_id" => auth()->user()->user_id,
  				"message" => $request->message,
  				"created_at" => $date,
  				"updated_at" => $date
  			]);


  			return response()->json(["message" => "ok", "fecha" => $date], 202);
  		}
    }
}
