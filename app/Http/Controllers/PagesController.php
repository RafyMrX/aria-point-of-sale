<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Sale;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
    public function units()
    {
        return view('units.index');
    }
    public function products()
    {
        return view('products.index');
    }
    public function sales()
    {
        return view('sales.index');
    }

    public function reportSales(){
        return view('laporan.sales');
    }

    public function reportPur(){
        return view('laporan.purchases');
    }

    public function purchese()
    {
        return view('purchese.index');
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

    public function returpur(){
        return view('pur_retur.index');
    }

    public function purnota($id){
        $sales = Purchase::select('purchases.total_retur AS jml_retur','purchases.id AS id','purchases.date_pur AS date_pur','suppliers.id_supplier AS sup_id','suppliers.name AS name_sup','purchases.id_pur AS pur_id',DB::raw('sum(detail_pur.qty) AS totalqty'),DB::raw('sum(detail_pur.qty_retur) AS qtyretur'),'detail_pur.qty_retur AS qty_retur','purchases.total_retur AS total_retur','purchases.created_at', 'users.name AS admin', 'suppliers.address AS retailAd','suppliers.tlp AS retailTel','suppliers.email AS retailem','products.id_product AS pid', 'detail_pur.qty AS qty','detail_pur.unit AS satuan','detail_pur.selling_price AS hargaJual','products.name AS nameP','detail_pur.capital_price AS hargamodal')
        ->join('detail_pur', 'detail_pur.id_pur', '=', 'purchases.id_pur')
        ->join('suppliers', 'suppliers.id_supplier', '=', 'detail_pur.id_supplier')
        ->join('products', 'products.id_product', '=', 'detail_pur.id_product')
        ->join('users', 'users.id_user', '=', 'detail_pur.id_user')
        ->having('purchases.id', $id)
        ->groupBy('purchases.total_retur','detail_pur.capital_price','detail_pur.qty_retur','purchases.total_retur','purchases.id','purchases.id_pur', 'purchases.date_pur','suppliers.id_supplier', 'suppliers.name','purchases.created_at','users.name','suppliers.address', 'suppliers.tlp', 'suppliers.email','products.id_product','detail_pur.qty','detail_pur.unit','detail_pur.selling_price','products.name')->first();

        $data = Purchase::select('purchases.id AS id','purchases.date_pur AS date_pur','suppliers.id_supplier AS sup_id','suppliers.name AS name_sup','purchases.id_pur AS pur_id',DB::raw('sum(detail_pur.qty) AS totalqty'),DB::raw('sum(detail_pur.qty_retur) AS qtyretur'),'detail_pur.qty_retur AS qty_retur','purchases.total_retur AS total_retur','purchases.created_at', 'users.name AS admin', 'suppliers.address AS retailAd','suppliers.tlp AS retailTel','suppliers.email AS retailem','products.id_product AS pid', 'detail_pur.qty AS qty','detail_pur.unit AS satuan','detail_pur.selling_price AS hargaJual','products.name AS nameP','detail_pur.capital_price AS hargamodal')
        ->join('detail_pur', 'detail_pur.id_pur', '=', 'purchases.id_pur')
        ->join('suppliers', 'suppliers.id_supplier', '=', 'detail_pur.id_supplier')
        ->join('products', 'products.id_product', '=', 'detail_pur.id_product')
        ->join('users', 'users.id_user', '=', 'detail_pur.id_user')
        ->having('purchases.id', $id)
        ->groupBy('detail_pur.capital_price','detail_pur.qty_retur','purchases.total_retur','purchases.id','purchases.id_pur', 'purchases.date_pur','suppliers.id_supplier', 'suppliers.name','purchases.created_at','users.name','suppliers.address', 'suppliers.tlp', 'suppliers.email','products.id_product','detail_pur.qty','detail_pur.unit','detail_pur.selling_price','products.name')->get();

        return view('purchese.nota', compact('sales', 'data'));
    }

    public function purturnota($id){
        $sales = Purchase::select('purchases.total_retur AS jml_retur','purchases.id AS id','purchases.date_pur AS date_pur','suppliers.id_supplier AS sup_id','suppliers.name AS name_sup','purchases.id_pur AS pur_id',DB::raw('sum(detail_pur.qty) AS totalqty'),DB::raw('sum(detail_pur.qty_retur) AS qtyretur'),'detail_pur.qty_retur AS qty_retur','purchases.total_retur AS total_retur','purchases.created_at', 'users.name AS admin', 'suppliers.address AS retailAd','suppliers.tlp AS retailTel','suppliers.email AS retailem','products.id_product AS pid', 'detail_pur.qty AS qty','detail_pur.unit AS satuan','detail_pur.selling_price AS hargaJual','products.name AS nameP','detail_pur.capital_price AS hargamodal')
        ->join('detail_pur', 'detail_pur.id_pur', '=', 'purchases.id_pur')
        ->join('suppliers', 'suppliers.id_supplier', '=', 'detail_pur.id_supplier')
        ->join('products', 'products.id_product', '=', 'detail_pur.id_product')
        ->join('users', 'users.id_user', '=', 'detail_pur.id_user')
        ->having('purchases.id', $id)
        ->groupBy('purchases.total_retur','detail_pur.capital_price','detail_pur.qty_retur','purchases.total_retur','purchases.id','purchases.id_pur', 'purchases.date_pur','suppliers.id_supplier', 'suppliers.name','purchases.created_at','users.name','suppliers.address', 'suppliers.tlp', 'suppliers.email','products.id_product','detail_pur.qty','detail_pur.unit','detail_pur.selling_price','products.name')->first();

        $data = Purchase::select('purchases.id AS id','purchases.date_pur AS date_pur','suppliers.id_supplier AS sup_id','suppliers.name AS name_sup','purchases.id_pur AS pur_id',DB::raw('sum(detail_pur.qty) AS totalqty'),DB::raw('sum(detail_pur.qty_retur) AS qtyretur'),'detail_pur.qty_retur AS qty_retur','purchases.total_retur AS total_retur','purchases.created_at', 'users.name AS admin', 'suppliers.address AS retailAd','suppliers.tlp AS retailTel','suppliers.email AS retailem','products.id_product AS pid', 'detail_pur.qty AS qty','detail_pur.unit AS satuan','detail_pur.selling_price AS hargaJual','products.name AS nameP','detail_pur.capital_price AS hargamodal')
        ->join('detail_pur', 'detail_pur.id_pur', '=', 'purchases.id_pur')
        ->join('suppliers', 'suppliers.id_supplier', '=', 'detail_pur.id_supplier')
        ->join('products', 'products.id_product', '=', 'detail_pur.id_product')
        ->join('users', 'users.id_user', '=', 'detail_pur.id_user')
        ->having('purchases.id', $id)
        ->groupBy('detail_pur.capital_price','detail_pur.qty_retur','purchases.total_retur','purchases.id','purchases.id_pur', 'purchases.date_pur','suppliers.id_supplier', 'suppliers.name','purchases.created_at','users.name','suppliers.address', 'suppliers.tlp', 'suppliers.email','products.id_product','detail_pur.qty','detail_pur.unit','detail_pur.selling_price','products.name')->get();

        return view('purchese.notaretur', compact('sales', 'data'));
    }

public function exdb(){
// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$database_name = "aria_pointofsale";

// Connect ke database
$conn = mysqli_connect($host, $username, $password, $database_name);
$conn->set_charset("utf8");

// Mendapatkan tabel yang terdapat dalam database
$tables = array();
$sql = "SHOW TABLES";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_row($result)) {
   $tables[] = $row[0];
}

$sqlScript = "";
foreach ($tables as $table) {
// Persiapan script untuk pembuatan struktur tabel
   $query = "SHOW CREATE TABLE $table";
   $result = mysqli_query($conn, $query);
   $row = mysqli_fetch_row($result);
   
   $sqlScript .= "\n\n" . $row[1] . ";\n\n";
   
   
   $query = "SELECT * FROM $table";
   $result = mysqli_query($conn, $query);
   
   $columnCount = mysqli_num_fields($result);
   
// Script untuk backup setiap tabel
   for ($i = 0; $i < $columnCount; $i ++) {
       while ($row = mysqli_fetch_row($result)) {
           $sqlScript .= "INSERT INTO $table VALUES(";
           for ($j = 0; $j < $columnCount; $j ++) {
               $row[$j] = $row[$j];
               
               if (isset($row[$j])) {
                   $sqlScript .= '"' . $row[$j] . '"';
               } else {
                   $sqlScript .= '""';
               }
               if ($j < ($columnCount - 1)) {
                   $sqlScript .= ',';
               }
           }
           $sqlScript .= ");\n";
       }
   }
   $sqlScript .= "\n";
}

if(!empty($sqlScript)) {
// Simpan sql script ke file backup
   $backup_file_name = $database_name . '_backup_' . time() . '.sql';
   $fileHandler = fopen($backup_file_name, 'w+');
   $number_of_lines = fwrite($fileHandler, $sqlScript);
   fclose($fileHandler);

// Download file backup melalui browser
   header('Content-Description: File Transfer');
   header('Content-Type: application/octet-stream');
   header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
   header('Content-Transfer-Encoding: binary');
   header('Expires: 0');
   header('Cache-Control: must-revalidate');
   header('Pragma: public');
   header('Content-Length: ' . filesize($backup_file_name));
   ob_clean();
   flush();
   readfile($backup_file_name);
   exec('rm ' . $backup_file_name);
}

    }

}
