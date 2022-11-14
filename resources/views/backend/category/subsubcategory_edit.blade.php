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
 
			
			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Edit SubCategory data </h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
<form method="post" action="{{ route('subsubcategory.update',$subsubcategory->id) }}" >
	@csrf
	<div class="row">
		<div class="col-12">
			<!-- /**************************************************/ -->
			<input type="hidden" name="id" value="{{ $subsubcategory->id}}">

			<!-- /***************************************************/ -->
			<div class="form-group">
				<h5>Category Name <span class="text-danger">*</span></h5>
				<select class="custom-select form-control" name="category_id" id="category_id">
					<option value="" selected="" disabled="">Select Category Name</option>
				   @foreach($categories as $category)
				   <option value="{{ $category->id }}" {{ $category->id == $subsubcategory->	category_id ? 'selected': ''}} >{{ $category->category_name_en }}</option>
				   @endforeach
				</select>
				@error('category_id')
					<span class="text-danger">{{ $message }}</span>
				@enderror
			</div>
			<div class="form-group">
				<h5>Sub Category Name <span class="text-danger">*</span></h5>
				<select class="custom-select form-control" name="subcategory_id" id="subcategory_id">
					<option value="" selected="" disabled="">Select Sub Category Name</option>
					 @foreach($subcategories as $subcategory)
				   <option value="{{ $subcategory->id }}" {{ $subcategory->id == $subsubcategory->	subcategory_id ? 'selected': ''}} >{{ $subcategory->subcategory_name_en }}</option>
				   @endforeach
				</select>
				@error('subcategory_id')
					<span class="text-danger">{{ $message }}</span>
				@enderror
			</div>
			<div class="form-group">
				<h5>Sub-SubCategory Name English <span class="text-danger">*</span></h5>
				<div class="controls">
					<input type="text" name="subsubcategory_name_en" id="subsubcategory_name_en" class="form-control" value="{{ $subsubcategory->subsubcategory_name_en}}">
					@error('subsubcategory_name_en')
					<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>
				
			</div>
			<div class="form-group">
				<h5>Sub-Subcategory Name Sinhala <span class="text-danger">*</span></h5>
				<div class="controls">
					<input type="text" name="subsubcategory_name_sin" id="subsubcategory_name_sin" class="form-control"  value="{{ $subsubcategory->subsubcategory_name_sin}}">
					@error('subsubcategory_name_sin')
					<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>
				
			</div>

			<div class="text-xs-right">
				<input type="submit" class="btn btn-rounded btn-primary btn-info mb-5" value="Update">
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
@endsection