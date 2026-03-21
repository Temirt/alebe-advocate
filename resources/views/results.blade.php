@extends('layouts.public')

@section('title', __('site.results_title'))

@section('content')
    <section class="page-hero" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('images/office.jpg') }}'); background-size: cover; background-position: center;">
        <div class="container hero-content">
            <h1>{{ __('site.results_title') }}</h1>
        </div>
    </section>
    <div class="container section">
        <h2>{{ __('site.results_title') }}</h2>
        <p class="section-sub">{{ __('site.results_sub') }}</p>

        <div class="grid">
            <div class="card">
                <h3>{{ __('site.result.case1.title') }}</h3>
                <p>{{ __('site.result.case1.desc') }}</p>
            </div>
            <div class="card">
                <h3>{{ __('site.result.case2.title') }}</h3>
                <p>{{ __('site.result.case2.desc') }}</p>
            </div>
            <div class="card">
                <h3>{{ __('site.result.case3.title') }}</h3>
                <p>{{ __('site.result.case3.desc') }}</p>
            </div>
        </div>
    </div>
@endsection
