<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    protected $guarded = ['created_at', 'updated_at'];
    
    public function category(){
        return $this->hasOne('App\Models\Category', 'id_category','id_category');
    }

    public function kd_product(){
        $kode = Product::orderBy('id_product', 'desc')->first();
        if(empty($kode)){
            $format = "PR0001";
        }else{
            $kode = $kode->id_product;
            $num = substr($kode, 2, 4);
            $add = (int) $num + 1;
            if(strlen($add) == 1){
                $format = "PR000".$add;
            }else if(strlen($add) == 2){
                $format = "PR00".$add;
            }
            else if(strlen($add) == 3){
                $format = "PR0".$add;
            }else{
                $format = "PR".$add;
            }
        }
        return $format;
    }
}
