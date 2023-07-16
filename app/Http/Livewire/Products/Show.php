<?php

namespace App\Http\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    public $product_id, $kd_product, $id_category, $barcode, $name, $capital_price, $selling_price, $unit, $qty, $exp, $status = null, $produksi;
    protected $listeners = ['deleteConfirmed' => 'deleteProduct'];
    // var for switch crerate
    public $switchValue = 2;
    // Datatable 
    use WithPagination;
    public $stProduct = null, $category = null;
    public $sortColumnName = 'created_at', $sortDirection = 'desc', $searchTerm = null, $showData = 5, $selectedRows = [], $selectedPageRows = false;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['searchTerm' => ['except' => '']];

    public function render()
    {
        $allStatus = Product::all()->count();
        $aktif = Product::where('status', 1)->count();
        $nonAktif = Product::where('status', 2)->count();
        $products = $this->dataList();
        $categories = Category::all();
        $units = Unit::all();
        return view('livewire.products.show', compact('allStatus','aktif', 'nonAktif', 'products', 'categories','units'));
    }

        // START VALIDATION FORM
        protected function rules()
        {
            return [
                'kd_product' => 'required',
                'barcode' => 'required',
                'produksi' => 'required',
                'id_category' => 'required',
                'unit' => 'required',
                'name' => 'required',
                'capital_price' =>  'required|digits_between:1,9999999999|gt:0',
                'selling_price' =>  'required|digits_between:1,9999999999|gt:capital_price',
                'qty' =>  'digits_between:1,9999999999',
                'exp' => 'nullable|after:' . date('Y-m-d', strtotime(date('Y-m-d'))-1)
            ];
        }
        protected $messages = [
            'name.required' => 'nama produk tidak boleh kosong.',
            'barcode.required' => 'barcode tidak boleh kosong.',
            'produksi.required' => 'Jenis produk tidak boleh kosong.',
            'unit.required' => 'Satuan produk tidak boleh kosong.',
            'id_category.required' => 'Katgeori produk tidak boleh kosong.',
            'capital_price.required' => 'harga tidak boleh kosong',
            'capital_price.digits_between' => 'format harga harus angka dan tidak boleh ada spasi, titik (.) dan koma(,)',
            'capital_price.gt' => 'harga tidak boleh 0 rupiah',
            'selling_price.required' => 'harga tidak boleh kosong',
            'selling_price.digits_between' => 'format harga harus angka dan tidak boleh ada spasi, titik (.) dan koma(,)',
            'selling_price.gt' => 'harga jual tidak boleh 0 rupiah atau dibawah harga modal ',
            'qty.digits_between' => 'qty hasrus angka dan tidak berjumlah minus',
            'exp.after' => 'tanggal expired tidak boleh hari sebelumnya'

        
        ];
        public function updated($propertyName)
        {
            $this->validateOnly($propertyName);
        }
        // END VALIDATION FORM


        // MAIN METHOD
    public function resetInput(){
            $this->reset(['kd_product','name','product_id','id_category','barcode','capital_price','selling_price','unit','qty','exp','produksi','switchValue']);
    }
    public function cancel(){
            $this->resetInput();
            $this->resetValidation();
    }

      // CREATE
      public function createProduct(){
        $this->resetInput();
        $this->resetValidation();
        $product = new Product();
        $this->kd_product =  $product->kd_product();
    }
    public function updatedproduksi(){
        if($this->produksi == 2){
            $this->qty = 0;
        }
    }
    public function switchStatusCreate($d){
        if($this->switchValue == $d){
            $this->switchValue = 1;
        }else{
            $this->switchValue = 2;
        }
    }

    // STORE 
    public function saveProduct(){
        $this->validate();
        if($this->exp == null){
            $this->exp = null;
        }
        Product::create([
            'id_product' => $this->kd_product,
            'id_category' => $this->id_category,
            'barcode' => $this->barcode,
            'name' => $this->name,
            'capital_price' => $this->capital_price,
            'selling_price' => $this->selling_price,
            'unit' =>  $this->unit,
            'qty' =>  $this->qty,
            'exp' =>  $this->exp,
            'status' =>  $this->switchValue,
            'produksi' => $this->produksi
        ]);
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('swal',['data' => 'Data berhasil ditambah!']);
    }

    // EDIT
    public function editProduct(int $id){
        $this->resetInput();
        $this->resetValidation();
        $product   = Product::find($id);
        if($product){
            $this->product_id = $product->id;
            $this->kd_product = $product->id_product;
            $this->id_category = $product->id_category;
            $this->barcode = $product->barcode;
            $this->name = $product->name;
            $this->capital_price = $product->capital_price;
            $this->selling_price = $product->selling_price;
            $this->unit  = $product->unit;
            $this->qty = $product->qty;
            $this->exp = $product->exp;
            $this->switchValue = $product->status;
            $this->produksi = $product->produksi;
    
        }else{
            return redirect()->to('/products');
        }
    }

    // UPDATE 
    public function updateProduct(){
        $this->validate();
        // untuk column date yang tidak bisa null
        if($this->exp == null){
            $this->exp = null;
        }
        Product::where('id', $this->product_id)->update([
            'id_product' => $this->kd_product,
            'id_category' => $this->id_category,
            'barcode' => $this->barcode,
            'name' => $this->name,
            'capital_price' => $this->capital_price,
            'selling_price' => $this->selling_price,
            'unit' =>  $this->unit,
            'qty' =>  $this->qty,
            'exp' =>  $this->exp,
            'status' =>  $this->switchValue,
            'produksi' => $this->produksi
        ]);
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('swal',['data' => 'Data berhasil diubah!']);
    }

    // DESTROY
    public function deleteConfirmation($id){
        $this->product_id = $id;
        $this->dispatchBrowserEvent('confirm-delete-dialog');
    }
    public function deleteProduct(){
        Product::where('id', $this->product_id)->delete();
       $this->dispatchBrowserEvent('swal',['data' => 'Data berhasil dihapus!']);
   }

    // DETAIL
    public function detailProduct(int $id){
        $this->resetInput();
        $this->resetValidation();
        $product   = Product::find($id);
        if($product){
            $this->product_id = $product->id;
            $this->kd_product = $product->id_product;
            $this->id_category = $product->id_category;
            $this->barcode = $product->barcode;
            $this->name = $product->name;
            $this->capital_price = $product->capital_price;
            $this->selling_price = $product->selling_price;
            $this->unit  = $product->unit;
            $this->qty = $product->qty;
            $this->exp = $product->exp;
            $this->switchValue = $product->status;
            $this->produksi = $product->produksi;
    
        }else{
            return redirect()->to('/products');
        }
    }

     // SWITCH status in table 
     public function switchStatus($id, $status){
        if($status == 1){
            $status = 2;
        }else{
            $status = 1;
        }
        Product::where('id', $id)->update([
            'status' => $status
        ]);
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
                $this->stProduct = null;
                $this->category = null;
        }
        // showData page
        public function updatedshowData(){
                $this->resetPage();
                $this->stProduct = null;
                $this->category = null;
        }
        // Bulk
        public function updatedselectedPageRows($value){
            if($value){
                $this->selectedRows = $this->dataList()->pluck('id')->map(function ($id){
                    return (string) $id;
                });
            }else{
                $this->reset(['selectedRows', 'selectedPageRows']);
            }
        }

        public function deleteSelectedRows(){
            Product::whereIn('id', $this->selectedRows)->delete();
            $this->dispatchBrowserEvent('swal',['data' => 'Data berhasil dihapus!']);
            $this->reset(['selectedRows', 'selectedPageRows']);
        }
    // filter by button
    public function filterStatus($st = null){
            $this->stProduct = $st;
            $this->searchTerm = null;
            $this->category = null;
        }
    public function filterCategory(String $category = null){
           $this->category = $category;
           $this->stProduct = null;
        }

        public function dataList(){
            if($this->stProduct != null){
                return Product::when($this->stProduct, function($query){
                     return $query->where('status', $this->stProduct);
                })
                ->orderBy($this->sortColumnName, $this->sortDirection)
                ->paginate($this->showData);
            }
            elseif($this->category != null){
                return Product::when($this->category, function($query){
                    return $query->where('id_category', $this->category);
               })
               ->orderBy($this->sortColumnName, $this->sortDirection)
               ->paginate($this->showData);
            }
            else{
                return Product::where('id_product', 'LIKE', '%'.$this->searchTerm.'%')
               ->orWhere('name', 'LIKE', '%'.$this->searchTerm.'%')
               ->orWhere('barcode', 'LIKE', '%'.$this->searchTerm.'%')
               ->orderBy($this->sortColumnName, $this->sortDirection)
               ->paginate($this->showData);
            }
        }

}
