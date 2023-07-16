@extends('layouts.main')
@section('title', 'Retur Penjualan')
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
        <h4>Retur Pembelian</h4>
    </div>
    <!-- /.card-header -->
<div class="card-body">
{{-- CONTENT LIVEWIRE --}}
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation" >
      <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Retur</button>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        @livewire('retur-pur.pos')
    </div>
  

  </div>


</div>
</div>
@push('scripts')
  <script>

    window.addEventListener('swal', function(e) {
      Swal.fire({
        title: e.detail.data,
        icon: 'success',
         showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,  
      })

      const myTimeout = setTimeout(myGreeting, 2000);
      function myGreeting() {
        window.location.reload();
      }

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
