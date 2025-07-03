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
            <form action="{{ isset($product) ? route('backend.product.update', $product->id) : route('backend.product.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @if (isset($product))
                    @method('PUT')
                @endif

                <div class="row p-4">
                    <!-- Title -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text"
                                   class="form-control"
                                   id="title"
                                   name="title"
                                   value="{{ old('title', $product->title ?? '') }}"
                                   placeholder="Enter product title">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="brand">Brand</label>
                            <input type="text"
                                   class="form-control"
                                   id="brand"
                                   name="brand"
                                   value="{{ old('brand', $product->brand ?? '') }}"
                                   placeholder="Enter product brand">
                        </div>
                    </div>

                    <!-- Subtitle -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="price">price</label>
                            <input type="number"
                                   class="form-control"
                                   id="price"
                                   name="price"
                                   value="{{ old('price', $product->price ?? '') }}"
                                   placeholder="Enter product price">
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <div>
                                <label for="image">Image</label>
                            </div>

                            <input type="file"
                                   name="image"
                                   id="image"
                                   class="form-control-file"
                                   accept="image/*">
                            @if (isset($product) && $product->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         alt="Current Image"
                                         style="max-width: 150px; max-height: 150px;">
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ old('status', $product->status ?? '1') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $product->status ?? '1') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-12 text-right mt-5">
                        <button type="submit" class="btn btn-primary">
                            {{ isset($product) ? 'Update product' : 'Create product' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
