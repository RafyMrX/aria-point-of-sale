{{-- CREATE MODAL RETAIL --}}
<div wire:ignore.self class="modal fade" id="retailmodal" tabindex="-1" role="dialog" aria-labelledby="retailmodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="retailmodalLabel">Form Tambah Retail</h5>
          <button wire:click='cancel' type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form wire:submit.prevent='saveRetail'>
        <div class="modal-body">
    
                <div class="form-group">
                <label>Kode Retail</label>
                <input type="text" wire:model="kd_retail" readonly  class="form-control">
                <small id="emailHelp" class="form-text text-muted">
                  <span wire:loading.remove wire:target='createRetail'><i class="fa fa-info-circle text-success" aria-hidden="true"></i>  Kode retail otomatis</span> 
                  <span wire:loading wire:target='createRetail'>Loading....</span>
                </small>
                @error('kd_retail')
                 <span class="error text-danger">{{ $message }}</span> 
                @enderror
                </div>

                <div class="form-group">
                <label>Nama Retail</label>
                <input type="text" wire:model="name"   class="@if($errors->has('name')) is-invalid @elseif($name == null)  @else is-valid @endif  form-control" placeholder="isi nama retail">
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
                <input type="text" wire:model="tlp" class="@if($errors->has('tlp')) is-invalid @elseif($tlp == null)  @else is-valid @endif form-control" placeholder="cth. 081399990090">
                @error('tlp') 
                <span class="error text-danger">{{ $message }}</span> 
                @enderror
                </div>

                <div class="form-group">
                <label>Email</label>
                <input type="email" wire:model="email" class="@if($errors->has('email')) is-invalid @elseif($email == null)  @else is-valid @endif form-control" placeholder="cth. joendoe@gmail.com">
                @error('email') 
                <span class="error text-danger">{{ $message }}</span> 
                @enderror
                </div>  

                <div class="form-group">
                  <label>Status Retail</label>
                  <div class="custom-control custom-switch">
                    <input wire:change='switchStatusCreate(2)' type="checkbox" class="custom-control-input" id="status" @checked($switchValue == 1)>
                    <label class="custom-control-label text-sm" for="status">{!! $switchValue == 2 ? "<span>Tidak Aktif</span>" : "<span class='text-success'>Aktif</span>" !!}</label>
                  </div> 
                  </div> 
     
            </div>
            <div class="modal-footer">
                <button wire:click='cancel' type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> batal</button>
                <button type="submit" class="btn btn-success" wire:loading.attr='disabled' wire:target='saveRetail'>
                    <span wire:loading.remove wire:target='saveRetail'><i class="fa fa-save"></i> simpan</span>
                    <div wire:loading wire:target='saveRetail'>
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
  <div wire:ignore.self class="modal fade" id="updateretailmodal" tabindex="-1" role="dialog" aria-labelledby="updateretailmodalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateretailmodalLabel">Form Edit Retail</h5>
        <button wire:click='cancel' type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form wire:submit.prevent='updateRetail'>
        <div class="modal-body">
    
          <div class="form-group">
            <label>Kode Supplier</label>
            <input type="text" wire:model="kd_retail" readonly  class="form-control">
            <small id="emailHelp" class="form-text text-muted">
              <span wire:loading.remove wire:target='editRetail'><i class="fa fa-info-circle text-success" aria-hidden="true"></i>  Kode retail otomatis</span> 
                <span wire:loading wire:target='editRetail'>Loading....</span>
            </small>
            @error('kd_retail')
             <span class="error text-danger">{{ $message }}</span> 
            @enderror
            </div>

            <div class="form-group">
            <label>Nama Retail</label>
            <input type="text" wire:model="name" class="@error('name') is-invalid @enderror form-control" placeholder="isi nama retail">
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

                <div class="form-group">
                  <label>Status Retail</label>
                  <div class="custom-control custom-switch">
                    <input wire:change='switchStatusCreate({{ $switchValue }})' type="checkbox" class="custom-control-input" id="status" @checked($switchValue == 1)>
                    <label class="custom-control-label text-sm" for="status">{!! $switchValue == 2 ? "<span>Tidak Aktif</span>" : "<span class='text-success'>Aktif</span>" !!}</label>
                  </div> 
                  </div> 
     
            </div>
            <div class="modal-footer">
                <button wire:click='cancel' type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> batal</button>
                <button type="submit" class="btn btn-warning" wire:loading.attr='disabled' wire:target='updateRetail'>
                    <span wire:loading.remove wire:target='updateRetail'><i class="fa fa-save"></i> simpan perubahan</span>
                    <div wire:loading wire:target='updateRetail'>
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