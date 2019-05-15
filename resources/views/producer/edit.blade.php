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
Edit Producer
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
	            <h5>Edit Producer</h5>
	        </div>
	        <div class="ibox-content">
	        	<div class="row">
	        		<div class="col-lg-12">
	        			<form method="POST" action="/producer/update/{{ $producer->id }}">
	        				@csrf
			        		<div class="form-row">
						        <div class="form-group col-md-4">
						            <label for="last-name"><strong>Last Name:</strong></label>
						            <input value="{{ $producer->lname }}" type="text" class="form-control" id="last-name" placeholder="Last Name" name="lname" required>
						        </div>

						        <div class="form-group col-md-4">
						            <label for="first-name"><strong>First Name:</strong></label>
						            <input value="{{ $producer->fname }}" type="text" class="form-control" id="first-name" placeholder="First Name" name="fname" required>
						        </div>

						        <div class="form-group col-md-4">
						            <label for="middle-name"><strong>Middle Name:</strong></label>
						            <input value="{{ $producer->mname }}" type="text" class="form-control" id="middle-name" placeholder="Middle Name" name="mname">
						        </div>
							</div>

							<div class="form-row">
						        <div class="form-group col-md-3">
						            <label for="birthday"><strong>Birthday:</strong></label>
						            <input value="{{ $producer->birth }}" type="date" max="{{ date('Y-m-d', time()) }}" class="form-control" id="birthday" placeholder="Birthday" name="bday" required>
						        </div>

						        <div class="form-group col-md-3">
						            <label for="age"><strong>Age:</strong></label>
						            <input value="{{ $producer->age }}" type="number" class="form-control" id="age" placeholder="Age" name="age" required>
						        </div>

						        <div class="form-group col-md-3">
						            <label for="gender"><strong>Gender:</strong></label>
						            <select class="form-control" id="gender" name="gender">
						            	<option @if($producer->gen == 'Male') selected @endif>Male</option>
						            	<option @if($producer->gen == 'Female') selected @endif>Female</option>
						            </select>
						        </div>

						        <div class="form-group col-md-3">
						            <label for="civil"><strong>Civil Status:</strong></label>
						            <select class="form-control" id="civil" name="civil">
						            	<option @if($producer->civil == 'Single') selected @endif>Single</option>
						            	<option @if($producer->civil == 'Married') selected @endif>Married</option>
						            	<option @if($producer->civil == 'Widowed') selected @endif>Widowed</option>
						            	<option @if($producer->civil == 'Separated') selected @endif>Separated</option>
						            	<option @if($producer->civil == 'Annuled') selected @endif>Annuled</option>
						            	<option @if($producer->civil == 'Divorced') selected @endif>Divorced</option>
						            </select>
						        </div>
							</div>

							<div class="form-row">
						        <div class="form-group col-md-6">
						            <label for="address"><strong>Address:</strong></label>
						            <input value="{{ $producer->address }}" type="text" class="form-control" id="address" placeholder="Address" name="address" required>
						        </div>

						        <div class="form-group col-md-6">
						            <label for="cp"><strong>Contact Number:</strong></label>
						            <input value="{{ $producer->cp }}" type="text" class="form-control" id="cp" placeholder="Contact Number" name="cp" required>
						        </div>
							</div>

							<div class="form-row">
						        <div class="form-group col-md-4">
						            <label for="category-select"><strong>Category:</strong></label>
						            <select id="category-select" name="category" data-placeholder="Choose category" class="chosen-select form-control" style="width:100%;" tabindex="4">
					                   	@foreach($categories as $cat)
					                   		<option @if($producer->id == $cat->id) selected @endif value="{{ $cat->id }}">{{ $cat->name }}</option>
					                   	@endforeach
			                		</select>
						        </div>

						        <div class="form-group col-md-4">
						            <label for="product"><strong>Products:</strong></label>
						            <select id="product-select" multiple name="product[]" data-placeholder="Choose product" class="chosen-select form-control" style="width:100%;" tabindex="4">
					                   	@foreach($products as $product)
					                   		<option @if(in_array($product->id, $ptpa) == true) selected @endif value="{{ $product->id }}">{{ $product->name }}</option>
					                   	@endforeach
			                		</select>
						        </div>

						        <div class="form-group col-md-4">
						            <label for="farm"><strong>Farm Lot (sqm):</strong></label>
						            <input type="number" value="{{ $producer->farm }}" class="form-control" id="farm" placeholder="Farm Lot" name="farm" required>
						        </div>
							</div>

							<div class="form-row">
						        <div class="form-group col-md-12">
						            <div class="hr-line-dashed"></div>
						        </div>
							</div>


							<div class="form-row">
						        <div class="form-group col-md-12">
						            <button type="submit" class="btn btn-success">Update</button>
						        </div>
							</div>

	        			</form>
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