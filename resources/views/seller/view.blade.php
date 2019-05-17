@extends('layouts.app')

{{-- VENDOR CSS --}}
@section('css-top')
<link href="{{ asset('vendor/chosen/chosen.css') }}" rel="stylesheet">
@endsection

{{-- CSS STYLE --}}
@section('css-bot')

@endsection

{{-- PAGE TITLE --}}
@section('page-title')
Seller Full Information
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
    <div class="col-lg-12">
	    <div class="ibox float-e-margins">
	        <div class="ibox-title">
	            <h5>Seller Full Information</h5>
	        </div>
	        <div class="ibox-content">

	        	<div class="row">

	        		<div class="col-sm-8">

	        			<div class="row">
	        				<div class="col-sm-12">
	        					<div class="form-group col-sm-4">
						            <label for="last-name"><strong>Last Name:</strong></label>
						            <input readonly value="{{ $seller->lname }}" type="text" class="form-control">
						        </div>
						        <div class="form-group col-sm-4">
						            <label for="last-name"><strong>First Name:</strong></label>
						            <input readonly value="{{ $seller->fname }}" type="text" class="form-control">
						        </div>
						        <div class="form-group col-sm-4">
						            <label for="last-name"><strong>Middle Name:</strong></label>
						            <input readonly value="{{ $seller->mname }}" type="text" class="form-control">
						        </div>
	        				</div>
	        			</div>

	        			<div class="row">
	        				<div class="col-sm-12">
	        					<div class="form-group col-sm-3">
						            <label for="last-name"><strong>Birthday:</strong></label>
						            <input readonly value="{{ $seller->birth }}" type="text" class="form-control">
						        </div>
						        <div class="form-group col-sm-3">
						            <label for="last-name"><strong>Age:</strong></label>
						            <input readonly value="{{ Carbon\Carbon::parse($seller->birth)->age }}" type="text" class="form-control">
						        </div>
						        <div class="form-group col-sm-3">
						            <label for="last-name"><strong>Gender:</strong></label>
						            <input readonly value="{{ $seller->gen }}" type="text" class="form-control">
						        </div>
						        <div class="form-group col-sm-3">
						            <label for="last-name"><strong>Civil Status:</strong></label>
						            <input readonly value="{{ $seller->civil }}" type="text" class="form-control">
						        </div>
	        				</div>
	        			</div>
	        		</div>

	        		<div class="col-sm-4">
	        			<center>
	        				<img src="{{ asset('img/avatar') }}/{{ $seller->img }}">
	        			</center>
	        		</div>
	        	</div>

	        	<div class="row">
	        		<div class="col-lg-12">
	        			<div class="form-group col-sm-6">
				            <label for="last-name"><strong>Contact Number:</strong></label>
				            <input readonly value="{{ $seller->cp }}" type="text" class="form-control">
				        </div>
				        <div class="form-group col-sm-6">
				            <label for="last-name"><strong>Address:</strong></label>
				            <input readonly value="{{ $seller->address }}" type="text" class="form-control">
				        </div>
	        		</div>
	        	</div>

	        	<div class="row">
	        		<div class="col-lg-12">
	        			<div class="form-group col-sm-4">
				            <label for="last-name"><strong>Category:</strong></label>
				            <input readonly value="{{ $category }}" type="text" class="form-control">
				        </div>
				        <div class="form-group col-sm-4">
				            <label for="last-name"><strong>Products:</strong></label>
				            <input readonly value="{{ $product }}" type="text" class="form-control">
				        </div>
				        <div class="form-group col-sm-4">
				            <label for="last-name"><strong>Dealer:</strong></label>
				            <input readonly value="{{ $seller->dealer->name }}" type="text" class="form-control">
				        </div>
	        		</div>
	        	</div>

	        	<div class="row">
	        		<div class="col-lg-12">
	        			<div class="form-row hidden-print">
					        <div class="form-group col-sm-12">
					            <a href="javascript:window.print()" type="submit" class="btn btn-success"><i class="fa fa-print"></i> Print</a>
					        </div>
						</div>
	        		</div>
	        	</div>

	        </div>
	    </div>
	</div>
	
</div>
@endsection

{{-- VENDOR JS --}}
@section('js-top')
 <script src="{{ asset('vendor/chosen/chosen.jquery.js') }}"></script>
@endsection

{{-- JS SCRIPT --}}
@section('js-bot')
<script type="text/javascript">
	$("#category-select").chosen();
	$("#product-select").chosen();
	$("#dealer-select").chosen();
</script>
@endsection