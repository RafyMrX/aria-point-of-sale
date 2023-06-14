{{-- CREATE MODAL SUPPLIER --}}
<div wire:ignore.self class="modal fade" id="suppliermodal" tabindex="-1" role="dialog" aria-labelledby="suppliermodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="suppliermodalLabel">Form Tambah Supplier</h5>
          <button wire:click='cancel' type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form wire:submit.prevent='saveSupplier'>
        <div class="modal-body">
    
                <div class="form-group">
                <label>Kode Supplier</label>
                <input type="text" wire:model="kd_supplier" readonly  class="form-control">
                <small id="emailHelp" class="form-text text-muted"><i class="fa fa-info-circle text-success" aria-hidden="true"></i> Kode supplier otomatis</small>
                @error('kd_supplier')
                 <span class="error text-danger">{{ $message }}</span> 
                @enderror
                </div>

                <div class="form-group">
                <label>Nama Supplier</label>
                <input type="text" wire:model="name" wire:model.defer class="@error('name') is-invalid @enderror  form-control" placeholder="isi nama supplier">
                @error('name') 
                <span class="error text-danger">{{ $message }}</span> 
                @enderror
                </div>

                <div class="form-group">
                <label>Alamat</label>
                <input type="text" wire:model="address" class="@error('address') is-invalid @enderror form-control" placeholder="isi alamat">
                @error('address') 
                <span class="error text-danger">{{ $message }}</span> 
                @enderror
                </div>

                <div class="form-group">
                <label>No Telp</label>
                <input type="text" wire:model="tlp" class="@error('tlp') is-invalid @enderror form-control" placeholder="cth. 081399990090">
                @error('tlp') 
                <span class="error text-danger">{{ $message }}</span> 
                @enderror
                </div>

                <div class="form-group">
                <label>Email</label>
                <input type="email" wire:model="email" class="@error('email') is-invalid @enderror form-control" placeholder="cth. joendoe@gmail.com">
                @error('email') 
                <span class="error text-danger">{{ $message }}</span> 
                @enderror
                </div>  
     
            </div>
            <div class="modal-footer">
                <button wire:click='cancel' type="button" class="btn btn-danger" data-dismiss="modal">batal</button>
                <button type="submit" class="btn btn-success" wire:loading.attr='disabled' wire:target='saveSupplier'>
                    <span wire:loading.remove wire:target='saveSupplier'>simpan</span>
                    <div wire:loading wire:target='saveSupplier'>
                        <div class="spinner-border spinner-border-sm" role="status">
                        </div>
                        <span>proses...</span>
                    </div>
                  
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>
  {{-- END MODAL CREATE SUPPLIER --}}


  {{-- EDIT MODAL SUPPLIER --}}
  <div wire:ignore.self class="modal fade" id="updatesuppliermodal" tabindex="-1" role="dialog" aria-labelledby="updatesuppliermodalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updatesuppliermodalLabel">Form Edit Supplier</h5>
        <button wire:click='cancel' type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form wire:submit.prevent='updateSupplier'>
      <div class="modal-body">
  
              <div class="form-group">
              <label>Kode Supplier</label>
              <input type="text" wire:model="kd_supplier" readonly  class="form-control">
              <small id="emailHelp" class="form-text text-muted"><i class="fa fa-info-circle text-success" aria-hidden="true"></i> Kode supplier otomatis</small>
              @error('kd_supplier')
               <span class="error text-danger">{{ $message }}</span> 
              @enderror
              </div>

              <div class="form-group">
              <label>Nama Supplier</label>
              <input type="text" wire:model="name" class="@error('name') is-invalid @enderror form-control" placeholder="isi nama supplier">
              @error('name') 
              <span class="error text-danger">{{ $message }}</span> 
              @enderror
              </div>

              <div class="form-group">
              <label>Alamat</label>
              <input type="text" wire:model="address" class="@error('address') is-invalid @enderror form-control" placeholder="isi alamat">
              @error('address') 
              <span class="error text-danger">{{ $message }}</span> 
              @enderror
              </div>

              <div class="form-group">
              <label>No Telp</label>
              <input type="text" wire:model="tlp" class="@error('tlp') is-invalid @enderror form-control" placeholder="cth. 081399990090">
              @error('tlp') 
              <span class="error text-danger">{{ $message }}</span> 
              @enderror
              </div>

              <div class="form-group">
              <label>Email</label>
              <input type="email" wire:model="email" class="@error('email') is-invalid @enderror form-control" placeholder="cth. joendoe@gmail.com">
              @error('email') 
              <span class="error text-danger">{{ $message }}</span> 
              @enderror
              </div>  
   
          </div>
          <div class="modal-footer">
              <button wire:click='cancel' type="button" class="btn btn-danger" data-dismiss="modal">batal</button>
              <button type="submit" class="btn btn-warning" wire:loading.attr='disabled' wire:target='updateSupplier'>
                  <span wire:loading.remove wire:target='updateSupplier'>Edit</span>
                  <div wire:loading wire:target='updateSupplier'>
                      <div class="spinner-border spinner-border-sm" role="status">
                      </div>
                      <span>proses...</span>
                  </div>
                
              </button>
          </div>
      </form>
    </div>
  </div>
</div>

  {{-- END EDIT MODAL SUPPLIER --}}