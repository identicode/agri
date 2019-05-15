@extends('layouts.app')

{{-- VENDOR CSS --}}
@section('css-top')
<link href="{{ asset('vendor/dataTables/datatables.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/chosen/chosen.css') }}" rel="stylesheet">
@endsection

{{-- CSS STYLE --}}
@section('css-bot')

@endsection

{{-- PAGE TITLE --}}
@section('page-title')
Seller List
@endsection

{{-- BREAD CRUMB --}}
@section('breadcrumb')

@endsection

{{-- BUTTON ACCTION --}}
@section('page-button')
{{-- <a href="/seller/add" target="_new" class="btn btn-success">Add Seller</a> --}}
@endsection

{{-- MAIN CONTENT --}}
@section('main-section')
<div class="row">
    <div class="col-lg-12">
	    <div class="ibox float-e-margins">
	        <div class="ibox-title">
	            <h5>Seller List</h5>
	        </div>
	        <div class="ibox-content">

	        	<div class="row">
	        		<div class="col-lg-12">
	        			<div class="form-group col-md-4">
				            <label for="category"><strong>Select Category:</strong></label>
				            <select id="category-select" data-placeholder="Choose category" class="chosen-select form-control" style="width:100%;" tabindex="4">
			                   	<option value="">See All</option>
			                   	@foreach($categories as $cat)
			                   			<option value="{{ $cat->name }}">{{ $cat->name }}</option>
			                   	@endforeach
	                		</select>
				        </div>
	        		</div>
	        	</div>

	            <div class="table-responsive">
			        <table class="table table-striped table-bordered table-hover dataTables-example" >
			        <thead>
			        <tr>
			            <th>#</th>
			            <th>Name</th>
			            <th>Address</th>
			            <th>Category</th>
			            <th>Products</th>
			            <th>Dealer</th>
			            <th>Action</th>
			        </tr>
			        </thead>
			        <tbody>
			        	@php($x = 1)
			        	@foreach($sellers as $seller)

			        		@php($arr = array())
			        		@foreach($seller->product as $product)
			        			@php($arr[] = $product->product->name)
			        		@endforeach
			        		<tr>
			        			<td>{{ $x++ }}</td>
			        			<td>{{ $seller->lname }}, {{ $seller->fname }}</td>
			        			<td>{{ $seller->address }}</td>
			        			<td>{{ @$seller->category->name }}</td>
			        			<td>{{ implode($arr, ', ') }}</td>
			        			<td>{{ @$seller->dealer->name }}</td>
			        			<td>
			        				<a href="/seller/show/{{ $seller->id }}" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i> View</a>
			        				<a href="/seller/edit/{{ $seller->id }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> Edit</a>
			        				<button onclick="deleteSeller('{{ $seller->id }}')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</button>
			        			</td>
			        		</tr>
			        	@endforeach
			        </tbody>
			        </table>
	            </div>

	        </div>
	    </div>
	</div>
	
</div>

@endsection

{{-- VENDOR JS --}}
@section('js-top')
<script src="{{ asset('vendor/dataTables/datatables.min.js') }}"></script>
<script src="{{ asset('vendor/chosen/chosen.jquery.js') }}"></script>
@endsection

{{-- JS SCRIPT --}}
@section('js-bot')
<script type="text/javascript">
$(document).ready(function(){

    var table = $('.dataTables-example').DataTable({
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
           {
                extend: 'print',
                title: '',
                customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).prepend(
                            	'<h2 align="center">'+$('#category-select').val()+'</h2>'
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
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            }
        ]
    });

    $('#category-select').on('change', function(){
       table.search(this.value).draw();   
    });

    $("#category-select").chosen();



});





function deleteSeller(id){
	swal({
        title: "Delete this seller?",
        text: "You will not be able to recover this information!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {
        window.location = '/seller/delete/'+id;
    });
}
</script>
@endsection