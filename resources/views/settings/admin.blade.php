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
Add Admin
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
	            <h5>Add Admin</h5>
	        </div>
	        <div class="ibox-content">
	        	<div class="row">
	        		<div class="col-lg-12">
	        			<form method="POST" action="/settings/account">
	        				@csrf
			        		<div class="form-row">
						        <div class="form-group col-md-4">
						            <label for="last-name"><strong>Last Name:</strong></label>
						            <input type="text" class="form-control" id="last-name" placeholder="Last Name" name="lname" value="{{ old('lname') }}" required>
						        </div>

						        <div class="form-group col-md-4">
						            <label for="first-name"><strong>First Name:</strong></label>
						            <input type="text" class="form-control" id="first-name" placeholder="First Name" name="fname" value="{{ old('fname') }}" required>
						        </div>

						        <div class="form-group col-md-4">
						            <label for="middle-name"><strong>Middle Name:</strong></label>
						            <input type="text" class="form-control" id="middle-name" placeholder="Middle Name" name="mname" value="{{ old('mname') }}">
						        </div>
							</div>


							<div class="form-row">
						        <div class="form-group col-md-4">
						            <label for="username"><strong>Username:</strong></label>
						            <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="{{ old('username') }}" required>
						        </div>

						        <div class="form-group col-md-4">
						            <label for="password"><strong>Password:</strong></label>
						            <input type="password" class="form-control" id="password" placeholder="Password" name="pass" required>
						        </div>

						        <div class="form-group col-md-4">
						            <label for="cpassword"><strong>Confirm Password:</strong></label>
						            <input type="password" class="form-control" id="cpassword" placeholder="Confirm Password" name="cpass" required>
						        </div>
							</div>



							<div class="form-row">
						        <div class="form-group col-md-12">
						            <div class="hr-line-dashed"></div>
						        </div>
							</div>


							<div class="form-row">
						        <div class="form-group col-md-12">
						            <button type="submit" class="btn btn-success">Add Admin</button>
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