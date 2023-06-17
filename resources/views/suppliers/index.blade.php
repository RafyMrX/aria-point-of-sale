@extends('layouts.main')
@section('title', 'Data Supplier')
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
        <h4>Data Supplier</h4>
    </div>
    <!-- /.card-header -->
<div class="card-body">
  @livewire('supplier-show')

</div>
</div>
@push('scripts')
  <script>
     window.addEventListener('close-modal', function(e) {
      $('#suppliermodal').modal('hide');
      $('#updatesuppliermodal').modal('hide');
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