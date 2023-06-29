<div wire:ignore.self class="modal fade bd-example-modal" id='productmodal' tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="retailmodalLabel">Form Tambah Produk</h5>
            <button wire:click='cancel' type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form wire:submit.prevent='saveProduct'>
          <div class="modal-body">
            <div class="row mb-2">
                <div class="col-md-6">
                    <div class="form-group">
                    <label>Barcode Produk</label>
                    {!!  DNS1D::getBarcodeHTML($barcode, 'C39',1,30);  !!}
                    <p class="font-italic">{{ $barcode }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md 4">
                    <div class="form-group">
                        <label>Kode Produk</label>
                        <input type="text" wire:model="kd_product" readonly  class="form-control">
                        <small id="emailHelp" class="form-text text-muted">
                          <span wire:loading.remove wire:target='createProduct'><i class="fa fa-info-circle text-success" aria-hidden="true"></i>  Kode produk otomatis</span> 
                          <span wire:loading wire:target='createProduct'>Loading....</span>
                        </small>
                        @error('kd_product')
                         <span class="error text-danger">{{ $message }}</span> 
                        @enderror
                        </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Jenis Produk</label>
                        <select name="" id="" wire:model='produksi' class="form-control">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="1">Produk Sendiri</option>
                            <option value="2">Produk Beli</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" wire:model="name"   class="@if($errors->has('name')) is-invalid @elseif($name == null)  @else is-valid @endif  form-control" placeholder="isi nama produk">
                        @error('name') 
                        <span class="error text-danger">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>
    
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="" id="" wire:model='id_category' class="form-control">
                            <option value="" selected>-- Pilih Kategori --</option>
                            @forelse ($categories as $item)
                            <option value="{{ $item->id_category }}" selected>{{ $item->name }}</option>
                            @empty
                            <option value="" selected class="text-danger">Tambahkan kategori pada menu manajemen kategori</option>
                            @endforelse
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Harga Modal</label>
                        <input type="text" wire:model="capital_price"   class="@if($errors->has('capital_price')) is-invalid @elseif($capital_price == null)  @else is-valid @endif  form-control" placeholder="cth.6500">
                        @error('capital_price') 
                        <span class="error text-danger">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Harga Jual</label>
                        <input type="text" wire:model="selling_price"   class="@if($errors->has('selling_price')) is-invalid @elseif($selling_price == null)  @else is-valid @endif  form-control" placeholder="cth.7500">
                        @error('selling_price') 
                        <span class="error text-danger">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Satuan/Unit</label>
                    <select name="" id="" wire:model='unit' class="form-control">
                        <option value="">-- Pilih Satuan --</option>
                        <option value="pcs">pcs</option>
                        <option value="bungkus">bungkus</option>
                        <option value="kotak">kotak</option>
                    </select>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label>Qty</label>
                        <input type="text" wire:model="qty"   class="@if($errors->has('qty')) is-invalid @elseif($qty == null)  @else is-valid @endif  form-control" placeholder="cth.20" @readonly($produksi == 2)>
                        @error('qty') 
                        <span class="error text-danger">{{ $message }}</span> 
                        @enderror
                        @if($produksi == 2) 
                        <span class="error text-secondary"><i class="fa fa-info-circle" aria-hidden="true"></i> Setelah produk ditambahkan, lakukan transaksi pembelian untuk menambah qty </span> 
                        @endif
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Expired</label>
                        <input type="date" wire:model="exp"   class="@if($errors->has('exp')) is-invalid @elseif($exp == null)  @else is-valid @endif  form-control" placeholder="cth.20">
                        @error('exp') 
                        <span class="error text-danger">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                <div class="form-group">
                    <label>Status Produk</label>
                    <div class="custom-control custom-switch">
                      <input wire:change='switchStatusCreate(2)' type="checkbox" class="custom-control-input" id="status" @if($switchValue == 1) checked @endif>
                      <label class="custom-control-label text-sm" for="status">{!! $switchValue == 2 ? "<span>Tidak Aktif</span>" : "<span class='text-success'>Aktif</span>" !!}</label>
                    </div> 
                </div>
                </div> 
      

            </div>
          </div>

          <div class="modal-footer">
            <button wire:click='cancel' type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> batal</button>
            <button type="submit" class="btn btn-success" wire:loading.attr='disabled' wire:target='saveProduct'>
                <span wire:loading.remove wire:target='saveProduct'><i class="fa fa-save"></i> simpan</span>
                <div wire:loading wire:target='saveProduct'>
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


  {{-- EDIT MODAL PRODUCT --}}
  <div wire:ignore.self class="modal fade bd-example-modal" id='updateproductmodal' tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="retailmodalLabel">Form Edit Produk</h5>
            <button wire:click='cancel' type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form wire:submit.prevent='updateProduct'>
          <div class="modal-body">
            <div class="row mb-2">
                <div class="col-md-6">
                    <div class="form-group">
                    <label>Barcode Produk</label>
                    {!!  DNS1D::getBarcodeHTML($barcode, 'C39',1,30);  !!}
                    <p class="font-italic">{{ $barcode }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md 4">
                    <div class="form-group">
                        <label>Kode Produk</label>
                        <input type="text" wire:model="kd_product" readonly  class="form-control">
                        <small id="emailHelp" class="form-text text-muted">
                          <span wire:loading.remove wire:target='editProduct'><i class="fa fa-info-circle text-success" aria-hidden="true"></i>  Kode produk otomatis</span> 
                          <span wire:loading wire:target='editProduct'>Loading....</span>
                        </small>
                        @error('kd_product')
                         <span class="error text-danger">{{ $message }}</span> 
                        @enderror
                        </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Jenis Produk</label>
                        <select name="" id="" wire:model='produksi' class="form-control">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="1" @selected($produksi == 1)>Produk Sendiri</option>
                            <option value="2" @selected($produksi == 2)>Produk Beli</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" wire:model="name"   class="@error('name') is-invalid @enderror  form-control" placeholder="isi nama produk">
                        @error('name') 
                        <span class="error text-danger">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>
    
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="" id="" wire:model='id_category' class="form-control">
                            <option value="" selected>-- Pilih Kategori --</option>
                            @forelse ($categories as $item)
                            <option value="{{ $item->id_category }}" selected>{{ $item->name }}</option>
                            @empty
                            <option value=""  class="text-danger">Tambahkan kategori pada menu manajemen kategori</option>
                            @endforelse
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Harga Modal</label>
                        <input type="text" wire:model="capital_price"   class="@error('capital_price') is-invalid @enderror form-control" placeholder="cth.6500">
                        @error('capital_price') 
                        <span class="error text-danger">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Harga Jual</label>
                        <input type="text" wire:model="selling_price"   class="@error('selling_price') is-invalid @enderror  form-control" placeholder="cth.7500">
                        @error('selling_price') 
                        <span class="error text-danger">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Satuan/Unit</label>
                    <select name="" id="" wire:model='unit' class="form-control">
                        <option value="">-- Pilih Satuan --</option>
                        <option value="pcs" @selected($unit == 'pcs')>pcs</option>
                        <option value="bungkus"  @selected($unit == 'bungkus')>bungkus</option>
                        <option value="kotak"  @selected($unit == 'kotak')>kotak</option>
                    </select>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label>Qty</label>
                        <input type="text" wire:model="qty"   class="@error('qty') is-invalid @enderror  form-control" placeholder="cth.20" @readonly($produksi == 2)>
                        @error('qty') 
                        <span class="error text-danger">{{ $message }}</span> 
                        @enderror
                        @if($produksi == 2) 
                        <span class="error text-secondary"><i class="fa fa-info-circle" aria-hidden="true"></i> Setelah produk ditambahkan, lakukan transaksi pembelian untuk menambah qty </span> 
                        @endif
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Expired</label>
                        <input type="date" wire:model="exp"   class="@error('exp') is-invalid @enderror  form-control" placeholder="cth.20">
                        @error('exp') 
                        <span class="error text-danger">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                <div class="form-group">
                    <label>Status Produk</label>
                    <div class="custom-control custom-switch">
                      <input wire:change='switchStatusCreate(2)' type="checkbox" class="custom-control-input" id="status" @if($switchValue == 1) checked @endif>
                      <label class="custom-control-label text-sm" for="status">{!! $switchValue == 2 ? "<span>Tidak Aktif</span>" : "<span class='text-success'>Aktif</span>" !!}</label>
                    </div> 
                </div>
                </div> 
      

            </div>
          </div>

          <div class="modal-footer">
            <button wire:click='cancel' type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> batal</button>
            <button type="submit" class="btn btn-success" wire:loading.attr='disabled' wire:target='updateProduct'>
                <span wire:loading.remove wire:target='updateProduct'><i class="fa fa-save"></i> simpan</span>
                <div wire:loading wire:target='updateProduct'>
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



  
  {{-- DETAIL MODAL PRODUCT --}}
  <div wire:ignore.self class="modal fade bd-example-modal" id='detailproductmodal' tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="retailmodalLabel">Detail Produk</h5>
            <button wire:click='cancel' type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <div class="row mb-2">
                <div class="col-md-6">
                    <div class="form-group">
                    <label>Barcode Produk</label>
                    {!!  DNS1D::getBarcodeHTML($barcode, 'C39',1,30);  !!}
                    <p class="font-italic">{{ $barcode }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md 4">
                    <div class="form-group">
                        <label>Kode Produk</label>
                        <input type="text" wire:model="kd_product" readonly  class="form-control">
                        <small id="emailHelp" class="form-text text-muted">
                          <span wire:loading.remove wire:target='editProduct'><i class="fa fa-info-circle text-success" aria-hidden="true"></i>  Kode produk otomatis</span> 
                          <span wire:loading wire:target='editProduct'>Loading....</span>
                        </small>
                        @error('kd_product')
                         <span class="error text-danger">{{ $message }}</span> 
                        @enderror
                        </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Jenis Produk</label>
                        <select name="" id="" wire:model='produksi' class="form-control" disabled>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="1" @selected($produksi == 1) >Produk Sendiri</option>
                            <option value="2" @selected($produksi == 2) >Produk Beli</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" wire:model="name"   class="@error('name') is-invalid @enderror  form-control" placeholder="isi nama produk" readonly>
                        @error('name') 
                        <span class="error text-danger">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>
    
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select disabled name="" id="" wire:model='id_category' class="form-control" >
                            @forelse ($categories as $item)
                            <option value="{{ $item->id_category }}" selected readonly>{{ $item->name }}</option>
                            @empty
                            <option value=""  class="text-danger">Tambahkan kategori pada menu manajemen kategori</option>
                            @endforelse
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Harga Modal</label>
                        <input type="text" wire:model="capital_price"   class="@error('capital_price') is-invalid @enderror form-control" placeholder="cth.6500" readonly>
                        @error('capital_price') 
                        <span class="error text-danger">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Harga Jual</label>
                        <input type="text" wire:model="selling_price"   class="@error('selling_price') is-invalid @enderror  form-control" placeholder="cth.7500" readonly>
                        @error('selling_price') 
                        <span class="error text-danger">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Satuan/Unit</label>
                    <select disabled name="" id="" wire:model='unit' class="form-control">
                        <option value="">-- Pilih Satuan --</option>
                        <option value="pcs" @selected($unit == 'pcs') readonly>pcs</option>
                        <option value="bungkus"  @selected($unit == 'bungkus') readonly>bungkus</option>
                        <option value="kotak"  @selected($unit == 'kotak') readonly>kotak</option>
                    </select>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label>Qty</label>
                        <input type="text" wire:model="qty"   class="@error('qty') is-invalid @enderror  form-control" placeholder="cth.20" @readonly($produksi == 2) readonly>
                        @error('qty') 
                        <span class="error text-danger">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Expired</label>
                        <input type="date" wire:model="exp"   class="@error('exp') is-invalid @enderror  form-control" placeholder="cth.20" readonly>
                        @error('exp') 
                        <span class="error text-danger">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                <div class="form-group">
                    <label>Status Produk</label>
                    <div class="custom-control custom-switch">
                        {!! $switchValue == 2 ? "<span class='font-weight-bold'>Tidak Aktif</span>" : "<span class='text-success font-weight-bold'>Aktif</span>" !!}
                    </div> 
                </div>
                </div> 
    
            </div>
          </div>
    
      </div>
    </div>
  </div>