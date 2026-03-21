@extends('layouts.public')

@section('title', 'Buy Form - ' . $form->title)

@section('content')
    <section class="page-hero page-hero--checkout">
        <div class="overlay"></div>
        <div class="container hero-content">
            <h1><i class="fas fa-shopping-cart"></i> Checkout</h1>
        </div>
    </section>

    <div class="container section">
        <div class="checkout-grid">
            <!-- Order Summary -->
            <div class="order-summary">
                <h2>Order Summary</h2>
                <div class="summary-card">
                    <div class="summary-item">
                        <h3>{{ $form->title }}</h3>
                        <p class="summary-description">{{ $form->description }}</p>
                    </div>
                    
                    @if($form->file_url)
                        <div class="summary-item">
                            <i class="fas fa-file-pdf"></i>
                            <span>PDF Document included</span>
                        </div>
                    @endif
                    
                    <div class="summary-divider"></div>
                    
                    <div class="summary-total">
                        <span>Total Amount</span>
                        <div class="total-price">
                            <span class="amount">{{ number_format($form->price ?? 0, 2) }}</span>
                            <span class="currency">{{ config('app.currency','ETB') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Form -->
            <div class="payment-form">
                @auth
                    <h2>Complete Your Purchase</h2>
                    <p class="welcome-message">
                        <i class="fas fa-user-check"></i> 
                        Logged in as <strong>{{ auth()->user()->name }}</strong>
                    </p>
                    
                    <form action="{{ route('forms.purchase', $form) }}" method="POST" class="checkout-form">
                        @csrf
                        <div class="form-info">
                            <i class="fas fa-info-circle"></i>
                            <p>Click the button below to complete your purchase. This is a secure transaction.</p>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-large">
                            <i class="fas fa-check-circle"></i>
                            Confirm Purchase - {{ number_format($form->price ?? 0, 2) }} {{ config('app.currency','ETB') }}
                        </button>
                    </form>
                @else
                    <div class="login-prompt card">
                        <div class="icon-header">
                            <i class="fas fa-lock"></i>
                        </div>
                        <h2>Authentication Required</h2>
                        <p>You must be logged in to purchase this legal document. This ensures you have permanent access to your downloads.</p>
                        
                        <div class="auth-buttons">
                            <a href="{{ route('login') }}" class="btn btn-primary btn-block">
                                <i class="fas fa-sign-in-alt"></i> Login to Continue
                            </a>
                            <p class="text-center mt-3" style="font-size: 0.9em; color: var(--muted);">
                                Don't have an account? <a href="/contact" style="color: var(--accent);">Contact us</a> to register.
                            </p>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <style>
        /* Checkout hero with background */
        .page-hero--checkout {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.9) 0%, rgba(30, 58, 138, 0.8) 100%), url('{{ asset('images/office.jpg') }}');
            background-size: cover;
            background-position: center;
            min-height: 30vh;
            position: relative;
            overflow: hidden;
        }
        
        .page-hero--checkout .hero-content {
            padding: 40px 0;
        }
        
        .page-hero--checkout h1 {
            color: #ffffff;
            font-size: 36px;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        
        /* Checkout grid */
        .checkout-grid {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 40px;
            align-items: start;
        }
        
        /* Order summary */
        .order-summary h2 {
            margin-bottom: 20px;
            color: var(--text);
        }
        
        .summary-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        
        .summary-item {
            margin-bottom: 16px;
        }
        
        .summary-item h3 {
            margin-bottom: 8px;
            color: var(--text);
        }
        
        .summary-description {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.6;
        }
        
        .summary-item i {
            color: var(--accent);
            margin-right: 8px;
        }
        
        .summary-divider {
            height: 1px;
            background: var(--card-border);
            margin: 20px 0;
        }
        
        .summary-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 18px;
            font-weight: 600;
        }
        
        .total-price {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }
        
        .total-price .amount {
            font-size: 32px;
            font-weight: 700;
            color: var(--accent);
            line-height: 1;
        }
        
        .total-price .currency {
            font-size: 14px;
            color: var(--muted);
            margin-top: 4px;
        }
        
        /* Payment form */
        .payment-form h2 {
            margin-bottom: 16px;
            color: var(--text);
        }
        
        .welcome-message,
        .guest-message {
            background: linear-gradient(135deg, rgba(176, 137, 43, 0.1) 0%, rgba(251, 191, 36, 0.1) 100%);
            border-left: 4px solid var(--accent);
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
        }
        
        .welcome-message i,
        .guest-message i {
            color: var(--accent);
            margin-right: 8px;
        }
        
        .guest-message a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
        }
        
        .guest-message a:hover {
            text-decoration: underline;
        }
        
        /* Form styling */
        .checkout-form {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 12px;
            padding: 32px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        
        .form-group {
            margin-bottom: 24px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text);
        }
        
        .form-group label i {
            color: var(--accent);
            margin-right: 8px;
        }
        
        .form-input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid var(--card-border);
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: var(--bg);
            color: var(--text);
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(176, 137, 43, 0.1);
        }
        
        .form-input.error {
            border-color: #ef4444;
        }
        
        .field-hint {
            display: block;
            margin-top: 6px;
            color: var(--muted);
            font-size: 13px;
        }
        
        .error-message {
            display: block;
            margin-top: 6px;
            color: #ef4444;
            font-size: 14px;
        }
        
        .form-info {
            background: rgba(59, 130, 246, 0.1);
            border-left: 4px solid #3b82f6;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            display: flex;
            gap: 12px;
        }
        
        .form-info i {
            color: #3b82f6;
            margin-top: 2px;
        }
        
        .form-info p {
            margin: 0;
            color: var(--text);
            font-size: 14px;
            line-height: 1.6;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--accent) 0%, #fbbf24 100%);
            color: var(--accent-text);
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-large {
            width: 100%;
            padding: 18px 32px;
            font-size: 18px;
            font-weight: 700;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(176, 137, 43, 0.3);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        /* Responsive */
        @media (max-width: 968px) {
            .checkout-grid {
                grid-template-columns: 1fr;
            }
            
            .order-summary {
                order: 2;
            }
            
            .payment-form {
                order: 1;
            }
        }
        
        @media (max-width: 768px) {
            .checkout-form {
                padding: 24px;
            }
            
            .btn-large {
                font-size: 16px;
                padding: 16px 24px;
            }
        }
    </style>
@endsection
