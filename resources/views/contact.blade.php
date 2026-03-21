@extends('layouts.public')

@section('title','Contact')

@section('content')
@section('content')
    <section class="page-hero" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('images/office.jpg') }}');">
        <div class="overlay"></div>
        <div class="container hero-content">
            <h1>Contact Us</h1>
            <p style="font-size: 1.2rem; color: #fff;">We are here to help with your legal needs</p>
        </div>
    </section>

<div class="container section">
    <h2>Contact Us</h2>
    <p class="muted">Use this form to send a message — we'll respond as soon as possible.</p>

    <form id="contactForm" action="/contact" method="POST" style="max-width:700px; margin-top:16px;">
        @csrf
        <div><label>Name</label><input type="text" name="name" required></div>
        <div><label>Email</label><input type="email" name="email" required></div>
        <div><label>Message</label><textarea name="message" required></textarea></div>
        <div style="text-align:right; margin-top:8px;"><button class="btn">Send Message</button></div>
    </form>
</div>
@endsection
