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
				  <h3 class="box-title">Edit Brand data </h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
<form method="post" action="{{route('brand.update')}}" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-12">
			<!-- /**************************************************/ -->
			<input type="hidden" name="id" value="{{ $brand->id}}">
            <input type="hidden" name="old_image" value="{{ $brand->brand_image}}">
			<!-- /***************************************************/ -->
			<div class="form-group">
				<h5>Brand Name English <span class="text-danger">*</span></h5>
				<div class="controls">
					<input type="text" name="brand_name_en" id="brand_name_en" class="form-control" value="{{ $brand->brand_name}}">
					@error('brand_name_en')
					<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>
				
			</div>
			
			<div class="form-group">
				<h5>Brand Image<span class="text-danger">*</span></h5>
				<div class="controls">
					<input type="file" name="brand_image" id="brand_image" class="form-control">
					@error('brand_image')
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