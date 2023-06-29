
<div>
    <div>
        @include('livewire.retails.modal') 
        <button type="button" wire:click='createRetail' class="btn btn-success mb-3 float-end" data-toggle="modal" data-target="#retailmodal"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Retail</button>
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
              <a class="dropdown-item" href="#">Export Excel</a>
              </div>
            </div>
            <span class="ml-1 badge badge-pill badge-secondary">Selected {{ count($selectedRows) }} {{ Str::plural('Retail', count($selectedRows)) }}</span>
            @endif
          </div>
          <div class="col-md-8">

            
            <div class="float-right">
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
              <x-search-input placeholder="Cari kode, nama" wire:model='searchTerm'/>
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
          <span wire:click="sortBy('id_retail')" class="float-right text-sm" style="cursor: pointer;">
            <i class="fa fa-arrow-up {{ $sortColumnName === 'id_retail' && $sortDirection === 'asc' ? '' : 'text-dark' }}"></i>
            <i class="fa fa-arrow-down {{ $sortColumnName === 'id_retail' && $sortDirection === 'desc' ? '' : 'text-dark' }}"></i>
          </span>
        </th>
        <th>
          Nama
          <span wire:click="sortBy('name')" class="float-right text-sm" style="cursor: pointer;">
            <i class="fa fa-arrow-up {{ $sortColumnName === 'name' && $sortDirection === 'asc' ? '' : 'text-dark' }}"></i>
            <i class="fa fa-arrow-down {{ $sortColumnName === 'name' && $sortDirection === 'desc' ? '' : 'text-dark' }}"></i>
          </span>
        </th>
        <th>Alamat</th>
        <th>Tlp</th>
        <th>Email</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
      </thead>
    <tbody wire:loading.class='text-muted'>
    @forelse($retails as $index => $item)
    <tr>
      <td class="text-center align-middle">
        <input wire:model='selectedRows' class="form-check" type="checkbox" value="{{ $item->id }}" id="{{ $item->id }}">
      </td>
      <td  class="align-middle">{{ $retails->firstItem() + $index}}.</td>
      <td class=" align-middle">{{ $item->id_retail }}</td>
      <td  class=" align-middle">{{ $item->name }}</td>
      <td  class=" align-middle">{{ $item->address }}</td>
      <td  class=" align-middle">{{ $item->tlp }}</td>
      <td  class=" align-middle">{{ $item->email }}</td>   
      <td  class=" align-middle">
        
        <div class="custom-control custom-switch">
          <input wire:change='switchStatus({{$item->id}}, {{  $item->status }})' type="checkbox" class="custom-control-input" @checked($item->status == 1) id="{{ $item->id_retail }}">
          <label class="custom-control-label text-sm  @if($item->status == 1) text-success @else text-secondary @endif" for="{{ $item->id_retail }}">{!! $item->status == 1 ? "Aktif <i class='fa fa-circle' ></i>" : "Tidak Aktif <i class='fa fa-circle ' ></i>" !!}</label>
      </div>  
      </td>    
      <td  class=" align-middle">
      <button data-toggle="modal" data-target="#updateretailmodal" wire:click='editRetail({{ $item->id }})' type="submit" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
      @if(!$selectedRows)
      |
      <button type="submit" class="btn btn-danger" wire:click="deleteConfirmation({{ $item->id }})"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
      @endif
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
{{ $retails->links() }}
</div>
</div>


