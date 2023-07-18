<?php

namespace App\Http\Livewire\Sales;

use App\Models\DetailSale;
use App\Models\Retail;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

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
//  EDIT
    public $editJ = [], $editR = [], $editqty, $editqtyr, $editindex;
    public  $stRetur, $stEdit;
    
    // modal 
    public $stModal = 2;


    public function editData($index){
        $this->stEdit = $index;
    }

    public function updatededitJ(){
        foreach($this->editJ as $key => $value){
            $this->editqty = $this->editJ[$key];
            $this->editindex = $key;
        }
    }
    public function updatededitR(){
       
        foreach($this->editR as $key => $value){
            $this->editqtyr = $this->editR[$key];
            $this->editindex = $key;
        }
    }

    public function editD($qty, $qtyr, $id){
        if($qty != null){
            DetailSale::where('id', $id)->update([
                'qty' => $qty
            ]);

            $id_sale = DetailSale::where('id', $id)->first();
            $data = DetailSale::where('id_sale', $id_sale->id_sale)->get();
            

        }
        if($qtyr != null){

        }
       
    }

    public function render()
    {
        $allStatus = Sale::all()->count();
        $closing = Sale::where('status', 1)->count();
        $pending = Sale::where('status', 2)->count();
        $sales = $this->dataList();
        // UNTUK MODAL
        $data = Sale::select('detail_sales.id AS idD','detail_sales.id_product AS idp','sales.id AS id','sales.date_sale AS dateSale','retails.id_retail AS retail_id','retails.name AS name_retail','sales.id_sale AS sale_id',DB::raw('sum(detail_sales.qty) AS totalqty'),DB::raw('sum(detail_sales.qty_retur) AS qtyretur'),'detail_sales.qty_retur AS qty_retur','sales.total AS totalSales','sales.total_retur AS total_retur','sales.jml_retur AS jml_retur','sales.status AS status','sales.created_at', 'users.name AS admin', 'retails.address AS retailAd','retails.tlp AS retailTel','retails.email AS retailem','products.id_product AS pid', 'detail_sales.qty AS qty','detail_sales.unit AS satuan','detail_sales.selling_price AS hargaJual','products.name AS nameP','detail_sales.capital_price AS hargamodal')
        ->join('detail_sales', 'detail_sales.id_sale', '=', 'sales.id_sale')
        ->join('retails', 'retails.id_retail', '=', 'detail_sales.id_retail')
        ->join('products', 'products.id_product', '=', 'detail_sales.id_product')
        ->join('users', 'users.id_user', '=', 'detail_sales.id_user')
        ->having('sales.id', $this->id_detail)
        ->groupBy('detail_sales.id','detail_sales.id_product','detail_sales.capital_price','sales.jml_retur','detail_sales.qty_retur','sales.total_retur','sales.id','sales.id_sale', 'sales.date_sale','retails.id_retail', 'retails.name', 'sales.total','sales.status','sales.created_at','users.name','retails.address', 'retails.tlp', 'retails.email','products.id_product','detail_sales.qty','detail_sales.unit','detail_sales.selling_price','products.name')->get();
        
        return view('livewire.sales.show', compact('allStatus','closing','pending','sales', 'data'));
    }

    // public function daterange(){
    //     dd('here');
    // }

    public function resetInput(){
        $this->reset(['retailName','retailAddress','retailTlp','retailEmail','idSale','dateSale','status','grandTotal','total','qty','cPrice','sPrice','id_product','productName', 'satuan','diskon']);
    }
    public function cancel(){
        $this->resetInput();
}

    // SWITCH STATUS PENJUALAN PENDING/CLOSING
    public function switchStatus($id, $status){
        if($status == 1){
            $status = 2;
        }else{
            $status = 1;
        }
        Sale::where('id', $id)->update([
            'status' => $status
        ]);
    }

    public function switchModal($stModal){
        if($stModal == 1){
            $this->stModal = 2;
        }else{
            $this->stModal = 1;
        }
    }

    // detail modal
    public function detailSales($id){
     $this->resetInput();
     $this->id_detail = $id;
    
     $sales = Sale::select('sales.id AS id','sales.date_sale AS dateSale','retails.id_retail AS retail_id','retails.name AS name_retail','sales.id_sale AS sale_id',DB::raw('sum(detail_sales.qty) AS totalqty'),'sales.total AS totalSales','sales.total_retur AS total_retur','sales.jml_retur AS jml_retur','sales.status AS status','sales.created_at', 'users.name AS admin', 'retails.address AS retailAd','retails.tlp AS retailTel','retails.email AS retailem','products.id_product AS pid', 'detail_sales.qty AS qty','detail_sales.unit AS satuan','detail_sales.selling_price AS hargaJual','products.name AS nameP', 'sales.comment AS ket')
        ->join('detail_sales', 'detail_sales.id_sale', '=', 'sales.id_sale')
        ->join('retails', 'retails.id_retail', '=', 'detail_sales.id_retail')
        ->join('products', 'products.id_product', '=', 'detail_sales.id_product')
        ->join('users', 'users.id_user', '=', 'detail_sales.id_user')
        ->having('sales.id', $id)
        ->groupBy('sales.jml_retur','sales.total_retur','sales.id','sales.id_sale', 'sales.date_sale','retails.id_retail', 'retails.name', 'sales.total','sales.status','sales.created_at','users.name','retails.address', 'retails.tlp', 'retails.email','products.id_product','detail_sales.qty','detail_sales.unit','detail_sales.selling_price','products.name', 'sales.comment')->first();

        if($sales){
            $this->stRetur = $sales->jml_retur;
            $this->retailName = $sales->name_retail;
            $this->retailAddress = $sales->retailAd;
            $this->retailTlp = $sales->retailTel;
            $this->retailEmail = $sales->retailem;
            $this->idSale = $sales->sale_id;
            $this->dateSale = $sales->dateSale;
            $this->status = $sales->status;
            $this->nameAdmin = $sales->admin;
            $this->total = $sales->totalSales;
            $this->comment = $sales->ket;
         
          
            return  view('livewire.sales.show');
        }else{
            return redirect()->to('/sales');
        }
    }

     // DATATABLE
        // shorting
        public function sortBy($columnName){
            if($this->sortColumnName === $columnName){
                $this->sortDirection = $this->swapDirection();
            }else{
                $this->sortDirection = 'asc';
            }
            $this->sortColumnName = $columnName;
        }
    
        public function swapDirection(){
            return $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }
    
            // search
        public function updatedsearchTerm(){
                $this->resetPage();
                $this->stSales = null;
        }
        // showData page
        public function updatedshowData(){
                $this->resetPage();
                $this->stSales = null;
        }

         // filter by button
    public function filterStatus($st = null){
        $this->searchTerm = null;
        $this->from = null;
        $this->to = null;
        $this->stSales = $st;
    }

    public function dataList(){
        if($this->stSales != null){
    
            return Sale::when($this->stSales, function($query){
                 return $query->where('sales.status', $this->stSales);
            })
            ->select('sales.id AS id','sales.date_sale','retails.id_retail AS retail_id','retails.name AS name_retail','sales.id_sale AS sale_id',DB::raw('sum(detail_sales.qty) AS totalqty'),DB::raw('sum(detail_sales.qty_retur) AS qtyretur'), 'sales.total_retur AS total_retur','sales.jml_retur AS jml_retur','sales.comment AS ket','sales.total','sales.status AS status','sales.created_at', 'users.name AS admin')
            ->join('detail_sales', 'detail_sales.id_sale', '=', 'sales.id_sale')
            ->join('retails', 'retails.id_retail', '=', 'detail_sales.id_retail')
            ->join('products', 'products.id_product', '=', 'detail_sales.id_product')
            ->join('users', 'users.id_user', '=', 'detail_sales.id_user')
            ->groupBy('sales.jml_retur','sales.total_retur','sales.id','sales.id_sale', 'sales.date_sale','retails.id_retail', 'retails.name', 'sales.total','sales.status','sales.created_at','users.name', 'sales.comment')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->showData);
        }else if($this->from != null && $this->to != null){
            return Sale::select('sales.id AS id','sales.date_sale','retails.id_retail AS retail_id','retails.name AS name_retail','sales.id_sale AS sale_id',DB::raw('sum(detail_sales.qty) AS totalqty'),DB::raw('sum(detail_sales.qty_retur) AS qtyretur'),'sales.total_retur AS total_retur','sales.jml_retur AS jml_retur','sales.total','sales.status AS status','sales.created_at', 'users.name AS admin','sales.comment AS ket')
            ->join('detail_sales', 'detail_sales.id_sale', '=', 'sales.id_sale')
            ->join('retails', 'retails.id_retail', '=', 'detail_sales.id_retail')
            ->join('products', 'products.id_product', '=', 'detail_sales.id_product')
            ->join('users', 'users.id_user', '=', 'detail_sales.id_user')
            ->whereBetween('sales.date_sale', [$this->from.' 00:00:00', $this->to.' 23:59:59'])
            // ->where('id_sale', 'LIKE', '%'.$this->searchTerm.'%')
            ->groupBy('sales.jml_retur','sales.total_retur','sales.id','sales.id_sale', 'sales.date_sale','retails.id_retail', 'retails.name', 'sales.total','sales.status','sales.created_at','users.name','sales.comment')
        //    ->orWhere('', 'LIKE', '%'.$this->searchTerm.'%')
        //    ->orWhere('barcode', 'LIKE', '%'.$this->searchTerm.'%')
           ->orderBy($this->sortColumnName, $this->sortDirection)
           ->paginate($this->showData);
        }
        else if($this->stSales == null){
            return Sale::select('sales.id AS id','sales.date_sale','retails.id_retail AS retail_id','retails.name AS name_retail','sales.id_sale AS sale_id',DB::raw('sum(detail_sales.qty) AS totalqty'),DB::raw('sum(detail_sales.qty_retur) AS qtyretur'),'sales.total_retur AS total_retur','sales.total','sales.status AS status','sales.created_at', 'users.name AS admin','sales.comment AS ket','sales.jml_retur AS jml_retur')
            ->join('detail_sales', 'detail_sales.id_sale', '=', 'sales.id_sale')
            ->join('retails', 'retails.id_retail', '=', 'detail_sales.id_retail')
            ->join('products', 'products.id_product', '=', 'detail_sales.id_product')
            ->join('users', 'users.id_user', '=', 'detail_sales.id_user')
            ->having('name_retail', 'LIKE', '%'.$this->searchTerm.'%')
            ->orhaving('retail_id', 'LIKE', '%'.$this->searchTerm.'%')
            ->orhaving('sale_id', 'LIKE', '%'.$this->searchTerm.'%')
            // ->where('id_sale', 'LIKE', '%'.$this->searchTerm.'%')
            ->groupBy('sales.jml_retur','sales.total_retur','sales.id','sales.id_sale', 'sales.date_sale','retails.id_retail', 'retails.name', 'sales.total','sales.status','sales.created_at','users.name', 'sales.comment')
        //    ->orWhere('', 'LIKE', '%'.$this->searchTerm.'%')
        //    ->orWhere('barcode', 'LIKE', '%'.$this->searchTerm.'%')
           ->orderBy($this->sortColumnName, $this->sortDirection)
           ->paginate($this->showData);
        }
    }

    // public function dataLoop(){

    // }

    
}
