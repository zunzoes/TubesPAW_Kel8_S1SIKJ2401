@extends('layouts.admin')

@section('title', 'Admin Dashboard - Apparify')
@section('page-title', 'Dashboard')

@push('styles')
<style>
    :root {
        --color-1: #6096B4; /* Muted Blue */
        --color-2: #93BFCF; /* Light Blue */
        --color-3: #BDCDD6; /* Grey Blue */
        --color-4: #EEE9DA; /* Beige */
        --color-5: #FCF8EE; /* Off-White */
    }
    
    .card-custom-1 { background-color: var(--color-1); color: white; }
    .card-custom-2 { background-color: var(--color-2); color: white; }
    .card-custom-3 { background-color: var(--color-3); color: #2C3333; }
    .card-custom-4 { background-color: var(--color-4); color: #2C3333; }
    
    .btn-apparify { background-color: var(--color-1); color: white; border: none; }
    .btn-apparify:hover { background-color: #4d7a94; color: white; }
    
    .table-header-custom { background-color: var(--color-3) !important; color: #2C3333; }
</style>
@endpush

@section('content')
<div class="container-fluid" style="background-color: var(--color-5); min-height: 100vh; padding-top: 20px;">
    
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card card-custom-1 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0 text-white-50">Total Products</h6>
                            <h2 class="mb-0">{{ $totalProducts ?? 8 }}</h2>
                        </div>
                        <i class="fas fa-box fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-custom-2 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0 text-white-50">Total Orders</h6>
                            <h2 class="mb-0">{{ $totalOrders ?? 3 }}</h2>
                        </div>
                        <i class="fas fa-shopping-cart fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-custom-3 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0 text-muted">Pending Orders</h6>
                            <h2 class="mb-0">{{ $pendingOrders ?? 1 }}</h2>
                        </div>
                        <i class="fas fa-clock fa-3x opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-custom-4 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0 text-muted">Total Revenue</h6>
                            <h2 class="mb-0">Rp {{ number_format($totalRevenue ?? 115000, 0, ',', '.') }}</h2>
                        </div>
                        <i class="fas fa-dollar-sign fa-3x opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <h5 class="mb-0" style="color: var(--color-1)"><i class="fas fa-shopping-cart"></i> Recent Orders</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-header-custom">
                                <tr>
                                    <th>Order Number</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>ORD-6949EA1FB0BCF</strong></td>
                                    <td>Customer</td>
                                    <td>Rp 115.000</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>23 Dec 2025</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-apparify">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection