<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPur extends Model
{
    protected $table = "detail_pur";
    protected $guarded = ['created_at', 'updated_at'];
}