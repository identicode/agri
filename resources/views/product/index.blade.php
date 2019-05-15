@extends('layouts.app')

{{-- VENDOR CSS --}}
@section('css-top')
<link href="{{ asset('vendor/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

{{-- CSS STYLE --}}
@section('css-bot')

@endsection

{{-- PAGE TITLE --}}
@section('page-title')
Product
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
	            <h5>Product List</h5>
	        </div>
	        <div class="ibox-content">

	            <div class="table-responsive">
			        <table class="table table-striped table-bordered table-hover dataTables-example" >
			        <thead>
			        <tr>
			            <th>#</th>
			            <th>Name</th>
			            <th width="30%">Action</th>
			        </tr>
			        </thead>
			        <tbody>
			        	@php($x = 1)
			        	@foreach($products as $product)
			        		<tr>
			        			<td>{{ $x++ }}</td>
			        			<td>{{ $product->name }}</td>
			        			<td align="center">
			        				<button onclick="editProduct('{{ $product->id }}', '{{ $product->name }}')" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> Edit</button>
			        				<button onclick="deleteProduct('{{ $product->id }}')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button>
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
	            <h5>Add Product</h5>
	        </div>
	        <div class="ibox-content">
	        	<form method="POST" action="/product">
	        		@csrf
	        		<div class="form-group">
		        		<label>Product Name</label>
		        		<input type="text" name="product" required placeholder="Product Name" class="form-control">
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

<div class="modal inmodal fade" id="product-edit-modal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Product</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="/product">
                @method('PUT')
                @csrf
	                <div class="form-group">
	                	<label>Product Name</label>
	                	<input type="hidden" id="cat-edit-id" name="pid" value="">
	                	<input type="text" id="cat-edit-name" name="name" placeholder="Category Name" value="" class="form-control">
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
@endsection

{{-- VENDOR JS --}}
@section('js-top')
<script src="{{ asset('vendor/dataTables/datatables.min.js') }}"></script>
@endsection

{{-- JS SCRIPT --}}
@section('js-bot')
<script type="text/javascript">
$(document).ready(function(){

    $('.dataTables-example').DataTable({
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
           
        ]
    });



});


function editProduct(id, name)
{
	$('#cat-edit-id').val(id);
	$('#cat-edit-name').val(name);
	$('#product-edit-modal').modal('toggle');

}

function deleteProduct(id){
	swal({
        title: "Delete this product?",
        text: "You will not be able to recover this information!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {
        window.location = '/product/delete/'+id;
    });
}
</script>
@endsection