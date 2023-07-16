@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
    
@endpush
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


@livewire('dashboard.show')


@endsection


