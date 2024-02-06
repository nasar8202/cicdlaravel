@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title', 'Registered Users List')

@section('content')
    <div class="dashboard-wrapper">
        <div class="dashboard-table-main">
            <h1 class="main-heading">All Users</h1>
            <div class="dashboard-table-inner">
                <table class="table table-hover box-shadow-blue bg-white" id="myTable">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date Joined</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registeredUsers as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->mobile_number }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td><a href="{{ route('admin.userManagement', $user->id) }}">View Profile</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td>No Users Found!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
