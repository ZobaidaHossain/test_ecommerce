@extends('layouts.admin')

@section('content')
<div class="row layout-top-spacing">
    <div class="col-lg-12 col-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <table id="style-3" class="table style-3 table-hover">

                    <thead>
                        <tr>
                            <th class="fs-3 "style="color:black">Role List</th>
                        </tr>
                        <tr>
                            <th class="checkbox-column text-center">#</th>

                            <th>Name</th>
@if(!empty($PermissionEdit) || !empty($PermissionDelete))
                            <th class="text-center dt-no-sorting">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $key => $role)
                        <tr>
                            <td class="checkbox-column text-center">{{ $key + 1 }}</td>

                            <td>{{ $role->name }}</td>

                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    @if(!empty($PermissionEdit))
                                    <a href="{{ route('backend.role.edit', $role->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    @endif
                                    @if(!empty($PermissionDelete))
                                    <form action="{{ route('backend.role.destroy', $role->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this role?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                    @endif
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
