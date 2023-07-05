@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <select name="" id="" class="form-control">
                    <option value="" selected>1 Bulan Terakhir</option>
                    <option value="" >4 Bulan Terakhir</option>
                    <option value="" >8 Bulan Terakhir</option>
                    <option value="" >12 Bulan Terakhir</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
        <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-usd" aria-hidden="true"></i></span>
        <div class="info-box-content">
        <span class="info-box-text">TOTAL LABA KOTOR</span>
        <span class="info-box-number">
        Rp.3.500.000
        </span>
        </div>
        </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
            <span class="info-box-icon bg-success elevation-1"><i class="fa fa-usd" aria-hidden="true"></i></span>
            <div class="info-box-content">
            <span class="info-box-text">TOTAL LABA BERSIH</span>
            <span class="info-box-number">
            Rp.3.500.000
            </span>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
        <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-refresh" aria-hidden="true"></i></span>
        <div class="info-box-content">
        <span class="info-box-text">PENJUALAN PENDING</span>
        <span class="info-box-number">
        6
        </span>
        </div>
        </div>
        </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                <span class="info-box-icon bg-success elevation-1"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">PENJUALAN CLOSING</span>
                <span class="info-box-number">
                4
                </span>
                </div>
                </div>
                </div>


    </div>
    
    <div class="row">
        <div class="col-md-8">
            <div id="container" style="width:100%; height:400px;"></div>
<script>
Highcharts.chart('container', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Total Pendapatan Bersih 3 Bulan Terakhir'
    },
    xAxis: {
        categories: ['January', 'February', 'March']
    },
    yAxis: {
        title: {
            text: 'Jumlah Uang'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Pendapatan',
        data: [2000000, 1500000, 3000000]
    }]
});
            </script>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Penjualan dan Pembelian Terbaru</h3>
                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
                </button>
                </div>
                </div>
                
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                    <li class="item">
                    <div class="product-img">
                    <p>INV1002</p>
                    </div>
                    <div class="product-info">
                    <span class="product-title">Toko Sembako</span>
                    <span class="badge badge-secondary">Rp.22.000</span> <span class="badge badge-info">Pembelian</span> 
                    <span class="product-description">
                   1 hour ago <a href="">Lihat Detail</a>
                    </span>
                    </div>
                    </li>
                    </ul>
                    </div>

                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                    <li class="item">
                    <div class="product-img">
                    <p>INV1003</p>
                    </div>
                    <div class="product-info">
                    <span class="product-title">Cik Melan</span>
                    <span class="badge badge-secondary">Rp.20.000</span> <span class="badge badge-primary">Penjualan</span> 
                    <span class="badge badge-success float-right">Closing</span>
                    <span class="product-description">
                   1 hour ago <a href="">Lihat Detail</a>
                    </span>
                    </div>
                    </li>
                    </ul>
                    </div>

                    <div class="card-body p-0">
                        <ul class="products-list product-list-in-card pl-2 pr-2">
                        <li class="item">
                        <div class="product-img">
                        <p>INV1004</p>
                        </div>
                        <div class="product-info">
                        <span class="product-title">Lindan</span>
                        <span class="badge badge-secondary">Rp.22.000</span> <span class="badge badge-primary">Penjualan</span> 
                        <span class="badge badge-warning float-right">Pending</span>
                        <span class="product-description">
                       1 hour ago <a href="">Lihat Detail</a>
                        </span>
                        </div>
                        </li>
                        </ul>
                        </div>
        </div>
    </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            
        </div>
    </div>
@endsection


