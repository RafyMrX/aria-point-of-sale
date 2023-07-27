
<div>
    <div>
        <button type="button" class="btn btn-success mb-3 float-end" data-toggle="modal" data-target="#satuanmodal"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Satuan</button>
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
            <span class="ml-1 badge badge-pill badge-secondary">Selected {{ count($selectedRows) }} {{ Str::plural('Unit', count($selectedRows)) }}</span>
            @endif
          </div>
          <div class="col-md-8">
            <div class="float-right">
            <x-search-input placeholder="Cari satuan"   wire:model='searchTerm'/>
            </div>
        </div>
        </div>
    </div>
    @include('livewire.units.modal') 

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
          Nama Kategori
          <span wire:click="sortBy('name')" class="float-right text-sm" style="cursor: pointer;">
            <i class="fa fa-arrow-up {{ $sortColumnName === 'name' && $sortDirection === 'asc' ? '' : 'text-dark' }}"></i>
            <i class="fa fa-arrow-down {{ $sortColumnName === 'name' && $sortDirection === 'desc' ? '' : 'text-dark' }}"></i>
          </span>
        </th>
        <th>Aksi</th>
      </tr>
      </thead>
    <tbody wire:loading.class='text-muted'>
    @forelse($units as $index => $item)
    <tr>
      <td class="text-center align-middle">
        <input wire:model='selectedRows' class="form-check" type="checkbox" value="{{ $item->id }}" id="{{ $item->id }}">
      </td>
      <td  class="align-middle">{{ $units->firstItem() + $index}}.</td>
      <td  class=" align-middle">{{ $item->name }}</td> 
      <td  class=" align-middle">
      <button data-toggle="modal" data-target="#updatesatuanmodal" wire:click='editSatuan({{ $item->id }})' type="submit" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
      @if(!$selectedRows)
      |
      <button type="submit" class="btn btn-danger" wire:click="deleteConfirmation({{ $item->id }})"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
      @endif
      </td>
    </tr>
    @empty
    <tr class="text-center">
      <td colspan="8">
          <img src="https://www.hyperyno.com/front/img/no-result-found.png" alt="No results found" width="170">
          {{-- <p class="mt-2">Tidak ada data ditemukan</p> --}}
      </td>
  </tr>
    @endforelse
  
  </tbody>
</table> 

</div>
<div>
{{ $units->links() }}
</div>
</div>


