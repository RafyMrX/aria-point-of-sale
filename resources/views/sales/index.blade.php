@extends('layouts.main')
@section('title', 'Transaksi Penjualan')
{{-- @section('page-title', 'Data Supplier') --}}
@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
@endpush

@section('content')
<div class="card card-light">
    <div class="card-header">
        <h4>Transaksi Penjualan</h4>
    </div>
    <!-- /.card-header -->
<div class="card-body">
{{-- CONTENT LIVEWIRE --}}
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation" wire:ignore>
      <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Transaksi</button>
    </li>
    <li class="nav-item" role="presentation" wire:ignore>
      <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Data Penjualan</button>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" wire:ignore.self>
        @livewire('sales.pos')
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab" wire:ignore.self>
        @livewire('sales.show')
    </div>

  </div>


</div>
</div>
@push('scripts')
  <script>
     window.addEventListener('close-modal', function(e) {
      $('#productmodal').modal('hide');
      $('#updateproductmodal').modal('hide');
     });
    window.addEventListener('swal', function(e) {
      Swal.fire({
        title: e.detail.data,
        icon: 'success',
        toast: true,
         position: 'top-right',
         showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,  
      })
    });  

    window.addEventListener('confirm-delete-dialog', event => {
       Swal.fire({
        title: 'Apakah anda yakin ?',
        showCancelButton: true,
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        text: "Data akan dihapus permanen!",
      }).then((result) => {
            if (result.isConfirmed) {
              Livewire.emit('deleteConfirmed')
            } 
      })
    });

    
  </script>
@endpush
@endsection
