@extends('layouts.admin')

@section('content')
<div class="row layout-top-spacing">
    <div class="col-lg-12 col-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <table id="style-3" class="table style-3 table-hover">
                    <thead>
                        <tr>
                            <th class="checkbox-column text-center">#</th>
                            <th class="text-center">Image</th>
                            <th>Title</th>
                            <th>Brand</th>
                            <th>price</th>
                            <th class="text-center">Status</th>
                            <th class="text-center dt-no-sorting">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $key => $product)
                        <tr>
                            <td class="checkbox-column text-center">{{ $key + 1 }}</td>
                            <td class="text-center">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="product Image" style="width: 100px; height: auto;" class="profile-img">
                            </td>
                            <td>{{ $product->title }}</td>
                            <td>{{$product->brand}}</td>
                            <td>{{ $product->price }}</td>
                            <td class="text-center">
                                {{ $product->status}}
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('backend.product.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('backend.product.destroy', $product->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
