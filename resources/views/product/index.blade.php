@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="row">
                <div class="row gy-1">
                    <div class="col-6 text-start">
                        <h2>Products</h2>
                    </div>
                    <div class="col-6 text-end">
                        <a class="btn btn-success" href="{{ route('products.create') }}"> New Product </a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="row">
                    <div class="col-lg-6 text-right"></div>

                    <div class="col-lg-6 text-right">
                        <br>
                        <form action="{{ route('products.index') }}" method="get">
                            @csrf
                            <div class="input-group">
                                <input placeholder="Name | Code" type="text" id="search" name="search" value="{{ (isset($_GET['search'])) ? $_GET['search'] : '' }}" class="form-control">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">Search!</button>
                                </div>
                            </div>
                        </form>
                        <br>
                    </div>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Selling Price</th>
                            <th>Special Price</th>
                            <th>Status</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->name }}</td>
                            <td>
                                {{ Str::limit($product->description, $limit = 50, $end = '...') }}
                            </td>
                            <td>{{ $product->selling_price}}</td>
                            <td>{{ $product->special_price }}</td>
                            <td>{{ $product_status[$product->status] }}</td>
                            <td width="20%">
                                <div class="row text-center">
                                    <div class="col-3 text-center">
                                        <a class="btn btn-primary btn-sm" href="{{ route('products.edit', $product->id) }}">Edit</a>
                                    </div>
                                    <div class="col-3 text-center ">
                                        <a class="btn btn-secondary btn-sm" href="{{ route('products.show', $product->id) }}">Show</a>
                                    </div>
                                    <div class="col-3 text-center ">
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm deleteData">Delete</button>
                                        </form>
                                    </div>
                                </div>


                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($products != [])
                {!! $products->links() !!}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection