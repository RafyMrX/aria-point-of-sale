<div>
    <div>
        <div class="row mt-3">
            <div class="col-md-3">
                <div class="card ">
                    <div class="card-header text-white" style="background-color: #5f815e;">
                        <h3 class="card-title">Informasi Nota</h3>
                    </div>
                    <form>
                        <div class="card-body">
                            <table class="table table-sm">
                                <tr>
                                    <td class="font-weight-bold align-middle">Invoice</td>
                                    <td>
                                        <input wire:model='kode_pur' type="text" class="form-control" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold align-middle">Tanggal</td>
                                    <td><input wire:model=date_pur type="text" class="form-control" readonly></td>
                                </tr>
                                <tr>
                                    
                                    <td class="font-weight-bold align-middle">Admin</td>
                                    <td><input wire:model='nameAdmin' type="text" class="form-control" readonly></td>
                                </tr>
                            </table>
                        </div>

                    </form>
                </div>

                <div class="card card-secondary">
                    <div class="card-header text-white" style="background-color: #5f815e;">
                        <h3 class="card-title">Informasi Supplier</h3>
                    </div>
                    <form>
                        <div class="card-body">
                            <table class="table table-sm">
                                <tr>

                                    <td class="font-weight-bold align-middle">Supplier</td>
                                    <td>
                                        <div wire:ignore>
                                            <select wire:model='id_supplier' class="form-control @error('id_supplier') is-invalid @enderror" id="select2-dropdown">
                                                <option selected>-- pilih --</option>
                                                @forelse ($suppliers as $item)
                                                <option value="{{ $item->id_supplier }}" selected>{{ $item->name }}</option>
                                                @empty
                                                <p>tidak ada data</p>
                                                @endforelse
                                            </select>
                                        </div>
                                            @error('id_supplier') 
                                            <span class="error text-danger">{{ $message }}</span> 
                                            @enderror
                                    </td>
                                </tr>
                              
                            </table>
                        </div>

                    </form>
                </div>
            </div>
            <div class="col-md-9">
                {{-- SEARCH --}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color: #3b3b3b;color: #fff;">Cari/Scan
                            Barcode</span>
                    </div>
                    <input wire:model.debounce.900ms='searchProduk' type="text" name="searchProduk"
                        class="form-control  @if($validasi < 1 && $vname < 1 && $vbar < 1) is-invalid @elseif($validasi == 1 && $vname == 1 && $vbar == 1) is-valid @endif"
                        placeholder="kode produk/barcode produk/nama produk">

                    <div class="input-group-append">
                        <span class="input-group-text" style="background-color: #5f815e;color: #fff;"><i
                                class="fa fa-barcode" aria-hidden="true"></i></span>
                    </div>
                </div>
                <div wire:loading.remove wire:target='searchProduk'>
                    @if($validasi < 1 && $vname < 1 && $vbar < 1)
                    <h4 class="error text-danger font-weight-bold">produk tidak ditemukan</h4>
                    @endif
                </div>
                <div wire:loading wire:target='searchProduk'>
                    <h4 class="error text-secondary font-weight-bold">Mencari ...</h4>
                </div>
                    {{-- END SEARCH --}}

                    <table class="table  table-striped table-sm table-hover rounded-6">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th class="text-center">Qty Beli</th>
                                <th>Total Beli</th>
                                <th class="text-center">Qty RTR</th>
                                <th>Total RTR</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $subtotal = 0;
                            $subtotal_retur = 0;
                            $submodal = 0;
                            $bersih = 0;
                        @endphp
                        @forelse ($carts as $item)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $item->id_product }}</td>
                            <td class="align-middle">{{ $item->name }}</td>
                            <td class="align-middle">{{ $item->product['unit'] }}</td>
                            <td class="align-middle">{{ number_format($item->capital_price, 0, ',', '.')  }}</td>
                             {{-- QTY PENJUALAN --}}
                             <td class="align-middle">
                                <center>
                                
                                <div class="input-group" style="width: 100px;">
                                    <input wire:model.debounce.700ms='qtyJ.{{ $item->id }}' type="number" class="form-control text-center" value="0" min="1" placeholder="0">
                           
                                    <span class="input-group-btn">

                                    </span>
                                </div>
                            </center>
                            </td>

                            <td class="align-middle text-orange font-weight-bold">{{ number_format( $item->capital_price * $item->qty , 0, ',', '.') }}</td>
                            {{-- END PENJUALAN --}}

                               {{-- START RETUR --}}
                               <td class="align-middle">
                                <center>
                                
                                <div class="input-group" style="width: 100px;">
                                    <span class="input-group-btn">

                                    </span>
                                    <input wire:model.debounce.700ms='qtyR.{{ $item->id }}' type="number" class="form-control text-center" value="0" min="1" placeholder="0">
                           
                                    <span class="input-group-btn">

                                    </span>

             
                                </div>
                                {!! $item->qty_retur > $item->qty ? "<span class='text-danger'>retur limit</span>" : '' !!}
                            </center>
                            </td>

                            <td class="align-middle text-danger font-weight-bold">-{{ number_format( $item->capital_price * $item->qty_retur , 0, ',', '.') }}</td>

                            <td class="align-middle">{{ number_format( $item->capital_price * $item->qty , 0, ',', '.') }}</td>
                            <td class="align-middle">
                                <button type="submit" class="btn btn-danger"
                                    wire:click="deleteConfirmation('{{ $item->id }}','{{ $item->id_product }}','{{ $item->qty }}', '{{  $item->product['qty'] }}')"><i class="fa fa-trash-o"
                                        aria-hidden="true"></i></button></td>
                        </tr>
                        @php
                        $sub = $item->capital_price * $item->qty;
                        $subtotal += $sub;
                        $subr = $item->capital_price * $item->qty_retur;
                        $subtotal_retur += $subr;

                        $mod = $item->capital_price * $item->qty;
                        $submodal += $mod;

                       $bersih = $subtotal-$subtotal_retur;

                         @endphp
                        @empty
                            <tr>
                                <td colspan="10" class="text-center p-3 font-italic">Belum ada produk yang ditambahkan</td>
                            </tr>
                      
                        @endforelse
                         
                        </tbody>
                    </table>
               
                    <div class="row">
                        <div class="col-md-6 ">
           
                            <textarea wire:model='comment' rows="4" class="form-control" placeholder="Keterangan"></textarea>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-striped table-sm">
       
                                <tr>
                                    <td class="font-weight-bold">Subtotal Penjualan</td>
                                    <td class="font-weight-bold bg-orange">Rp.{{ number_format( $subtotal, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Subtotal Retur</td>
                                    <td class="font-weight-bold text-danger bg-danger">Rp. -{{ number_format( $subtotal_retur, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Grand Total</td>
                                    <td class="font-weight-bold text-success bg-green">Rp. {{ number_format( $subtotal-$subtotal_retur, 0, ',', '.') }}</td>
                                </tr>
                            </table>
                            <div class="float-right mt-2" style="display: inline-grid;
                    grid-template-columns: 1fr 1fr;
                    grid-gap: 2px;">
                    {{-- ADMIN --}}
                                <button type="button" wire:click="resetCart('{{ $id_user }}','2')" type="button" class="btn btn-danger btn-lg mr-2" @if($statusCart < 1) disabled @endif><i class="fa fa-refresh"
                                        aria-hidden="true"></i> Reset</button>
                                <button wire:click="order('{{ $id_user }}', '{{ $subtotal }}','{{ $bersih }}','{{ $submodal }}','{{ $subtotal_retur }}')"  type="button" class="btn btn-primary btn-lg "  @if($statusCart < 1) disabled @endif><i class="fa fa-floppy-o" aria-hidden="true" ></i> Buat
                                    Transaksi</button>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function () {

            $('#select2-dropdown').select2();
            $('#select2-dropdown').on('change', function(e){
                var data = $('#select2-dropdown').select2('val');
                @this.set('id_supplier',data);
            });
        });
</script>
@endpush