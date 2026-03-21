@extends('layouts.public')

@section('content')
@section('content')
@section('content')
    <section class="page-hero" style="background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)), url('{{ asset('images/office.jpg') }}');">
        <div class="container hero-content">
            <h1>{{ __('site.attorney_title') }}</h1>
        </div>
    </section>

    <div class="container" style="padding:40px 20px;">
        <div class="attorney-grid">
                <div>
                    <div class="attorney-visual" style="background-image: url('{{ asset('images/attorney.jpg') }}'); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);"></div>
                </div>
                <div>
                <h1>{{ __('site.attorney_name') }}</h1>
                <h3>{{ __('site.attorney_title') }}</h3>

                <h4>{{ __('site.credentials') }}</h4>
                <ul>
                    <li>{{ __('site.cred.licensed') }}</li>
                    <li>{{ __('site.cred.experience') }}</li>
                    <li>{{ __('site.cred.published') }}</li>
                </ul>

                <h4>{{ __('site.bio_title') }}</h4>
                <p>{{ __('site.bio_text') }}</p>

                <div style="margin-top:20px;">
                    <a href="/contact" class="btn">{{ __('site.book_consult') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
