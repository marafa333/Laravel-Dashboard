@extends('admin.layout.layout')
@section('contect')
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> All Products</li>
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
                    <h3 class="box-title">All products</h3>
                    <br>
                    <a href="{{ route('products.create') }}" class="btn btn-primary my-3">Add Product</a>
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
                                        aria-label="Product Title: activate to sort column ascending" style="width: 274px;">
                                        Product Title</th>
                                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="example1"
                                        rowspan="1" colspan="1"
                                        aria-label="Product Price: activate to sort column ascending" style="width: 245px;">
                                        Product Price</th>
                                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="example1"
                                        rowspan="1" colspan="1"
                                        aria-label="Product Image: activate to sort column ascending" style="width: 160px;">
                                        Product Image</th>
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
                                @foreach ($products as $product)
                                    <tr class="odd">
                                        <td class="  sorting_1">{{ $id++ }}</td>
                                        <td class=" ">{{ $product->name }}</td>
                                        <td class=" ">{{ $product->price }}</td>
                                        <td class=" ">
                                            @if ($product->image)
                                                <img src="{{ asset('/' . $product->image) }}" alt="{{ $product->name }}"
                                                    width="100" height="100">
                                            @endif
                                        </td>
                                        <td class=" ">
                                            <a href="{{ route('products.edit', $product->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
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
