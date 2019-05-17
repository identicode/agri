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
Edit Seller
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
	            <h5>Edit Seller</h5>
	        </div>
	       
	        <div class="ibox-content">
	        	<form method="POST" action="/seller/update/{{ $seller->id }}">
	        	@csrf
	        		<div class="row">
	        			<div class="col-sm-8">

		        			<div class="row">
		        				<div class="col-sm-12">
		        					<div class="form-group col-sm-4">
							            <label><strong>Last Name:</strong></label>
							            <input name="lname" required value="{{ $seller->lname }}" type="text" class="form-control">
							        </div>
							        <div class="form-group col-sm-4">
							            <label><strong>First Name:</strong></label>
							            <input name="fname" required value="{{ $seller->fname }}" type="text" class="form-control">
							        </div>
							        <div class="form-group col-sm-4">
							            <label><strong>Middle Name:</strong></label>
							            <input name="mname" value="{{ $seller->mname }}" type="text" class="form-control">
							        </div>
		        				</div>
		        			</div>

		        			<div class="row">
		        				<div class="col-sm-12">
		        					<div class="form-group col-sm-4">
							            <label for="last-name"><strong>Birthday:</strong></label>
							            <input name="bday" required max="{{ date('Y-m-d', time()) }}" value="{{ $seller->birth }}" type="date" class="form-control">
							        </div>
							        
							        <div class="form-group col-sm-4">
							            <label for="last-name"><strong>Gender:</strong></label>
							            <select class="form-control" id="gender" name="gender" required>
							            	<option @if($seller->gen == 'Male') selected @endif>Male</option>
							            	<option @if($seller->gen == 'Female') selected @endif>Female</option>
						            	</select>
							        </div>
							        <div class="form-group col-sm-4">
							            <label for="last-name"><strong>Civil Status:</strong></label>
							            <select class="form-control" id="civil" name="civil" required>
							            	<option @if($seller->civil == 'Single') selected @endif>Single</option>
							            	<option @if($seller->civil == 'Married') selected @endif>Married</option>
							            	<option @if($seller->civil == 'Widowed') selected @endif>Widowed</option>
							            	<option @if($seller->civil == 'Separated') selected @endif>Separated</option>
							            	<option @if($seller->civil == 'Annuled') selected @endif>Annuled</option>
							            	<option @if($seller->civil == 'Divorced') selected @endif>Divorced</option>
						            	</select>
							        </div>
		        				</div>
		        			</div>
	        			</div>

		        		<div class="col-sm-4">
		        			<center>
		        				<img id="seller-image-edit" src="{{ asset('img/avatar') }}/{{ $seller->img }}">
		        			</center>
		        		</div>
	        		</div>

	        		<div class="row">
		        		<div class="col-lg-12">
		        			<div class="form-group col-sm-6">
					            <label for="last-name"><strong>Contact Number:</strong></label>
					            <input name="cp" required value="{{ $seller->cp }}" type="text" class="form-control">
					        </div>
					        <div class="form-group col-sm-6">
					            <label for="last-name"><strong>Address:</strong></label>
					            <input name="address" required value="{{ $seller->address }}" type="text" class="form-control">
					        </div>
		        		</div>
	        		</div>

	        		<div class="row">
		        		<div class="col-lg-12">
		        			<div class="form-group col-sm-4">
					            <label for="last-name"><strong>Category:</strong></label>
					            <select id="category-select" multiple name="category[]" data-placeholder="Choose category" class="chosen-select form-control" style="width:100%;" tabindex="4">
				                   	@foreach($categories as $cat)
				                   		<option @if(in_array($cat->id, $stca) == true) selected @endif value="{{ $cat->id }}">{{ $cat->name }}</option>
				                   	@endforeach
			                	</select>
					        </div>
					        <div class="form-group col-sm-4">
					            <label for="last-name"><strong>Products:</strong></label>
					            <select id="product-select" multiple name="product[]" data-placeholder="Choose product" class="chosen-select form-control" style="width:100%;" tabindex="4">
				                   	@foreach($products as $product)
				                   		<option @if(in_array($product->id, $stpa) == true) selected @endif value="{{ $product->id }}">{{ $product->name }}</option>
				                   	@endforeach
			                	</select>
					        </div>
					        <div class="form-group col-sm-4">
					            <label for="last-name"><strong>Dealer:</strong></label>
					            <select id="dealer-select" name="dealer" data-placeholder="Choose dealer" class="chosen-select form-control" style="width:100%;" tabindex="4">
				                   	@foreach($dealers as $dealer)
				                   		<option @if($seller->id == $dealer->id) selected @endif value="{{ $dealer->id }}">{{ $dealer->name }}</option>
				                   	@endforeach
		                		</select>
					        </div>
		        		</div>
	        		</div>

	        		<div class="row">
		        		<div class="col-lg-12">
		        			<div class="form-group col-sm-6">
					            <label for="last-name"><strong>Image:</strong></label>
					            <input type="hidden" id="crop-image" value="" name="image">
                                <input class="form-control" type="file" name="upload_image" id="upload_image" accept="image/*" >
					        </div>
		        		</div>
	        		</div>

	        		<div class="row">
		        		<div class="col-lg-12">
		        			<div class="form-group col-sm-12">
					           <div class="hr-line-dashed"></div>
					        </div>
		        		</div>
	        		</div>

	        		<div class="row">
		        		<div class="col-lg-12">
		        			<div class="form-group col-sm-12">
					           <button type="submit" class="btn btn-success">Save Changes</button>
					        </div>
		        		</div>
	        		</div>
	        	</form>
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
            $("#seller-image-edit").attr("src", response);
            $('#uploadimageModal').modal('toggle');
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