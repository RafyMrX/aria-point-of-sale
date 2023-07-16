<?php

namespace App\Http\Livewire\Purchese;

use App\Models\Purchase;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Show extends Component
{
        // Datatable 
        use WithPagination;
        public $stSales = null;
        public $sortColumnName = 'created_at', $sortDirection = 'desc', $searchTerm = null, $showData = 5, $selectedRows = [], $selectedPageRows = false;
        protected $paginationTheme = 'bootstrap';
        protected $queryString = ['searchTerm' => ['except' => '']];
           // date range
    public $from =null, $to = null;
       // detail sales retail
       public $id_detail = null;
       public $retailName, $retailAddress, $retailTlp, $retailEmail;

           // detail sales 
   public $idSale, $dateSale, $status, $grandTotal, $total, $qty, $cPrice, $sPrice,$diskon, $comment;
      // detail sales produk
      public $id_product, $productName, $satuan;
      // detail sales admin
      public $nameAdmin;

      public  $stRetur;

      public function cancel(){
        $this->resetInput();
}

    public function render()
    {
        $pur = $this->dataList();

          // UNTUK MODAL
          $data = Purchase::select('purchases.id AS id','purchases.date_pur AS date_pur','suppliers.id_supplier AS sup_id','suppliers.name AS name_sup','purchases.id_pur AS pur_id',DB::raw('sum(detail_pur.qty) AS totalqty'),DB::raw('sum(detail_pur.qty_retur) AS qtyretur'),'detail_pur.qty_retur AS qty_retur','purchases.total_retur AS total_retur','purchases.created_at', 'users.name AS admin', 'suppliers.address AS retailAd','suppliers.tlp AS retailTel','suppliers.email AS retailem','products.id_product AS pid', 'detail_pur.qty AS qty','detail_pur.unit AS satuan','detail_pur.selling_price AS hargaJual','products.name AS nameP','detail_pur.capital_price AS hargamodal')
          ->join('detail_pur', 'detail_pur.id_pur', '=', 'purchases.id_pur')
          ->join('suppliers', 'suppliers.id_supplier', '=', 'detail_pur.id_supplier')
          ->join('products', 'products.id_product', '=', 'detail_pur.id_product')
          ->join('users', 'users.id_user', '=', 'detail_pur.id_user')
          ->having('purchases.id', $this->id_detail)
          ->groupBy('detail_pur.capital_price','detail_pur.qty_retur','purchases.total_retur','purchases.id','purchases.id_pur', 'purchases.date_pur','suppliers.id_supplier', 'suppliers.name','purchases.created_at','users.name','suppliers.address', 'suppliers.tlp', 'suppliers.email','products.id_product','detail_pur.qty','detail_pur.unit','detail_pur.selling_price','products.name')->get();

        return view('livewire.purchese.show', compact('pur','data'));
    }

    public function resetInput(){
        $this->reset(['retailName','retailAddress','retailTlp','retailEmail','idSale','dateSale','grandTotal','total','qty','cPrice','sPrice','id_product','productName', 'satuan']);
    }

    public function detailSales($id){
        $this->resetInput();
        $this->id_detail = $id;
        $sales = Purchase::select('purchases.total_retur AS jml_retur','purchases.id AS id','purchases.date_pur AS date_pur','suppliers.id_supplier AS sup_id','suppliers.name AS name_sup','purchases.id_pur AS pur_id',DB::raw('sum(detail_pur.qty) AS totalqty'),DB::raw('sum(detail_pur.qty_retur) AS qtyretur'),'detail_pur.qty_retur AS qty_retur','purchases.total_retur AS total_retur','purchases.created_at', 'users.name AS admin', 'suppliers.address AS retailAd','suppliers.tlp AS retailTel','suppliers.email AS retailem','products.id_product AS pid', 'detail_pur.qty AS qty','detail_pur.unit AS satuan','detail_pur.selling_price AS hargaJual','products.name AS nameP','detail_pur.capital_price AS hargamodal')
        ->join('detail_pur', 'detail_pur.id_pur', '=', 'purchases.id_pur')
        ->join('suppliers', 'suppliers.id_supplier', '=', 'detail_pur.id_supplier')
        ->join('products', 'products.id_product', '=', 'detail_pur.id_product')
        ->join('users', 'users.id_user', '=', 'detail_pur.id_user')
        ->having('purchases.id', $id)
        ->groupBy('purchases.total_retur','detail_pur.capital_price','detail_pur.qty_retur','purchases.total_retur','purchases.id','purchases.id_pur', 'purchases.date_pur','suppliers.id_supplier', 'suppliers.name','purchases.created_at','users.name','suppliers.address', 'suppliers.tlp', 'suppliers.email','products.id_product','detail_pur.qty','detail_pur.unit','detail_pur.selling_price','products.name')->first();

        if($sales){
            $this->stRetur = $sales->jml_retur;
            $this->retailName = $sales->name_sup;
            $this->retailAddress = $sales->retailAd;
            $this->retailTlp = $sales->retailTel;
            $this->retailEmail = $sales->retailem;
            $this->idSale = $sales->pur_id;
            $this->dateSale = $sales->date_pur;
            $this->nameAdmin = $sales->admin;
            $this->comment = $sales->ket;
         
          
            return  view('livewire.purchese.show');
        }else{
            return redirect()->to('/purchases');
        }

    }

    public function dataList(){

         if($this->from != null && $this->to != null){
            return Purchase::select('purchases.jml_bayar AS bayar','purchases.total_retur AS jml_retur','purchases.id AS id','purchases.date_pur','suppliers.id_supplier AS sup_id','suppliers.name AS name_sup','purchases.id_pur AS pur_id',DB::raw('sum(detail_pur.qty) AS totalqty'),DB::raw('sum(detail_pur.qty_retur) AS qtyretur'),'purchases.total_beli AS total_beli','purchases.created_at', 'users.name AS admin','purchases.comment AS ket')
            ->join('detail_pur', 'detail_pur.id_pur', '=', 'purchases.id_pur')
            ->join('suppliers', 'suppliers.id_supplier', '=', 'detail_pur.id_supplier')
            ->join('products', 'products.id_product', '=', 'detail_pur.id_product')
            ->join('users', 'users.id_user', '=', 'detail_pur.id_user')
            ->whereBetween('purchases.date_pur', [$this->from.' 00:00:00', $this->to.' 23:59:59'])
            // ->where('id_pur', 'LIKE', '%'.$this->searchTerm.'%')
            ->groupBy('purchases.jml_bayar','purchases.total_retur','purchases.total_beli','purchases.id','purchases.id_pur', 'purchases.date_pur','suppliers.id_supplier', 'suppliers.name','purchases.created_at','users.name','purchases.comment')
        //    ->orWhere('', 'LIKE', '%'.$this->searchTerm.'%')
        //    ->orWhere('barcode', 'LIKE', '%'.$this->searchTerm.'%')
        ->orderBy('created_at', 'desc')
           ->paginate($this->showData);
        }
        else if($this->stSales == null){
            return Purchase::select('purchases.jml_bayar AS bayar','purchases.total_retur AS jml_retur','purchases.id AS id','purchases.date_pur','suppliers.id_supplier AS sup_id','suppliers.name AS name_sup','purchases.id_pur AS pur_id',DB::raw('sum(detail_pur.qty) AS totalqty'),DB::raw('sum(detail_pur.qty_retur) AS qtyretur'),'purchases.total_beli AS total_beli','purchases.created_at', 'users.name AS admin','purchases.comment AS ket')
            ->join('detail_pur', 'detail_pur.id_pur', '=', 'purchases.id_pur')
            ->join('suppliers', 'suppliers.id_supplier', '=', 'detail_pur.id_supplier')
            ->join('products', 'products.id_product', '=', 'detail_pur.id_product')
            ->join('users', 'users.id_user', '=', 'detail_pur.id_user')
            ->having('name_sup', 'LIKE', '%'.$this->searchTerm.'%')
            ->orhaving('sup_id', 'LIKE', '%'.$this->searchTerm.'%')
            ->orhaving('pur_id', 'LIKE', '%'.$this->searchTerm.'%')
            // ->where('id_pur', 'LIKE', '%'.$this->searchTerm.'%')
            ->groupBy('purchases.jml_bayar','purchases.total_retur','purchases.total_beli','purchases.id','purchases.id_pur', 'purchases.date_pur','suppliers.id_supplier', 'suppliers.name','purchases.created_at','users.name','purchases.comment')
        //    ->orWhere('', 'LIKE', '%'.$this->searchTerm.'%')
        //    ->orWhere('barcode', 'LIKE', '%'.$this->searchTerm.'%')
             ->orderBy('created_at', 'desc')
           ->paginate($this->showData);
        }
    }
}
