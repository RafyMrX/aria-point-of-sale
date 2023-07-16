<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    protected $guarded = ['created_at', 'updated_at'];
    
    public function cart(){
        return $this->hasMany('App\Models\Cart', 'id_product','id_product');
    }

    public function DetailSale(){
        return $this->hasMany('App\Models\DetailSale', 'id_product','id_product');
    }

    public function category(){
        return $this->hasOne('App\Models\Category', 'id_category','id_category');
    }

    public function barcode(){
        $kode = Product::orderBy('id_product', 'desc')->first();
        if(empty($kode)){
            $fr = "PR0001";
            $num = substr($fr, 2, 4);
            $add = (int) $num;
            $format =  $add.''.date('dmY');
        }else{
        $num = substr($kode->id_product, 2, 4);
        $add = (int) $num + 1;
        $format =  $add.''.date('dmY');
    }
    return $format;
}

    public function kd_product(){
        // 001
        $kode = Product::orderBy('id_product', 'desc')->first();
        if(empty($kode)){
            $format = "001";
        }else{
            $kode = $kode->id_product;
            $add = (int) $kode + 1;
            if(strlen($add) == 1){
                $format = "00".$add;
            }else if(strlen($add) == 2){
                $format = "0".$add;
            }
            else if(strlen($add) == 3){
                $format = $add;
            }
        }
        return $format;
    }
}
