<?php

namespace App\Http\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    public $stProduct = null, $category = null;
    protected $listeners = ['deleteConfirmed' => 'deleteRetail'];
    // var for switch crerate
    public $switchValue = 2;
    // Datatable 
    use WithPagination;
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
        return view('livewire.products.show', compact('allStatus','aktif', 'nonAktif', 'products', 'categories'));
    }


        // MAIN METHOD
    public function resetInput(){
            $this->reset(['kd_retail','name', 'address','tlp','email','switchValue']);
    }
    public function cancel(){
            $this->resetInput();
            $this->resetValidation();
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
