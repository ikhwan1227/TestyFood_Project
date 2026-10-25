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
            <a href="mailto:{{ $globalSettings['contact_email'] ?? 'tastyfood@gmail.com' }}">
                <img src="{{ asset('assets/icon-email.png') }}" alt="">
                <h3>EMAIL</h3>
                <p>{{ $globalSettings['contact_email'] ?? 'tastyfood@gmail.com' }}</p>
            </a>
            <a href="tel:{{ $globalSettings['contact_phone'] ?? '+6281234567890' }}">
                <img src="{{ asset('assets/icon-phone.png') }}" alt="">
                <h3>PHONE</h3>
                <p>{{ $globalSettings['contact_phone'] ?? '+62 812 3456 7890' }}</p>
            </a>
            
            {{-- Ubah link dan teks lokasi di sini --}}
            <a href="{{ $globalSettings['maps_url'] ?? 'https://www.google.com/maps/search/Bandung' }}" target="_blank" rel="noopener">
                <img src="{{ asset('assets/icon-location.png') }}" alt="">
                <h3>LOCATION</h3>
                <p>{{ $globalSettings['address'] ?? 'Kota Bandung, Jawa Barat' }}</p>
            </a>
        </div>
    </section>

    <section class="section gray">
        <div class="wrap">
            <a href="https://www.google.com/maps/search/?api=1&query=Jl.+Terusan+Mars+Utara+III+No.+8D,+Kota+Bandung,+Jawa+Barat+40292"
            target="_blank"
            rel="noopener"
            aria-label="Buka peta lokasi Tasty Food">
                <iframe 
                    width="100%" 
                    height="450" 
                    style="border:0; border-radius: 16px; box-shadow: 0 3px 5px #0002;"
                    loading="lazy" 
                    allowfullscreen 
                    referrerpolicy="no-referrer-when-downgrade"
                    src="https://maps.google.com/maps?q={{ urlencode($globalSettings['address'] ?? 'Bandung') }}&t=&z=15&ie=UTF8&iwloc=&output=embed">
                </iframe>
            </a>
        </div>
    </section>
@endsection