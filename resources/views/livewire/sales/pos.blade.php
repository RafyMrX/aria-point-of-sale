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
                                        <input wire:model='kode_sales' type="text" class="form-control" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold align-middle">Tanggal</td>
                                    <td><input wire:model='date_sales' type="date" class="form-control @error('date_sales') is-invalid @enderror">
                                    @error('date_sales') 
                                        <span class="error text-danger">{{ $message }}</span> 
                                     @enderror
                                    </td>
                                  
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
                        <h3 class="card-title">Informasi Retail</h3>
                    </div>
                    <form>
                        <div class="card-body">
                            <table class="table table-sm">
                                <tr>

                                    <td class="font-weight-bold align-middle">Retail</td>
                                    <td>
                                        <div wire:ignore>
                                            <select wire:model='id_retail' class="form-control @error('id_retail') is-invalid @enderror" id="select2-dropdown">
                                                <option selected>-- pilih --</option>
                                                @forelse ($retails as $item)
                                                <option value="{{ $item->id_retail }}" selected>{{ $item->name }}</option>
                                                @empty
                                                <p>tidak ada data</p>
                                                @endforelse
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
                                        <select wire:model='status' class="form-control @error('status') is-invalid @enderror">
                                            <option value="" selected>-- pilih --</option>
                                            <option value="1">Closing</option>
                                            <option value="2">Pending</option>
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
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th class="text-center">Disc(%)</th>
                                <th class="text-center">Qty PJ</th>
                                <th>Total PJ</th>
                                <th class="text-center">Qty RTR</th>
                                <th>Total RTR</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $subtotal = 0;
                            $subtotal_retur = 0;
                            $submodal = 0;
                            $bersih = 0;
                            $bt=2;
                            $btr=2;
                        @endphp
                        @forelse ($carts as $item)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $item->id_product }}</td>
                            <td class="align-middle">{{ $item->name }}</td>
                            <td class="align-middle">{{ $item->product['unit'] }}</td>
                            <td class="align-middle">
                                {{  number_format($item->selling_price, 0, ',', '.')  }}
                            </td>

                            <td class="align-middle">
                                @if($item->diskon < 1)
                                <input wire:model.debounce.700ms='disc.{{ $item->id }}' type="number" class="form-control text-center" value="0" min="1" placeholder="disc" style="width:85px;">
                                @else
                                <a href="#" wire:click="resetDisc('{{ $item->id }}')"><u>Reset diskon</u></a>
                                @endif
                            </td>

                            {{-- QTY PENJUALAN --}}
                            <td class="align-middle">
                                <center>
                                
                                <div class="input-group" style="width: 100px;">
                                    <span class="input-group-btn">
    {{-- <button type="button" class=" btn btn-secondary" wire:loading.attr='disabled' wire:click="decQty('{{ $item->id}}','{{ $item->id_product }}')"  @if($item->qty < 1) disabled @endif>
                                          <span class="fa fa-minus"></span>
                                        </button> --}}
                                    </span>
                                    <input wire:model.debounce.700ms='qtyJ.{{ $item->id }}' type="number" class="form-control text-center" value="0" min="1" placeholder="0">
                           
                                    <span class="input-group-btn">
    {{-- <button type="button" class="btn btn-secondary"  wire:loading.attr='disabled' wire:click="incQty('{{ $item->id}}','{{ $item->id_product }}')" @if( $item->product['qty'] < 1) disabled @endif>
                                            <span class="fa fa-plus"></span>
                                        </button> --}}
                                    </span>

                                </div>
                                {!! $item->qty > $item->product['qty'] ? "<span class='text-danger'>produk limit</span>" : '' !!}
                            </center>
                            </td>

                            <td class="align-middle text-orange font-weight-bold">{{ number_format( $item->selling_price * $item->qty , 0, ',', '.') }}</td>
                            {{-- END PENJUALAN --}}
                            {{-- START RETUR --}}
                            <td class="align-middle">
                                <center>
                                
                                <div class="input-group" style="width: 100px;">
                                    <span class="input-group-btn">
    {{-- <button type="button" class=" btn btn-secondary" wire:loading.attr='disabled' wire:click="decQtyR('{{ $item->id}}','{{ $item->id_product }}')" @if($item->qty_retur < 1) disabled @endif>
                                          <span class="fa fa-minus"></span>
                                        </button> --}}
                                    </span>
                                    <input wire:model.debounce.700ms='qtyR.{{ $item->id }}' type="number" class="form-control text-center" value="0" min="1" placeholder="0">
                           
                                    <span class="input-group-btn">
    {{-- <button type="button" class="btn btn-secondary"  wire:loading.attr='disabled' wire:click="incQtyR('{{ $item->id}}','{{ $item->id_product }}')" @if( $item->qty <= $item->qty_retur)  disabled @endif>
                                            <span class="fa fa-plus"></span>
                                        </button> --}}
                                    </span>

                                </div>
                                {!! $item->qty_retur > $item->qty ? "<span class='text-danger'>retur limit</span>" : '' !!}
                            </center>
                            </td>

                            <td class="align-middle text-danger font-weight-bold">-{{ number_format( $item->selling_price * $item->qty_retur , 0, ',', '.') }}</td>

                           

                            {{-- END RETUR --}}
                            <td class="align-middle font-weight-bold">{{ number_format(($item->selling_price * $item->qty) - ($item->selling_price * $item->qty_retur), 0, ',', '.')}}</td>
                            <td class="align-middle">
                                <button type="submit" class="btn btn-danger"
                                    wire:click="deleteCart('{{ $item->id }}','{{ $item->id_product }}','{{ $item->qty }}', '{{  $item->product['qty'] }}')"><i class="fa fa-trash-o"
                                        aria-hidden="true"></i></button>
                            </td>
                        </tr>
                        @php
                        $sub = $item->selling_price * $item->qty;
                        $subtotal += $sub;
                        $subr = $item->selling_price * $item->qty_retur;
                        $subtotal_retur += $subr;

                        if($item->product['retur'] == 1){
                        $j =  $item->qty - $item->qty_retur;
                        $mod = $item->capital_price * $j;
                        $submodal += $mod;
                        }else{
                        $mod = $item->capital_price * $item->qty;
                        $submodal += $mod;
                        }

                       $bersih = $subtotal-$subtotal_retur-$submodal;

                       if($item->qty > $item->product['qty']){
                        $bt = 1;
                       }else{
                        $bt = 2;
                       }

                       if($item->qty_retur > $item->qty){
                        $btr = 1;
                       }else{
                        $btr = 2;
                       }

                         @endphp
                        @empty
                            <tr>
                                <td colspan="12" class="text-center p-3 font-italic">Belum ada produk yang ditambahkan</td>
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
                            <textarea wire:model='comment' rows="4" class="form-control" placeholder="Keterangan"></textarea>
                        </div>
                        <div class="col-md-6">
                {{-- {{ $bersih }} --}}
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
                                <button type="button" wire:click="resetCart('{{ $id_user }}','1')" type="button" class="btn btn-danger btn-lg mr-2" @if($statusCartreset < 1) disabled @endif><i class="fa fa-refresh"
                                        aria-hidden="true"></i> Reset</button>
                                <button wire:click="order('{{ $id_user }}', '{{ $subtotal }}','{{ $bersih }}','{{ $submodal }}','{{ $subtotal_retur }}')"  type="button" class="btn btn-primary btn-lg "  @if($statusCart < 1 or $bt == 1 or  $btr == 1) disabled @endif><i class="fa fa-floppy-o" aria-hidden="true" ></i> Buat Transaksi</button>
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
                @this.set('id_retail',data);
            });
        });
</script>
@endpush