<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSale extends Model
{
    protected $table = "detail_sales";
    protected $guarded = ['created_at', 'updated_at'];

}
