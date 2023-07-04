<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\DB;

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
    public function sales()
    {
        return view('sales.index');
    }
    public function salespdf($id){
        
        $sales = Sale::select('sales.id AS id','sales.date_sale AS dateSale','retails.id_retail AS retail_id','retails.name AS name_retail','sales.id_sale AS sale_id',DB::raw('sum(detail_sales.qty) AS totalqty'),'sales.total AS totalSales','sales.status AS status','sales.created_at', 'users.name AS admin', 'retails.address AS retailAd','retails.tlp AS retailTel','retails.email AS retailem','products.id_product AS pid', 'detail_sales.qty AS qty','detail_sales.unit AS satuan','detail_sales.selling_price AS hargaJual','products.name AS nameP', 'sales.comment AS ket')
        ->join('detail_sales', 'detail_sales.id_sale', '=', 'sales.id_sale')
        ->join('retails', 'retails.id_retail', '=', 'detail_sales.id_retail')
        ->join('products', 'products.id_product', '=', 'detail_sales.id_product')
        ->join('users', 'users.id_user', '=', 'detail_sales.id_user')
        ->having('sales.id', $id)
        ->groupBy('sales.id','sales.id_sale', 'sales.date_sale','retails.id_retail', 'retails.name', 'sales.total','sales.status','sales.created_at','users.name','retails.address', 'retails.tlp', 'retails.email','products.id_product','detail_sales.qty','detail_sales.unit','detail_sales.selling_price','products.name', 'sales.comment')->first();

        $data = Sale::select('sales.id AS id','sales.date_sale AS dateSale','retails.id_retail AS retail_id','retails.name AS name_retail','sales.id_sale AS sale_id',DB::raw('sum(detail_sales.qty) AS totalqty'),'sales.total AS totalSales','sales.status AS status','sales.created_at', 'users.name AS admin', 'retails.address AS retailAd','retails.tlp AS retailTel','retails.email AS retailem','products.id_product AS pid', 'detail_sales.qty AS qty','detail_sales.unit AS satuan','detail_sales.selling_price AS hargaJual','products.name AS nameP')
        ->join('detail_sales', 'detail_sales.id_sale', '=', 'sales.id_sale')
        ->join('retails', 'retails.id_retail', '=', 'detail_sales.id_retail')
        ->join('products', 'products.id_product', '=', 'detail_sales.id_product')
        ->join('users', 'users.id_user', '=', 'detail_sales.id_user')
        ->having('sales.id', $id)
        ->groupBy('sales.id','sales.id_sale', 'sales.date_sale','retails.id_retail', 'retails.name', 'sales.total','sales.status','sales.created_at','users.name','retails.address', 'retails.tlp', 'retails.email','products.id_product','detail_sales.qty','detail_sales.unit','detail_sales.selling_price','products.name')->get();
        // $pdf = \PDF::loadview('sales.nota', compact('sales','data'))->setPaper('A4','potrait');
        // return $pdf->stream('test.pdf');
        return view('sales.nota', compact('sales','data'));
    }

    public function returpdf($id){
        $sales = Sale::select('sales.id AS id','sales.date_sale AS dateSale','retails.id_retail AS retail_id','retails.name AS name_retail','sales.id_sale AS sale_id',DB::raw('sum(detail_sales.qty) AS totalqty'),'sales.total AS totalSales','sales.status AS status','sales.created_at', 'users.name AS admin', 'retails.address AS retailAd','retails.tlp AS retailTel','retails.email AS retailem','products.id_product AS pid', 'detail_sales.qty AS qty','detail_sales.unit AS satuan','detail_sales.selling_price AS hargaJual','products.name AS nameP', 'sales.comment AS ket')
        ->join('detail_sales', 'detail_sales.id_sale', '=', 'sales.id_sale')
        ->join('retails', 'retails.id_retail', '=', 'detail_sales.id_retail')
        ->join('products', 'products.id_product', '=', 'detail_sales.id_product')
        ->join('users', 'users.id_user', '=', 'detail_sales.id_user')
        ->having('sales.id', $id)
        ->groupBy('sales.id','sales.id_sale', 'sales.date_sale','retails.id_retail', 'retails.name', 'sales.total','sales.status','sales.created_at','users.name','retails.address', 'retails.tlp', 'retails.email','products.id_product','detail_sales.qty','detail_sales.unit','detail_sales.selling_price','products.name', 'sales.comment')->first();

        $data = Sale::select('sales.id AS id','sales.date_sale AS dateSale','retails.id_retail AS retail_id','retails.name AS name_retail','sales.id_sale AS sale_id',DB::raw('sum(detail_sales.qty) AS totalqty'),DB::raw('sum(detail_sales.qty_retur) AS qtyretur'),'detail_sales.qty_retur AS qty_retur','sales.total AS totalSales','sales.total_retur AS total_retur','sales.status AS status','sales.created_at', 'users.name AS admin', 'retails.address AS retailAd','retails.tlp AS retailTel','retails.email AS retailem','products.id_product AS pid', 'detail_sales.qty AS qty','detail_sales.unit AS satuan','detail_sales.selling_price AS hargaJual','products.name AS nameP')
        ->join('detail_sales', 'detail_sales.id_sale', '=', 'sales.id_sale')
        ->join('retails', 'retails.id_retail', '=', 'detail_sales.id_retail')
        ->join('products', 'products.id_product', '=', 'detail_sales.id_product')
        ->join('users', 'users.id_user', '=', 'detail_sales.id_user')
        ->having('sales.id', $id)
        ->groupBy('detail_sales.qty_retur','sales.total_retur','sales.id','sales.id_sale', 'sales.date_sale','retails.id_retail', 'retails.name', 'sales.total','sales.status','sales.created_at','users.name','retails.address', 'retails.tlp', 'retails.email','products.id_product','detail_sales.qty','detail_sales.unit','detail_sales.selling_price','products.name')->get();
   
        return view('sales_retur.notaretur', compact('sales', 'data'));
    }

    public function retursales(){
        return view('sales_retur.index');
    }
}
