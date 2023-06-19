<?php

namespace App\Http\Livewire;

use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithPagination;

class SupplierShow extends Component
{
    
    protected $listeners = ['deleteConfirmed' => 'deleteSupplier'];
    public $kd_supplier, $name, $address, $tlp, $email;
    public  $supplier_id;


    // Datatable 
    use WithPagination;
    public $sortColumnName = 'created_at', $sortDirection = 'desc', $searchTerm = null, $showData = 5, $selectedRows = [], $selectedPageRows = false;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['searchTerm' => ['except' => '']];

    
    public function render()
    {
        $suppliers = $this->dataList();
        return view('livewire.supplier-show', compact('suppliers'));
    }


// START VALIDATION FORM
    protected function rules()
    {
        return [
            'kd_supplier' => 'required',
            'name' => 'required',
            'email' =>  'email|nullable',
            'tlp' => 'digits_between:10,13|nullable'
        ];
    }
    protected $messages = [
        'name.required' => 'Bagian nama tidak boleh kosong.',
        'email.email' => 'Bagian email harus benar menggunakan format email @.',
        'tlp.digits_between' => 'Bagian no telp harus angka dan panjang antara 10 - 13 digit.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
// END VALIDATION FORM 

    public function cancel(){
        $this->resetInput();
        $this->resetValidation();
    }

    public function createSupplier(){
        $this->resetInput();
        $this->resetValidation();
        $supplier = new Supplier();
        $this->kd_supplier =  $supplier->kd_supplier();
    }

    public function saveSupplier(){
        $this->validate();
        Supplier::create([
            'id_supplier' => $this->kd_supplier,
            'name' => $this->name,
            'address' => $this->address,
            'tlp' => $this->tlp,
            'email' => $this->email
        ]);
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('swal',['data' => 'Data berhasil ditambah!']);
 
    }

    public function editSupplier(int $id){
        $this->resetInput();
        $this->resetValidation();
        $supplier   = Supplier::find($id);
        if($supplier){
            $this->supplier_id = $supplier->id;
            $this->kd_supplier = $supplier->id_supplier;
            $this->name = $supplier->name;
            $this->address = $supplier->address;
            $this->tlp = $supplier->tlp;
            $this->email = $supplier->email;

        }else{
            return redirect()->to('/suppliers');
        }
    }

    public function updateSupplier(){
       $this->validate();
        Supplier::where('id',$this->supplier_id)->update([
            'id_supplier' => $this->kd_supplier,
            'name' => $this->name,
            'address' => $this->address,
            'tlp' => $this->tlp,
            'email' => $this->email
        ]);
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('swal',['data' => 'Data berhasil diubah!']);
        
    }

    public function deleteConfirmation($id){
        $this->supplier_id = $id;
        $this->dispatchBrowserEvent('confirm-delete-dialog');
    }
    
    public function deleteSupplier(){
        $supplier = Supplier::where('id', $this->supplier_id)->delete();
        $this->dispatchBrowserEvent('swal',['data' => 'Data berhasil dihapus!']);
    }

    public function deleteSelectedRows(){
        Supplier::whereIn('id', $this->selectedRows)->delete();
        $this->dispatchBrowserEvent('swal',['data' => 'Data berhasil dihapus!']);
        $this->reset(['selectedRows', 'selectedPageRows']);
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

    // main data
    public function dataList(){
        return Supplier::where('id_supplier', 'LIKE', '%'.$this->searchTerm.'%')
        ->orWhere('name', 'LIKE', '%'.$this->searchTerm.'%')
        ->orderBy($this->sortColumnName, $this->sortDirection)
        ->paginate($this->showData);
    }
    // END DATATABLE

    public function resetInput(){
        $this->reset(['kd_supplier','name', 'address','tlp','email']);
    }


}
