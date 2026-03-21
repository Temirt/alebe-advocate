@extends('layouts.public')

@section('content')
@section('content')
    <section class="page-hero" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('images/office.jpg') }}');">
        <div class="container hero-content">
            <h1>{{ __('site.practice_title') }}</h1>
        </div>
    </section>

    <div class="container" style="padding:40px 20px;">
        <div class="grid" style="grid-template-columns: 1fr 420px; gap: 30px; align-items: start;">
            <div>
                <h1>{{ __('site.practice_title') }}</h1>
                <p>{{ __('site.practice_sub') }}</p>

                <section class="grid" style="margin-top:20px;">
                    <div class="card">
                        <h3>{{ __('site.criminal.title') }}</h3>
                        <p>{{ __('site.criminal.desc') }}</p>
                    </div>
                    <div class="card">
                        <h3>{{ __('site.family.title') }}</h3>
                        <p>{{ __('site.family.desc') }}</p>
                    </div>
                    <div class="card">
                        <h3>{{ __('site.property.title') }}</h3>
                        <p>{{ __('site.property.desc') }}</p>
                    </div>
                    <div class="card">
                        <h3>{{ __('site.contract.title') }}</h3>
                        <p>{{ __('site.contract.desc') }}</p>
                    </div>
                </section>

                <div style="margin-top:30px;">
                    <a href="/forms" class="btn">{{ __('site.view_forms') }}</a>
                </div>
            </div>

            <aside>
                <div class="practice-visual practice-visual--neutral"></div>
                <div style="margin-top:18px;">
                    <h2>{{ __('site.practice_features') }}</h2>
                    <div class="grid">
                        <div class="card">
                            <h3>{{ __('site.feature.education.title') }}</h3>
                            <p>{{ __('site.feature.education.desc') }}</p>
                        </div>
                        <div class="card">
                            <h3>{{ __('site.feature.forms.title') }}</h3>
                            <p>{{ __('site.feature.forms.desc') }}</p>
                        </div>
                        <div class="card">
                            <h3>{{ __('site.feature.remote.title') }}</h3>
                            <p>{{ __('site.feature.remote.desc') }}</p>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection
