<?php

namespace App\Http\Livewire\Laporan;

use Livewire\Component;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

class Purchases extends Component
{
    public $from, $to, $id_supplier, $alls= [];
    public function render()
    {
        $suppliers = Supplier::all();
        foreach($suppliers as $item){
            $this->alls[] = $item->id_supplier;
        }

        if($this->id_supplier == 1){
            $data =  Purchase::select('purchases.id AS id','purchases.date_pur','suppliers.id_supplier AS supplier_id','suppliers.name AS name_supplier','purchases.id_pur AS pur_id',DB::raw('sum(detail_pur.qty) AS totalqty'),DB::raw('sum(detail_pur.qty_retur) AS qtyretur'),'purchases.total_retur AS total_retur','purchases.total_beli AS total_beli','purchases.jml_bayar AS jml_bayar','purchases.created_at', 'users.name AS admin','purchases.comment AS ket','detail_pur.id_supplier')
            ->join('detail_pur', 'detail_pur.id_pur', '=', 'purchases.id_pur')
            ->join('suppliers', 'suppliers.id_supplier', '=', 'detail_pur.id_supplier')
            ->join('products', 'products.id_product', '=', 'detail_pur.id_product')
            ->join('users', 'users.id_user', '=', 'detail_pur.id_user')
            ->whereBetween('purchases.date_pur', [$this->from.' 00:00:00', $this->to.' 23:59:59'])
            ->whereIn('detail_pur.id_supplier', $this->alls)
            // ->where('id_pur', 'LIKE', '%'.$this->searchTerm.'%')
            ->groupBy('purchases.jml_bayar','purchases.total_beli','purchases.id_pur','purchases.date_pur','detail_pur.id_supplier','purchases.total_retur','purchases.id','purchases.id_pur', 'purchases.date_pur','suppliers.id_supplier', 'suppliers.name','purchases.created_at','users.name', 'purchases.comment')->orderBy('purchases.date_pur', 'desc')->get();
        }else{
            $data =  Purchase::select('purchases.id AS id','purchases.date_pur','suppliers.id_supplier AS supplier_id','suppliers.name AS name_supplier','purchases.id_pur AS pur_id',DB::raw('sum(detail_pur.qty) AS totalqty'),DB::raw('sum(detail_pur.qty_retur) AS qtyretur'),'purchases.total_retur AS total_retur','purchases.total_beli AS total_beli','purchases.jml_bayar AS jml_bayar','purchases.created_at', 'users.name AS admin','purchases.comment AS ket','detail_pur.id_supplier')
            ->join('detail_pur', 'detail_pur.id_pur', '=', 'purchases.id_pur')
            ->join('suppliers', 'suppliers.id_supplier', '=', 'detail_pur.id_supplier')
            ->join('products', 'products.id_product', '=', 'detail_pur.id_product')
            ->join('users', 'users.id_user', '=', 'detail_pur.id_user')
            ->whereBetween('purchases.date_pur', [$this->from.' 00:00:00', $this->to.' 23:59:59'])
            ->where('detail_pur.id_supplier', $this->id_supplier)
            // ->where('id_pur', 'LIKE', '%'.$this->searchTerm.'%')
            ->groupBy('purchases.jml_bayar','purchases.total_beli','purchases.id_pur','purchases.date_pur','detail_pur.id_supplier','purchases.total_retur','purchases.id','purchases.id_pur', 'purchases.date_pur','suppliers.id_supplier', 'suppliers.name','purchases.created_at','users.name', 'purchases.comment')->orderBy('purchases.date_pur', 'desc')->get();
        }
        return view('livewire.laporan.purchases', compact('data','suppliers'));
    }
}
