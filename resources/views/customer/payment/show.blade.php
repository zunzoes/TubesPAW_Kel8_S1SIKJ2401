@extends('layouts.customer')

@section('title', 'Payment - Order #' . $order->order_number)

@section('content')
<div class="container pb-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('customer.orders.index') }}">My Orders</a></li>
            <li class="breadcrumb-item"><a href="{{ route('customer.orders.show', $order->id) }}">Order Details</a></li>
            <li class="breadcrumb-item active">Payment</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
                <div class="card-body p-4 text-center">
                    <h5 class="text-muted small text-uppercase fw-bold mb-2">Total Amount to Pay</h5>
                    <h2 class="text-primary fw-bold mb-4">Rp {{ number_format($order->total, 0, ',', '.') }}</h2>
                    
                    <div class="alert alert-warning border-0 small mb-4 text-start">
                        <i class="fas fa-exclamation-triangle me-2"></i> 
                        Please transfer the exact amount. Verification usually takes 1-12 hours during working days.
                    </div>

                    <div class="text-start bg-light p-4 rounded mb-4 border">
                        <p class="small text-muted mb-3 fw-bold text-uppercase">Transfer Destination:</p>
                        <div class="d-flex align-items-center mb-0">
                            {{-- Anda bisa mengganti logo ini sesuai bank Anda --}}
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" alt="BCA" width="60" class="me-3">
                            <div>
                                <h5 class="mb-0 fw-bold text-dark">1234-5678-90</h5>
                                <p class="mb-0 small text-muted">Account Name: <strong>PT Apparify Indonesia</strong></p>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 opacity-50">

                    <h5 class="fw-bold mb-3 text-start"><i class="fas fa-upload me-2 text-primary"></i>Upload Payment Proof</h5>
                    
                    <form action="{{ route('customer.payment.uploadProof', $order->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4 text-start">
                            <label class="form-label small text-muted">Select Image (JPG, PNG, JPEG - Max 2MB)</label>
                            <input type="file" name="payment_proof" class="form-control @error('payment_proof') is-invalid @enderror" required>
                            @error('payment_proof')
                                <div class="invalid-feedback fw-bold">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold py-3 shadow-sm">
                                <i class="fas fa-check-circle me-2"></i> Confirm Payment
                            </button>
                            <a href="{{ route('customer.orders.show', $order->id) }}" class="btn btn-link text-muted text-decoration-none">
                                Pay Later
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection