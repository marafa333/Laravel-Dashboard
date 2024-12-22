@extends('admin.layout.layout')
@section('contect')
<section class="content-header">
    <h1>
        Dashboard
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href= "{{ route('products.index') }}"><i class="fa fa-dashboard"></i> All Products</a></li>
        <li class="active">Edit Product</li>
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
          <form role="form" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="box-body">
              <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="{{ $product->name }}" required>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Product Description</label>
                <textarea name="description" id="description" class="form-control" rows="5">{{ $product->description }}</textarea>
              </div>
              <div class="form-group">
                <label for="name">Product Price</label>
                <input type="text" class="form-control" name="price" id="price" placeholder="Enter Price" value="{{ $product->price }}" required>
              </div>
              <div class="form-group">
                <label for="exampleInputFile">Product Image</label>
                @if ($product->image)
                <img src="{{ asset('/' . $product->image) }}" alt="{{ $product->name }}" width="100" height="100" class="mt-2">
                @endif
                <input type="file" id="image" name="image">
              </div>
            </div><!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-success">Update</button>
            </div>
          </form>
        </div><!-- /.box -->
      </div>


@endsection
