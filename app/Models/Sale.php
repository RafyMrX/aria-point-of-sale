<?php

namespace App\Models;

use DateTimeZone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = "sales";
    protected $guarded = ['created_at', 'updated_at'];


    public function DetailSale(){
        return $this->hasMany('App\Models\DetailSale', 'id_sale','id_sale');
    }

    public function admin(){
        $admin = 'amir';
        return $admin;
    }

    public function datenow(){
        $date = date('Y-m-d H:i:s');

        return $date;
    }

    public function dateSale(){
            // date 
    //Creating a DateTime object
      $tz = 'Asia/Jakarta';   
      $date_time_Obj = date_create(date('Y-m-d'), new DateTimeZone($tz));
    //formatting the date to print it
     $format = date_format($date_time_Obj, "d-F-Y");

     return $format;
    }

    public function kd_sale(){
        // INV/J/30062023/0001
        $text ='INV/J/';
        $date = date('dmY').'/';
        $kode = Sale::orderBy('id_sale', 'desc')->first();
        if(empty($kode)){
            $format = $text.''.$date.'0001';
        }else{
            $kode = $kode->id_sale;
            $num = substr($kode, 15, 4);
            $add = (int) $num + 1;
            if(strlen($add) == 1){
                $format = $text."".$date.""."000".$add;
            }else if(strlen($add) == 2){
                $format = $text."".$date.""."00".$add;
            }
            else if(strlen($add) == 3){
                $format = $text."".$date.""."0".$add;
            }else{
                $format = $text."".$date."".$add;
            }
        }
        return $format;
    }
}
