<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}



// <?php

// namespace App\Http\Livewire;

// use App\Models\Supplier;
// use Livewire\Component;

// class SupplierCreate extends Component
// {
//     public $kd_supplier;
//     public function render()
//     {
//         $supplier = new Supplier();
//         $kode = $supplier->kd_supplier();
//         $this->kd_supplier = $kode;
//         return view('livewire.supplier-main');
//     }
// }
