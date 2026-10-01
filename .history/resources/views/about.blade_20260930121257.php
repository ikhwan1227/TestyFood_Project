@extends('layouts.app')

@section('title', 'Tentang')
@section('page_title', 'TENTANG KAMI')

@section('content')
    <section class="section gray">
        <div class="wrap two-cols">
            <div>
                <h2>TASTY FOOD</h2>
                <p><b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum
                        commodo, dui diam convallis arcu, eget consectetur ex sem eget lacus. Nullam vitae dignissim
                        neque, vel luctus ex. Fusce sit amet viverra ante.</b></p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum
                    commodo, dui diam convallis arcu, eget consectetur ex sem eget lacus. Nullam vitae dignissim
                    neque, vel luctus ex. Fusce sit amet viverra ante.</p>
            </div>
            <div class="image-pair portrait">
                <img src="{{ asset('assets/brooke-lark-oaz0raysASk-unsplash.webp') }}" alt="Hidangan Tasty Food" loading="lazy">
                <img src="{{ asset('assets/sebastian-coman-photography-eBmyH7oO5wY-unsplash.webp') }}" alt="Hidangan Tasty Food" loading="lazy">
            </div>
        </div>
    </section>

    <section class="section wrap about">
        <div class="two-cols">
            <div class="image-pair">
                <img src="{{ asset('assets/fathul-abrar-T-qI_MI2EMA-unsplash.webp') }}" alt="Hidangan Tasty Food" loading="lazy">
                <img src="{{ asset('assets/michele-blackwell-rAyCBQTH7ws-unsplash.webp') }}" alt="Hidangan Tasty Food" loading="lazy">
            </div>
            <div>
                <h2>VISI</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce scelerisque magna aliquet cursus
                    tempus. Duis viverra metus et turpis elementum elementum. Aliquam rutrum placerat tellus et
                    suscipit. Curabitur facilisis lectus vitae eros malesuada eleifend. Mauris eget tellus odio.
                    Phasellus vestibulum turpis ac sem commodo, at posuere eros consequat. Duis nec ex at ante
                    volutpat posuere. Morbi vel nunc tortor. Nulla facilisi. Nulla accumsan ullamcorper purus nec
                    venenatis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer imperdiet erat vel
                    leo rutrum lobortis.</p>
            </div>
        </div>
        <div class="two-cols">
            <div>
                <h2>MISI</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce scelerisque magna aliquet cursus
                    tempus. Duis viverra metus et turpis elementum elementum. Aliquam rutrum placerat tellus et
                    suscipit. Curabitur facilisis lectus vitae eros malesuada eleifend. Mauris eget tellus odio.
                    Phasellus vestibulum turpis ac sem commodo, at posuere eros consequat. Duis nec ex at ante
                    volutpat posuere. Morbi vel nunc tortor. Nulla facilisi. Nulla accumsan ullamcorper purus nec
                    venenatis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer imperdiet erat vel
                    leo rutrum lobortis.</p>
            </div>
            <img class="wide" src="{{ asset('assets/sanket-shah-SVA7TyHxojY-unsplash.webp') }}" alt="Hidangan Tasty Food" loading="lazy">
        </div>
    </section>
@endsection