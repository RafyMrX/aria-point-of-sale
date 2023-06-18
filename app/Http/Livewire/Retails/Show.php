<?php

namespace App\Http\Livewire\Retails;

use App\Models\Retail;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    // Datatable 
    use WithPagination;
    public $sortColumnName = 'created_at', $sortDirection = 'desc', $searchTerm = null, $showData = 5, $selectedRows = [], $selectedPageRows = false;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['searchTerm' => ['except' => '']];


    public function render()
    {
        $allStatus = Retail::all()->count();
        $aktif = Retail::where('status', 1)->count();
        $nonAktif = Retail::where('status', 0)->count();
        $retails = $this->dataList();
        return view('livewire.retails.show', compact('retails','allStatus','aktif','nonAktif'));
    }

    public function switchStatus($id, $status){
        if($status == 1){
            $status = 0;
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

    public function dataList(){
        return Retail::where('id_retail', 'LIKE', '%'.$this->searchTerm.'%')
        ->orWhere('name', 'LIKE', '%'.$this->searchTerm.'%')
        ->orderBy($this->sortColumnName, $this->sortDirection)
        ->paginate($this->showData);
    }
}
