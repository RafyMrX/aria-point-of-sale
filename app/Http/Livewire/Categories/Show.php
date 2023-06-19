<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    public $kd_category, $category_id, $name;
    protected $listeners = ['deleteConfirmed' => 'deleteCategory'];

    // Datatable 
    use WithPagination;
    public $sortColumnName = 'created_at', $sortDirection = 'desc', $searchTerm = null, $showData = 5, $selectedRows = [], $selectedPageRows = false;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['searchTerm' => ['except' => '']];

    public function render()
    {
        $categories = $this->dataList();
        return view('livewire.categories.show', compact('categories'));
    }

        // START VALIDATION FORM
    protected function rules()
        {
            return [
                'kd_category' => 'required',
                'name' => 'required',
            ];
        }
    protected $messages = [
            'name.required' => 'Bagian nama tidak boleh kosong.'
        ];
    public function updated($propertyName)
        {
            $this->validateOnly($propertyName);
        }
        // END VALIDATION FORM

    // main method
    public function resetInput(){
        $this->reset(['kd_category','name']);
    }
    public function cancel(){
        $this->resetInput();
        $this->resetValidation();
    }

        // CREATE
        public function createCategory(){
            $this->resetInput();
            $this->resetValidation();
            $category = new Category();
            $this->kd_category =  $category->kd_category();
        }

        // STORE
        public function saveCategory(){
            $this->validate();
            Category::create([
                'id_category' => $this->kd_category,
                'name' => $this->name,
            ]);
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
            $this->dispatchBrowserEvent('swal',['data' => 'Data berhasil ditambah!']);
        }

        // EDIT
        public function editCategory(int $id){
            $this->resetInput();
            $this->resetValidation();
            $category   = Category::find($id);
            if($category){
                $this->category_id = $category->id;
                $this->kd_category = $category->id_category;
                $this->name = $category->name;    
            }else{
                return redirect()->to('/categories');
            }
        }
        // UPDATE
        public function updateCategory(){
            $this->validate();
            Category::where('id',$this->category_id)->update([
                'id_category' => $this->kd_category,
                'name' => $this->name,
            ]);
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
            $this->dispatchBrowserEvent('swal',['data' => 'Data berhasil diubah!']);
        }

        // DESTROY
        public function deleteConfirmation($id){
            $this->category_id = $id;
            $this->dispatchBrowserEvent('confirm-delete-dialog');
        }
        public function deleteCategory(){
            Category::where('id', $this->category_id)->delete();
            $this->dispatchBrowserEvent('swal',['data' => 'Data berhasil dihapus!']);
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
        }
    
        public function updatedshowData(){
                $this->resetPage();
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
            Category::whereIn('id', $this->selectedRows)->delete();
            $this->dispatchBrowserEvent('swal',['data' => 'Data berhasil dihapus!']);
            $this->reset(['selectedRows', 'selectedPageRows']);
        }
    
        // main data
        public function dataList(){
            return Category::where('id_category', 'LIKE', '%'.$this->searchTerm.'%')
            ->orWhere('name', 'LIKE', '%'.$this->searchTerm.'%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->showData);
        }
        // END DATATABLE
}
