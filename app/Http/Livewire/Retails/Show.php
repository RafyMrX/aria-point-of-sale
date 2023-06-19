<?php

namespace App\Http\Livewire\Retails;

use App\Models\Retail;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{

    public $retail_id, $kd_retail, $name, $address, $tlp, $email, $s = null ;
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
        $allStatus = Retail::all()->count();
        $aktif = Retail::where('status', 1)->count();
        $nonAktif = Retail::where('status', 2)->count();
        $retails = $this->dataList();
        return view('livewire.retails.show', compact('retails','allStatus','aktif','nonAktif'));
    }

    // START VALIDATION FORM
    protected function rules()
    {
        return [
            'kd_retail' => 'required',
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

    // MAIN METHOD
    public function resetInput(){
        $this->reset(['kd_retail','name', 'address','tlp','email','switchValue']);
    }
    public function cancel(){
        $this->resetInput();
        $this->resetValidation();
    }

    // CREATE
    public function createRetail(){
        $this->resetInput();
        $this->resetValidation();
        $retail = new Retail();
        $this->kd_retail =  $retail->kd_retail();
    }

    public function switchStatusCreate($d){
        if($this->switchValue == $d){
            $this->switchValue = 1;
        }else{
            $this->switchValue = 2;
        }
    }

    // STORE
    public function saveRetail(){
        $this->validate();
        Retail::create([
            'id_retail' => $this->kd_retail,
            'name' => $this->name,
            'address' => $this->address,
            'tlp' => $this->tlp,
            'email' => $this->email,
            'status' =>  $this->switchValue
        ]);
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('swal',['data' => 'Data berhasil ditambah!']);
    }

    // EDIT 
    public function editRetail(int $id){
        $this->resetInput();
        $this->resetValidation();
        $retail   = Retail::find($id);
        if($retail){
            $this->retail_id = $retail->id;
            $this->kd_retail = $retail->id_retail;
            $this->name = $retail->name;
            $this->address = $retail->address;
            $this->tlp = $retail->tlp;
            $this->email = $retail->email;
            $this->switchValue = $retail->status;

        }else{
            return redirect()->to('/retails');
        }
    }
    // UPDATE
    public function updateRetail(){
        $this->validate();
        Retail::where('id',$this->retail_id)->update([
            'id_retail' => $this->kd_retail,
            'name' => $this->name,
            'address' => $this->address,
            'tlp' => $this->tlp,
            'email' => $this->email,
            'status' => $this->switchValue
        ]);
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('swal',['data' => 'Data berhasil diubah!']);
    }

    // DESTROY
    public function deleteConfirmation($id){
        $this->retail_id = $id;
        $this->dispatchBrowserEvent('confirm-delete-dialog');
    }
    public function deleteRetail(){
         Retail::where('id', $this->retail_id)->delete();
        $this->dispatchBrowserEvent('swal',['data' => 'Data berhasil dihapus!']);
    }

    // switch status in table 
    public function switchStatus($id, $status){
        if($status == 1){
            $status = 2;
        }else{
            $status = 1;
        }
        Retail::where('id', $id)->update([
            'status' => $status
        ]);
    }

    public function deleteSelectedRows(){
        Retail::whereIn('id', $this->selectedRows)->delete();
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

    public function filterStatus($s = null){
            $this->s = $s;
        }

    public function dataList(){
        return Retail::when($this->s, function($query, $s){
             return $query->where('status', $s);
        })
        ->orWhere('id_retail', 'LIKE', '%'.$this->searchTerm.'%')
        ->orWhere('name', 'LIKE', '%'.$this->searchTerm.'%')
        ->orderBy($this->sortColumnName, $this->sortDirection)
        ->paginate($this->showData);
    }
}
