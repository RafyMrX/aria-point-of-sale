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
                                        Informasi Retail
                                    </div>
                                    <div>
                                        <span class="text-sm text-grey-m2 align-middle">Kepada:</span>
                                        <span class="text-600 text-110 align-middle text-secondary-d1">{{ $sales->name_retail }}</span>
                                    </div>
                                    <div class="text-grey-m2">
                                        <div class="my-1">
                                            Alamat: {{ $sales->retailAd}}
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
                                            <span class="text-600 text-90">ID:</span> {{ $sales->sale_id }}
                                        </div>
                                        <div class="my-2"><i class="fa fa-circle  text-xs mr-1"></i>
                                            <span class="text-600 text-90">Kasir:</span> {{ $sales->admin}}
                                        </div>
                                        <div class="my-2"><i class="fa fa-circle  text-xs mr-1"></i>
                                            <span class="text-600 text-90">Tanggal: </span>{{ \Carbon\Carbon::parse($sales->dateSale )->format("d F Y")  }}
                                        </div>
                                        <div class="my-2"><i class="fa fa-circle  text-xs mr-1"></i>
                                            <span class="text-600 text-90">Jam: </span>{{ \Carbon\Carbon::parse($sales->dateSale)->format("H:i")  }} WIB
                                        </div>

                                        <div class="my-2"><i class="fa fa-circle  text-xs mr-1"></i>
                                            <span class="text-600 text-90">Status:</span> 
                                            @if($sales->status == 2)
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
                                            <span class="text-600 text-90">Keterangan:</span> {{ $sales->ket }}
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-9">
                                    <h5>Produk terjual</h5>
                                    
                                    <table class="table table-sm ">
                                        <thead style="background-color: #f6f6f6;">
                                            <tr>
                                                <th>#</th>
                                                <th>Kode Produk</th>
                                                <th>Nama Produk</th>
                                                <th>Qty</th>
                                                <th>Satuan</th>
                                                <th>Harga</th>
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
                                                <td>{{ $item->qty }}</td>
                                                <td>{{ $item->satuan }}</td>
                                                <td>{{ number_format($item->hargaJual, 0, ',', '.')  }}</td>
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
                                                font-weight: bold;">Rp.{{ number_format($sales->totalSales, 0, ',', '.') }}</td>
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