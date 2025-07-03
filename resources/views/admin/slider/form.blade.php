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
            <form action="{{ isset($slider) ? route('backend.slider.update', $slider->id) : route('backend.slider.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @if (isset($slider))
                    @method('PUT')
                @endif

                <div class="row p-4">
                    <!-- Heading -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="heading">Heading</label>
                            <input type="text"
                                   class="form-control"
                                   id="heading"
                                   name="heading"
                                   value="{{ old('heading', $slider->heading ?? '') }}"
                                   placeholder="Enter slider heading">
                        </div>
                    </div>

                    <!-- Title -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text"
                                   class="form-control"
                                   id="title"
                                   name="title"
                                   value="{{ old('title', $slider->title ?? '') }}"
                                   placeholder="Enter slider title">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title_two">Title two</label>
                            <input type="text"
                                   class="form-control"
                                   id="title_two"
                                   name="title_two"
                                   value="{{ old('title_two', $slider->title_two ?? '') }}"
                                   placeholder="Enter slider title">
                        </div>
                    </div>

                    <!-- Subtitle -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="subtitle">Subtitle</label>
                            <input type="text"
                                   class="form-control"
                                   id="subtitle"
                                   name="subtitle"
                                   value="{{ old('subtitle', $slider->subtitle ?? '') }}"
                                   placeholder="Enter slider subtitle">
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
                            @if (isset($slider) && $slider->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $slider->image) }}"
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
                                <option value="1" {{ old('status', $slider->status ?? '1') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $slider->status ?? '1') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-12 text-right mt-5">
                        <button type="submit" class="btn btn-primary">
                            {{ isset($slider) ? 'Update Slider' : 'Create Slider' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
