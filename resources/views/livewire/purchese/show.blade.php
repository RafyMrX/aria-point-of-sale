<div>
    <div>
        @include('livewire.purchese.modal') 
     
        {{-- DATA TABLE --}}       
          <p class="font-weight-bold mt-3">Filter Tanggal Transaksi</p>
          <div class="row">
            <div class="col-md-2">
            
                <span>From :</span>
                <input wire:model='from' type="date" class="form-control d-inline" value="">
          </div>
          
          <div class="col-md-2">
            <span>To :</span>
            <input wire:model='to' type="date" class="form-control d-inline" value="">
          </div>
        </div>
        
        <div class="float-right">
         
            <div class="btn-group">
            
          <x-search-input placeholder="Nota, kode Supplier, nama"  wire:model='searchTerm'/>
            </div>
        </div>



        <div class="row mb-2 mt-3">
          <div class="col-md-4">
            <div class="btn-group">
            <x-select-input wire:model='showData'/>
            </div>
          </div>
          <div class="col-md-8">

        </div>
        </div>
    </div>


    <div class="table-responsive">
      <x-loading wire:loading.delay.longest/>
    <table class="table  table-striped table-sm table-hover rounded-6"> 
    <thead style="background-color: #5f815e; color:#fff;">
      <tr>
        <th>#</th>
        <th>
          Tanggal
        </th>
        <th>No Nota</th>
        <th>Kode Supplier</th>
        <th>Nama Supplier</th>
        <th>
          Qty
        </th>
        <th>
          Total Pembelian
        </th>
        <th>Aksi</th>
      </tr>
      </thead>
    <tbody wire:loading.class='text-muted'>
      @forelse($pur as $index => $item)

      <tr>
        <td  class="align-middle">{{ $pur->firstItem() + $index}}.</td>
        <td class="align-middle">{{ \Carbon\Carbon::parse($item->date_pur)->format('d-F-Y') }}</td>
        <td class="align-middle">{{ $item->pur_id }}</td>
        <td class="align-middle">{{ $item->sup_id }}</td>
        <td class="align-middle">{{ $item->name_sup }}</td>
        <td class="align-middle">
          @if($item->jml_retur < 1)
          {{ $item->totalqty }} 
          @else
          {{ $item->totalqty-$item->qtyretur }} <sup class="text-red @if($item->jml_retur < 1) d-none @endif" style="font-size: 11pt; font-weight:bold;">-{{ $item->qtyretur }}</sup>
          @endif
        </td>
        <td class="align-middle">
        @if($item->jml_retur < 1)
        Rp. {{ number_format($item->total_beli, 0, ',', '.') }}
        @else
        Rp. {{ number_format($item->bayar, 0, ',', '.') }} <sup class="text-red @if($item->jml_retur < 1) d-none @endif" style="font-size: 11pt; font-weight:bold;">-{{  number_format($item->jml_retur, 0, ',', '.') }}</sup>
        @endif
      
        <td class="align-middle">
          @if($item->jml_retur < 1)
          <a class="btn btn-secondary mx-1px text-95" href="{{url('/exportpur/'.$item->id)}}" target="_blank" data-title="Print">
            <i class="fa fa-print" aria-hidden="true"></i>
          
        </a>
        @else
        <a class="btn btn-secondary mx-1px text-95" href="{{url('/exportpurretur/'.$item->id)}}" target="_blank" data-title="Print">
          <i class="fa fa-print" aria-hidden="true"></i>
        
      </a>
        @endif

          <button data-toggle="modal" data-target="#detailSalesmodal" wire:click="detailSales('{{ $item->id }}')" type="submit" class="btn btn-info"><i class="fa fa-file-text-o" aria-hidden="true"></i></button>
        </td>
      </tr>
      @empty
      <tr class="text-center">
        <td colspan="10">
            <img src="https://www.hyperyno.com/front/img/no-result-found.png" alt="No results found" width="170">
            {{-- <p class="mt-2">Tidak ada data ditemukan</p> --}}
        </td>
    </tr>
      @endforelse
  </tbody>
</table> 

</div>
<div>
{{ $pur->links() }}
</div>

</div>
@push('scripts')
  <script>
    $(function() {
      $('#daterange').daterangepicker()
    });
  </script>
@endpush
