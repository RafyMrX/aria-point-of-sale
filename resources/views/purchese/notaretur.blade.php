<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>

</head>
<body>
    <script>
        window.print()
    </script>
            <div class="page-content container">
                <div class="page-header ">
                    <div class="row">
                        <div class="col-md-6" style="margin-bottom: -21px;">
                            <h1>ARIA</h1>
                            <p style="margin-top: -12px;">Donat Kentang, Snack & Nasi</p>
                            <p style="margin-top: -20px;">081336517773, 0813336517778</p>
                        </div>
                    </div>
                    
                </div>
                <hr>
                                <!-- .row -->

                            <div class="row">
                                <div class="col-md-3 border-right">
                                    <div class="mt-1 mb-2 text-gray  text-600 text-125">
                                        Informasi Supplier
                                    </div>
                                    <div>
                                        <span class="text-sm text-grey-m2 align-middle">Kepada:</span>
                                        <span class="text-600 text-110 align-middle text-secondary-d1">{{ $sales->name_sup }}</span>
                                    </div>
                                    <div class="text-grey-m2">
                                        <div class="my-1">
                                            Alamat: {{ $sales->retailAd }}
                                        </div>
                                        <div class="my-1">
                                            Tlp: {{ $sales->retailTel }}
                                        </div>
                                        <div class="my-1">
                                            Email: {{ $sales->retailem }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="text-grey-m2">
                                        <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                            Informasi Nota
                                        </div>

                                        <div class="my-2"><i class="fa fa-circle  text-xs mr-1"></i>
                                            <span class="text-600 text-90">ID:</span> {{ $sales->pur_id }}
                                        </div>
                                        <div class="my-2"><i class="fa fa-circle  text-xs mr-1"></i>
                                            <span class="text-600 text-90">Admin:</span> {{ $sales->admin }}
                                        </div>
                                        <div class="my-2"><i class="fa fa-circle  text-xs mr-1"></i>
                                            <span class="text-600 text-90">Tanggal: </span>{{ \Carbon\Carbon::parse($sales->date_pur )->format("d F Y")  }}
                                        </div>
                                        <div class="my-2"><i class="fa fa-circle  text-xs mr-1"></i>
                                            <span class="text-600 text-90">Jam: </span>{{ \Carbon\Carbon::parse($sales->date_pur )->format("H:i")  }} WIB
                                        </div>

                                 
                                        <div class="my-2"><i class="fa fa-circle  text-xs mr-1"></i>
                                            <span class="text-600 text-90">Keterangan:</span> {{ $sales->ket }}
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-9">
                                    <h5>Produk dibeli</h5>
                                    <table class="table table-sm ">
                                        <thead style="background-color: #f6f6f6;">
                                            <tr>
                                                <th>#</th>
                                                <th>Kode Produk </th>
                                                <th>Nama Produk</th>
                                                <th>Satuan</th>
                                                {{-- <th>modal</th> --}}
                                                <th>Harga</th>
                                                <th class="text-center">Qty Pembelian</th>
                                                <th>Total Pembelian</th>
                                                <th class="text-center border-left">Qty Retur</th>
                                                <th>Total Retur</th>
                                                {{-- <th>Aksi</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $subtotal = 0;
                                                $subtotal_retur = 0;
                                                // $modal = 0;
                                            @endphp
                                            @foreach ($data as $index => $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->pid }}</td>
                                                <td>{{ $item->nameP }}</td>
                                                <td>{{ $item->satuan }}</td>
                                                {{-- <td>{{ number_format($item->hargamodal, 0, ',', '.')  }}</td> --}}
                                                <td>{{ number_format($item->hargamodal, 0, ',', '.')  }}</td>
                                                <td class="text-center">
                                                
                                                    {{ $item->qty }}
                                           
                                                </td>
                                                <td class="text-orange">{{ number_format( $item->hargamodal * $item->qty , 0, ',', '.') }}</td>

                                                <td class="text-center">
                                          
                                                    {{ $item->qty_retur }}
                                       
                                                </td>
                                                <td class="text-danger">-{{ number_format( $item->hargamodal * $item->qty_retur , 0, ',', '.') }}</td>
                                                {{-- @if($stEdit === $index)
                                                <td class="text-center border-left"><button wire:click="editD('{{ $editqty }}','{{ $editqtyr }}','{{ $editindex }}')" type="button" class="btn btn-success">Simpan</button></td>
                                                @else
                                                <td class="text-center border-left"><button wire:click="editData({{ $index }})" type="button" class="btn btn-warning">Edit</button>
                                                </td>
                                                @endif --}}
                                               
                                            </tr>
                                            @php
                                            $sub = $item->hargamodal * $item->qty;
                                            $subtotal += $sub;
                                            $subr = $item->hargamodal * $item->qty_retur;
                                            $subtotal_retur += $subr;

                                            // $mod = $item->hargamodal * $item->qty;
                                            // $modal += $mod;
                                            @endphp 
                                            @endforeach
                                            {{-- {{ $modal }} --}}
                                            <tr>
                                                <td colspan="7"  class="font-weight-bold" style="background-color: #c6c6c6;">Subtotal Pembelian <i class="text-sm">(Sp)</i></td>
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
                                </div>

                                <!-- /.col -->
                            </div>

                            <hr>
                        
            </div>

            
</body>
</html>