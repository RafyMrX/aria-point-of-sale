@push('styles')
<style>
    .text-secondary-d1 {
        color: #728299 !important;
    }

    .page-header {
        margin: 0 0 1rem;
        padding-bottom: 1rem;
        padding-top: .5rem;
        border-bottom: 1px dotted #e2e2e2;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -ms-flex-align: center;
        align-items: center;
    }

    .page-title {
        padding: 0;
        margin: 0;
        font-size: 1.75rem;
        font-weight: 300;
    }

    .brc-default-l1 {
        border-color: #dce9f0 !important;
    }

    .ml-n1,
    .mx-n1 {
        margin-left: -.25rem !important;
    }

    .mr-n1,
    .mx-n1 {
        margin-right: -.25rem !important;
    }

    .mb-4,
    .my-4 {
        margin-bottom: 1.5rem !important;
    }

    hr {
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 1px solid rgba(0, 0, 0, .1);
    }

    .text-grey-m2 {
        color: #888a8d !important;
    }

    .text-success-m2 {
        color: #86bd68 !important;
    }

    .font-bolder,
    .text-600 {
        font-weight: 600 !important;
    }

    .text-110 {
        font-size: 110% !important;
    }

    .text-blue {
        color: #303031 !important;
    }

    .pb-25,
    .py-25 {
        padding-bottom: .75rem !important;
    }

    .pt-25,
    .py-25 {
        padding-top: .75rem !important;
    }

    .bgc-default-tp1 {
        background-color: rgb(53 53 53 / 92%) !important;
    }

    .bgc-default-l4,
    .bgc-h-default-l4:hover {
        background-color: #f3f8fa !important;
    }

    .page-header .page-tools {
        -ms-flex-item-align: end;
        align-self: flex-end;
    }

    .btn-light {
        color: #757984;
        background-color: #f5f6f9;
        border-color: #dddfe4;
    }

    .w-2 {
        width: 1rem;
    }

    .text-120 {
        font-size: 120% !important;
    }

    .text-primary-m1 {
        color: #4087d4 !important;
    }

    .text-danger-m1 {
        color: #dd4949 !important;
    }

    .text-blue-m2 {
        color: #68a3d5 !important;
    }

    .text-150 {
        font-size: 150% !important;
    }

    .text-60 {
        font-size: 60% !important;
    }

    .text-grey-m1 {
        color: #7b7d81 !important;
    }

    .align-bottom {
        vertical-align: bottom !important;
    }
</style>
@endpush
<div wire:ignore.self class="modal fade bd-example-modal" id='detailSalesmodal' tabindex="-1" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="retailmodalLabel">Detail Penjualan</h5>
                <button wire:click='cancel' type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="page-content container">
                    <div class="page-header ">
                        <h1 class="page-title text-secondary-d1">
                            Invoice
                            <small class="page-info">
                                <i class="fa fa-angle-double-right text-80"></i>
                                : {{ $idSale }}
                            </small>
                        </h1>

                        <div class="page-tools">
                            <div class="action-buttons">
                                @if($stRetur < 1)
                                <a class="btn btn-secondary mx-1px text-95" href="{{url('/exportsales/'.$id_detail)}}" target="_blank" data-title="Print">
                                  <i class="fa fa-print" aria-hidden="true"></i>
                                  Cetak
                              </a>
                              @else
                              <a class="btn btn-secondary mx-1px text-95" href="{{url('/exportsalesretur/'.$id_detail)}}" target="_blank" data-title="Print">
                                <i class="fa fa-print" aria-hidden="true"></i>
                                Cetak
                            </a>
                              @endif
                            </div>
                        </div>
                    </div>

                    <div class="container px-0">
                        <div class="row mt-4">
                            <div class="col-12 col-lg-12">

                                <!-- .row -->

                                <div class="row">
                                    <div class="col-md-2 border-right">
                                        <div class="mt-1 mb-2 text-gray  text-600 text-125">
                                            Informasi Retail
                                        </div>
                                        <div>
                                            <span class="text-sm text-grey-m2 align-middle">Kepada:</span>
                                            <span class="text-600 text-110 align-middle text-secondary-d1">{{ $retailName }}</span>
                                        </div>
                                        <div class="text-grey-m2">
                                            <div class="my-1">
                                                Alamat: {{ $retailAddress }}
                                            </div>
                                            <div class="my-1">
                                                Tlp: {{ $retailTlp }}
                                            </div>
                                            <div class="my-1">
                                                Email: {{ $retailEmail }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="text-grey-m2">
                                            <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                                Informasi Nota
                                            </div>

                                            <div class="my-2"><i class="fa fa-circle  text-xs mr-1"></i>
                                                <span class="text-600 text-90">ID:</span> {{ $idSale }}
                                            </div>
                                            <div class="my-2"><i class="fa fa-circle  text-xs mr-1"></i>
                                                <span class="text-600 text-90">Kasir:</span> {{ $nameAdmin }}
                                            </div>
                                            <div class="my-2"><i class="fa fa-circle  text-xs mr-1"></i>
                                                <span class="text-600 text-90">Tanggal: </span>{{ \Carbon\Carbon::parse($dateSale )->format("d F Y")  }}
                                            </div>
                                            <div class="my-2"><i class="fa fa-circle  text-xs mr-1"></i>
                                                <span class="text-600 text-90">Jam: </span>{{ \Carbon\Carbon::parse($dateSale )->format("H:i")  }} WIB
                                            </div>

                                            <div class="my-2"><i class="fa fa-circle  text-xs mr-1"></i>
                                                <span class="text-600 text-90">Status:</span> 
                                                @if($status == 2)
                                                <span class="badge badge-warning badge-pill px-25">
                                                    Pending
                                                </span>
                                                @else
                                                <span class="badge badge-success badge-pill px-25">
                                                    Closing
                                                </span>
                                                @endif
                                            </div>
                                            <div class="my-2"><i class="fa fa-circle  text-xs mr-1"></i>
                                                <span class="text-600 text-90">Keterangan:</span> {{ $comment }}
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-10">
                                        <h5>Produk terjual</h5>
                                        @if($stRetur < 1)
                                        <table class="table table-sm ">
                                            <thead style="background-color: #f6f6f6;">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Kode Produk</th>
                                                    <th>Nama Produk</th>
                                                    <th>Satuan</th>
                                                    <th>Harga</th>
                                                    <th>Qty</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $subtotal = 0;
                                                @endphp
                                                @foreach ($data as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->pid }}</td>
                                                    <td>{{ $item->nameP }}</td>
                                                    <td>{{ $item->satuan }}</td>
                                                    <td>{{ number_format($item->hargaJual, 0, ',', '.')  }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>{{ number_format( $item->hargaJual * $item->qty , 0, ',', '.') }}</td>
                                                </tr>
                                                @php
                                                    $sub= $item->hargaJual * $item->qty;
                                                    $subtotal += $sub;
                                                @endphp
                                                @endforeach
                                        
    
                                                <tr>
                                                    <td colspan="5" style="border: none; background-color:#f6f6f6;"></td>
                                                    <td class="font-weight-bold" style="background-color: #c6c6c6">Grand Total</td>
                                                    <td style="background-color: #c1f5c2;
                                                    font-weight: bold;">Rp.{{ number_format($total, 0, ',', '.') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="custom-control custom-switch mb-2">
                                            <input wire:change='switchModal({{ $stModal }})' type="checkbox" class="custom-control-input" @checked($stModal == 1) id="1">
                                            <label class="custom-control-label text-sm" for="1">
                                              {!! $stModal == 1 ? "<span class='badge badge-pill badge-secondary'>Sembunyikan</span>" : "<span class='badge badge-pill badge-secondary'>Tampilkan Informasi Modal</span>" !!}
                                            </label>
                                      
                                          </div>
                                        @if($stModal == 1)
                                        <h5>Penjualan Modal</h5>
                                        <table class="table table-sm ">
                                            <thead style="background-color: #f6f6f6;">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Kode Produk </th>
                                                    <th>Nama Produk</th>
                                                    <th>Satuan</th>
                                                    <th>hrg modal</th>
                                                    <th class="text-center">Qty </th>
                                                    <th>Total Modal</th>
                                                    {{-- <th>Aksi</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $subtotal = 0;
                                                    $subtotal_retur = 0;
                                                    $modal = 0;
                                                @endphp
                                                @foreach ($data as $index => $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->pid }}</td>
                                                    <td>{{ $item->nameP }}</td>
                                                    <td>{{ $item->satuan }}</td>
                                                    <td>{{ number_format($item->hargamodal, 0, ',', '.')  }}</td>
                                                    <td class="text-center">
                                                        {{ $item->qty }}
                                                    </td>
                                                    <td>{{ number_format( $item->hargamodal * $item->qty , 0, ',', '.') }}</td>
                                                    {{-- @if($stEdit === $index)
                                                    <td class="text-center border-left"><button wire:click="editD('{{ $editqty }}','{{ $editqtyr }}','{{ $editindex }}')" type="button" class="btn btn-success">Simpan</button></td>
                                                    @else
                                                    <td class="text-center border-left"><button wire:click="editData({{ $index }})" type="button" class="btn btn-warning">Edit</button>
                                                    </td>
                                                    @endif --}}
                                                   
                                                </tr>
                                                @php
                                                $mod = $item->hargamodal * $item->qty;
                                                $modal += $mod;
                                                @endphp 
                                                @endforeach
                                                <tr>
                                                    <td colspan="6"  class="font-weight-bold" style="background-color: #c6c6c6;">Subtotal Modal</td>
                                                    <td colspan="7" class="bg-secondary font-weight-bold">Rp.{{ number_format( $modal , 0, ',', '.') }}</td>
                                                </tr>
                 
                                            </tbody>
                                        </table>
                                        @endif


                                        @else
                                        <table class="table table-sm ">
                                            <thead style="background-color: #f6f6f6;">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Kode Produk </th>
                                                    <th>Nama Produk</th>
                                                    <th>Satuan</th>
                                                    {{-- <th>hrg modal</th> --}}
                                                    <th>hrg jual</th>
                                                    <th class="text-center">Qty Penjualan</th>
                                                    <th>Total Penjualan</th>
                                                    <th class="text-center border-left">Qty Retur</th>
                                                    <th>Total Retur</th>
                                                    {{-- <th>Laba produk</th> --}}
                                                    {{-- <th>Aksi</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $subtotal = 0;
                                                    $subtotal_retur = 0;
                                                    // $modal = 0;
                                                    $laba = 0;
                                                @endphp
                                                @foreach ($data as $index => $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->pid }}</td>
                                                    <td>{{ $item->nameP }}</td>
                                                    <td>{{ $item->satuan }}</td>
                                                    {{-- <td>{{ number_format($item->hargamodal, 0, ',', '.')  }}</td> --}}
                                                    <td>{{ number_format($item->hargaJual, 0, ',', '.')  }}</td>
                                                    <td class="text-center">
                                                        @if($stEdit === $index)
                                                        <input type="number" wire:model.debounce.600ms='editJ.{{ $item->idD }}' style="width: 50px;">
                                                        @else
                                                        {{ $item->qty }}
                                                        @endif
                                                    </td>
                                                    <td class="text-orange">{{ number_format( $item->hargaJual * $item->qty , 0, ',', '.') }}</td>

                                                    <td class="text-center">
                                                        @if($stEdit === $index)
                                                        <input type="number" wire:model.debounce.600ms='editR.{{ $item->idD }}' style="width: 50px;">
                                                        @else
                                                        {{ $item->qty_retur }}
                                                        @endif
                                                    </td>
                                                    <td class="text-danger">-{{ number_format( $item->hargaJual * $item->qty_retur , 0, ',', '.') }}</td>
                                                 
                                                    {{-- @php
                                                        $untung = $item->hargamodal-$item->hargaJual;
                                                        $pnj = $item->qty-$item->qty_retur;
                                                    @endphp
                                                    <td class="text-success">{{  number_format($untung * $pnj   , 0, ',', '.') }}</td> --}}

                                                    {{-- @if($stEdit === $index)
                                                    <td class="text-center border-left"><button wire:click="editD('{{ $editqty }}','{{ $editqtyr }}','{{ $editindex }}')" type="button" class="btn btn-success">Simpan</button></td>
                                                    @else
                                                    <td class="text-center border-left"><button wire:click="editData({{ $index }})" type="button" class="btn btn-warning">Edit</button>
                                                    </td>
                                                    @endif --}}
                                                   
                                                </tr>
                                                @php
                                                $sub = $item->hargaJual * $item->qty;
                                                $subtotal += $sub;
                                                $subr = $item->hargaJual * $item->qty_retur;
                                                $subtotal_retur += $subr;
                                                // $lab = $untung * $pnj;
                                                // $laba += $lab;

                                                // $mod = $item->hargamodal * $item->qty;
                                                // $modal += $mod;
                                                @endphp 
                                                @endforeach
                                                {{-- {{ $modal }} --}}
                                                {{-- {{ $laba }} --}}
                                                <tr>
                                                    <td colspan="7"  class="font-weight-bold" style="background-color: #c6c6c6;">Subtotal Penjualan <i class="text-sm">(Sp)</i></td>
                                                    <td colspan="7" class="bg-orange font-weight-bold">Rp.{{ number_format( $subtotal, 0, ',', '.') }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="7" class="font-weight-bold" style="background-color: #c6c6c6">Subtotal Retur <i class="text-sm">(Sr)</i></td>
                                                    <td colspan="7" class="bg-danger font-weight-bold">Rp. -{{ number_format( $subtotal_retur, 0, ',', '.') }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="7"  class="font-weight-bold" style="background-color: #c6c6c6">Grand Total <span class="text-sm"><i>(Sp - Sr)</i></span></td>
                                                    <td colspan="7" class="bg-success font-weight-bold">Rp. {{ number_format( $subtotal - $subtotal_retur, 0, ',', '.') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="custom-control custom-switch mb-2">
                                            <input wire:change='switchModal({{ $stModal }})' type="checkbox" class="custom-control-input" @checked($stModal == 1) id="1">
                                            <label class="custom-control-label text-sm" for="1">
                                              {!! $stModal == 1 ? "<span class='badge badge-pill badge-secondary'>Sembunyikan</span>" : "<span class='badge badge-pill badge-secondary'>Tampilkan Informasi Modal</span>" !!}
                                            </label>
                                      
                                          </div>
                                        @if($stModal == 1)
                                        <h5>Penjualan Modal</h5>
                                        <table class="table table-sm ">
                                            <thead style="background-color: #f6f6f6;">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Kode Produk </th>
                                                    <th>Nama Produk</th>
                                                    <th>Satuan</th>
                                                    <th>hrg modal</th>
                                                    <th class="text-center">Qty </th>
                                                    <th>Total Modal</th>
                                                    {{-- <th>Aksi</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $subtotal = 0;
                                                    $subtotal_retur = 0;
                                                    $modal = 0;
                                                @endphp
                                                @foreach ($data as $index => $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->pid }}</td>
                                                    <td>{{ $item->nameP }} {!! $item->rtr == 1 ? "<sup class ='text-small text-success font-weight-bold'>Konsinyasi</sup>" : "" !!}</td>
                                                    <td>{{ $item->satuan }}</td>
                                                    <td>{{ number_format($item->hargamodal, 0, ',', '.')  }}</td>
                                                    <td class="text-center">
                                                        @if ($item->rtr == 1)
                                                        {{ $item->qty - $item->qtyretur}}
                                                        @else
                                                        {{ $item->qty }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->rtr == 1)
                                                        @php
                                                            $j =  $item->qty - $item->qtyretur;
                                                        @endphp
                                                        {{ number_format( $item->hargamodal * $j , 0, ',', '.') }}
                                                        @else
                                                        {{ number_format( $item->hargamodal * $item->qty , 0, ',', '.') }}
                                                        @endif
                                                    </td>
                                                    {{-- @if($stEdit === $index)
                                                    <td class="text-center border-left"><button wire:click="editD('{{ $editqty }}','{{ $editqtyr }}','{{ $editindex }}')" type="button" class="btn btn-success">Simpan</button></td>
                                                    @else
                                                    <td class="text-center border-left"><button wire:click="editData({{ $index }})" type="button" class="btn btn-warning">Edit</button>
                                                    </td>
                                                    @endif --}}
                                                   
                                                </tr>
                                                @php
                                                if($item->rtr == 1){
                                                $j =  $item->qty - $item->qtyretur;
                                                $mod = $item->hargamodal * $j;
                                                $modal += $mod;
                                                }else{
                                                $mod = $item->hargamodal * $item->qty;
                                                $modal += $mod;
                                                }
                                                @endphp 
                                                @endforeach
                                                <tr>
                                                    <td colspan="6"  class="font-weight-bold" style="background-color: #c6c6c6;">Subtotal Modal</td>
                                                    <td colspan="7" class="bg-secondary font-weight-bold">Rp.{{ number_format( $modal , 0, ',', '.') }}</td>
                                                </tr>
                 
                                            </tbody>
                                        </table>
                                        @endif
                                        @endif

                                    </div>

                                    <!-- /.col -->
                                </div>

                                <div class="mt-4">
                                    


                                    <div class="row border-b-2 brc-default-l2"></div>

    

                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">

                                        </div>

                                        <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>