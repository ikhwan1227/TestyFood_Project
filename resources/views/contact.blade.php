@extends('layouts.app')

@section('title', 'Kontak')
@section('page_title', 'KONTAK KAMI')

@section('content')
    <section class="section wrap">
        <h2>KONTAK KAMI</h2>
        <form id="contact" action="{{ route('contact.store') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div>
                    <input name="subject" placeholder="Subject" aria-label="Subject" required>
                    <input name="name" placeholder="Name" aria-label="Name" required>
                    <input type="email" name="email" placeholder="Email" aria-label="Email" required>
                </div>
                <textarea name="message" placeholder="Message" aria-label="Message" required></textarea>
            </div>
            <button class="button" type="submit">KIRIM</button>
            <p id="form-status" role="status"></p>
        </form>

        <div class="contact-info">
            <a href="mailto:tastyfood@gmail.com">
                <img src="{{ asset('assets/Group 66.png') }}" alt="">
                <h3>EMAIL</h3>
                <p>tastyfood@gmail.com</p>
            </a>
            <a href="tel:+6281234567890">
                <img src="{{ asset('assets/Group 67.png') }}" alt="">
                <h3>PHONE</h3>
                <p>+62 812 3456 7890</p>
            </a>
            <a href="https://www.google.com/maps/search/Bandung">
                <img src="{{ asset('assets/Group 68.png') }}" alt="">
                <h3>LOCATION</h3>
                <p>Kota Bandung, Jawa Barat</p>
            </a>
        </div>
    </section>

    <section class="section gray">
        <div class="wrap">
            <a href="https://www.google.com/maps/search/Bandung" target="_blank" rel="noopener" aria-label="Buka peta Bandung">
                <img class="map" src="{{ asset('assets/map.webp') }}" alt="Peta kawasan Bandung">
            </a>
        </div>
    </section>
@endsection