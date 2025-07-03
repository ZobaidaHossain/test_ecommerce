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
            <form action="{{ route('backend.user.update', ['id' => $getRecord->id]) }}" method="POST" enctype="multipart/form-data">

                @csrf


                <div class="row p-4">
                    <!-- Title -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="role_id">Role Name</label>
                            <select class="form-control" id="role_id" name="role_id">
                                <option value="" disabled selected>Select role</option>
                                @foreach($getRole as $value)
                                    <option value="{{ $value->id }}"
                                        {{ old('role_id', $getRecord->role_id) == $value->id ? 'selected' : '' }}>
                                        {{ $value->name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>



                    <!-- Subtitle -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text"
                                   class="form-control"
                                   id="name"
                                   name="name"
                                   value="{{ $getRecord->name }}"
                                   placeholder="Enter user name">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email"
                                   class="form-control"
                                   id="email"
                                   name="email"
                                   value="{{ $getRecord->email }}"
                                   placeholder="Enter user email">
                        </div>
                    </div>

                    {{-- <div class="col-md-12">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password"
                                   class="form-control"
                                   id="password"
                                   name="password"
                                   value="{{ $getRecord->password }}"
                                   placeholder="Enter user password">
                        </div>
                    </div> --}}

                    <!-- Submit Button -->
                    <div class="col-md-12 text-right mt-5">
                        <button type="submit" class="btn btn-primary">
                           Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
