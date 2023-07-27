
<div>
    <div>
        @include('livewire.products.modal') 
        <button type="button" wire:click='createProduct' class="btn btn-success mb-3 float-end" data-toggle="modal" data-target="#productmodal"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Produk</button>
        {{-- DATA TABLE --}}
        <div class="row mb-2">
          <div class="col-md-4">
            <div class="btn-group">
            <x-select-input wire:model='showData'/>
            </div>
            @if($selectedRows)
            <div class="btn-group ml-2">
              <button type="button" class="btn btn-default">Aksi Bulk</button>
              <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
              <span class="sr-only">Toggle Dropdown</span>
              </button>
              <div class="dropdown-menu" role="menu" style="">
              <a wire:click.prevent='deleteSelectedRows' class="dropdown-item" href="#">Hapus yang ditandai</a>
              
              </div>
            </div>
            <span class="ml-1 badge badge-pill badge-secondary">Selected {{ count($selectedRows) }} {{ Str::plural('Product', count($selectedRows)) }}</span>
            @endif
          </div>
          <div class="col-md-8">

            
            <div class="float-right">
                <div class="btn-group mr-2">
                    <button type="button" class="btn btn-default">Filter by Category</button>
                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                    <span class="sr-only"></span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                      <button class="dropdown-item" wire:click="filterCategory()" href="#">Semua Kategori</button>
                    @forelse ($categories as $item)
                    <button class="dropdown-item" wire:click="filterCategory('{{ $item->id_category }}')" href="#">{{ $item->name }}</button>
                    @empty
                    <span>Tidak ada data</span>
                    @endforelse
                    </div>
                </div>
                <div class="btn-group mr-2">
                  <button wire:click='filterStatus' type="button" class="btn btn-default">
                    <span class="mr-1">Semua</span>
                    <span class="badge badge-pill badge-info">{{ $allStatus }}</span>
                  </button>
                  <button wire:click='filterStatus(1)'  type="button" class="btn btn-default">
                    <span class="mr-1">Aktif</span>
                    <span class="badge badge-pill badge-success">{{ $aktif }}</span>
                  </button>
                  <button wire:click='filterStatus(2)'  type="button" class="btn btn-default">
                    <span class="mr-1">Tidak Aktif</span>
                    <span class="badge badge-pill badge-secondary">{{ $nonAktif }}</span>
                  </button>
                </div>
                <div class="btn-group">
                
              <x-search-input placeholder="Cari kode, barcode, nama"  wire:model='searchTerm'/>
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
        <th class=" align-middle text-center">
          <input class="form-check" type="checkbox" value="" wire:model='selectedPageRows'>
        </th>
        <th>#</th>
        <th>
          Kode
          <span wire:click="sortBy('id_product')" class="float-right text-sm" style="cursor: pointer;">
            <i class="fa fa-arrow-up {{ $sortColumnName === 'id_product' && $sortDirection === 'asc' ? '' : 'text-dark' }}"></i>
            <i class="fa fa-arrow-down {{ $sortColumnName === 'id_product' && $sortDirection === 'desc' ? '' : 'text-dark' }}"></i>
          </span>
        </th>
        <th>Barcode</th>
        <th>
          Nama
          <span wire:click="sortBy('name')" class="float-right text-sm" style="cursor: pointer;">
            <i class="fa fa-arrow-up {{ $sortColumnName === 'name' && $sortDirection === 'asc' ? '' : 'text-dark' }}"></i>
            <i class="fa fa-arrow-down {{ $sortColumnName === 'name' && $sortDirection === 'desc' ? '' : 'text-dark' }}"></i>
          </span>
        </th>
        <th>Kategori</th>
        <th>Qty</th>
        <th>Satuan</th>
        <th>Harga Modal</th>
        <th>Harga Jual</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
      </thead>
    <tbody wire:loading.class='text-muted'>
    @forelse($products as $index => $item)
    
    <tr>
      <td class="text-center align-middle">
        <input wire:model='selectedRows' class="form-check" type="checkbox" value="{{ $item->id }}" id="{{ $item->id }}">
      </td>
      <td  class="align-middle">{{ $products->firstItem() + $index}}.</td>
      <td class=" align-middle">{{ $item->id_product }}</td>
      <td  class=" align-middle text-center">
        <center>
        {!! DNS1D::getBarcodeHTML($item->barcode, 'C39',1,25); !!}
      </center>
        <span class="font-italic">{{ $item->barcode }}</span>
        </td>
      <td  class=" align-middle">{{ $item->name }}</td>
      <td  class=" align-middle">@if($item->category == null) <small class="font-italic">tidak ada kategori</small> @else {{ $item->category['name'] }}  @endif</td>
      <td  class=" align-middle @if($item->qty <= 5) text-danger @endif ">{{ $item->qty }} @if($item->qty <= 5)<i class="fa fa-exclamation-circle" aria-hidden="true"></i> @endif</td>
      <td class=" align-middle">{{ $item->unit }}</td>
      <td class=" align-middle">{{ number_format($item->capital_price) }}</td>
      <td class=" align-middle">{{ number_format($item->selling_price) }}</td>
      <td  class=" align-middle">
        <div class="custom-control custom-switch">
          <input wire:change='switchStatus({{$item->id}}, {{  $item->status }})' type="checkbox" class="custom-control-input" @checked($item->status == 1) id="{{ $item->id_product }}">
          <label class="custom-control-label text-sm  @if($item->status == 1) text-success @else text-secondary @endif" for="{{ $item->id_product }}">{!! $item->status == 1 ? "Aktif" : "Tidak Aktif " !!}</label>
      </div>  
      </td>    
      <td  class=" align-middle">
    <button data-toggle="modal" data-target="#detailproductmodal" wire:click='detailProduct({{ $item->id }})' type="submit" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></button> |
      <button data-toggle="modal" data-target="#updateproductmodal" wire:click='editProduct({{ $item->id }})' type="submit" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
      @if(!$selectedRows)
      |
      <button type="submit" class="btn btn-danger" wire:click="deleteConfirmation({{ $item->id }})"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
      @endif
      </td>
    </tr>
    @empty
    <tr class="text-center">
      <td colspan="12">
          <img src="https://www.hyperyno.com/front/img/no-result-found.png" alt="No results found" width="170">
          {{-- <p class="mt-2">Tidak ada data ditemukan</p> --}}
      </td>
  </tr>
    @endforelse
  
  </tbody>
</table> 

</div>
<div>
{{ $products->links() }}
</div>
</div>


