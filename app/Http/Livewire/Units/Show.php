<?php

namespace App\Http\Livewire\Units;

use App\Models\Unit;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
     // Datatable 
     use WithPagination;
     public $sortColumnName = 'created_at', $sortDirection = 'desc', $searchTerm = null, $showData = 5, $selectedRows = [], $selectedPageRows = false;
     protected $paginationTheme = 'bootstrap';
     protected $queryString = ['searchTerm' => ['except' => '']];

     public  $unit_id, $name;
    protected $listeners = ['deleteConfirmed' => 'deleteSatuan'];
     
    public function render()
    {
        $units = $this->dataList();
        return view('livewire.units.show', compact('units'));
    }

        // START VALIDATION FORM
    protected function rules()
        {
            return [
                'name' => 'required',
            ];
        }
    protected $messages = [
            'name.required' => 'Nama satuan tidak boleh kosong.'
        ];
    public function updated($propertyName)
        {
            $this->validateOnly($propertyName);
        }
        // END VALIDATION FORM
    
        public function resetInput(){
            $this->reset(['name']);
        }

        public function cancel(){
            $this->resetInput();
            $this->resetValidation();
        }

        public function saveSatuan(){
            $this->validate();
            Unit::create([
                'name' => $this->name,
            ]);
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
            $this->dispatchBrowserEvent('swal',['data' => 'Data berhasil ditambah!']);
        }

         // EDIT
         public function editSatuan(int $id){
            $this->resetInput();
            $this->resetValidation();
            $unit   = Unit::find($id);
            if($unit){
                $this->unit_id = $unit->id;
                $this->name = $unit->name;    
            }else{
                return redirect()->to('/units');
            }
        }

           // UPDATE
           public function updateSatuan(){
            $this->validate();
            Unit::where('id',$this->unit_id)->update([
                'name' => $this->name,
            ]);
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
            $this->dispatchBrowserEvent('swal',['data' => 'Data berhasil diubah!']);
        }

        public function deleteConfirmation($id){
            $this->unit_id = $id;
            $this->dispatchBrowserEvent('confirm-delete-dialog');
        }
        public function deleteSatuan(){
            Unit::where('id', $this->unit_id)->delete();
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
            Unit::whereIn('id', $this->selectedRows)->delete();
            $this->dispatchBrowserEvent('swal',['data' => 'Data berhasil dihapus!']);
            $this->reset(['selectedRows', 'selectedPageRows']);
        }

  

    public function dataList(){
        return Unit::where('name', 'LIKE', '%'.$this->searchTerm.'%')
        ->orderBy($this->sortColumnName, $this->sortDirection)
        ->paginate($this->showData);
    }
}
