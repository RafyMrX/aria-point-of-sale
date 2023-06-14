<?php

namespace App\Http\Livewire;

use App\Models\Supplier;
use Livewire\Component;

class SupplierShow extends Component
{
    public $kd_supplier, $name, $address, $tlp, $email;
    public $suppliers, $supplier_id;
    protected $listeners = ['deleteConfirmed' => 'deleteSupplier'];

    public function render()
    {
        $this->suppliers = Supplier::all();
        return view('livewire.supplier-show');
    }

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

    public function cancel(){
        $this->resetInput();
        $this->resetValidation();
    }

    public function createSupplier(){
        $this->resetValidation();
        $this->resetInput();
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
            return redirect()->to('/data-supplier');
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



    public function resetInput(){
        $this->reset(['kd_supplier','name', 'address','tlp','email']);
    }


}
