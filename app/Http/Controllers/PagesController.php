<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function suppliers()
    {
        return view('suppliers.index');
    }

    public function retails()
    {
        return view('retails.index');
    }
    public function categories()
    {
        return view('categories.index');
    }
    public function products()
    {
        return view('products.index');
    }
}
