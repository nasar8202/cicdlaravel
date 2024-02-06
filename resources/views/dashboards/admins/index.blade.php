@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title', 'Dashboard')

@section('content')
    <div class="dashboard-wrapper">
        <div class="dash-box-wrap">
            <div class="row">
                <div class="col-lg-4">
                    <div class="box box-shadow-blue bg-white">
                        <div class="row no-gutters">
                            <div class="col-4">
                                <div class="icon">
                                    <img src="{{ URL::asset('assets/icon2.png') }}" alt="" />
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="content">
                                    <h3>Properties Listed</h3>
                                    <h2>{{ $activeProperties }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="box box-shadow-blue bg-white">
                        <div class="row no-gutters">
                            <div class="col-4">
                                <div class="icon">
                                    <img src="{{ URL::asset('assets/icon1.png') }}" alt="" />
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="content">
                                    <h3>Properties Sold</h3>
                                    <h2>{{ $soldProperties }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="box box-shadow-blue bg-white">
                        <div class="row no-gutters">
                            <div class="col-4">
                                <div class="icon">
                                    <img src="{{ URL::asset('assets/icon3.png') }}" alt="" />
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="content">
                                    <h3>Registered Users</h3>
                                    <h2>{{ $registeredUsers ?? '0' }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="growth-listing">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="main-heading">User Growth</h1>
                    <div class="graph line-chart box-shadow-blue bg-white">
                        <div class="graph-select">
                            <div class="row">
                                <div class="col-8"></div>
                                <div class="col-4">
                                    <select id="interval" onchange="updateChartWithData()" class="form-control">
                                        <option value="monthly">Monthly</option>
                                        <option value="weekly">Weekly</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <canvas id="line" width="400" height="200"></canvas>
                    </div>
                </div>
                <div class="col-md-6">
                    <h1 class="main-heading">No of Listing</h1>
                    <div class="graph bar-chart box-shadow-blue bg-white">
                        <canvas id="bar" width="400" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-table-main">
            <h1 class="main-heading">Listing Leaderboards</h1>
            <div class="dashboard-table-inner">
                <table class="table table-hover box-shadow-blue bg-white" id="myTable">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Listings for Rent</th>
                            <th>Listings for Sale</th>
                            <th>Total Sold</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $propertiesGroupedByUser = $allProperties->groupBy('user.id');
                            $totalSaleAndRent = 0;
                        @endphp

                        @forelse($propertiesGroupedByUser as $userId => $properties)
                            @php
                                $propertiesForSaleCount = $properties->where('purpose_type', '=', 'Sell')->count();
                                $propertiesForRentCount = $properties->where('purpose_type', '=', 'Rent')->count();
                                $totalSaleAndRent = $propertiesForSaleCount + $propertiesForRentCount;
                            @endphp
                            <tr>
                                <td>{{ $properties->first()->user->name ?? '' }}</td>
                                <td>{{ $propertiesForRentCount ?? '0' }}</td>
                                <td>{{ $propertiesForSaleCount ?? '0' }}</td>
                                <td>{{ $totalSaleAndRent ?? '0' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No Property Found!</td>
                            </tr>
                        @endforelse


                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
