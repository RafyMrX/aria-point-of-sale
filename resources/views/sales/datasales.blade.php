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
<a href="{{ route('sales') }}" class="btn btn-success">Transaksi</a>
<a href="{{ route('data.sales') }}" class="btn btn-success">Data Penjualan</a>
<hr>
@livewire('sales.show')
  


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
