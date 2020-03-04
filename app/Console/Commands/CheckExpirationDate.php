<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\SendMailExpirationDate;
use Illuminate\Support\Facades\Mail;
use DB;

class CheckExpirationDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checked:animals';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Se revisan los productos que ya expiro su plan y se manda correo a los propietarios';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        date_default_timezone_set('America/Mexico_City');
        $date = date('Y-m-d h:i:s', time());

        $sales = DB::table("sales")
                    ->join("users", "sales.user_id", "users.user_id")
                    ->join("animals", "sales.animal_id", "animals.animal_id")
                    ->select("sales.*", "users.*", "animals.name as name_animal")
                    ->where("sales.date_end", '<=', $date)
                    ->where("sales.disabled", 0)
                    ->get();


        if ($sales != null) {
            foreach ($sales as $sale) {
                try {
                    DB::table("sales")->where("sale_id", $sale->sale_id)->update(['disabled' => 1]);
                    Mail::to("853e9296af-b1cadc@inbox.mailtrap.io")->send(new SendMailExpirationDate($sale));
                } catch(Exception $e) {
                    \Log::error("El error de Email de Demonio. checando animales que ya expiro su plan ".$e->getMessage());
                }
            }
        }

    }
}
