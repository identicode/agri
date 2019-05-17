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
	        <form method="POST" action="/producer/update/{{ $producer->id }}">
	        	@csrf
	        <div class="ibox-content">
	        	

	        	<div class="row">
	        		<div class="col-lg-9">
	        			<div class="row">
	        				<div class="col-sm-12">
	        					<div class="form-group col-sm-4">
						            <label><strong>Last Name:</strong></label>
						            <input name="lname" value="{{ $producer->lname }}" type="text" class="form-control" required>
						        </div>
						        <div class="form-group col-sm-4">
						            <label><strong>First Name:</strong></label>
						            <input name="fname" value="{{ $producer->fname }}" type="text" class="form-control" required>
						        </div>
						        <div class="form-group col-sm-4">
						            <label><strong>Middle Name:</strong></label>
						            <input name="mname" value="{{ $producer->mname }}" type="text" class="form-control">
						        </div>
	        				</div>
	        			</div>
	        			<div class="row">
	        				<div class="col-sm-12">
	        					<div class="form-group col-sm-4">
						            <label><strong>Birthday:</strong></label>
						            <input name="bday" value="{{ $producer->birth }}" type="date" class="form-control" required>
						        </div>

						        <div class="form-group col-sm-4">
						            <label><strong>Gender:</strong></label>
						            <select class="form-control" id="gender" name="gender" required>
						            	<option @if($producer->gen == 'Male') selected @endif>Male</option>
						            	<option @if($producer->gen == 'Female') selected @endif>Female</option>
						            </select>
						        </div>

						        <div class="form-group col-sm-4">
						            <label><strong>Civil Status:</strong></label>
						            <select class="form-control" id="civil" name="civil" required>
						            	<option @if($producer->civil == 'Single') selected @endif>Single</option>
						            	<option @if($producer->civil == 'Married') selected @endif>Married</option>
						            	<option @if($producer->civil == 'Widowed') selected @endif>Widowed</option>
						            	<option @if($producer->civil == 'Separated') selected @endif>Separated</option>
						            	<option @if($producer->civil == 'Annuled') selected @endif>Annuled</option>
						            	<option @if($producer->civil == 'Divorced') selected @endif>Divorced</option>
						            </select>
						        </div>      
	        				</div>
	        			</div>
	        			<div class="row">
	        				<div class="col-sm-12">

						        <div class="form-group col-sm-6">
						            <label><strong>Address:</strong></label>
						            <input name="address" value="{{ $producer->address }}" type="text" class="form-control" required>
						        </div>

						        <div class="form-group col-sm-3">
						            <label><strong>Contact Number:</strong></label>
						            <input name="cp" value="{{ $producer->cp }}" type="text" class="form-control" required>
						        </div>

						        <div class="form-group col-sm-3">
						            <label><strong>Farm Lot:</strong></label>
						            <input name="farm" value="{{ $producer->farm }}" type="number" class="form-control" required>
						        </div>
	        				</div>
	        			</div>
	        			<div class="row">
	        				<div class="col-lg-12">
						        <div class="form-group col-sm-6">
						            <label><strong>Category:</strong></label>
						            <select id="category-select" name="category[]" multiple data-placeholder="Choose category" class="chosen-select form-control" style="width:100%;" tabindex="4" required>
					                   	@foreach($categories as $category)
					                   		<option @if(in_array($category->id, $ptca) == true) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
					                   	@endforeach
			                		</select>
						        </div>

						        <div class="form-group col-sm-6">
						            	<label><strong>Product:</strong></label>
							           <select id="product-select" multiple name="product[]" data-placeholder="Choose product" class="chosen-select form-control" style="width:100%;" tabindex="4" required>
						                   	@foreach($products as $product)
						                   		<option @if(in_array($product->id, $ptpa) == true) selected @endif value="{{ $product->id }}">{{ $product->name }}</option>
						                   	@endforeach
				                		</select>
						        </div>
	        				</div>
	        			</div>

	        			<div class="row">
	        				<div class="col-lg-12">
						        <div class="form-group col-sm-6">
						            <label><strong>Producer Image:</strong></label>
						            <input type="hidden" id="crop-image" value="" name="image">
                                	<input class="form-control" type="file" name="upload_image" id="upload_image" accept="image/*" >
						        </div>

						        <div class="form-group col-sm-6">
						            <label><strong>Farm Image:</strong></label>
						            <input type="hidden" id="crop-image2" value="" name="image2">
                                	<input class="form-control" type="file" name="upload_image2" id="upload_image2" accept="image/*" >
						        </div>
	        				</div>
	        			</div>

	        			<div class="row">
	        				<div class="col-lg-12">
	        					<div class="form-row hidden-print">
							        <div class="form-group col-md-12">
							            <button type="submit" class="btn btn-success"> Save Changes</button>
							        </div>
								</div>
	        				</div>
	        			</div>
	        		</div>
	        		<div class="col-lg-3">
	        			<div class="row">
	        				<div class="col-lg-12">
	        					<center>
	        						<img id="producer-image" class="img-thumbnail" src="{{ asset('img/avatar') }}/{{ $producer->img }}" width="100px" height="100px">
	        						<h3>(Producer Image)</h3>
	        						<br>
	        					</center>
	        				</div>
	        			</div>
	        			<div class="clear-fix"></div>
	        			<div class="row">
	        				<div class="col-lg-12">
	        					<center>
	        						<img id="farm-image" class="img-thumbnail" src="{{ asset('img/avatar') }}/{{ $producer->fimg }}" width="100px" height="100px">
	        						<h3>(Farm Image)</h3>
	        					</center>
	        				</div>
	        			</div>
	        		</div>
	        	</div>

	        </div>
	    	</form>
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
            $("#producer-image").attr("src", response);
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
            $("#farm-image").attr("src", response);
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