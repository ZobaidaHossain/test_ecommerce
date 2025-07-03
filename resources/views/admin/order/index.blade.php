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
                            <th>Product Title</th>
                            <th>Quantity</th>
                            <th class="text-center">Status</th>
                            <th class="text-center dt-no-sorting">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $key => $order)
                        <tr>
                            <td class="checkbox-column text-center">{{ $key + 1 }}</td>
                         
                            <td>{{ $order->product->title }}</td>
                            <td>{{$order->quantity}}</td>
                            <td class="text-center">
                                {{ $order->status}}
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('backend.order.edit', $order->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('backend.order.destroy', $order->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this order?');">
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
