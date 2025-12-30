@extends('layouts.admin')

@section('title', 'Products - Apparify')
@section('page-title', 'Products Management')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold" style="color: #6096B4;"><i class="fas fa-box me-2"></i> All Products</h4>
        <a href="{{ route('admin.products.create') }}" class="btn text-white shadow-sm" style="background-color: #6096B4;">
            <i class="fas fa-plus"></i> Add New Product
        </a>
    </div>

    <div class="card mb-4 border-0 shadow-sm" style="border-radius: 15px; background-color: #EEE9DA;">
        <div class="card-body">
            <form action="{{ route('admin.products.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                            <input type="text" name="search" class="form-control border-start-0" placeholder="Search products..." 
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select name="category" class="form-select border-0">
                            <option value="">All Categories</option>
                            @foreach($categories ?? [] as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-select border-0">
                            <option value="">All Status</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn text-white w-100 shadow-sm" style="background-color: #6096B4;">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden; background-color: white;">
        <div class="card-body p-0">
            @if(isset($products) && $products->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background-color: #BDCDD6; color: #2C3333;">
                            <tr>
                                <th class="ps-4" width="5%">#</th>
                                <th width="10%">Image</th>
                                <th width="25%">Product Name</th>
                                <th width="15%">Category</th>
                                <th width="12%">Base Price</th>
                                <th width="10%">Variants</th>
                                <th width="10%">Status</th>
                                <th class="pe-4 text-center" width="13%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $index => $product)
                                <tr>
                                    <td class="ps-4 text-muted">{{ $products->firstItem() + $index }}</td>
                                    <td>
                                        <img src="{{ $product->image_url }}" 
                                             class="rounded shadow-sm border" 
                                             style="width: 50px; height: 50px; object-fit: cover; border-color: #BDCDD6 !important;" 
                                             alt="{{ $product->name }}"
                                             onerror="this.onerror=null;this.src='{{ asset('images/placeholder-product.png') }}';">
                                    </td>
                                    <td>
                                        <div class="fw-bold" style="color: #2C3333;">{{ $product->name }}</div>
                                        @if($product->has_design)
                                            <span class="badge" style="font-size: 0.7rem; background-color: #FCF8EE; color: #6096B4; border: 1px solid #BDCDD6;">
                                                <i class="fas fa-check"></i> Pre-designed
                                            </span>
                                        @else
                                            <span class="badge" style="font-size: 0.7rem; background-color: #EEE9DA; color: #2C3333; border: 1px solid #BDCDD6;">
                                                <i class="fas fa-paint-brush"></i> Custom Only
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill px-3" style="background-color: #93BFCF; color: white;">
                                            {{ $product->category->name ?? 'No Category' }}
                                        </span>
                                    </td>
                                    <td class="fw-bold" style="color: #6096B4;">
                                        Rp {{ number_format($product->base_price, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <span class="badge border text-dark" style="background-color: #FCF8EE;">
                                            <i class="fas fa-layer-group me-1" style="color: #6096B4;"></i>{{ $product->variants->count() }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($product->is_active)
                                            <span class="badge rounded-pill px-3 bg-success">Active</span>
                                        @else
                                            <span class="badge rounded-pill px-3 bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="pe-4 text-center">
                                        <div class="btn-group shadow-sm" role="group">
                                            <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-sm" style="border-color: #BDCDD6; color: #6096B4;" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm" style="border-color: #BDCDD6; color: #93BFCF;" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline" 
                                                  onsubmit="return confirm('Are you sure want to delete this product?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm" style="border-color: #BDCDD6; color: #BDCDD6;" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center p-4">
                    <div class="text-muted small">
                        Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} results
                    </div>
                    <div>
                        {{ $products->links() }}
                    </div>
                </div>
            @else
                <div class="text-center py-5" style="background-color: #FCF8EE;">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; background-color: #EEE9DA;">
                        <i class="fas fa-box-open fa-3x" style="color: #BDCDD6;"></i>
                    </div>
                    <h5 style="color: #2C3333;">No products found</h5>
                    <p class="text-muted small mb-4">Try adjusting your filters or search keywords.</p>
                    <a href="{{ route('admin.products.create') }}" class="btn rounded-pill px-4 shadow-sm text-white" style="background-color: #6096B4;">
                        <i class="fas fa-plus me-2"></i>Create First Product
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    /* Styling pagination agar sesuai palet */
    .pagination .page-link { color: #6096B4; border-color: #BDCDD6; }
    .pagination .page-item.active .page-link { background-color: #6096B4; border-color: #6096B4; }
    
    .table-hover tbody tr:hover { background-color: #FCF8EE; }
    .form-control:focus, .form-select:focus { border-color: #93BFCF; box-shadow: 0 0 0 0.25rem rgba(147, 191, 207, 0.25); }
</style>
@endsection