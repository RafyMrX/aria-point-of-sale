<?php

namespace App\Http\Livewire\Retur;

use App\Models\DetailSale;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Pos extends Component
{
    public $idSale, $tanggal, $admin, $retail, $status, $id_retail, $retailName, $qty = 0;

    public function render()
    {
        $faktur = Sale::all();
        $sales = DetailSale::where('id_sale', $this->idSale)->get();
        return view('livewire.retur.pos', compact('faktur', 'sales'));
    }

    public function decQty($id_sale, $id_product)
    {
        $this->idSale=$id_sale;
        $data = DetailSale::where('id_sale',$id_sale)->where('id_product', $id_product)->first();
        if($data){
            $data->decrement('qty_retur');
            // $products = Product::where('id_product', $id_product)->first();
            // $products->decrement('qty');
        }
    }

    public function incQty($id_sale, $id_product)
    {

        $this->idSale=$id_sale;
        $data = DetailSale::where('id_sale',$id_sale)->where('id_product', $id_product)->first();
        if($data){
            $data->increment('qty_retur');
            // $data->decrement('qty');
            // $products = Product::where('id_product', $id_product)->first();
            // $products->increment('qty');
        
        }
    }
    
    public function resetButton($idSale){
        DetailSale::where('id_sale', $idSale)->update([
            'qty_retur' => 0
        ]);
        Sale::where('id_sale', $idSale)->update([
            'total_retur' => 0
        ]);
    }

    public function retur($id, $t_retur,$t_total, $bersih,$submodal){
        $sales = DetailSale::where('id_sale', $id)->get();
        foreach($sales as $sale){
            Product::where('id_product', $sale->id_product)->update([
                'qty' =>  $sale->product['qty']+$sale->qty_retur
            ]);
        }
        Sale::where('id_sale',$id)->update([
            'jml_retur' => $t_retur,
            'total_retur' => $t_total-$t_retur,
            'total' => $t_total-$t_retur,
            'total_bersih' => $bersih,
            'total_modal' => $submodal
        ]);

        $this->dispatchBrowserEvent('swal',['data' => 'Retur Berhasil!']);

    }

    public function updatedidSale(){
    if($this->idSale != null){
        $data =  Sale::select('sales.id AS id','sales.date_sale AS dateSale','retails.id_retail AS retail_id','retails.name AS name_retail','sales.id_sale AS sale_id',DB::raw('sum(detail_sales.qty) AS totalqty'),'sales.total AS totalSales','sales.status AS status','sales.created_at', 'users.name AS admin', 'retails.address AS retailAd','retails.tlp AS retailTel','retails.email AS retailem','products.id_product AS pid', 'detail_sales.qty AS qty','detail_sales.unit AS satuan','detail_sales.selling_price AS hargaJual','products.name AS nameP','detail_sales.capital_price AS hargamodal')
        ->join('detail_sales', 'detail_sales.id_sale', '=', 'sales.id_sale')
        ->join('retails', 'retails.id_retail', '=', 'detail_sales.id_retail')
        ->join('products', 'products.id_product', '=', 'detail_sales.id_product')
        ->join('users', 'users.id_user', '=', 'detail_sales.id_user')
        ->having('sales.id_sale', $this->idSale)
        ->groupBy('detail_sales.capital_price','sales.id','sales.id_sale', 'sales.date_sale','retails.id_retail', 'retails.name', 'sales.total','sales.status','sales.created_at','users.name','retails.address', 'retails.tlp', 'retails.email','products.id_product','detail_sales.qty','detail_sales.unit','detail_sales.selling_price','products.name');
 
        $f = $data->first();
        $g = $data->get();
        $this->tanggal = $f->dateSale;
        $this->admin = $f->admin;
        $this->id_retail = $f->retail_id;
        $this->retailName = $f->name_retail;
        $this->status = $f->status;
      

    }else{
        $this->tanggal = null;
        $this->admin = null;
        $this->id_retail = null;
        $this->retailName = null;
        $this->status = null;
    }

    }
}
