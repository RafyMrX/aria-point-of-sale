<div>
    <div>
        <button type="button" wire:click='createSupplier' class="btn btn-success mb-3 float-end" data-toggle="modal" data-target="#suppliermodal"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Supplier</button>
    </div>
    @include('livewire.supplier-modal') 
    <table id="example2" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Kode</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Tlp</th>
        <th>Email</th>
        <th>Aksi</th>
      </tr>
      </thead>

    <tbody>
      @foreach($suppliers as $supplier)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $supplier->id_supplier }}</td>
        <td>{{ $supplier->name }}</td>
        <td>{{ $supplier->address }}</td>
        <td>{{ $supplier->tlp }}</td>
        <td>{{ $supplier->email }}</td>    
        <td><button data-toggle="modal" data-target="#updatesuppliermodal" wire:click='editSupplier({{ $supplier->id }})' type="submit" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> |
        <button type="submit" class="btn btn-danger" wire:click="deleteConfirmation({{ $supplier->id }})"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
          
        </td>
      </tr>
      @endforeach
      </tbody>
    </table>
</div>


