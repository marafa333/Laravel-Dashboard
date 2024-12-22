@extends('admin.layout.layout')
@section('contect')
<section class="content-header">
    <h1>
        Dashboard
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href= "{{ route('guests.index') }}"><i class="fa fa-dashboard"></i> All Guests</a></li>
        <li class="active">Edit Guest</li>
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
            <h3 class="box-title">Add Guest</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="{{ route('guests.update', $guest->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="box-body">
              <div class="form-group">
                <label for="name">Guest Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{ $guest->name }}" required>
              </div>
              <div class="form-group">
                <label for="name">Guest Age</label>
                <input type="text" class="form-control" name="age" id="age" placeholder="Enter Age" value="{{ $guest->age }}" required>
              </div>
              <div class="form-group">
                <label for="name">Guest Phone</label>
                <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone" value="{{ $guest->phone }}" required>
              </div>
              <div class="form-group">
                <label for="name">Guest Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" value="{{ $guest->email }}" required>
              </div>
              <div class="form-group">
                <label for="name">Guest Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" value="{{ old('password') }}" required>
              </div>
              <div class="form-group">
                <label for="exampleInputFile">Guest Image</label>
                @if ($guest->image)
                <img src="{{ asset('/' . $guest->image) }}" alt="{{ $guest->name }}" width="100" height="100" class="mt-2">
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
