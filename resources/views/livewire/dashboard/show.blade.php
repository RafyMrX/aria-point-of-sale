<div>
    
    {{-- <div class="row mb-3">
        <div class="col-md-2">
              <span>From :</span>
              <input wire:model='from' type="date" class="form-control d-inline" value="">
        </div>
        
        <div class="col-md-2">
          <span>To :</span>
          <input wire:model='to' type="date" class="form-control d-inline" value="">
        </div>
    </div> --}}
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
        <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-usd" aria-hidden="true"></i></span>
        <div class="info-box-content">
        <span class="info-box-text">TOTAL KEUNTUNGAN KOTOR</span>
        <span class="info-box-number">
        Rp.{{ number_format($dataGrid->k_kotor, 0, ',', '.') }}
        </span>
        </div>
        </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
            <span class="info-box-icon bg-success elevation-1"><i class="fa fa-usd" aria-hidden="true"></i></span>
            <div class="info-box-content">
            <span class="info-box-text">TOTAL KEUNTUNGAN BERSIH</span>
            <span class="info-box-number">
                Rp.{{  number_format($dataGrid->k_bersih, 0, ',', '.') }}
            </span>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
        <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-refresh" aria-hidden="true"></i></span>
        <div class="info-box-content">
        <span class="info-box-text">PENJUALAN PENDING</span>
        <span class="info-box-number">
        {{ $dataGrid->aktif }}
        </span>
        </div>
        </div>
        </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                <span class="info-box-icon bg-success elevation-1"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">PENJUALAN CLOSING</span>
                <span class="info-box-number">
                    {{ $dataGrid->nonaktif }}
                </span>
                </div>
                </div>
                </div>


    </div>
{{ $to }}
 @php
    //  $a = ['jan'];
    //  $b = [1];
    //  $incm = json_encode($d, JSON_NUMERIC_CHECK);
    //  $tgl = json_encode($t);
 @endphp
    <div class="row mt-3">
        <div class="col-md-8 ">
            <div wire:ignore class="bg-white"  style="padding:10px;">
                <canvas id="myChart"></canvas>
            </div>
              
              <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
              
              <script>
                
                var dates = {!! json_encode($t) !!};
                var inc = {!! json_encode($d) !!};
                const ctx = document.getElementById('myChart');
                new Chart(ctx, {
                  type: 'bar',
                  data: {
                    labels: dates,
                    datasets: [{
                    label: 'GRAFIK KEUNTUNGAN BERSIH PERBULAN',
                      data: inc,
                      backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                        ],
                      borderWidth: 1
                    }],
                    
                  },
                  options: {
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    }
                  }
                });
              </script>
        </div>

        <div class="col-md-4">
            
            <div class="card">
            <div class="card-header">
                <h5>Produk terlaris</h5>
            </div>
            <div class="card-body table-responsive">
            <table class="table table-striped table-bordered table-sm">
                <thead style="background-color: #5f815e; color:#fff;">
                    <tr>
                        <th class="align-middle text-center">Ranking</th>
                        <th>Produk</th>
                        <th>Jumlah Terjual</th>
                    </tr>
                    
                </thead>
                <tbody>
                @forelse ($product as $item)
                <tr>
                    <td class="align-middle text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->nm_product }}</td>
                    <td>{{ $item->jml }}</td>
                </tr>  
                
                @empty
                    <tr>
                        <td colspan="3">Tidak ada produk terjual</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            </div>
        </div>
        </div>

    </div>
</div>
