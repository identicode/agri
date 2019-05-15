@extends('layouts.app')

{{-- VENDOR CSS --}}
@section('css-top')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/croppie/croppie.css') }}">
@endsection

{{-- CSS STYLE --}}
@section('css-bot')

@endsection

{{-- PAGE TITLE --}}
@section('page-title')
Profile
@endsection

{{-- BREAD CRUMB --}}
@section('breadcrumb')

@endsection

{{-- BUTTON ACCTION --}}
@section('page-button')

@endsection

{{-- MAIN CONTENT --}}
@section('main-section')
<div class="row m-t-lg">
                <div class="col-lg-8">
                    <div class="tabs-container">

                        <div class="tabs-left">

                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#profile-info"> Information</a></li>
                                <li class=""><a data-toggle="tab" href="#profile-avatar">Avatar</a></li>
                                <li class=""><a data-toggle="tab" href="#profile-username">Username</a></li>
                                <li class=""><a data-toggle="tab" href="#profile-password">Password</a></li>
                                <li class=""><a data-toggle="tab" href="#profile-question">Security Question</a></li>
                            </ul>

                            <div class="tab-content ">

                                <div id="profile-info" class="tab-pane active">
                                    <div class="panel-body">
                                        	<div class="col-lg-12">
                                        		<form class="form-horizontal" method="POST" action="/settings/profile/info">
                                        			@csrf
                                        			<div class="form-group">
                                        				<label class="col-sm-3 control-label">
                                        					Last Name
                                        				</label>

                                    					<div class="col-sm-9">
                                    						<input type="text" name="lname" value="{{ Auth::user()->lname }}" class="form-control">
                                    					</div>

                                					</div>

                                					<div class="form-group">
                                        				<label class="col-sm-3 control-label">
                                        					First Name
                                        				</label>

                                    					<div class="col-sm-9">
                                    						<input type="text" name="fname" value="{{ Auth::user()->fname }}" class="form-control">
                                    					</div>

                                					</div>

                                					<div class="form-group">
                                        				<label class="col-sm-3 control-label">
                                        					Middle Name
                                        				</label>

                                    					<div class="col-sm-9">
                                    						<input type="text" name="mname" value="{{ Auth::user()->mname }}" class="form-control">
                                    					</div>

                                					</div>

                                					<div class="hr-line-dashed"></div>

                                					<div class="form-group">
                                        				
                                    					<div class="col-sm-12">
                                    						<button class="btn btn-success" type="submit">Save Changes</button>
                                    					</div>

                                					</div>

                                        		</form>
                                        	</div>
                                    </div>
                                </div>

                                <div id="profile-avatar" class="tab-pane">
                                    <div class="panel-body">
                                    	<div class="col-lg-12">
                                    		<center>
                                    			<img id="avatar-image-edit" src="{{ asset('img/avatar') }}/{{ Auth::user()->img }}" width="150px" height="150px" class="img-thumbnail">
                                    		</center>
                                    		
                                    	</div>

                                    	<div class="col-lg-12">
                                    		<div class="hr-line-dashed"></div>
                                    	</div>

                                    	<div class="col-lg-12">
                                    		<form class="form-horizontal" method="POST" action="/settings/profile/avatar">
                                        			@csrf
                                        			<div class="form-group">
                                        				<label class="col-sm-3 control-label">
                                        					Change Image
                                        				</label>

                                    					<div class="col-sm-9">
                                    						<input required type="hidden" id="crop-image" value="" name="image">
                                							<input required class="form-control" type="file" name="upload_image" id="upload_image" accept="image/*" >
                                    					</div>

                                					</div>

                                					<div class="hr-line-dashed"></div>

                                					<div class="form-group">
                                        				
                                    					<div class="col-sm-12">
                                    						<button class="btn btn-success" type="submit">Save Changes</button>
                                    					</div>

                                					</div>

                                        </form>
                                    	</div>
                                        

                                        

                                    </div>
                                </div>

                                <div id="profile-username" class="tab-pane">
                                    <div class="panel-body">
                                    	<div class="col-lg-12">
                                        		<form class="form-horizontal" method="POST" action="/settings/profile/username">
                                        			@csrf
                                        			<div class="form-group">
                                        				<label class="col-sm-3 control-label">
                                        					Username
                                        				</label>

                                    					<div class="col-sm-9">
                                    						<input type="text" name="username" value="{{ Auth::user()->username }}" class="form-control">
                                    					</div>

                                					</div>

                                					<div class="hr-line-dashed"></div>

                                					<div class="form-group">
                                        				
                                    					<div class="col-sm-12">
                                    						<button class="btn btn-success" type="submit">Save Changes</button>
                                    					</div>

                                					</div>

                                        		</form>
                                        	</div>
                                    </div>
                                </div>

                                <div id="profile-password" class="tab-pane">
                                    <div class="panel-body">
                                    	<div class="col-lg-12">
                                        		<form class="form-horizontal" method="POST" action="/settings/profile/password">
                                        			@csrf
                                        			<div class="form-group">
                                        				<label class="col-sm-3 control-label">
                                        					Old Password
                                        				</label>

                                    					<div class="col-sm-9">
                                    						<input type="password" name="old" class="form-control">
                                    					</div>

                                					</div>

                                					<div class="form-group">
                                        				<label class="col-sm-3 control-label">
                                        					New Password
                                        				</label>

                                    					<div class="col-sm-9">
                                    						<input type="password" name="pass" value="{{ old('pass') }}" class="form-control">
                                    					</div>

                                					</div>

                                					<div class="form-group">
                                        				<label class="col-sm-3 control-label">
                                        					Confirm Password
                                        				</label>

                                    					<div class="col-sm-9">
                                    						<input type="password" name="cpass" value="{{ old('cpass') }}" class="form-control">
                                    					</div>

                                					</div>

                                					<div class="hr-line-dashed"></div>

                                					<div class="form-group">
                                        				
                                    					<div class="col-sm-12">
                                    						<button class="btn btn-success" type="submit">Save Changes</button>
                                    					</div>

                                					</div>

                                        		</form>
                                        	</div>
                                    </div>
                                </div>

                                <div id="profile-question" class="tab-pane">
                                    <div class="panel-body">
                                        <form method="POST" action="/settings/profile/question">
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="question-select"><strong>Question:</strong></label>
                                                    <select id="question-select" required name="question" data-placeholder="Choose category" class="chosen-select form-control" style="width:100%;" tabindex="4">
                                                        <option value="">Select Question</option>
                                                        <option>What is your mother's maiden name?</option>
                                                        <option>What is the name of your favorite pet?</option>
                                                        <option>What is your favorite movie?</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="question-select"><strong>Answer:</strong></label>
                                                    <input type="text" name="answer" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <button class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
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
@endsection

{{-- VENDOR JS --}}
@section('js-top')
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
            $("#avatar-image-edit").attr("src", response);
            $('#uploadimageModal').modal('toggle');
        })
    });


});
</script>
@endsection