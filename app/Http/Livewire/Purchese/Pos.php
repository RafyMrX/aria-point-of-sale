<?php

namespace App\Http\Livewire\Purchese;

use App\Models\Cart;
use App\Models\DetailPur;
use App\Models\Product;
use Livewire\Component;
use App\Models\Purchase;
use App\Models\Supplier;
date_default_timezone_set('Asia/Jakarta');
class Pos extends Component
{
    // protected $listeners = ['deleteConfirmed' => 'deleteCart'];
    protected $listeners = ['reset_kode' => 'rst'];
    public $cart_id;
    // Informasi Nota
    public $kode_pur, $date_pur, $nameAdmin,$id_user, $total;
    // informasi retail 
    public $id_supplier, $status;
    // comment 
    public $comment;
    // add cart
    public $searchProduk, $validasi = 2, $qty = 1, $vname =2, $vbar = 2,$qtyJ = [], $qtyR = [];
    // delete cart and restore data qty to product
    public $qtyRestore, $id_product, $productQty;

    public function rst(){
     
        $this->reset(['kode_pur']);
    }

    public function render()
    {
        $purchase = new Purchase();
        $this->kode_pur = $purchase->kd_pur($this->date_pur);
        // $this->date_pur = $purchase->datePur();
        $this->nameAdmin = $purchase->admin();
        $this->id_user = $purchase->idAdmin();
        $suppliers = Supplier::all();

        $carts = Cart::where('id_user', $this->id_user)->where('produksi',2)->get();
        $statusCart = Cart::where('id_user', $this->id_user)->where('produksi',2)->where('qty','>',0)->count();
        return view('livewire.purchese.pos', compact('suppliers', 'carts','statusCart'));
    }

    protected function rules()
    {
        return [
            'id_supplier' => 'required',
            'date_pur' => 'required',

        ];
    }
    protected $messages = [
        'id_supplier.required' => 'Pilih Supplier!.',
        'date_pur.required' => 'Pilih Tanggal!.',
    ];

    public function updatedqtyJ(){

        foreach($this->qtyJ as $key => $value){
            if($value != null){
                Cart::where('id_user', $this->id_user)->where('produksi',2)->where('id', $key)->update([
                    'qty' => $this->qtyJ[$key]
                ]);
    
                // $cart =  Cart::where('id_user', $this->id_user)->where('produksi',2)->where('id', $key)->first();
                // $product = Product::where('id_product',$cart->id_product)->update([
                //     'qty' => $cart->product['qty']-$this->qtyJ[$key]
                // ]);
            }else{
                 Cart::where('id_user', $this->id_user)->where('produksi',2)->where('id', $key)->update([
                    'qty' => 0
                ]);
            }

        }
}

public function updatedqtyR(){

foreach($this->qtyR as $key => $value){
    if($value != null){
        Cart::where('id_user', $this->id_user)->where('produksi',2)->where('id', $key)->update([
            'qty_retur' => $this->qtyR[$key]
        ]);
        // $cart =  Cart::where('id_user', $this->id_user)->where('produksi',2)->where('id', $key)->first();
        // $product = Product::where('id_product',$cart->id_product)->update([
        //     'qty' => $cart->product['qty']-$this->qtyJ[$key]
        // ]);
    }else{
         Cart::where('id_user', $this->id_user)->where('produksi',2)->where('id', $key)->update([
            'qty_retur' => 0
        ]);
    }

}
}

    public function updatedsearchProduk(){
        $products = Product::where('id_product', $this->searchProduk)
        ->where('status', 1) 
        ->where('produksi',2);

        $namaProduk = Product::where('name', $this->searchProduk)
        ->where('status', 1) 
        ->where('produksi',2);

        $barcode = Product::where('barcode', $this->searchProduk)
        ->where('status', 1) 
        ->where('produksi',2);

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
         ->where('id_user', $this->id_user)->where('produksi', 2);

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
                'produksi' => 2
            ]);
            $data->first();
            $data->decrement('qty');
            $this->resetInput();
         }else{
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
        $this->reset(['kode_pur', 'comment','id_supplier']);
        $this->dispatchBrowserEvent('swal',['data' => 'Data berhasil dihapus!']);
    }

    public function resetCart($id_user, $produksi){
        Cart::where('id_user', $id_user)->where('produksi', $produksi)->delete();
        $this->reset(['kode_pur', 'comment','id_supplier']);
        $this->dispatchBrowserEvent('swal',['data' => 'Berhasil Reset Data!']);
    }

    public function order($id_user, $subtotal, $bersih, $submodal, $subretur){
        $this->validate();
        $carts = Cart::where('id_user', $id_user)->where('produksi', 2);

        // insert to purchases table
        $details = $carts->get();
        $returs = $carts->get();
        $pur = $carts->first();
        $create_pur = Purchase::create([
            'id_pur' => $this->kode_pur,
            'total_beli' => $subtotal,
            'total_retur' => $subretur,
            'jml_bayar' => $bersih,
            'date_pur' => $this->date_pur,
            'comment' => $this->comment
        ]);
        // insert to table detail_pur
        foreach($details as $detail){
            DetailPur::create([
                'id_pur' => $this->kode_pur,
                'id_product' => $detail->id_product,
                'id_supplier' => $this->id_supplier,
                'id_user' => $detail->id_user,
                'unit' => $detail->product['unit'],
                'qty' => $detail->qty,
                'qty_retur' => $detail->qty_retur,
                'capital_price' => $detail->capital_price,
                'selling_price' => $detail->selling_price,
            ]);
        }

        foreach($details as $detail){
            Product::where('id_product', $detail->id_product)->update([
                'qty' => $detail->product['qty']+$detail->qty
            ]);
        }

        foreach($returs as $detail){
            Product::where('id_product', $detail->id_product)->update([
                'qty' => $detail->product['qty']-$detail->qty_retur
            ]);
        }

        Cart::where('id_user', $id_user)->where('produksi',2)->delete();
        $this->reset(['kode_pur', 'comment','id_supplier']);
        $this->dispatchBrowserEvent('swalOrder',['data' => 'Transaksi pembelian berhasil']);

    }


    public function resetInput(){
        $this->reset(['cart_id','id_product','qtyRestore','searchProduk']);
    }
 

}
