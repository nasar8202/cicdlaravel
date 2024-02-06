@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title', 'Property Management')

@section('content')
    <div class="dashboard-wrapper">
        <div class="dashboard-table-main">
            <h1 class="main-heading">All Properties</h1>
            <div class="dashboard-table-inner">
                <table class="table table-hover box-shadow-blue bg-white" id="myTable">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Listed By</th>
                            <th>Listing Type</th>
                            <th>Listed At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($properties as $property)
                            <tr>
                                <td>{{ $property->addInformation->title }}</td>
                                <td>{{ $property->user->name }}</td>
                                <td>{{ $property->locationAndPurpose->purpose_type }}</td>
                                <td>{{ $property->created_at }}</td>
                                <td>{{ $property->status }}</td>
                                <td><a href="{{ route('admin.propertyDetails', $property->id) }}">View Detail</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td>No Property Found!</td>
                            </tr>
                        @endforelse


                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
