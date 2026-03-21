@extends('layouts.public')

@section('title', 'Purchase Receipt')

@section('content')
    <section class="page-hero page-hero--success">
        <div class="overlay"></div>
        <div class="container hero-content">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h1>Purchase Successful!</h1>
            <p style="color: var(--hero-text); font-size: 18px; margin-top: 12px;">
                Thank you for your purchase. Your order has been confirmed.
            </p>
        </div>
    </section>

    <div class="container section">
        <div class="receipt-container">
            <div class="receipt-card">
                <div class="receipt-header">
                    <h2><i class="fas fa-receipt"></i> Order Receipt</h2>
                    <div class="receipt-status">
                        <span class="status-badge status-paid">
                            <i class="fas fa-check"></i> Paid
                        </span>
                    </div>
                </div>

                <div class="receipt-body">
                    <div class="receipt-section">
                        <h3>Transaction Details</h3>
                        <div class="detail-row">
                            <span class="detail-label">Transaction ID</span>
                            <span class="detail-value">{{ $order->transaction_id }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Date</span>
                            <span class="detail-value">{{ $order->created_at->format('F j, Y - g:i A') }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Status</span>
                            <span class="detail-value status-text">{{ ucfirst($order->status) }}</span>
                        </div>
                    </div>

                    <div class="receipt-divider"></div>

                    <div class="receipt-section">
                        <h3>Customer Information</h3>
                        <div class="detail-row">
                            <span class="detail-label">Account</span>
                            <span class="detail-value">{{ $order->user->name ?? 'Customer' }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Email</span>
                            <span class="detail-value">{{ $order->user->email ?? 'N/A' }}</span>
                        </div>
                    </div>

                    <div class="receipt-divider"></div>

                    <div class="receipt-section">
                        <h3>Order Items</h3>
                        <div class="order-item">
                            <div class="item-info">
                                <i class="fas fa-file-alt"></i>
                                <div>
                                    <div class="item-name">{{ $form->title }}</div>
                                    <div class="item-description">{{ $form->description }}</div>
                                </div>
                            </div>
                            <div class="item-price">
                                {{ number_format($order->amount, 2) }} {{ config('app.currency','ETB') }}
                            </div>
                        </div>
                    </div>

                    <div class="receipt-divider"></div>

                    <div class="receipt-total">
                        <span class="total-label">Total Paid</span>
                        <span class="total-amount">
                            {{ number_format($order->amount, 2) }} {{ config('app.currency','ETB') }}
                        </span>
                    </div>
                </div>

                <div class="receipt-footer">
                    @if($form->file_url)
                        <a href="{{ route('forms.download', [$form, 'tx' => $order->transaction_id]) }}" class="btn btn-download">
                            <i class="fas fa-download"></i> Download Your Document
                        </a>
                    @endif
                    <a href="{{ url('/forms') }}" class="btn btn-outline">
                        <i class="fas fa-arrow-left"></i> Back to Forms
                    </a>
                </div>
            </div>

            <div class="receipt-info">
                <div class="info-card">
                    <i class="fas fa-info-circle"></i>
                    <h4>Important Information</h4>
                    <ul>
                        <li>Save this receipt for your records</li>
                        <li>Your document is available for download immediately</li>
                        @if(!$order->user_id)
                            <li>A copy of this receipt has been sent to {{ $order->guest_email }}</li>
                        @endif
                        <li>For support, contact us with your transaction ID</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Success hero */
        .page-hero--success {
            background: linear-gradient(135deg, rgba(5, 150, 105, 0.9) 0%, rgba(16, 185, 129, 0.8) 100%), url('{{ asset('images/office.jpg') }}');
            background-size: cover;
            background-position: center;
            min-height: 35vh;
            position: relative;
            overflow: hidden;
        }
        
        .page-hero--success::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.1), transparent);
        }
        
        .success-icon {
            font-size: 64px;
            color: #ffffff;
            margin-bottom: 16px;
            animation: successPulse 2s ease-in-out infinite;
        }
        
        @keyframes successPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        
        .page-hero--success h1 {
            color: #ffffff;
            font-size: 42px;
        }
        
        /* Receipt container */
        .receipt-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 32px;
            align-items: start;
        }
        
        .receipt-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        
        .receipt-header {
            background: linear-gradient(135deg, var(--accent) 0%, #fbbf24 100%);
            padding: 24px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .receipt-header h2 {
            color: var(--accent-text);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        
        .status-paid {
            background: rgba(255,255,255,0.25);
            color: var(--accent-text);
        }
        
        .receipt-body {
            padding: 32px;
        }
        
        .receipt-section {
            margin-bottom: 24px;
        }
        
        .receipt-section h3 {
            color: var(--text);
            font-size: 18px;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--card-border);
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid var(--card-border);
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            color: var(--muted);
            font-weight: 500;
        }
        
        .detail-value {
            color: var(--text);
            font-weight: 600;
            text-align: right;
        }
        
        .status-text {
            color: #10b981;
        }
        
        .receipt-divider {
            height: 1px;
            background: var(--card-border);
            margin: 24px 0;
        }
        
        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 16px;
            background: rgba(0,0,0,0.02);
            border-radius: 8px;
        }
        
        [data-theme="dark"] .order-item {
            background: rgba(255,255,255,0.03);
        }
        
        .item-info {
            display: flex;
            gap: 16px;
            flex: 1;
        }
        
        .item-info i {
            font-size: 24px;
            color: var(--accent);
            margin-top: 4px;
        }
        
        .item-name {
            font-weight: 600;
            color: var(--text);
            margin-bottom: 4px;
        }
        
        .item-description {
            font-size: 14px;
            color: var(--muted);
        }
        
        .item-price {
            font-size: 18px;
            font-weight: 700;
            color: var(--accent);
            white-space: nowrap;
            margin-left: 16px;
        }
        
        .receipt-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: linear-gradient(135deg, rgba(176, 137, 43, 0.1) 0%, rgba(251, 191, 36, 0.1) 100%);
            border-radius: 8px;
        }
        
        .total-label {
            font-size: 20px;
            font-weight: 600;
            color: var(--text);
        }
        
        .total-amount {
            font-size: 28px;
            font-weight: 700;
            color: var(--accent);
        }
        
        .receipt-footer {
            padding: 24px 32px;
            background: rgba(0,0,0,0.02);
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        
        [data-theme="dark"] .receipt-footer {
            background: rgba(255,255,255,0.02);
        }
        
        .btn-download {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 24px;
            background: linear-gradient(135deg, var(--accent) 0%, #fbbf24 100%);
            color: var(--accent-text);
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(176, 137, 43, 0.3);
        }
        
        .btn-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 24px;
            border: 2px solid var(--card-border);
            background: transparent;
            color: var(--text);
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-outline:hover {
            border-color: var(--accent);
            color: var(--accent);
        }
        
        /* Info card */
        .info-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        
        .info-card > i {
            font-size: 32px;
            color: #3b82f6;
            margin-bottom: 16px;
        }
        
        .info-card h4 {
            color: var(--text);
            margin-bottom: 16px;
        }
        
        .info-card ul {
            list-style: none;
            padding: 0;
        }
        
        .info-card li {
            padding: 8px 0;
            padding-left: 24px;
            position: relative;
            color: var(--muted);
            line-height: 1.6;
        }
        
        .info-card li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #10b981;
            font-weight: 700;
        }
        
        /* Responsive */
        @media (max-width: 968px) {
            .receipt-container {
                grid-template-columns: 1fr;
            }
            
            .receipt-info {
                order: -1;
            }
        }
        
        @media (max-width: 768px) {
            .receipt-body {
                padding: 24px;
            }
            
            .receipt-footer {
                flex-direction: column;
            }
            
            .btn-download,
            .btn-outline {
                width: 100%;
            }
            
            .page-hero--success h1 {
                font-size: 32px;
            }
            
            .success-icon {
                font-size: 48px;
            }
        }
    </style>
@endsection
