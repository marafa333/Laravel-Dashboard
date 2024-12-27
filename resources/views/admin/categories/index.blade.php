@extends('admin.layout.layout')
@section('contect')
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> All Categories</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Add -->
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        {{-- Edit --}}
        @if (Session::has('edit'))
            <div class="alert alert-info">
                {{ Session::get('edit') }}
            </div>
        @endif
        {{-- Delete --}}
        @if (Session::has('delete'))
            <div class="alert alert-danger">
                {{ Session::get('delete') }}
            </div>
        @endif
        {{-- Error --}}
        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">All Categories</h3>
                    <br>
                    <a href="{{ route('categories.create') }}" class="btn btn-primary my-3">Add Category</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline" role="grid">
                        <table id="example1" class="table table-bordered table-striped dataTable"
                            aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1"
                                        rowspan="1" colspan="1" aria-sort="ascending"
                                        aria-label="Id: activate to sort column descending" style="width: 190px;">
                                        #</th>
                                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="example1"
                                        rowspan="1" colspan="1"
                                        aria-label="Category Title: activate to sort column ascending"
                                        style="width: 274px;">Category Title</th>
                                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="example1"
                                        rowspan="1" colspan="1"
                                        aria-label="Category Image: activate to sort column ascending"
                                        style="width: 160px;">Category Image</th>
                                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="example1"
                                        rowspan="1" colspan="1"
                                        aria-label="Actions: activate to sort column ascending" style="width: 160px;">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody role="alert" aria-live="polite" aria-relevant="all">
                                @php
                                    $id = 1;
                                @endphp
                                @foreach ($categories as $category)
                                    <tr class="odd">
                                        <td class="  sorting_1">{{ $id++ }}</td>
                                        <td class=" ">{{ $category->name }}</td>
                                        <td class=" ">
                                            @if ($category->image)
                                                <img src="{{ asset('/' . $category->image) }}" alt="{{ $category->name }}"
                                                    width="100" height="100">
                                            @endif
                                        </td>
                                        <td class=" ">
                                            <a href="{{ route('categories.edit', $category->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.box-body -->
            </div>
        @endsection
