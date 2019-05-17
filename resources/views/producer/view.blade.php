@extends('layouts.app')

{{-- VENDOR CSS --}}
@section('css-top')

@endsection

{{-- CSS STYLE --}}
@section('css-bot')

@endsection

{{-- PAGE TITLE --}}
@section('page-title')
Producer Full Information
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
	            <h5>Producer Full Information</h5>
	        </div>
	        <div class="ibox-content">

	        	<div class="row">
	        		<div class="col-lg-9">
	        			<div class="row">
	        				<div class="col-sm-12">
	        					<div class="form-group col-sm-4">
						            <label><strong>Last Name:</strong></label>
						            <input readonly value="{{ $producer->lname }}" type="text" class="form-control">
						        </div>
						        <div class="form-group col-sm-4">
						            <label><strong>First Name:</strong></label>
						            <input readonly value="{{ $producer->fname }}" type="text" class="form-control">
						        </div>
						        <div class="form-group col-sm-4">
						            <label><strong>Middle Name:</strong></label>
						            <input readonly value="{{ $producer->mname }}" type="text" class="form-control">
						        </div>
	        				</div>
	        			</div>
	        			<div class="row">
	        				<div class="col-sm-12">
	        					<div class="form-group col-sm-3">
						            <label><strong>Birthday:</strong></label>
						            <input readonly value="{{ $producer->birth }}" type="date" class="form-control">
						        </div>

						        <div class="form-group col-sm-3">
						            <label><strong>Age:</strong></label>
						            <input readonly value="{{ Carbon\Carbon::parse($producer->birth)->age }}" type="text" class="form-control">
						        </div>

						        <div class="form-group col-sm-3">
						            <label><strong>Gender:</strong></label>
						            <input readonly value="{{ $producer->gen }}" type="text" class="form-control">
						        </div>

						        <div class="form-group col-sm-3">
						            <label><strong>Civil Status:</strong></label>
						            <input readonly value="{{ $producer->civil }}" type="text" class="form-control">
						        </div>      
	        				</div>
	        			</div>
	        			<div class="row">
	        				<div class="col-sm-12">

						        <div class="form-group col-sm-6">
						            <label><strong>Address:</strong></label>
						            <input readonly value="{{ $producer->address }}" type="text" class="form-control">
						        </div>

						        <div class="form-group col-sm-3">
						            <label><strong>Contact Number:</strong></label>
						            <input readonly value="{{ $producer->cp }}" type="text" class="form-control">
						        </div>

						        <div class="form-group col-sm-3">
						            <label><strong>Farm Lot:</strong></label>
						            <input readonly value="{{ $producer->farm }}" type="text" class="form-control">
						        </div>
	        				</div>
	        			</div>
	        			<div class="row">
	        				<div class="col-lg-12">
						        <div class="form-group col-sm-6">
						            <label><strong>Category:</strong></label>
						            <input readonly value="{{ $category }}" type="text" class="form-control">
						        </div>

						        <div class="form-group col-sm-6">
						            <label><strong>Product:</strong></label>
						            <input readonly value="{{ $product }}" type="text" class="form-control">
						        </div>
	        				</div>
	        			</div>

	        			<div class="row">
	        				<div class="col-lg-12">
	        					<div class="form-row hidden-print">
							        <div class="form-group col-md-12">
							            <a href="javascript:window.print()" type="submit" class="btn btn-success"><i class="fa fa-print"></i> Print</a>
							        </div>
								</div>
	        				</div>
	        			</div>
	        		</div>
	        		<div class="col-lg-3">
	        			<div class="row">
	        				<div class="col-lg-12">
	        					<center>
	        						<img class="img-thumbnail" src="{{ asset('img/avatar') }}/{{ $producer->img }}" width="100px" height="100px">
	        						<h3>(Producer Image)</h3>
	        						<br>
	        					</center>
	        				</div>
	        			</div>
	        			<div class="clear-fix"></div>
	        			<div class="row">
	        				<div class="col-lg-12">
	        					<center>
	        						<img class="img-thumbnail" src="{{ asset('img/avatar') }}/{{ $producer->fimg }}" width="100px" height="100px">
	        						<h3>(Farm Image)</h3>
	        					</center>
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

@endsection

{{-- JS SCRIPT --}}
@section('js-bot')

@endsection