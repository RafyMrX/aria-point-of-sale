<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $guarded = ['created_at', 'updated_at'];
  
    public function kd_category(){
        $kode = Category::orderBy('id_category', 'desc')->first();
        if(empty($kode)){
            $format = "K0001";
        }else{
            $kode = $kode->id_category;
            $num = substr($kode, 1, 4);
            $add = (int) $num + 1;
            if(strlen($add) == 1){
                $format = "K000".$add;
            }else if(strlen($add) == 2){
                $format = "K00".$add;
            }
            else if(strlen($add) == 3){
                $format = "K0".$add;
            }else{
                $format = "K".$add;
            }
        }
        return $format;
    }
}
