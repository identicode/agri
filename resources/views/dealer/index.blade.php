@extends('layouts.app')

{{-- VENDOR CSS --}}
@section('css-top')
<link href="{{ asset('vendor/dataTables/datatables.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/chosen/chosen.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/croppie/croppie.css') }}">
@endsection

{{-- CSS STYLE --}}
@section('css-bot')

@endsection

{{-- PAGE TITLE --}}
@section('page-title')
Dealer
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
    <div class="col-lg-7">
	    <div class="ibox float-e-margins">
	        <div class="ibox-title">
	            <h5>Dealer List</h5>
	        </div>
	        <div class="ibox-content">

	            <div class="table-responsive">
			        <table class="table table-striped table-bordered table-hover dataTables-example" >
			        <thead>
			        <tr>
			            <th>Image</th>
			            <th>Name</th>
			            <th>Product</th>
			            <th width="30%">Action</th>
			        </tr>
			        </thead>
			        <tbody>
			        	@foreach($dealers as $dealer)

			        		@php($arr = array())
					        @foreach($dealer->product as $product)
			        			@php($arr[] = $product->product->name)
			        		@endforeach
			        		<tr>
			        			<td align="center">
			        				<img src="{{ asset('img/avatar') }}/{{ $dealer->img }}" width="40px" height="40px">
			        			</td>
			        			<td>{{ $dealer->name }}</td>
			        			<td>{{ @implode($arr, ', ') }}</td>
			        			<td align="center">
			        				<button onclick="editDealer('{{ $dealer->id }}', '{{ $dealer->name }}')" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> Edit</button>
			        				<button onclick="deleteDealer('{{ $dealer->id }}')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button>
			        			</td>
			        		</tr>
			        	@endforeach
			        </tbody>
			        </table>
	            </div>

	        </div>
	    </div>
	</div>
	<div class="col-lg-5">
	    <div class="ibox float-e-margins">
	        <div class="ibox-title">
	            <h5>Add Dealer</h5>
	        </div>
	        <div class="ibox-content">
	        	<form method="POST" action="/dealer">
	        		@csrf
	        		<div class="form-group">
		        		<label>Dealer Name</label>
		        		<input type="text" name="dealer" required placeholder="Dealer Name" class="form-control">
		        	</div>

		        	<div class="hr-line-dashed"></div>

		        	<div class="form-group">
		        		<label>Product</label>
		        		<select name="product[]" multiple data-placeholder="Choose a Product" class="chosen-select form-control" style="width:100%;" tabindex="4">
		                   	@foreach($products as $product)
		                   		<option value="{{ $product->id }}">{{ $product->name }}</option>
		                   	@endforeach
                		</select>
		        	</div>

		        	<div class="hr-line-dashed"></div>

		        	<div class="form-group">
		        		<label>Image</label>
		        		<input required type="hidden" id="crop-image" value="" name="image">
                        <input required class="form-control" type="file" name="upload_image" id="upload_image" accept="image/*" >
		        	</div>

					<div class="hr-line-dashed"></div>

		        	<div class="form-group">
		        		<button class="btn btn-success" type="submit">Submit</button>
		        	</div>

	        	</form>
	        </div>
	    </div>
	</div>
</div>

<div class="modal inmodal fade" id="dealer-edit-modal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Product</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="/dealer">
                @method('PUT')
                @csrf
	                <div class="form-group">
	                	<label>Dealer Name</label>
	                	<input type="hidden" id="cat-edit-id" name="did" value="">
	                	<input type="text" id="cat-edit-name" name="dname" placeholder="Dealer Name" value="" class="form-control">
	                </div>

	                <div class="form-group">
	                	<label>Product</label>
	                	<select name="product" class="form-control">
		                   	@foreach($products as $product)
		                   		<option value="{{ $product->id }}">{{ $product->name }}</option>
		                   	@endforeach
                		</select>
	                </div>

	                
	                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save changes</button>
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
@endsection

{{-- VENDOR JS --}}
@section('js-top')
<script src="{{ asset('vendor/dataTables/datatables.min.js') }}"></script>
 <script src="{{ asset('vendor/chosen/chosen.jquery.js') }}"></script>
 <script src="{{ asset('vendor/croppie/croppie.min.js') }}"></script>
<script src="{{ asset('vendor/croppie/exif.js') }}"></script>
@endsection

{{-- JS SCRIPT --}}
@section('js-bot')
<script type="text/javascript">
$(document).ready(function(){

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

    $('.dataTables-example').DataTable({
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
           {
                extend: 'print',
                title: '',
                customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');


                            $(win.document.body).prepend(
                            	'<h2 align="center">Dealer List</h2>'
                        	);

                        	$(win.document.body).prepend(
                            	'<h1 align="center">System For Agricultural Local Entrepreneur</h1>'
                        	);

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    },
                autoPrint: false,
                exportOptions: {
                    columns: [ 0, 1, 2 ],
                    stripHtml: false
                }
            }
        ]
    });

    $(".chosen-select").chosen();

    



});


function editDealer(id, name)
{
	$('#cat-edit-id').val(id);
	$('#cat-edit-name').val(name);
	$('#dealer-edit-modal').modal('toggle');

}

function deleteDealer(id){
	swal({
        title: "Delete this dealer?",
        text: "You will not be able to recover this information!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {
        window.location = '/dealer/delete/'+id;
    });
}
</script>
@endsection