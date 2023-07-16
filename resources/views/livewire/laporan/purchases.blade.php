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
        <p class="font-weight-bold">Filter Supplier</p>
        <span class="text-white">To :</span>
        <div wire:ignore>
            <select wire:model='id_supplier' class="form-control @error('id_supplier') is-invalid @enderror" id="select2-dropdown">
                <option value="" selected>-- pilih supplier --</option>
                <option value="1" >Semua Supplier</option>
                @forelse ($suppliers as $item)
                <option value="{{ $item->id_supplier }}">{{ $item->name }}</option>
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
      <th class="align-middle">Nota</th>
      <th class="align-middle">Supplier</th>
      <th class="align-middle text-center">Jumlah dikirim</th>
      <th class="align-middle text-center">Jumlah terjual</th>
      <th class="align-middle text-center">Jumlah Retur</th>
      <th class="align-middle text-center">Total Bayar</th>

    </tr>
    </thead>
  <tbody wire:loading.class='text-muted'>
    @php
        $qtyKirim = 0;
        $qtyTerjual = 0;
        $qtyRetur = 0;
        $bayar = 0;
    @endphp
    @forelse($data as $index => $item)
    <tr>
      <td  class="align-middle">{{ $loop->iteration }}</td>
      <td class="align-middle">{{ \Carbon\Carbon::parse($item->date_pur)->format('d-F-Y') }} </td>
      <td class="align-middle">{{ $item->pur_id }}</td>
      <td class="align-middle">{{ $item->name_supplier }}</td>
      <td class="align-middle text-center">{{ $item->totalqty }}</td>
      <td class="align-middle text-center">{{ $item->totalqty-$item->qtyretur }}</td>
      <td class="align-middle text-center">{{ $item->qtyretur }}</td>
      <td class="align-middle text-center">{{ number_format( $item->jml_bayar , 0, ',', '.') }}</td>
 
    </tr>

    @php  
    $qtyKirim += $item->totalqty;
    $qtyTerjual += $item->totalqty-$item->qtyretur;
    $qtyRetur += $item->qtyretur;
    $bayar += $item->jml_bayar;
    @endphp
    @empty
    <tr class="text-center">
      <td colspan="10">
          <img src="https://www.hyperyno.com/front/img/no-result-found.png" alt="No results found" width="170">
      </td>
  </tr>
  
    @endforelse
    @if(!empty($id_supplier))
    <tr>
        <td colspan="4" class="align-middle text-center font-weight-bold text-white" style="background-color: #5f815e">Subtotal</td>
        <td class="align-middle text-center font-weight-bold" style="background-color: #a0a0a0;">{{ $qtyKirim }}</td>
        <td class="align-middle text-center font-weight-bold" style="background-color: #a0a0a0;">{{ $qtyTerjual  }}</td>
        <td class="align-middle text-center font-weight-bold" style="background-color: #a0a0a0;">{{ $qtyRetur }}</td>
        <td class="align-middle text-center font-weight-bold" style="background-color: #a0a0a0;">{{ number_format( $bayar , 0, ',', '.') }}</td>

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
                @this.set('id_supplier',data);
            });
        });
</script>
@endpush