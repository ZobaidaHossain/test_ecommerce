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
                <form action="{{ isset($role) ? route('backend.role.update', $role->id) : route('backend.role.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($role))
                        @method('PUT')
                    @endif

                    <div class="row p-4">
                        <!-- Heading -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $role->name ?? '') }}" placeholder="Enter role name">
                            </div>
                        </div>

                        <div class="row mb-3 mt-3">
                            <label style="display: block; margin-bottom:20px;" for="inputText"
                                class="col-sm-12 col-form-label"><b>Permission</b></label>
                                @foreach ($getPermission as $value)
    <div class="row" style="margin-bottom:20px;">
        <div class="col-md-3">
            {{ $value['name'] }}
        </div>
        <div class="col-md-9">
            <div class="row">
                @foreach ($value['group'] as $group)
                    @php
                        $checked = '';
                    @endphp
                    @if (isset($getRolePermission))
                        @foreach ($getRolePermission as $role)
                            @if ($role->permission_id == $group['id'])
                                @php
                                    $checked = 'checked';
                                @endphp
                            @endif
                        @endforeach
                    @endif
                    <div class="col-md-3">
                        <label>
                            <input type="checkbox" {{ $checked }} value="{{ $group['id'] }}" name="permission_id[]">
                            {{ $group['name'] }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <hr>
@endforeach

                         
                        </div>

                        <!-- Submit Button -->
                        <div class="col-md-12 text-right mt-5">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($role) ? 'Update role' : 'Create role' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
