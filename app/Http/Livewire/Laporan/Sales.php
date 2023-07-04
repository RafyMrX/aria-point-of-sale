<?php

namespace App\Http\Livewire\Laporan;

use App\Models\Retail;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Sales extends Component
{
    public $from, $to, $id_retail, $alls= [];
    public function render()
    {
        $retails = Retail::where('status', 1)->get();
        foreach($retails as $item){
            $this->alls[] = $item->id_retail;
        }
        if($this->id_retail == 1){
        $data =  Sale::select('sales.id AS id','sales.date_sale','retails.id_retail AS retail_id','retails.name AS name_retail','sales.id_sale AS sale_id',DB::raw('sum(detail_sales.qty) AS totalqty'),DB::raw('sum(detail_sales.qty_retur) AS qtyretur'),'sales.total_retur AS total_retur','sales.total AS total_kotor','sales.total_bersih AS total_bersih','sales.total_modal AS total_modal','sales.status AS status','sales.created_at', 'users.name AS admin','sales.comment AS ket','sales.jml_retur AS jml_retur','detail_sales.id_retail')
        ->join('detail_sales', 'detail_sales.id_sale', '=', 'sales.id_sale')
        ->join('retails', 'retails.id_retail', '=', 'detail_sales.id_retail')
        ->join('products', 'products.id_product', '=', 'detail_sales.id_product')
        ->join('users', 'users.id_user', '=', 'detail_sales.id_user')
        ->whereBetween('sales.date_sale', [$this->from.' 00:00:00', $this->to.' 23:59:59'])
        ->whereIn('detail_sales.id_retail', $this->alls)
        // ->where('id_sale', 'LIKE', '%'.$this->searchTerm.'%')
        ->groupBy('detail_sales.id_retail','sales.total_modal','sales.total_bersih','sales.jml_retur','sales.total_retur','sales.id','sales.id_sale', 'sales.date_sale','retails.id_retail', 'retails.name', 'sales.total','sales.status','sales.created_at','users.name', 'sales.comment')->orderBy('sales.date_sale', 'desc')->get();
        }else{
            $data =  Sale::select('sales.id AS id','sales.date_sale','retails.id_retail AS retail_id','retails.name AS name_retail','sales.id_sale AS sale_id',DB::raw('sum(detail_sales.qty) AS totalqty'),DB::raw('sum(detail_sales.qty_retur) AS qtyretur'),'sales.total_retur AS total_retur','sales.total AS total_kotor','sales.total_bersih AS total_bersih','sales.total_modal AS total_modal','sales.status AS status','sales.created_at', 'users.name AS admin','sales.comment AS ket','sales.jml_retur AS jml_retur','detail_sales.id_retail')
        ->join('detail_sales', 'detail_sales.id_sale', '=', 'sales.id_sale')
        ->join('retails', 'retails.id_retail', '=', 'detail_sales.id_retail')
        ->join('products', 'products.id_product', '=', 'detail_sales.id_product')
        ->join('users', 'users.id_user', '=', 'detail_sales.id_user')
        ->whereBetween('sales.date_sale', [$this->from.' 00:00:00', $this->to.' 23:59:59'])
        ->where('detail_sales.id_retail', $this->id_retail)
        // ->where('id_sale', 'LIKE', '%'.$this->searchTerm.'%')
        ->groupBy('detail_sales.id_retail','sales.total_modal','sales.total_bersih','sales.jml_retur','sales.total_retur','sales.id','sales.id_sale', 'sales.date_sale','retails.id_retail', 'retails.name', 'sales.total','sales.status','sales.created_at','users.name', 'sales.comment')->orderBy('sales.date_sale', 'desc')->get();
        }
        return view('livewire.laporan.sales', compact('data','retails'));
    }
}
