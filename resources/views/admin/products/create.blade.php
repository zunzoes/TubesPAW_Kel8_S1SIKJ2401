@extends('layouts.admin')

@section('title', 'Create Product - Apparify')
@section('page-title', 'Create New Product')

@section('content')
<div class="container-fluid">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
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
                                   id="name" name="name" value="{{ old('name') }}" required
                                   placeholder="e.g. Premium Cotton Hoodie">
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
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                      id="description" name="description" rows="5" required
                                      placeholder="Explain product details, materials, and care instructions...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="base_price" class="form-label fw-bold">Base Price (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">Rp</span>
                                <input type="number" class="form-control border-start-0 @error('base_price') is-invalid @enderror" 
                                       id="base_price" name="base_price" value="{{ old('base_price') }}" required
                                       placeholder="50000" step="1000">
                            </div>
                            @error('base_price')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold"><i class="fas fa-images text-primary me-2"></i> Product Images</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="images" class="form-label fw-bold small text-muted">Upload Images <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('images') is-invalid @enderror" 
                                   id="images" name="images[]" multiple accept="image/*" required>
                            @error('images')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text mt-2">
                                <i class="fas fa-info-circle me-1"></i> You can upload multiple images. The first image will be set as <b>Primary</b>.
                            </div>
                        </div>
                        <div id="image-preview" class="row g-2 mt-3"></div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold"><i class="fas fa-layer-group text-primary me-2"></i> Product Variants</h5>
                        <button type="button" class="btn btn-sm btn-primary shadow-sm" id="add-variant">
                            <i class="fas fa-plus me-1"></i> Add Variant
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="variants-container">
                            {{-- Default Variant Item (Index 0) --}}
                            <div class="variant-item border rounded-3 p-3 mb-3 bg-light position-relative shadow-sm">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold small">Size</label>
                                        <select class="form-select border-0" name="variants[0][size]" required>
                                            <option value="">Select Size</option>
                                            <option value="XS">XS</option>
                                            <option value="S">S</option>
                                            <option value="M" selected>M</option>
                                            <option value="L">L</option>
                                            <option value="XL">XL</option>
                                            <option value="XXL">XXL</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold small">Color Name</label>
                                        <input type="text" class="form-control border-0" name="variants[0][color]" placeholder="e.g. Black" required>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <label class="form-label fw-bold small">Pick Color</label>
                                        <input type="color" class="form-control form-control-color border-0 w-100" name="variants[0][color_code]" value="#000000" style="height: 38px;">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label fw-bold small">Initial Stock</label>
                                        <input type="number" class="form-control border-0" name="variants[0][stock]" value="10" min="0" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label fw-bold small">Add. Price (Rp)</label>
                                        <input type="number" class="form-control border-0" name="variants[0][additional_price]" value="0" min="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold"><i class="fas fa-cog text-muted me-2"></i> Settings</h5>
                    </div>
                    <div class="card-body">
                        {{-- Logika Switch: Nilai tetap terkirim ke Controller meski dimatikan --}}
                        <div class="mb-4">
                            <div class="form-check form-switch p-3 bg-light rounded-3">
                                <input class="form-check-input ms-0 me-3" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                <label class="form-check-label fw-bold" for="is_active">Publish Product</label>
                            </div>
                            <small class="text-muted d-block mt-2 px-2">Make this product visible to customers immediately.</small>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch p-3 bg-light rounded-3">
                                <input class="form-check-input ms-0 me-3" type="checkbox" id="has_design" name="has_design" value="1" checked>
                                <label class="form-check-label fw-bold" for="has_design">Has Pre-Design</label>
                            </div>
                            <small class="text-muted d-block mt-2 px-2">Uncheck if this product is <b>Custom Only</b> (blue badge).</small>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg py-2 shadow-sm rounded-pill">
                                <i class="fas fa-save me-2"></i> Create Product
                            </button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary py-2 rounded-pill">
                                <i class="fas fa-times me-2"></i> Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
let variantIndex = 1;

// Add new variant row dynamically
document.getElementById('add-variant').addEventListener('click', function() {
    const container = document.getElementById('variants-container');
    const newVariant = `
        <div class="variant-item border rounded-3 p-3 mb-3 bg-light position-relative shadow-sm animate__animated animate__fadeIn">
            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 remove-variant rounded-circle" style="width: 25px; height: 25px; padding: 0;">
                <i class="fas fa-times"></i>
            </button>
            <div class="row g-3 mt-1">
                <div class="col-md-3">
                    <label class="form-label fw-bold small text-muted">Size</label>
                    <select class="form-select border-0 shadow-none" name="variants[${variantIndex}][size]" required>
                        <option value="">Select</option>
                        <option value="XS">XS</option><option value="S">S</option>
                        <option value="M">M</option><option value="L">L</option>
                        <option value="XL">XL</option><option value="XXL">XXL</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold small text-muted">Color Name</label>
                    <input type="text" class="form-control border-0 shadow-none" name="variants[${variantIndex}][color]" placeholder="e.g. Red" required>
                </div>
                <div class="col-md-2 text-center">
                    <label class="form-label fw-bold small text-muted">Pick Color</label>
                    <input type="color" class="form-control form-control-color border-0 w-100 shadow-none" name="variants[${variantIndex}][color_code]" value="#ff0000" style="height: 38px;">
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold small text-muted">Initial Stock</label>
                    <input type="number" class="form-control border-0 shadow-none" name="variants[${variantIndex}][stock]" value="10" min="0" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold small text-muted">Add. Price (Rp)</label>
                    <input type="number" class="form-control border-0 shadow-none" name="variants[${variantIndex}][additional_price]" value="0" min="0">
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', newVariant);
    variantIndex++;
});

// Remove variant row
document.addEventListener('click', function(e) {
    if (e.target.closest('.remove-variant')) {
        e.target.closest('.variant-item').remove();
    }
});

// Image preview with Primary indicator
document.getElementById('images').addEventListener('change', function(e) {
    const preview = document.getElementById('image-preview');
    preview.innerHTML = '';
    
    Array.from(e.target.files).forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const col = document.createElement('div');
            col.className = 'col-md-3';
            col.innerHTML = `
                <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 10px;">
                    <img src="${e.target.result}" class="card-img-top" style="height: 120px; object-fit: cover;">
                    <div class="card-body p-2 text-center bg-light">
                        ${index === 0 ? '<span class="badge bg-primary px-3 rounded-pill">Primary</span>' : '<small class="text-muted">Gallery</small>'}
                    </div>
                </div>
            `;
            preview.appendChild(col);
        };
        reader.readAsDataURL(file);
    });
});
</script>
@endpush