@extends('layouts.public')

@section('title', __('site.disclaimer_title'))

@section('content')
    <div class="container section">
        <h2>{{ __('site.disclaimer_title') }}</h2>
        <p>{{ __('site.disclaimer_text') }}</p>
    </div>
@endsection
