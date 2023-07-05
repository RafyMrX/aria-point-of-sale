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
                                        <div wire:ignore>
                                            <select wire:model='idSale' class="form-control @error('idSale') is-invalid @enderror" id="select2-dropdown">
                                                <option value="" selected>-- pilih --</option>
                                                @forelse ($faktur as $item)
                                                <option value="{{ $item->id_sale }}" selected>{{ $item->id_sale }}</option>
                                                @empty
                                                <p>tidak ada data</p>
                                                @endforelse
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold align-middle">Tanggal</td>
                                    <td><input wire:model=tanggal type="text" class="form-control" readonly></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold align-middle">Admin</td>
                                    <td><input wire:model='admin' type="text" class="form-control" readonly></td>
                                </tr>
                            </table>
                        </div>

                    </form>
                </div>

                <div class="card card-secondary">
                    <div class="card-header text-white" style="background-color: #5f815e;">
                        <h3 class="card-title">Informasi Retail</h3>
                    </div>
                    <form>
                        <div class="card-body">
                            <table class="table table-sm">
                                <tr>

                                    <td class="font-weight-bold align-middle">Retail</td>
                                    <td>
                                        <div>
                                            <select wire:model='id_retail' class="form-control @error('id_retail') is-invalid @enderror" id="select2-dropdown" readonly style="pointer-events: none;">
                                                <option selected value="{{ $id_retail }}">{{ $retailName }}</option>
                                                {{-- @forelse ($retails as $item)
                                                <option value="{{ $item->id_retail }}" selected>{{ $item->name }}</option>
                                                @empty
                                                <p>tidak ada data</p>
                                                @endforelse --}}
                                            </select>
                                        </div>
                                            @error('id_retail') 
                                            <span class="error text-danger">{{ $message }}</span> 
                                            @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold align-middle">Status</td>
                                    <td>
                                        <select wire:model='status' class="form-control @error('status') is-invalid @enderror" readonly style="pointer-events: none;">
                                            <option value="" selected></option>
                                            <option value="1" @if($status == 1) selected @endif>Closing</option>
                                            <option value="2" @if($status == 2) selected @endif>Pending</option>
                                        </select>
                                        @error('status') 
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
                    <table class="table  table-striped table-sm table-hover rounded-6">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th class="text-center">Qty</th>
                                <th>Total Penjualan</th>
                                <th class="text-center">Qty Retur</th>
                                <th>Total Retur</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $subtotal = 0;
                            $subtotal_retur = 0;
                            $submodal = 0;
                            $bersih = 0;
                        @endphp
                        @forelse ($sales as $item)
                        @if($item->sale['jml_retur'] < 1)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $item->id_product }}</td>
                            <td class="align-middle">{{ $item->product['name'] }}</td>
                            <td class="align-middle">{{ $item->unit }}</td>
                            <td class="align-middle">{{ $item->selling_price }}</td>
                            <td class="align-middle text-center">{{ $item->qty }}</td>
                            <td class="align-middle text-orange font-weight-bold">{{number_format($item->selling_price*$item->qty, 0, ',', '.')  }}</td>
                            
                            <td class="align-middle">
                                <center>
                                
                                <div class="input-group" style="width: 120px;">
                                    <span class="input-group-btn">
    <button type="button" class=" btn btn-secondary" wire:loading.attr='disabled' wire:click="decQty('{{ $item->id_sale}}','{{ $item->id_product }}')" @if($item->qty_retur < 1) disabled @endif>
                                          <span class="fa fa-minus"></span>
                                        </button>
                                    </span>
                                    <input type="text" class="form-control text-center" value="{{ $item->qty_retur }}" min="1" readonly>
                           
                                    <span class="input-group-btn">
    <button type="button" class="btn btn-secondary"  wire:loading.attr='disabled' wire:click="incQty('{{ $item->id_sale}}','{{ $item->id_product }}')" @if( $item->qty <= $item->qty_retur)  disabled @endif>
                                            <span class="fa fa-plus"></span>
                                        </button>
                                    </span>

                                    {{-- {!! $item->product['qty'] < 1 ? "<span class='text-danger'>produk limit</span>" : '' !!} --}}
                                </div>
                            </center>
                            </td>
                            <td class="align-middle text-danger font-weight-bold">-{{ number_format( $item->selling_price * $item->qty_retur , 0, ',', '.') }}</td>

                        </tr>
                        @else
                            <tr>
                                <td colspan="9" class="font-weight-bold text-red pd-5 text-center">NOTA ATAU PENJUALAN INI SUDAH DI RETUR TIDAK DAPAT DIUBAH!</td>
                            </tr>
                            @break
                        @endif
                        @php
                        $sub = $item->selling_price * $item->qty;
                        $subtotal += $sub;
                        $subr = $item->selling_price * $item->qty_retur;
                        $subtotal_retur += $subr;

                        $mod = $item->capital_price * $item->qty;
                        $submodal += $mod;

                       $bersih = $subtotal-$subtotal_retur-$submodal;
                    @endphp 
                        @empty
                            <tr>
                                <td colspan="9" class="text-center p-3 font-italic">Belum ada produk yang ditambahkan</td>
                            </tr>
                      
                        @endforelse
                         
                        </tbody>
                    </table>
       
                    <div class="row">
                        <div class="col-md-6 ">
                            {{-- <div class="alert alert-warning alert-dismissible fade show" role="alert"
                                style="background-color: rgb(231, 231, 165)">
                                Pastikan jumlah produk cukup!.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div> --}}
                            {{-- <textarea wire:model='comment' rows="4" class="form-control" placeholder="Keterangan"></textarea> --}}
                        </div>
                        <div class="col-md-6">
                        
                            <table class="table table-striped table-sm">
                                <tr>
                                    <td class="font-weight-bold">Subtotal Penjualan</td>
                                    <td class="font-weight-bold text-orange bg-orange">Rp. {{ number_format( $subtotal, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Subtotal Retur</td>
                                    <td class="font-weight-bold text-danger bg-danger">Rp. -{{ number_format( $subtotal_retur, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Grand Total</td>
                                    <td class="font-weight-bold text-success bg-green">Rp. {{ number_format( $subtotal-$subtotal_retur, 0, ',', '.') }}</td>
                                </tr>
          
                                {{-- <tr>
                                    <td class="font-weight-bold">Diskon</td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" class="">
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr> --}}
                                {{-- <tr>
                                    <td class="font-weight-bold">Grand Total</td>
                                    <td>Rp.30.000</td>
                                </tr> --}}
                            </table>
                            <div class="float-right mt-2" style="display: inline-grid;
                    grid-template-columns: 1fr 1fr;
                    grid-gap: 2px;">
                    {{-- ADMIN --}}
                                <button type="button" wire:click="resetButton('{{ $idSale }}')" type="button" class="btn btn-danger btn-lg mr-2" @if($subtotal_retur < 1) disabled @endif><i class="fa fa-refresh"
                                        aria-hidden="true"></i> Reset</button>
                                <button wire:click="retur('{{ $idSale }}','{{ $subtotal_retur }}','{{ $subtotal }}','{{ $bersih }}','{{ $submodal }}')"  type="button" class="btn btn-primary btn-lg" @if($subtotal_retur < 1) disabled @endif><i class="fa fa-floppy-o" aria-hidden="true"></i> Buat
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
                @this.set('idSale',data);
            });
        });
</script>
@endpush