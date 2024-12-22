@extends('admin.layout.layout')
@section('contect')
<section class="content-header">
    <h1>
        Dashboard
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('products.index') }}"><i class="fa fa-dashboard"></i> All Products</a></li>
        <li class="active">Add Product</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
<div class="row">
<div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Add Product</h3>
      </div><!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="{{ route('products.index') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="box-body">
          <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="{{ old('name') }}" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Product Description</label>
            <textarea name="description" id="description" class="form-control" rows="5">{{ old('description') }}</textarea>
          </div>
          <div class="form-group">
            <label for="name">Product Price</label>
            <input type="text" class="form-control" name="price" id="price" placeholder="Enter Price" value="{{ old('price') }}" required>
          </div>
          <div class="form-group">
            <label for="exampleInputFile">Product Image</label>
            <input type="file" id="image" name="image">
          </div>
        </div><!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div><!-- /.box -->
  </div>

@endsection
