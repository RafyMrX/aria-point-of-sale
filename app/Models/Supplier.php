<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = "suppliers";
    protected $guarded = ['created_at', 'updated_at'];
  
    public function kd_supplier(){
        $kode = Supplier::orderBy('id_supplier', 'desc')->first();
        if(empty($kode)){
            $format = "SP0001";
        }else{
            $kode = $kode->id_supplier;
            $num = substr($kode, 2, 4);
            $add = (int) $num + 1;
            if(strlen($add) == 1){
                $format = "SP000".$add;
            }else if(strlen($add) == 2){
                $format = "SP00".$add;
            }
            else if(strlen($add) == 3){
                $format = "SP0".$add;
            }else{
                $format = "SP".$add;
            }
        }
        return $format;
    }
}
