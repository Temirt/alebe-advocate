@extends('layouts.public')

@section('title', __('site.privacy_title'))

@section('content')
    <div class="container section">
        <h2>{{ __('site.privacy_title') }}</h2>
        <p>{{ __('site.privacy_text') }}</p>
    </div>
@endsection
