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
                            <th>Title Two</th>
                            <th>Subtitle</th>
                            <th>Heading</th>
                            <th class="text-center">Status</th>
                            <th class="text-center dt-no-sorting">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sliders as $key => $slider)
                        <tr>
                            <td class="checkbox-column text-center">{{ $key + 1 }}</td>
                            <td class="text-center">
                                <img src="{{ asset('storage/' . $slider->image) }}" alt="Slider Image" style="width: 100px; height: auto;" class="profile-img">
                            </td>
                            <td>{{ $slider->title }}</td>
                            <td>{{$slider->title_two}}</td>
                            <td>{{ $slider->subtitle }}</td>
                            <td>{{ $slider->heading }}</td>
                            <td class="text-center">
                                {{ $slider->status}}
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('backend.slider.edit', $slider->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('backend.slider.destroy', $slider->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this slider?');">
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
