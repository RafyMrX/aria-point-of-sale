<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retail extends Model
{
    protected $table = "retails";
    protected $guarded = ['created_at', 'updated_at'];
  
    public function kd_retail(){
        $kode = Retail::orderBy('id_retail', 'desc')->first();
        if(empty($kode)){
            $format = "RT0001";
        }else{
            $kode = $kode->id_retail;
            $num = substr($kode, 2, 4);
            $add = (int) $num + 1;
            if(strlen($add) == 1){
                $format = "RT000".$add;
            }else if(strlen($add) == 2){
                $format = "RT00".$add;
            }
            else if(strlen($add) == 3){
                $format = "RT0".$add;
            }else{
                $format = "RT".$add;
            }
        }
        return $format;
    }
}
