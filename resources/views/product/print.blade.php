<!DOCTYPE html>
<html>
<head>
	<title></title>
	
	<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

h1{
	font-family: arial, sans-serif;
}

p{
	font-family: arial, sans-serif;
}

td, th {
  border: 1px solid #dddddd;
  text-align: center;
  padding: 8px;
}

</style>
</head>
<body>
<h1 align="center">Seller List</h1>

<table>
	<thead>
		<tr>
			<th>Seller Name</th>
			<th>Address</th>
			<th>Products</th>
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
    			<td>{{ $seller->lname }}, {{ $seller->fname }}</td>
    			<td>{{ $seller->address }}</td>
    			<td>{{ implode($arr, ', ') }}</td>
    		</tr>
    	@endforeach
	</tbody>
</table>
</body>
</html>