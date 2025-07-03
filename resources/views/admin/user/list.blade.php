@extends('layouts.admin')

@section('content')
<div class="row layout-top-spacing">
    <div class="col-lg-12 col-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <table id="style-3" class="table style-3 table-hover">

                    <thead>
                        <tr>
                            <th class="fs-3 "style="color:black">User List</th>
                        </tr>
                        <tr>
                            <th >#</th>

                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>

                            <th class="text-center dt-no-sorting">Action</th>
                        </tr>
                    </thead>
<tbody>
@foreach ($getRecord as $value)
<tr>
    <th >{{$value->id}}</th>
    <td>{{$value->name}}</td>
    <td>{{$value->email}}</td>
    <td>{{$value->role_name}}</td>
    <td>
        <a href="{{url('backend/user/edit/'. $value->id)}}" class="btn btn-primary btn-sm">Edit</a>
        <a href="{{url('backend/user/delete/'. $value->id)}}" class="btn btn-danger btn-sm">Delete</a>
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
