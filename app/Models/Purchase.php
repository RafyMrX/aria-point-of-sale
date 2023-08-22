<?php

namespace App\Models;

use DateTimeZone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    protected $table = "purchases";
    protected $guarded = ['created_at', 'updated_at'];

    
    public function admin(){
        $admin =  auth()->user()->name ;
        return $admin;
    }

    public function idAdmin(){
        $id =  auth()->user()->id_user ;
        return $id;
    }

    public function datenow(){
        $date = date('Y-m-d H:i:s');

        return $date;
    }

    public function datePur(){
            // date 
    //Creating a DateTime object
      $tz = 'Asia/Jakarta';   
      $date_time_Obj = date_create(date('Y-m-d'), new DateTimeZone($tz));
    //formatting the date to print it
     $format = date_format($date_time_Obj, "d-F-Y");

     return $format;
    }

    public function kd_pur($tgl){
        // INV/J/30062023/0001
        $text ='INV/B/';
        if(empty($tgl)){
            $date = '00000000'.'/';
        }else{
            $date = str_replace('-','',$tgl).'/';
        }
        $kode = Purchase::orderBy('id', 'desc')->first();
        if(empty($kode)){
            $format = $text.''.$date.'0001';
        }else{
            $kode = $kode->id_pur;
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
