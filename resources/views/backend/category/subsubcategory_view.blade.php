@extends('admin.admin_master')
@section('admin')
	  <div class="container-full">
		<!-- Content Header (Page header) -->
<!-- 		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Data Tables</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Tables</li>
								<li class="breadcrumb-item active" aria-current="page">Data Tables</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div> -->

		<!-- Main content -->
		<section class="content">
		  <div class="row">
 
			<div class="col-8">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Sub-SubCategory List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table style="width:450px; id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<td>Category</td>
								<td>Sub Category</td>
								<td>SubSubCategory En</td>
								<td>Action</td>
							</tr>
						</thead>
						<tbody>
							@foreach($subsubcategories as $subsubcategory)
							<tr>
								<td>{{$subsubcategory['category']['category_name_en']}}</td>
								<td>{{$subsubcategory['subcategory']['subcategory_name_en']}}</td>
								<td>{{$subsubcategory->subsubcategory_name_en}}</td>
								<td width="30%">
									<a href="{{ route('subsubcategory.edit',$subsubcategory->id)}}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
									<a href="{{ route('subsubcategory.delete',$subsubcategory->id)}}" class="btn btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					  </table>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->
			</div>
			<div class="col-4">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Add New Sub-SubCategory </h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
<form method="post" action="{{ route('subsubcategory.store') }}" >
	@csrf
	<div class="row">
		<div class="col-12">
			<div class="form-group">
				<h5>Category Name <span class="text-danger">*</span></h5>
				<select class="custom-select form-control" name="sub_category_name" id="sub_category_name">
					<option value="" selected="" disabled="">Select Category Name</option>
				   @foreach($categories as $category)
						<option value="{{ $category->id }}">{{ $category->category_name }}</option>
				    @endforeach
				</select>
				@error('category_id')
					<span class="text-danger">{{ $message }}</span>
				@enderror
			</div>
			<div class="form-group">
				<h5>Sub Category Name <span class="text-danger">*</span></h5>
				<select class="custom-select form-control" name="sub_category" id="sub_category">
					<option value="" selected="" disabled="">Select Sub Category Name</option>
				</select>
				@error('subcategory_id')
					<span class="text-danger">{{ $message }}</span>
				@enderror
			</div>
			<div class="form-group">
				<h5>Sub-Sub Category Name English <span class="text-danger">*</span></h5>
				<div class="controls">
					<input type="text" name="subsubcategory_name" id="subsubcategory_name" class="form-control" >
					@error('subsubcategory_name')
					<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>
				
			</div>
			
			<div class="text-xs-right">
				<input type="submit" class="btn btn-rounded btn-primary btn-info mb-5" value="Add New">
			</div>
		</form>
					
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->
			</div> 
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>

	  <script src="http://code.jquery.com/jquery-3.4.1.js"></script>
        
		<script>
					$(document).ready(function () {
					$('#sub_category_name').on('change', function () {
					let id = $(this).val();
					$('#sub_category').empty();
					$('#sub_category').append(`<option value="0" disabled selected>Processing...</option>`);
					$.ajax({
					type: 'GET',
					url: 'GetSubCatAgainstMainCatEdit/' + id,
					success: function (response) {
					var response = JSON.parse(response);
					console.log(response);   
					$('#sub_category').empty();
					$('#sub_category').append(`<option value="0" disabled selected>Select Sub Category*</option>`);
					response.forEach(element => {
						$('#sub_category').append(`<option value="${element['id']}">${element['name']}</option>`);
						});
					}
				});
			});
		});
		</script>
@endsection