<div>
    <div>
        @include('livewire.sales.modal') 
     
        {{-- DATA TABLE --}}
        {{ $from }} {{ $to }}
        <form>
        <div class="row mt-3">
          <div class="col-md-2">
            
                <label>Filter Tanggal Transaksi</label>
                <input wire:model='from' type="date" class="form-control d-inline" value="">
          </div>
          
          <div class="col-md-2">
            <label class="text-white">:</label>
            <input wire:model='to' type="date" class="form-control d-inline" value="">
          </div>

          <div class="col-md-2">
            <label class="text-white">.</label>
            <button class="btn btn-info d-block">Cari</button>
          </div>

        </div>
      </form>



        <div class="row mb-2 mt-3">
          <div class="col-md-4">
            <div class="btn-group">
            <x-select-input wire:model='showData'/>
            </div>
          </div>
          <div class="col-md-8">

            
            <div class="float-right">
         
                <div class="btn-group mr-2">
                  <button wire:click='filterStatus' type="button" class="btn btn-default">
                    <span class="mr-1">Semua</span>
                    <span class="badge badge-pill badge-info">{{ $allStatus }}</span>
                  </button>
                  <button wire:click='filterStatus(1)'  type="button" class="btn btn-default">
                    <span class="mr-1">Closing</span>
                    <span class="badge badge-pill badge-success">{{ $closing }}</span>
                  </button>
                  <button wire:click='filterStatus(2)'  type="button" class="btn btn-default">
                    <span class="mr-1">Pending</span>
                    <span class="badge badge-pill badge-warning">{{ $pending }}</span>
                  </button>
                </div>
                <div class="btn-group">
                
              <x-search-input placeholder="Cari kode retail, nama"  wire:model='searchTerm'/>
                </div>
            </div>
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
          <span wire:click="sortBy('date_sale')" class="float-right text-sm" style="cursor: pointer;">
            <i class="fa fa-arrow-up {{ $sortColumnName === 'date_sale' && $sortDirection === 'asc' ? '' : 'text-dark' }}"></i>
            <i class="fa fa-arrow-down {{ $sortColumnName === 'date_sale' && $sortDirection === 'desc' ? '' : 'text-dark' }}"></i>
          </span>
        </th>
        <th>No Nota</th>
        <th>Kode Retail</th>
        <th>Nama Retail</th>
        <th>
          Qty
          <span wire:click="sortBy('totalqty')" class="float-right text-sm" style="cursor: pointer;">
            <i class="fa fa-arrow-up {{ $sortColumnName === 'totalqty' && $sortDirection === 'asc' ? '' : 'text-dark' }}"></i>
            <i class="fa fa-arrow-down {{ $sortColumnName === 'totalqty' && $sortDirection === 'desc' ? '' : 'text-dark' }}"></i>
          </span>
        </th>
        <th>
          Total
          <span wire:click="sortBy('total')" class="float-right text-sm" style="cursor: pointer;">
            <i class="fa fa-arrow-up {{ $sortColumnName === 'total' && $sortDirection === 'asc' ? '' : 'text-dark' }}"></i>
            <i class="fa fa-arrow-down {{ $sortColumnName === 'total' && $sortDirection === 'desc' ? '' : 'text-dark' }}"></i>
          </span>
        </th>

        <th>Status</th>
        <th>Aksi</th>
      </tr>
      </thead>
    <tbody wire:loading.class='text-muted'>
      @forelse($sales as $index => $item)

      <tr>
        <td  class="align-middle">{{ $sales->firstItem() + $index}}.</td>
        <td class="align-middle">{{ $item->date_sale }}</td>
        <td class="align-middle">{{ $item->sale_id }}</td>
        <td class="align-middle">{{ $item->retail_id }}</td>
        <td class="align-middle">{{ $item->name_retail }}</td>
        <td class="align-middle">{{ $item->totalqty }}</td>
        <td class="align-middle">Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
        <td class="align-middle">
          <div class="custom-control custom-switch">
            <input wire:change='switchStatus({{ $item->id}}, {{ $item->status }})' type="checkbox" class="custom-control-input" @checked($item->status == 1) id="{{ $item->sale_id }}">
            <label class="custom-control-label text-sm" for="{{ $item->sale_id }}">
              {!! $item->status == 1 ? "<span class='badge badge-pill badge-success'>Closing</span>" : "<span class='badge badge-pill badge-warning'>Pending</span>" !!}
            </label>
      
          </div>
        
        
        </td>
        <td class="align-middle">
          <button data-toggle="modal" data-target="#updateretailmodal" wire:click='cetak()' type="submit" class="btn btn-secondary"><i class="fa fa-print" aria-hidden="true"></i>  Cetak</button>
          <button data-toggle="modal" data-target="#detailSalesmodal" wire:click='detailSales({{ $item->id }})' type="submit" class="btn btn-info"><i class="fa fa-file-text-o" aria-hidden="true"></i>  Detail </button>
        </td>
      </tr>
      @empty
      <tr class="text-center">
        <td colspan="9">
            <img src="https://www.hyperyno.com/front/img/no-result-found.png" alt="No results found" width="170">
            {{-- <p class="mt-2">Tidak ada data ditemukan</p> --}}
        </td>
    </tr>
      @endforelse
  </tbody>
</table> 

</div>
<div>
{{ $sales->links() }}
</div>

</div>
@push('scripts')
  <script>
    $(function() {
      $('#daterange').daterangepicker()
    });
  </script>
@endpush
