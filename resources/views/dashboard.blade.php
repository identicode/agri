@extends('layouts.app')

{{-- VENDOR CSS --}}
@section('css-top')
<!-- c3 Charts -->
<link href="{{ asset('vendor/c3/c3.min.css') }}" rel="stylesheet">
@endsection

{{-- CSS STYLE --}}
@section('css-bot')

@endsection

{{-- PAGE TITLE --}}
@section('page-title')
Dashboard
@endsection

{{-- BREAD CRUMB --}}
@section('breadcrumb')

@endsection

{{-- BUTTON ACCTION --}}
@section('page-button')

@endsection

{{-- MAIN CONTENT --}}
@section('main-section')
<div class="row">

	<div class="col-lg-3">
        <div class="widget style1 navy-bg">
            <div class="row">
                <div class="col-xs-4">
                    <i class="fa fa-user fa-5x"></i>
                </div>
                <div class="col-xs-8 text-right">
                    <span> Seller </span>
                    <h2 class="font-bold">{{ $count['seller'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="widget style1 lazur-bg">
            <div class="row">
                <div class="col-xs-4">
                    <i class="fa fa-lemon-o fa-5x"></i>
                </div>
                <div class="col-xs-8 text-right">
                    <span> Producer </span>
                    <h2 class="font-bold">{{ $count['producer'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="widget style1 yellow-bg">
            <div class="row">
                <div class="col-xs-4">
                    <i class="fa fa-truck fa-5x"></i>
                </div>
                <div class="col-xs-8 text-right">
                    <span> Dealer </span>
                    <h2 class="font-bold">{{ $count['dealer'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="widget style1 red-bg">
            <div class="row">
                <div class="col-xs-4">
                    <i class="fa fa-leaf fa-5x"></i>
                </div>
                <div class="col-xs-8 text-right">
                    <span> Product </span>
                    <h2 class="font-bold">{{ $count['product'] }}</h2>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">

	<div class="col-lg-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Seller</h5>
            </div>
            <div class="ibox-content">
                <div>
                    <div id="seller-pie"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Producer</h5>
            </div>
            <div class="ibox-content">
                <div>
                    <div id="producer-pie"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Dealer</h5>
            </div>
            <div class="ibox-content">
                <div>
                    <div id="dealer-pie"></div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

{{-- VENDOR JS --}}
@section('js-top')
<!-- d3 and c3 charts -->
<script src="{{ asset('vendor/d3/d3.min.js') }}"></script>
<script src="{{ asset('vendor/c3/c3.min.js') }}"></script>
@endsection

{{-- JS SCRIPT --}}
@section('js-bot')
<script type="text/javascript">
$(document).ready(function () {
	c3.generate({
        bindto: '#seller-pie',
        data:{
            columns: [
                ['data1', 30],
                ['data2', 120]
            ],
            colors:{
                data1: '#1ab394',
                data2: '#23c6c8'
            },
            type : 'pie'
        }
    });

    c3.generate({
        bindto: '#producer-pie',
        data:{
            columns: [
                ['data1', 30],
                ['data2', 120]
            ],
            colors:{
                data1: '#1ab394',
                data2: '#23c6c8'
            },
            type : 'pie'
        }
    });

    c3.generate({
        bindto: '#dealer-pie',
        data:{
            columns: [
                ['data1', 30],
                ['data2', 120]
            ],
            colors:{
                data1: '#1ab394',
                data2: '#23c6c8'
            },
            type : 'pie'
        }
    });
});
</script>
@endsection