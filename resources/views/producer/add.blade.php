@extends('layouts.app')

{{-- VENDOR CSS --}}
@section('css-top')
<link href="{{ asset('vendor/chosen/chosen.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/croppie/croppie.css') }}">
@endsection

{{-- CSS STYLE --}}
@section('css-bot')

@endsection

{{-- PAGE TITLE --}}
@section('page-title')
Add Producer
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
	            <h5>Add Producer</h5>
	        </div>
	        <div class="ibox-content">
	        	<div class="row">
	        		<div class="col-lg-12">
	        			<form method="POST" action="/producer">
	        				@csrf
			        		<div class="form-row">
						        <div class="form-group col-md-4">
						            <label for="last-name"><strong>Last Name:</strong></label>
						            <input type="text" class="form-control" id="last-name" placeholder="Last Name" name="lname" required>
						        </div>

						        <div class="form-group col-md-4">
						            <label for="first-name"><strong>First Name:</strong></label>
						            <input type="text" class="form-control" id="first-name" placeholder="First Name" name="fname" required>
						        </div>

						        <div class="form-group col-md-4">
						            <label for="middle-name"><strong>Middle Name:</strong></label>
						            <input type="text" class="form-control" id="middle-name" placeholder="Middle Name" name="mname">
						        </div>
							</div>

							<div class="form-row">
						        <div class="form-group col-md-4">
						            <label for="birthday"><strong>Birthday:</strong></label>
						            <input type="date" max="{{ date('Y-m-d', time()) }}" class="form-control" id="birthday" placeholder="Birthday" name="bday" required>
						        </div>

						        <div class="form-group col-md-4">
						            <label for="gender"><strong>Gender:</strong></label>
						            <select class="form-control" id="gender" name="gender">
						            	<option>Male</option>
						            	<option>Female</option>
						            </select>
						        </div>

						        <div class="form-group col-md-4">
						            <label for="civil"><strong>Civil Status:</strong></label>
						            <select class="form-control" id="civil" name="civil" required>
						            	<option>Single</option>
						            	<option>Married</option>
						            	<option>Widowed</option>
						            	<option>Separated</option>
						            	<option>Annuled</option>
						            	<option>Divorced</option>
						            </select>
						        </div>
							</div>

							<div class="form-row">
						        <div class="form-group col-md-6">
						            <label for="address"><strong>Address:</strong></label>
						            <input type="text" class="form-control" id="address" placeholder="Address" name="address" required>
						        </div>

						        <div class="form-group col-md-6">
						            <label for="cp"><strong>Contact Number:</strong></label>
						            <input type="text" class="form-control" id="cp" placeholder="Contact Number" name="cp" required>
						        </div>
							</div>

							<div class="form-row">
						        <div class="form-group col-md-4">
						            <label for="category-select"><strong>Category:</strong></label>
						            <select id="category-select" required multiple name="category[]" data-placeholder="Choose category" class="chosen-select form-control" style="width:100%;" tabindex="4">
					                   	@foreach($categories as $cat)
					                   		<option value="{{ $cat->id }}">{{ $cat->name }}</option>
					                   	@endforeach
			                		</select>
						        </div>

						        <div class="form-group col-md-4">
						            <label for="product"><strong>Products:</strong></label>
						            <select id="product-select" required multiple name="product[]" data-placeholder="Choose product" class="chosen-select form-control" style="width:100%;" tabindex="4">
					                   	@foreach($products as $product)
					                   		<option value="{{ $product->id }}">{{ $product->name }}</option>
					                   	@endforeach
			                		</select>
						        </div>

						        <div class="form-group col-md-4">
						            <label for="farm"><strong>Farm Lot (sqm):</strong></label>
						            <input type="number" class="form-control" id="farm" placeholder="Farm Lot" name="farm" required>
						        </div>
							</div>

							<div class="form-row">
						        <div class="form-group col-md-4">
						            <label for="last-name"><strong>Producer Image:</strong></label>
						            <input required type="hidden" id="crop-image" value="" name="image">
                                	<input required class="form-control" type="file" name="upload_image" id="upload_image" accept="image/*" >
						        </div>

						        <div class="form-group col-md-4">
						            <label for="first-name"><strong>Farm Image:</strong></label>
						            <input required type="hidden" id="crop-image2" value="" name="image2">
                                	<input required class="form-control" type="file" name="upload_image2" id="upload_image2" accept="image/*" >
						        </div>
							</div>

							<div class="form-row">
						        <div class="form-group col-md-12">
						            <div class="hr-line-dashed"></div>
						        </div>
							</div>


							<div class="form-row">
						        <div class="form-group col-md-12">
						            <button type="submit" class="btn btn-success">Add Producer</button>
						        </div>
							</div>

	        			</form>
	        		</div>
	        	</div>
	        </div>
	    </div>
	</div>
	
</div>

<!-- Modal Image Cropper -->
<div id="uploadimageModal" class="modal" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload & Crop Image</h4>
        </div>
        <div class="modal-body">
          <div class="row">
       <div class="col-md-12 text-center">
        <div id="image_demo"></div>
       </div>
    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success crop_image">Crop</button>
        </div>
     </div>
    </div>
</div><!-- /.modal -->

<!-- Modal Image Cropper -->
<div id="uploadimageModal2" class="modal" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload & Crop Image</h4>
        </div>
        <div class="modal-body">
          <div class="row">
       <div class="col-md-12 text-center">
        <div id="image_demo2"></div>
       </div>
    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success crop_image2">Crop</button>
        </div>
     </div>
    </div>
</div><!-- /.modal -->

@endsection

{{-- VENDOR JS --}}
@section('js-top')
<script src="{{ asset('vendor/chosen/chosen.jquery.js') }}"></script>
<script src="{{ asset('vendor/croppie/croppie.min.js') }}"></script>
<script src="{{ asset('vendor/croppie/exif.js') }}"></script>

@endsection

{{-- JS SCRIPT --}}
@section('js-bot')
<script type="text/javascript">
	$(document).ready(function () {

	$image_crop = $('#image_demo').croppie({
        enableExif: true,
        viewport: {
            width:150,
            height:150,
            type:'square' //circle
        },
        boundary:{
            width:300,
            height:300
        }
    });

    $('#upload_image').on('change', function(){
        var reader = new FileReader();
        reader.onload = function (event) {
        $image_crop.croppie('bind', {
            url: event.target.result
        }).then(function(){
          console.log('jQuery bind complete');
        });
        }
        reader.readAsDataURL(this.files[0]);
        $('#uploadimageModal').modal('show');
    });

    $('.crop_image').click(function(event){
        $image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport',
            format: 'jpeg'
        }).then(function(response){
            $('#crop-image').val(response);
            $('#uploadimageModal').modal('toggle');
        })
    });


});
</script>

<script type="text/javascript">
	$(document).ready(function () {

	$image_crop2 = $('#image_demo2').croppie({
        enableExif: true,
        viewport: {
            width:150,
            height:150,
            type:'square' //circle
        },
        boundary:{
            width:300,
            height:300
        }
    });

    $('#upload_image2').on('change', function(){
        var reader = new FileReader();
        reader.onload = function (event) {
        $image_crop2.croppie('bind', {
            url: event.target.result
        }).then(function(){
          console.log('jQuery bind complete');
        });
        }
        reader.readAsDataURL(this.files[0]);
        $('#uploadimageModal2').modal('show');
    });

    $('.crop_image2').click(function(event){
        $image_crop2.croppie('result', {
            type: 'canvas',
            size: 'viewport',
            format: 'jpeg'
        }).then(function(response){
            $('#crop-image2').val(response);
            $('#uploadimageModal2').modal('toggle');
        })
    });


});
</script>

<script type="text/javascript">
	$("#category-select").chosen();
	$("#product-select").chosen();
	$("#dealer-select").chosen();
</script>
@endsection