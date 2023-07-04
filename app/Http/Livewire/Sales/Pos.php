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
    
    protected $listeners = ['deleteConfirmed' => 'deleteCart'];
    public $cart_id;
    // Informasi Nota
    public $kode_sales, $date_sales, $nameAdmin, $total;
    // informasi retail 
    public $id_retail, $status;
    // comment 
    public $comment;
    // add cart
    public $searchProduk, $validasi = 2, $qty = 1, $vname =2, $vbar = 2;
    // delete cart and restore data qty to product
    public $qtyRestore, $id_product, $productQty;



    public function render()
    {
        $sales = new Sale();
        $this->kode_sales = $sales->kd_sale();
        $this->date_sales = $sales->dateSale();
        $this->nameAdmin = $sales->admin();
        $retails = Retail::where('status',1)->get();
        // ADMIN
        $carts = Cart::where('id_user', 'A0001')->get();
        $statusCart = Cart::where('id_user', 'A0001')->where('qty','>',0)->count();
        return view('livewire.sales.pos', compact('retails', 'carts','statusCart'));
    }

 

    public function decQty($id, $id_product)
    {
        // ADMIN
        $data = Cart::where('id', $id)->where('id_user', 'A0001')->first();
        if($data){
            $data->decrement('qty');
            $products = Product::where('id_product', $id_product)->first();
            $products->increment('qty');
        }
    }
    public function incQty($id, $id_product)
    {
        // ADMIN
        $data = Cart::where('id', $id)->where('id_user', 'A0001')->first();
        if($data){
            $data->increment('qty');
            $products = Product::where('id_product', $id_product)->first();
            $products->decrement('qty');
        }
    }

    public function updatedsearchProduk()
    {
        $products = Product::where('id_product', $this->searchProduk)
        ->where('status', 1) 
        ->where('produksi',1)
        ->where('qty','>',0);

        $namaProduk = Product::where('name', $this->searchProduk)
        ->where('status', 1) 
        ->where('produksi',1)
        ->where('qty','>',0);

        $barcode = Product::where('barcode', $this->searchProduk)
        ->where('status', 1) 
        ->where('produksi',1)
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
                ->orWhere('name', $this->searchProduk);

            if ($data->count() < 1) {
                Cart::create([
                    // ADMIN
                    'id_user' => 'A0001',
                    'id_product' => $item->id_product,
                    'barcode' => $item->barcode,
                    'name' => $item->name,
                    'capital_price' => $item->capital_price,
                    'selling_price' => $item->selling_price,
                    'qty' => $this->qty
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
    public function deleteCart(){
        Product::where('id_product', $this->id_product)->update([
            'qty' => $this->productQty+$this->qtyRestore
        ]);
        Cart::where('id', $this->cart_id)->delete();
        $this->resetInput();
        $this->dispatchBrowserEvent('swal',['data' => 'Data berhasil dihapus!']);
    }

    public function resetCart($id_user){
        $carts = Cart::where('id_user', $id_user)->get();
        foreach($carts as $item){
            Product::where('id_product', $item->id_product)->update([
                'qty' => $item->product['qty']+$item->qty
            ]);
        }
        Cart::where('id_user', $id_user)->delete();
        $this->dispatchBrowserEvent('swal',['data' => 'Berhasil Reset Data!']);
    }

    public function order($id_user, $subtotal, $bersih, $submodal){
        $this->validate();
        $carts = Cart::where('id_user', $id_user);
    
        // insert to sales tabel
        $details = $carts->get();
        $sales = $carts->first();
       $create_sales = Sale::create([
            'id_sale' => $this->kode_sales,
            'total' => $subtotal,
            'total_diskon' => 0,
            'total_bersih' => $bersih,
            'total_modal' => $submodal,
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
                'capital_price' => $detail->capital_price,
                'selling_price' => $detail->selling_price,
            ]);
        }
// update qty produk
        // foreach($details as $detail){
        //     Product::where('id_product', $detail->id_product)->update([
        //         'qty' => $detail->product['qty']-$detail->qty
        //     ]);
        // }

        Cart::where('id_user', $id_user)->delete();

        $this->reset(['kode_sales', 'status', 'comment','id_retail']);
        $this->dispatchBrowserEvent('swalOrder',['data' => 'Transaksi berhasil']);
    }

    public function resetInput(){
        $this->reset(['cart_id','id_product','qtyRestore','searchProduk']);
    }

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



}
