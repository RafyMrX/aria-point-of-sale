<div wire:ignore.self class="modal fade" id="categorymodal" tabindex="-1" role="dialog" aria-labelledby="categorymodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="categorymodalLabel">Form Tambah Kategori</h5>
          <button wire:click='cancel' type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form wire:submit.prevent='saveCategory'>
        <div class="modal-body">
    
                <div class="form-group">
                <label>Kode Kategori</label>
                <input type="text" wire:model="kd_category" readonly  class="form-control">
                <small id="emailHelp" class="form-text text-muted">
                  <span wire:loading.remove wire:target='createCategory'><i class="fa fa-info-circle text-success" aria-hidden="true"></i>  Kode kategori otomatis</span> 
                  <span wire:loading wire:target='createCategory'>Loading....</span>
                </small>
                @error('kd_category')
                 <span class="error text-danger">{{ $message }}</span> 
                @enderror
                </div>

                <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" wire:model="name"   class="@if($errors->has('name')) is-invalid @elseif($name == null)  @else is-valid @endif  form-control" placeholder="isi nama Kategori">
                @error('name') 
                <span class="error text-danger">{{ $message }}</span> 
                @enderror
                </div>  
            </div>
            <div class="modal-footer">
                <button wire:click='cancel' type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> batal</button>
                <button type="submit" class="btn btn-success" wire:loading.attr='disabled' wire:target='saveCategory'>
                    <span wire:loading.remove wire:target='saveCategory'><i class="fa fa-save"></i> simpan</span>
                    <div wire:loading wire:target='saveCategory'>
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


  <div wire:ignore.self class="modal fade" id="updatecategorymodal" tabindex="-1" role="dialog" aria-labelledby="updatecategorymodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updatecategorymodalLabel">Form Edit Kategori</h5>
          <button wire:click='cancel' type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form wire:submit.prevent='updateCategory'>
          <div class="modal-body">
      
            <div class="form-group">
              <label>Kode Kategori</label>
              <input type="text" wire:model="kd_category" readonly  class="form-control">
              <small id="emailHelp" class="form-text text-muted">
                <span wire:loading.remove wire:target='editCategory'><i class="fa fa-info-circle text-success" aria-hidden="true"></i>  Kode kategori otomatis</span> 
                  <span wire:loading wire:target='editCategory'>Loading....</span>
              </small>
              @error('kd_category')
               <span class="error text-danger">{{ $message }}</span> 
              @enderror
              </div>
  
              <div class="form-group">
              <label>Nama Kategori</label>
              <input type="text" wire:model="name" class="@error('name') is-invalid @enderror form-control" placeholder="isi nama Kategori">
              @error('name') 
              <span class="error text-danger">{{ $message }}</span> 
              @enderror
              </div>
         
              </div>
              <div class="modal-footer">
                  <button wire:click='cancel' type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> batal</button>
                  <button type="submit" class="btn btn-warning" wire:loading.attr='disabled' wire:target='updateCategory'>
                      <span wire:loading.remove wire:target='updateCategory'><i class="fa fa-save"></i> simpan perubahan</span>
                      <div wire:loading wire:target='updateCategory'>
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