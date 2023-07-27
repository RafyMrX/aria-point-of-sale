<?php

namespace App\Http\Livewire\Sales;

use App\Models\Cart;
use App\Models\DetailSale;
use App\Models\Product;
use App\Models\Retail;
use App\Models\Sale;
use DateTimeZone;
use Livewire\Component;
date_default_timezone_set('Asia/Jakarta');
class Pos extends Component
{
    // POS ==================
    
    // protected $listeners = ['deleteConfirmed' => 'deleteCart'];
    protected $listeners = ['reset_kode' => 'rst'];
  

    public $cart_id;
    // Informasi Nota
    public $kode_sales, $date_sales, $nameAdmin,$id_user, $total;
    // informasi retail 
    public $id_retail, $status;
    // comment 
    public $comment;
    // add cart
    public $searchProduk, $validasi = 2, $qty = 1, $vname =2, $vbar = 2, $qtyJ = [], $qtyR = [];
    // delete cart and restore data qty to product
    public $qtyRestore, $id_product, $productQty;

    public $qtyJL, $qtyRL;

    public function rst(){
     
        $this->reset(['kode_sales']);
    }
    public function render()
    {
        $sales = new Sale();
        $this->kode_sales = $sales->kd_sale();
        $this->date_sales = $sales->dateSale();
        $this->nameAdmin = $sales->admin();
        $this->id_user = $sales->idAdmin();
        $retails = Retail::where('status',1)->get();
        // ADMIN
        $carts = Cart::where('id_user', $this->id_user)->where('produksi',1)->orderBy('id', 'desc')->get();
        $statusCart = Cart::where('id_user', $this->id_user)->where('produksi',1)->where('qty','>',0)->count();
        $statusCartreset = Cart::where('id_user', $this->id_user)->where('produksi',1)->count();
        return view('livewire.sales.pos', compact('retails', 'carts','statusCart','statusCartreset'));
    }

 

    // public function decQty($id, $id_product)
    // {
    //     // ADMIN
    //     $data = Cart::where('id', $id)->where('id_user', $this->id_user)->first();
    //     if($data){
    //         $data->decrement('qty');
    //         $products = Product::where('id_product', $id_product)->first();
    //         $products->increment('qty');
    //     }
    // }
    // public function incQty($id, $id_product)
    // {
    //     // ADMIN
    //     $data = Cart::where('id', $id)->where('id_user', $this->id_user)->first();
    //     if($data){
    //         $data->increment('qty');
    //         $products = Product::where('id_product', $id_product)->first();
    //         $products->decrement('qty');
    //     }
    // }
    protected function rules()
    {
        return [
            'status' => 'required',
            'id_retail' => 'required',
        ];
    }
    protected $messages = [
        'status.required' => 'Pilih Status!.',
        'id_retail.required' => 'Pilih Retail!.',
    ];
    
    public function updatedqtyJ(){

                foreach($this->qtyJ as $key => $value){
                    if($value != null){
                        Cart::where('id_user', $this->id_user)->where('produksi',1)->where('id', $key)->update([
                            'qty' => $this->qtyJ[$key]
                        ]);
                        $this->qtyJL = $this->qtyJ[$key];
                        // $cart =  Cart::where('id_user', $this->id_user)->where('produksi',1)->where('id', $key)->first();
                        // $product = Product::where('id_product',$cart->id_product)->update([
                        //     'qty' => $cart->product['qty']-$this->qtyJ[$key]
                        // ]);
                    }else{
                         Cart::where('id_user', $this->id_user)->where('produksi',1)->where('id', $key)->update([
                            'qty' => 0
                        ]);
                    }
       
                }
    }

    public function updatedqtyR(){

        foreach($this->qtyR as $key => $value){
            if($value != null){
                Cart::where('id_user', $this->id_user)->where('produksi',1)->where('id', $key)->update([
                    'qty_retur' => $this->qtyR[$key]
                ]);
                $this->qtyRL = $this->qtyR[$key];
                // $cart =  Cart::where('id_user', $this->id_user)->where('produksi',1)->where('id', $key)->first();
                // $product = Product::where('id_product',$cart->id_product)->update([
                //     'qty' => $cart->product['qty']-$this->qtyJ[$key]
                // ]);
            }else{
                 Cart::where('id_user', $this->id_user)->where('produksi',1)->where('id', $key)->update([
                    'qty_retur' => 0
                ]);
            }

        }
}
    
    // public function decQtyR($id, $id_product)
    // {
    //     $data = Cart::where('id',$id)->where('id_product', $id_product)->first();
    //     if($data){
    //         $data->decrement('qty_retur');
    //         // $products = Product::where('id_product', $id_product)->first();
    //         // $products->decrement('qty');
    //     }
    // }

    // public function incQtyR($id, $id_product)
    // {
    //     $data = Cart::where('id',$id)->where('id_product', $id_product)->first();
    //     if($data){
    //         $data->increment('qty_retur');
    //         // $data->decrement('qty');
    //         // $products = Product::where('id_product', $id_product)->first();
    //         // $products->increment('qty');
        
    //     }
    // }

    public function updatedsearchProduk()
    {
        $products = Product::where('id_product', $this->searchProduk)
        ->where('status', 1) 
        ->where('qty','>',0);

        $namaProduk = Product::where('name', $this->searchProduk)
        ->where('status', 1) 
        ->where('qty','>',0);

        $barcode = Product::where('barcode', $this->searchProduk)
        ->where('status', 1) 
        ->where('qty','>',0);


        $this->validasi = count($products->get());
        $this->vname = count($namaProduk->get());
        $this->vbar = count($barcode->get());

        if ($this->validasi > 0 || $this->vname > 0 || $this->vbar > 0) {
            if($this->validasi > 0 ){
                $item = $products->first();
            }elseif($this->vname > 0 ){
                $item = $namaProduk->first();
            }else{
                $item = $barcode->first();
            }

            //    cek data apakah sudah ada di cart
            $data = Cart::where('id_product', $this->searchProduk)
                ->orWhere('barcode', $this->searchProduk)
                ->orWhere('name', $this->searchProduk)
                ->where('id_user', $this->id_user)->where('produksi', 1);

            if ($data->count() < 1) {
                Cart::create([
                    // ADMIN
                    'id_user' => $this->id_user,
                    'id_product' => $item->id_product,
                    'barcode' => $item->barcode,
                    'name' => $item->name,
                    'capital_price' => $item->capital_price,
                    'selling_price' => $item->selling_price,
                    'qty' => $this->qty,
                    'produksi' => 1
                ]);
                $data->first();
                $data->decrement('qty');
                $this->resetInput();
            } else {
                $d =  $data->first();
                Cart::where('id_product', $this->searchProduk)
                    ->orWhere('barcode', $this->searchProduk)
                    ->orWhere('name', $this->searchProduk)->update([
                        'qty' => $d->qty + 1
                    ]);
                    $data->first();
                    $data->decrement('qty');
                    $this->resetInput();
            }
        }
    }

    public function deleteConfirmation($id, $id_product, $qtyRestore, $productQty){
        $this->cart_id = $id;
        $this->id_product = $id_product;
        $this->qtyRestore = $qtyRestore;
        $this->productQty = $productQty;
        
        $this->dispatchBrowserEvent('confirm-delete-dialog');
    }
    public function deleteCart($id, $id_product, $qtyRestore, $productQty){
        $this->cart_id = $id;
        $this->id_product = $id_product;
        $this->qtyRestore = $qtyRestore;
        $this->productQty = $productQty;
        Cart::where('id', $this->cart_id)->delete();
        $this->resetInput();
        $this->dispatchBrowserEvent('swal',['data' => 'Data berhasil dihapus!']);
    }

    public function resetCart($id_user, $produksi){
        Cart::where('id_user', $id_user)->where('produksi', $produksi)->delete();
        $this->dispatchBrowserEvent('swal',['data' => 'Berhasil Reset Data!']);
    }

    public function order($id_user, $subtotal, $bersih, $submodal, $subretur){
        $this->validate();
        $carts = Cart::where('id_user', $id_user)->where('produksi', 1);
    
        // insert to sales tabel
        $details = $carts->get();
        $returs = $carts->get();
        $sales = $carts->first();
       $create_sales = Sale::create([
            'id_sale' => $this->kode_sales,
            'total' => $subtotal-$subretur,
            'total_diskon' => 0,
            'total_bersih' => $bersih,
            'total_modal' => $submodal,
            'total_retur' => $subtotal-$subretur,
            'jml_retur' => $subretur,
            'diskon' => 0,
            'date_sale' => date('Y-m-d H:i:s'),
            'status' => $this->status,
            'comment' => $this->comment
        ]);
        // insert pada tabel detail sales
       
        foreach($details as $detail){
            DetailSale::create([
                'id_sale' => $this->kode_sales,
                'id_product' => $detail->id_product,
                'id_retail' => $this->id_retail,
                'id_user' => $detail->id_user,
                'unit' => $detail->product['unit'],
                'qty' => $detail->qty,
                'qty_retur' => $detail->qty_retur,
                'capital_price' => $detail->capital_price,
                'selling_price' => $detail->selling_price,
            ]);
        }
// update qty produk
        foreach($details as $detail){
            Product::where('id_product', $detail->id_product)->update([
                'qty' => $detail->product['qty']-$detail->qty
            ]);
        }

        foreach($returs as $detail){
            Product::where('id_product', $detail->id_product)->update([
                'qty' => $detail->product['qty']+$detail->qty_retur
            ]);
        }



        Cart::where('id_user', $id_user)->where('produksi',1)->delete();

        $this->reset(['kode_sales', 'status', 'comment','id_retail']);
        $this->dispatchBrowserEvent('swalOrder',['data' => 'Transaksi penjualan berhasil']);
    }

    public function resetInput(){
        $this->reset(['cart_id','id_product','qtyRestore','searchProduk']);
    }





}
