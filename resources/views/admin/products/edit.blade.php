@extends('layouts.admin')

@section('title', 'Edit Product - Apparify')
@section('page-title', 'Edit Product')

@section('content')
<div class="container-fluid">
    {{-- Form Utama Produk --}}
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold"><i class="fas fa-info-circle text-primary me-2"></i> Basic Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Product Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $product->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                            <select class="form-select @error('category_id') is-invalid @enderror" 
                                    id="category_id" name="category_id" required>
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="5" required>{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="base_price" class="form-label fw-bold">Base Price (Rp) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('base_price') is-invalid @enderror" 
                                   id="base_price" name="base_price" value="{{ old('base_price', $product->base_price) }}" required>
                            @error('base_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold"><i class="fas fa-images text-primary me-2"></i> Product Images</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3 mb-4">
                            @foreach($product->images as $image)
                                <div class="col-md-3 text-center">
                                    <div class="card h-100 border-0 shadow-sm overflow-hidden" style="border-radius: 10px;">
                                        <img src="{{ str_starts_with($image->image_path, 'http') ? $image->image_path : asset('storage/' . $image->image_path) }}" 
                                             class="card-img-top" style="height: 120px; object-fit: cover;">
                                        <div class="card-body p-2 bg-light">
                                            @if($image->is_primary)
                                                <span class="badge bg-primary w-100 mb-2">Primary</span>
                                            @endif
                                            <button type="button" class="btn btn-sm btn-outline-danger w-100" 
                                                    onclick="deleteImage({{ $image->id }})">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <input type="file" class="form-control" name="images[]" multiple accept="image/*">
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold"><i class="fas fa-layer-group text-primary me-2"></i> Product Variants</h5>
                        <button type="button" class="btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addVariantModal">
                            <i class="fas fa-plus me-1"></i> Add Variant
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4">Size</th>
                                        <th>Color Info</th>
                                        <th width="120">Stock</th>
                                        <th width="150">Add. Price</th>
                                        <th class="pe-4 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product->variants as $variant)
                                        <tr>
                                            <form action="{{ route('admin.products.variants.update', $variant->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <td class="ps-4 fw-bold text-dark">{{ $variant->size }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="d-inline-block rounded-circle me-2 border shadow-sm" 
                                                              style="width: 18px; height: 18px; background-color: {{ $variant->color_code }}"></span>
                                                        <span>{{ $variant->color }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="number" name="stock" class="form-control form-control-sm text-center" 
                                                           value="{{ $variant->stock }}" min="0">
                                                </td>
                                                <td>
                                                    <input type="number" name="additional_price" class="form-control form-control-sm" 
                                                           value="{{ (int)$variant->additional_price }}" min="0">
                                                </td>
                                                <td class="pe-4 text-center">
                                                    <div class="btn-group">
                                                        <button type="submit" class="btn btn-sm btn-success shadow-sm">
                                                            <i class="fas fa-save"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-outline-danger border-0" 
                                                                onclick="deleteVariant({{ $variant->id }})">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar Settings --}}
            <div class="col-md-4">
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
                    <div class="card-header bg-white py-3 text-center">
                        <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm rounded-pill mb-2">
                            <i class="fas fa-save me-2"></i> Save All Changes
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary w-100 rounded-pill">
                            Cancel
                        </a>
                    </div>
                    <div class="card-body">
                        {{-- Logika Switch: Jika dimatikan, request tetap terkirim sebagai 0 di Controller melalui merge() --}}
                        <div class="form-check form-switch p-3 bg-light rounded-3 mb-3">
                            <input class="form-check-input ms-0 me-3" type="checkbox" id="is_active" name="is_active" value="1" 
                                   {{ $product->is_active ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="is_active">Product Active</label>
                        </div>
                        <div class="form-check form-switch p-3 bg-light rounded-3">
                            <input class="form-check-input ms-0 me-3" type="checkbox" id="has_design" name="has_design" value="1" 
                                   {{ $product->has_design ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="has_design">Has Pre-Design</label>
                        </div>
                        <div class="mt-3 small text-muted px-2">
                            <i class="fas fa-info-circle me-1"></i> Jika <b>Has Pre-Design</b> mati, produk akan berlabel <b>Custom Only</b>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

{{-- Hidden Delete Forms --}}
<form id="delete-image-form" method="POST" class="d-none"> @csrf @method('DELETE') </form>
<form id="delete-variant-form" method="POST" class="d-none"> @csrf @method('DELETE') </form>

@push('scripts')
<script>
    function deleteImage(id) {
        if(confirm('Hapus gambar ini?')) {
            let form = document.getElementById('delete-image-form');
            form.action = '/admin/products/images/' + id;
            form.submit();
        }
    }
    function deleteVariant(id) {
        if(confirm('Hapus varian ini?')) {
            let form = document.getElementById('delete-variant-form');
            form.action = '/admin/products/variants/' + id;
            form.submit();
        }
    }
</script>
@endpush

@include('admin.products.partials.modal-variant')
@endsection