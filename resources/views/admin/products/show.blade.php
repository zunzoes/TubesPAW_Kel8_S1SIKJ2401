@extends('layouts.admin')

@section('title', 'Product Detail - Apparify')
@section('page-title', 'Product Detail')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px; overflow: hidden;">
                <div class="card-body p-0">
                    @if($product->images->isNotEmpty())
                        <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @foreach($product->images as $index => $image)
                                    <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></button>
                                @endforeach
                            </div>
                            <div class="carousel-inner bg-light">
                                @foreach($product->images as $index => $image)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        {{-- MENGGUNAKAN LOGIKA IMAGE PATH YANG FLEKSIBEL --}}
                                        <img src="{{ str_starts_with($image->image_path, 'http') ? $image->image_path : asset('storage/' . $image->image_path) }}" 
                                             class="d-block w-100" 
                                             style="height: 500px; object-fit: contain;"
                                             alt="{{ $product->name }}">
                                    </div>
                                @endforeach
                            </div>
                            @if($product->images->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon bg-dark rounded-circle p-3"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon bg-dark rounded-circle p-3"></span>
                                </button>
                            @endif
                        </div>
                    @else
                        <div class="bg-light d-flex flex-column align-items-center justify-content-center" style="height: 400px;">
                            <i class="fas fa-image fa-5x text-muted mb-3"></i>
                            <p class="text-muted">No images uploaded for this product</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-info-circle text-primary me-2"></i> Product Information</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h2 class="fw-bold mb-1">{{ $product->name }}</h2>
                            <span class="badge rounded-pill bg-secondary bg-opacity-10 text-secondary px-3">
                                {{ $product->category->name ?? 'Uncategorized' }}
                            </span>
                            @if($product->is_active)
                                <span class="badge rounded-pill bg-success px-3">Active</span>
                            @else
                                <span class="badge rounded-pill bg-danger px-3">Inactive</span>
                            @endif
                        </div>
                        <h3 class="text-primary fw-bold">Rp {{ number_format($product->base_price, 0, ',', '.') }}</h3>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold text-uppercase small text-muted mb-2">Description</h6>
                        <p class="text-dark" style="line-height: 1.6;">{{ $product->description }}</p>
                    </div>

                    <div class="row g-3 bg-light rounded p-3">
                        <div class="col-sm-6">
                            <div class="small text-muted text-uppercase">Slug</div>
                            <code class="text-primary">{{ $product->slug }}</code>
                        </div>
                        <div class="col-sm-6">
                            <div class="small text-muted text-uppercase">Design Type</div>
                            <span class="text-dark fw-medium">
                                {!! $product->has_design ? '<i class="fas fa-palette me-1"></i> Pre-designed' : '<i class="fas fa-paint-brush me-1"></i> Custom Only' !!}
                            </span>
                        </div>
                        <div class="col-sm-6">
                            <div class="small text-muted text-uppercase">Creation Date</div>
                            <span class="text-dark fw-medium">{{ $product->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="col-sm-6">
                            <div class="small text-muted text-uppercase">Stock Status</div>
                            <span class="text-dark fw-medium">{{ $product->variants->sum('stock') }} pcs across {{ $product->variants->count() }} variants</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-layer-group text-primary me-2"></i> Available Variants</h5>
                </div>
                <div class="card-body p-0">
                    @if($product->variants->isNotEmpty())
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4">Size</th>
                                        <th>Color</th>
                                        <th>Stock</th>
                                        <th>Price Adjustment</th>
                                        <th class="pe-4">Final Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product->variants as $variant)
                                        <tr>
                                            <td class="ps-4 fw-bold">{{ $variant->size }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="d-inline-block rounded-circle me-2 border" 
                                                          style="width: 15px; height: 15px; background-color: {{ $variant->color_code }}"></span>
                                                    {{ $variant->color }}
                                                </div>
                                            </td>
                                            <td>
                                                @if($variant->stock > 10)
                                                    <span class="badge bg-soft-success text-success px-3">{{ $variant->stock }} pcs</span>
                                                @elseif($variant->stock > 0)
                                                    <span class="badge bg-soft-warning text-warning px-3">{{ $variant->stock }} pcs</span>
                                                @else
                                                    <span class="badge bg-soft-danger text-danger px-3">Out of Stock</span>
                                                @endif
                                            </td>
                                            <td class="text-muted">
                                                {{ $variant->additional_price > 0 ? '+ Rp ' . number_format($variant->additional_price, 0, ',', '.') : '-' }}
                                            </td>
                                            <td class="pe-4 fw-bold text-dark">
                                                Rp {{ number_format($product->base_price + $variant->additional_price, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <p class="text-muted mb-0">No variants defined for this product.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-bolt text-warning me-2"></i> Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning py-2 shadow-sm rounded-3">
                            <i class="fas fa-edit me-2"></i> Edit Product
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary py-2 rounded-3">
                            <i class="fas fa-arrow-left me-2"></i> Back to List
                        </a>
                        <hr>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" 
                              onsubmit="return confirm('Are you sure want to delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100 py-2 rounded-3">
                                <i class="fas fa-trash me-2"></i> Delete Product
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-chart-line text-success me-2"></i> Sales Performance</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted small text-uppercase fw-bold">Total Orders</span>
                            <span class="h5 mb-0 fw-bold">{{ $product->orderItems->count() }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted small text-uppercase fw-bold">Units Sold</span>
                            <span class="h5 mb-0 fw-bold">{{ $product->orderItems->sum('quantity') }} pcs</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center py-3 bg-light">
                            <span class="text-muted small text-uppercase fw-bold text-dark">Total Revenue</span>
                            <span class="h5 mb-0 fw-bold text-success">Rp {{ number_format($product->orderItems->sum('subtotal'), 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-soft-success { background-color: rgba(40, 167, 69, 0.1); }
    .bg-soft-warning { background-color: rgba(255, 193, 7, 0.1); }
    .bg-soft-danger { background-color: rgba(220, 53, 69, 0.1); }
    .carousel-item img { border-radius: 15px 15px 0 0; }
</style>
@endsection