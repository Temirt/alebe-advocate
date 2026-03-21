@extends('layouts.public')

@section('title', __('site.forms_title'))

@section('content')
    <section class="page-hero page-hero--forms">
        <div class="overlay"></div>
        <div class="container hero-content">
            <h1>{{ __('site.forms_title') }}</h1>
            <p class="section-sub" style="color: var(--hero-text); font-size: 18px; margin-top: 12px;">{{ __('site.forms_sub') }}</p>
        </div>
    </section>
    
    <div class="container section">
        <div class="grid forms-grid">
            @forelse($forms as $form)
                <div class="card form-card">
                    <div class="form-card-header">
                        <h3>{{ $form->title }}</h3>
                        @if($form->price)
                            <div class="form-price">
                                <span class="price-amount">{{ number_format($form->price, 2) }}</span>
                                <span class="price-currency">{{ config('app.currency','ETB') }}</span>
                            </div>
                        @endif
                    </div>
                    
                    <p class="form-description">{{ $form->description }}</p>
                    
                    @if($form->file_url)
                        @auth
                            <p class="form-attachment">
                                <i class="fas fa-file-pdf"></i> 
                                <a href="{{ $form->file_url }}" target="_blank">Preview attachment</a>
                            </p>
                        @else
                            <p class="form-attachment muted">
                                <i class="fas fa-lock"></i> 
                                <em>Attachment available after purchase</em>
                            </p>
                        @endauth
                    @endif
                    
                    <div class="form-actions">
                        <a class="btn btn-buy" href="{{ route('forms.buy', $form) }}">
                            <i class="fas fa-shopping-cart"></i> {{ __('site.buy_now') }}
                        </a>
                        @guest
                            <!-- Clean guest experience, no need to show login prompt here -->
                        @endguest
                    </div>
                </div>
            @empty
                <div class="card empty-state">
                    <i class="fas fa-inbox" style="font-size: 48px; color: var(--muted); margin-bottom: 16px;"></i>
                    <p>No forms available at this time.</p>
                    <p class="muted"><small>Please check back later</small></p>
                </div>
            @endforelse
        </div>
    </div>

    <style>
        /* Forms page hero with background */
        .page-hero--forms {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.9) 0%, rgba(59, 130, 246, 0.8) 100%), url('{{ asset('images/office.jpg') }}');
            background-size: cover;
            background-position: center;
            min-height: 40vh;
            position: relative;
            overflow: hidden;
            padding-top: 120px; /* Fix overlap with fixed navbar */
        }
        
        .page-hero--forms::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent, rgba(0,0,0,0.2));
        }
        
        .page-hero--forms .hero-content {
            position: relative;
            z-index: 2;
            padding: 60px 0;
        }
        
        .page-hero--forms h1 {
            color: #ffffff;
            font-size: 42px;
            text-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        
        /* Forms grid */
        .forms-grid {
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 32px;
        }
        
        /* Form card styling */
        .form-card {
            position: relative;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 12px;
            padding: 28px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }
        
        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent) 0%, #fbbf24 100%);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }
        
        .form-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.12);
        }
        
        .form-card:hover::before {
            transform: scaleX(1);
        }
        
        .form-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
            gap: 16px;
        }
        
        .form-card-header h3 {
            margin: 0;
            flex: 1;
            color: var(--text);
        }
        
        .form-price {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            background: linear-gradient(135deg, var(--accent) 0%, #fbbf24 100%);
            padding: 8px 16px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(176, 137, 43, 0.2);
        }
        
        .price-amount {
            font-size: 24px;
            font-weight: 700;
            color: var(--accent-text);
            line-height: 1;
        }
        
        .price-currency {
            font-size: 12px;
            font-weight: 600;
            color: var(--accent-text);
            opacity: 0.8;
            margin-top: 2px;
        }
        
        .form-description {
            color: var(--muted);
            line-height: 1.6;
            margin-bottom: 16px;
        }
        
        .form-attachment {
            padding: 12px;
            background: rgba(0,0,0,0.02);
            border-radius: 6px;
            margin-bottom: 16px;
            font-size: 14px;
        }
        
        [data-theme="dark"] .form-attachment {
            background: rgba(255,255,255,0.03);
        }
        
        .form-attachment i {
            margin-right: 8px;
            color: var(--accent);
        }
        
        .form-attachment a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
        }
        
        .form-attachment a:hover {
            text-decoration: underline;
        }
        
        .form-actions {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid var(--card-border);
        }
        
        .btn-buy {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            justify-content: center;
            padding: 14px 24px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .btn-buy:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(176, 137, 43, 0.3);
        }
        
        .guest-note {
            margin-top: 12px;
            text-align: center;
            color: var(--muted);
        }
        
        .guest-note a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
        }
        
        .guest-note a:hover {
            text-decoration: underline;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 40px;
            grid-column: 1 / -1;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .forms-grid {
                grid-template-columns: 1fr;
            }
            
            .page-hero--forms h1 {
                font-size: 32px;
            }
            
            .form-card-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .form-price {
                align-self: flex-start;
            }
        }
    </style>
@endsection
