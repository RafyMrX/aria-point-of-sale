<div wire:ignore.self class="modal fade" id="satuanmodal" tabindex="-1" role="dialog" aria-labelledby="categorymodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="categorymodalLabel">Form Tambah Satuan</h5>
          <button wire:click='cancel' type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form wire:submit.prevent='saveSatuan'>
        <div class="modal-body">

                <div class="form-group">
                <label>Nama Satuan</label>
                <input type="text" wire:model="name"   class="@if($errors->has('name')) is-invalid @elseif($name == null)  @else is-valid @endif  form-control" placeholder="isi Satuan">
                @error('name') 
                <span class="error text-danger">{{ $message }}</span> 
                @enderror
                </div>  
            </div>
            <div class="modal-footer">
                <button wire:click='cancel' type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> batal</button>
                <button type="submit" class="btn btn-success" wire:loading.attr='disabled' wire:target='saveSatuan'>
                    <span wire:loading.remove wire:target='saveSatuan'><i class="fa fa-save"></i> simpan</span>
                    <div wire:loading wire:target='saveSatuan'>
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


  <div wire:ignore.self class="modal fade" id="updatesatuanmodal" tabindex="-1" role="dialog" aria-labelledby="updatesatuanmodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updatecategorymodalLabel">Form Edit Satuan</h5>
          <button wire:click='cancel' type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form wire:submit.prevent='updateSatuan'>
          <div class="modal-body">
  
              <div class="form-group">
              <label>Nama Satuan</label>
              <input type="text" wire:model="name" class="@error('name') is-invalid @enderror form-control" placeholder="isi  Satuan">
              @error('name') 
              <span class="error text-danger">{{ $message }}</span> 
              @enderror
              </div>
         
              </div>
              <div class="modal-footer">
                  <button wire:click='cancel' type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> batal</button>
                  <button type="submit" class="btn btn-warning" wire:loading.attr='disabled' wire:target='updateSatuan'>
                      <span wire:loading.remove wire:target='updateSatuan'><i class="fa fa-save"></i> simpan perubahan</span>
                      <div wire:loading wire:target='updateSatuan'>
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