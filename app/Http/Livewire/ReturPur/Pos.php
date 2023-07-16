<?php

namespace App\Http\Livewire\ReturPur;

use Livewire\Component;
use App\Models\Purchase;
use App\Models\DetailPur;
use Illuminate\Support\Facades\DB;

class Pos extends Component
{
    public $idSale, $tanggal, $admin, $retail, $status, $id_retail, $retailName, $qty = 0;

    public function render()
    {
        $faktur = Purchase::all();
        $sales = DetailPur::where('id_pur', $this->idSale)->get();
        return view('livewire.retur-pur.pos',  compact('faktur', 'sales'));
    }

    public function updatedidSale(){
        if($this->idSale != null){
          $data = Purchase::select('purchases.id AS id','purchases.date_pur AS date','suppliers.id_supplier AS sup_id','suppliers.name AS name_sup','purchases.id_pur AS pur_id',DB::raw('sum(detail_pur.qty) AS totalqty'),DB::raw('sum(detail_pur.qty_retur) AS qtyretur'),'detail_pur.qty_retur AS qty_retur','purchases.total_retur AS total_retur','purchases.created_at', 'users.name AS admin', 'suppliers.address AS retailAd','suppliers.tlp AS retailTel','suppliers.email AS retailem','products.id_product AS pid', 'detail_pur.qty AS qty','detail_pur.unit AS satuan','detail_pur.selling_price AS hargaJual','products.name AS nameP','detail_pur.capital_price AS hargamodal')
          ->join('detail_pur', 'detail_pur.id_pur', '=', 'purchases.id_pur')
          ->join('suppliers', 'suppliers.id_supplier', '=', 'detail_pur.id_supplier')
          ->join('products', 'products.id_product', '=', 'detail_pur.id_product')
          ->join('users', 'users.id_user', '=', 'detail_pur.id_user')
          ->having('purchases.id', $this->idSale)
          ->groupBy('detail_pur.capital_price','detail_pur.qty_retur','purchases.total_retur','purchases.id','purchases.id_pur', 'purchases.date_pur','suppliers.id_supplier', 'suppliers.name','purchases.created_at','users.name','suppliers.address', 'suppliers.tlp', 'suppliers.email','products.id_product','detail_pur.qty','detail_pur.unit','detail_pur.selling_price','products.name');

          $f = $data->first();
          $g = $data->get();
        //   $this->tanggal = $f->date;
        //   $this->admin = $f->admin;
        //   $this->id_retail = $f->sup_id;
        //   $this->retailName = $f->name_sup;

        }else{
            $this->tanggal = null;
        $this->admin = null;
        $this->id_retail = null;
        $this->retailName = null;

        }
    }


}
