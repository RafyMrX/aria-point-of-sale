<div>
  
    <div class="row">
      <div class="col-md-2">
        <p class="font-weight-bold">Filter Tanggal Transaksi</p>
          <span>From :</span>
          <input wire:model='from' type="date" class="form-control d-inline" value="">
    </div>
    
    <div class="col-md-2">
        <p class="text-white">Filter Tanggal Transaksi</p>
      <span>To :</span>
      <input wire:model='to' type="date" class="form-control d-inline" value="">
    </div>

    <div class="col-md-3">
        <p class="font-weight-bold">Filter Retail</p>
        <span class="text-white">To :</span>
        <div wire:ignore>
            <select wire:model='id_retail' class="form-control @error('id_retail') is-invalid @enderror" id="select2-dropdown">
                <option value="" selected>-- pilih retail --</option>
                <option value="1" >Semua Retail</option>
                @forelse ($retails as $item)
                <option value="{{ $item->id_retail }}">{{ $item->name }}</option>
                @empty
                <option value="" selected>Tidak ada data</option>
                @endforelse
            </select>
        </div>
    </div>
    
  </div>

  <div class="table-responsive mt-5">
    <x-loading wire:loading.delay.longest/>
  <table class="table  table-striped table-sm table-hover rounded-6"> 
  <thead style="background-color: #5f815e; color:#fff;">
    <tr>
      <th class="align-middle">#</th>
      <th class="align-middle">Tanggal</th>
      <th class="align-middle">nota</th>
      <th class="align-middle">Retail</th>
      <th class="align-middle text-center">Qty Kirim</th>
      <th class="align-middle text-center">Qty Terjual</th>
      <th class="align-middle text-center">Qty Retur</th>
      <th class="align-middle text-center">keuntungan Kotor</th>
      <th class="align-middle text-center">Modal</th>
      <th class="align-middle text-center">keuntungan Bersih</th>
    </tr>
    </thead>
  <tbody wire:loading.class='text-muted'>
    @php
        $qtyKirim = 0;
        $qtyTerjual = 0;
        $qtyRetur = 0;
        $labk = 0;
        $mod =0;
        $bersih =0;
    @endphp
    @forelse($data as $index => $item)
    <tr>
      <td  class="align-middle">{{ $loop->iteration }}</td>
      <td class="align-middle">{{ \Carbon\Carbon::parse($item->date_sale)->format('d-F-Y') }} </td>
      <td class="align-middle">{{ $item->sale_id }}</td>
      <td class="align-middle">{{ $item->name_retail }}</td>
      <td class="align-middle text-center">{{ $item->totalqty }}</td>
      <td class="align-middle text-center">{{ $item->totalqty-$item->qtyretur }}</td>
      <td class="align-middle text-center">{{ $item->qtyretur }}</td>
      <td class="align-middle text-center">{{ number_format( $item->total_kotor , 0, ',', '.') }}</td>
      <td class="align-middle text-center">{{ number_format( $item->total_modal, 0, ',', '.') }}</td>
      <td class="align-middle text-center @if($item->total_bersih < 0) text-red @endif">{{ number_format( $item->total_bersih , 0, ',', '.') }}</td>
    </tr>

    @php  
    $qtyKirim += $item->totalqty;
    $qtyTerjual += $item->totalqty-$item->qtyretur;
    $qtyRetur += $item->qtyretur;
    $labk += $item->total_kotor;
    $mod+= $item->total_modal;
    $bersih += $item->total_bersih;
    @endphp
    @empty
    <tr class="text-center">
      <td colspan="10">
          <img src="https://www.hyperyno.com/front/img/no-result-found.png" alt="No results found" width="170">
      </td>
  </tr>
  
    @endforelse
    @if(!empty($id_retail))
    <tr>
        <td colspan="4" class="align-middle text-center font-weight-bold text-white" style="background-color: #5f815e">Total</td>
        <td class="align-middle text-center font-weight-bold" style="background-color: #a0a0a0;">{{ $qtyKirim }}</td>
        <td class="align-middle text-center font-weight-bold" style="background-color: #a0a0a0;">{{ $qtyTerjual  }}</td>
        <td class="align-middle text-center font-weight-bold" style="background-color: #a0a0a0;">{{ $qtyRetur }}</td>
        <td class="align-middle text-center font-weight-bold" style="background-color: #a0a0a0;">{{ number_format( $labk , 0, ',', '.') }}</td>
        <td class="align-middle text-center font-weight-bold" style="background-color: #a0a0a0;">{{ number_format( $mod , 0, ',', '.') }}</td>
        <td class="align-middle text-center font-weight-bold " style="background-color: #a0a0a0;">{{ number_format( $bersih , 0, ',', '.') }}</td>
    </tr>
    @endif
</tbody>
</table> 

</div>


</div>
@push('scripts')
<script>
    $(document).ready(function () {

            $('#select2-dropdown').select2();
            $('#select2-dropdown').on('change', function(e){
                var data = $('#select2-dropdown').select2('val');
                @this.set('id_retail',data);
            });
        });
</script>
@endpush