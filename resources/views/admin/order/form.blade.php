@extends('layouts.admin')

@section('content')

<div class="row layout-top-spacing">
    <div class="col-lg-12 col-12">
        <div class="card">

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ isset($order) ? route('backend.order.update', $order->id) : route('backend.order.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @if (isset($order))
                    @method('PUT')
                @endif

                <div class="row p-4">
                    <!-- Title -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="product_id">Product Title</label>
                            <select class="form-control" id="product_id" name="product_id">
                                <option value="" disabled selected>Select a product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" 
                                        {{ old('product_id', $order->product_id ?? '') == $product->id ? 'selected' : '' }}>
                                        {{ $product->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                   

                    <!-- Subtitle -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number"
                                   class="form-control"
                                   id="quantity"
                                   name="quantity"
                                   value="{{ old('quantity', $order->quantity ?? '') }}"
                                   placeholder="Enter order quantity">
                        </div>
                    </div>

                 

                    <!-- Status -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ old('status', $order->status ?? '1') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $order->status ?? '1') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-12 text-right mt-5">
                        <button type="submit" class="btn btn-primary">
                            {{ isset($order) ? 'Update order' : 'Create order' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
