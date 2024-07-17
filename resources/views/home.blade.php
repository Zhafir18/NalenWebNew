@extends('layout')

@section('title', 'Home')

@section('content')

<link rel="stylesheet" href="{{ asset('css/home.css') }}">

<main class="scroll-smooth">
    <div class="home-container">
        <div class="home">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" data-aos="zoom-in" data-aos-duration="1000">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('images/LandingPage1.JPG') }}" class="d-block w-100" style="object-fit: cover; height: 500px; border-radius: 0 0 10px 10px;" alt="First slide">
                    </div>
                    <!-- <div class="carousel-item">
                        <img src="{{ asset('images/Logo Katbag.jpg') }}" class="d-block w-100" style="object-fit: cover; height: 500px;" alt="Third slide">
                    </div> -->
                </div>
                <a class="carousel-control-prev" href="#carouselExampleSlidesOnly" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleSlidesOnly" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            
            <div class="intro-section mt-5">
                <div class="intro-text" data-aos="fade-right" data-aos-duration="2000">
                    <h1>KATBAG</h1>
                    <p>Katbag akan hadir sebagai teman setia yang selalu melengkapi gaya Anda. Dengan material berkualitas dan desain yang simpel, Katbag memastikan Anda selalu siap menghadapi hari dengan penuh percaya diri.</p>
                    <a href="#products" class="btn btn-primary shop-now-btn" style="background-color:#e3484d; border-color:#e3484d;">Shop Now</a>
                </div>
                <div class="intro-image" data-aos="fade-left" data-aos-duration="2000">
                    <img src="{{ asset('images/intro.png') }}" alt="Intro Image">
                </div>
            </div>

            <div id="products" class="product-section-wrapper mt-5">
                <div class="product-section d-flex flex-column p-5" style="border-radius: 10px;">
                    <h2 class="text-center">Our Products</h2>
                    <div>
                        <a href="{{ url('/products/all') }}" class="btn btn-all-product">View All Products</a>
                    </div>
                    <div id="productCarousel" class="carousel slide" data-ride="carousel" data-interval="false" data-aos="fade-up" data-aos-duration="2000">
                        <div class="carousel-inner">
                            @foreach($products->chunk(3) as $chunk)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <div class="row justify-content-center">
                                        @foreach($chunk as $product)
                                            <div class="col-md-4 col-sm-12 product-card p-5">
                                                <div class="card" style="border-radius:10px;">
                                                    @php
                                                        $images = json_decode($product->product_image, true);
                                                        $firstImage = is_array($images) && count($images) > 0 ? $images[0] : $product->product_image;
                                                    @endphp
                                                    <img src="{{ asset('images/' . $firstImage) }}" class="card-img-top w-100" style="border-radius:10px; padding: 7px; max-height: 500px" alt="{{ $product->product_name }}">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $product->product_name }}</h5>
                                                        <p class="card-text">{{ $product->product_price }}</p>
                                                        <button type="button" class="btn view-product-btn" data-toggle="modal" data-target="#productModal"
                                                            data-id="{{ $product->product_id }}"
                                                            data-name="{{ $product->product_name }}"
                                                            data-price="{{ $product->product_price }}"
                                                            data-description="{{ $product->product_description }}"
                                                            data-link="{{ $product->product_link }}"
                                                            data-image="{{ json_encode($images) }}"
                                                            style="background-color:#e3484d; color: white">View Product
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="product-carousel-controls">
                            <a class="product-carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
                                <span class="product-carousel-control-prev-icon">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </span>
                            </a>
                            <a class="product-carousel-control-next" href="#productCarousel" role="button" data-slide="next">
                                <span class="product-carousel-control-next-icon">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>

                <div id="productCarousel-mobile" class="carousel slide" data-ride="carousel" data-interval="false" data-aos="fade-up" data-aos-duration="2000">
                        <div class="carousel-inner">
                            @foreach($products->chunk(1) as $chunk)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <div class="row justify-content-center">
                                        @foreach($chunk as $product)
                                            <div class="col-md-4 col-sm-12 product-card p-5">
                                                <div class="card" style="border-radius:10px;">
                                                    @php
                                                        $images = json_decode($product->product_image, true);
                                                        $firstImage = is_array($images) && count($images) > 0 ? $images[0] : $product->product_image;
                                                    @endphp
                                                    <img src="{{ asset('images/' . $firstImage) }}" class="card-img-top w-100" style="border-radius:10px; padding: 7px; max-height: 500px" alt="{{ $product->product_name }}">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $product->product_name }}</h5>
                                                        <p class="card-text">{{ $product->product_price }}</p>
                                                        <button type="button" class="btn view-product-btn" data-toggle="modal" data-target="#productModal"
                                                            data-id="{{ $product->product_id }}"
                                                            data-name="{{ $product->product_name }}"
                                                            data-price="{{ $product->product_price }}"
                                                            data-description="{{ $product->product_description }}"
                                                            data-link="{{ $product->product_link }}"
                                                            data-image="{{ json_encode($images) }}"
                                                            style="background-color:#e3484d; color: white">View Product
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="product-carousel-controls">
                            <a class="product-carousel-control-prev" href="#productCarousel-mobile" role="button" data-slide="prev">
                                <span class="product-carousel-control-prev-icon">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </span>
                            </a>
                            <a class="product-carousel-control-next" href="#productCarousel-mobile" role="button" data-slide="next">
                                <span class="product-carousel-control-next-icon">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </span>
                            </a>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 10px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProductName"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="prod" class="col-md-4">
                            <div id="modalCarousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner" id="modalCarouselInner">
                                    <!-- Images will be injected here by JavaScript -->
                                </div>
                                <a class="carousel-control-prev" href="#modalCarousel" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#modalCarousel" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-8" id="productDetailsColumn">
                            <h4 id="modalProductPrice"></h4>
                            <h5 style="color: #">Deskripsi Produk</h5>
                            <span id="modalProductDescription"></span>
                            <a id="modalProductLink" href="" target="_blank" class="btn btn-primary mt-auto">Buy Now</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.querySelector('.shop-now-btn').addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });

    var imageBaseUrl = "{{ asset('images/') }}";
</script>
@endsection
