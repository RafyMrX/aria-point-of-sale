<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\DetailSale;
use App\Models\Sale;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Show extends Component
{
    public $from = null, $to = null, $t, $d;

    public function render()
    {
        // if(!empty($this->to)){
        //     dd($this->from);

        // }
    //    for data inside grid
        $dataGrid =  Sale::select(DB::raw('sum(total) AS k_kotor'),DB::raw('sum(total_bersih) AS k_bersih'), DB::raw('COUNT(DISTINCT IF(status = 1,
        id_sale, NULL)) AS nonaktif'), 
        DB::raw('COUNT(DISTINCT IF(status = 2,
        id_sale,NULL)) AS aktif'))
        ->first();

        
        $incomes = Sale::select(DB::raw("DATE_FORMAT(date_sale, '%m-%Y') AS tgl"),DB::raw('sum(total_bersih) AS bersih'))
        // ->whereBetween('date_sale', [$startDate, $endDate])
        // ->whereBetween('date_sale', [$this->from.' 00:00:00', $this->to.' 23:59:59'])
        ->groupBy('tgl')->pluck('bersih');

        $date = Sale::select(DB::raw("DATE_FORMAT(date_sale, '%M-%Y') AS tg"),DB::raw("DATE_FORMAT(date_sale, '%m-%Y') AS tgl"),DB::raw('sum(total_bersih) AS bersih'))
        // ->whereBetween('date_sale', [$startDate, $endDate])
        // ->whereBetween('date_sale', [$this->from.' 00:00:00', $this->to.' 23:59:59'])
        ->groupBy('tgl')->pluck('tg');

        $product = DetailSale::select('products.name AS nm_product',DB::raw("SUM(detail_sales.qty) AS jml"))
        ->join('products', 'products.id_product', '=', 'detail_sales.id_product')
        ->groupBy('products.name')->orderBy('jml', 'desc')->limit(10)->get();
         $this->d = $incomes;
          $this->t = $date;

        
      

        return view('livewire.dashboard.show', compact('dataGrid','product'));
    }

}
