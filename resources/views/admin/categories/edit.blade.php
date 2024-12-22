@extends('admin.layout.layout')
@section('contect')
<section class="content-header">
    <h1>
        Dashboard
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href= "{{ route('categories.index') }}"><i class="fa fa-dashboard"></i> All Categories</a></li>
        <li class="active">Edit Category</li>
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
            <h3 class="box-title">Add Category</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="box-body">
              <div class="form-group">
                <label for="name">Category Title</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Title" value="{{ $category->name }}" required>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Category Description</label>
                <textarea name="description" id="description" class="form-control" rows="5">{{ $category->description }}</textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputFile">Category Image</label>
                @if ($category->image)
                <img src="{{ asset('/' . $category->image) }}" alt="{{ $category->name }}" width="100" height="100" class="mt-2">
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
