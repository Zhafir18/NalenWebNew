@extends('layout')

@section('title', 'All Products')

@section('content')
<link rel="stylesheet" href="{{ asset('css/allproduct.css') }}">

<main>
    <div class="home-container">
        <div class="home">
            <div id="products" class="product-section-wrapper">
                <div class="product-section d-flex flex-column p-5" style="border-radius: 10px;">
                    <h2 class="text-center mb-5">Our Products</h2>
                    <form method="get" action="{{ url('/products/all') }}" class="mb-4 search-form">
                        <div class="input-group">
                            <input type="text" name="productName" class="form-control" placeholder="Search by name" value="{{ request('productName') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-lg-3 col-md-6 mb-4 product-card" data-aos="fade-up" data-aos-duration="1000">
                            <div class="card" style="border-radius:10px;">
                                @php
                                    $images = json_decode($product->product_image, true);
                                    $firstImage = is_array($images) && count($images) > 0 ? $images[0] : $product->product_image;
                                @endphp
                                <img src="{{ asset('images/' . $firstImage) }}" class="card-img-top" style="border-radius:10px; padding: 7px; max-height: 500px;" alt="{{ $product->product_name }}">
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
                                        style="background-color:#e3484d; color: white">View Product</button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div id="products-mobile" class="product-section-wrapper">
                <div class="product-section d-flex flex-column p-5" style="border-radius: 10px;">
                    <h2 class="text-center mb-5">Our Products</h2>
                    <form method="get" action="{{ url('/products/all') }}" class="mb-4 search-form">
                        <div class="input-group">
                            <input type="text" name="productName" class="form-control" placeholder="Search by name" value="{{ request('productName') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-lg-6 mb-4 product-card" data-aos="fade-up" data-aos-duration="1000">
                            <div class="card" style="border-radius:10px;">
                                @php
                                    $images = json_decode($product->product_image, true);
                                    $firstImage = is_array($images) && count($images) > 0 ? $images[0] : $product->product_image;
                                @endphp
                                <img src="{{ asset('images/' . $firstImage) }}" class="card-img-top" style="border-radius:10px; padding: 7px; max-height: 500px;" alt="{{ $product->product_name }}">
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
                                        style="background-color:#e3484d; color: white">View Product</button>
                                </div>
                            </div>
                        </div>
                        @endforeach
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
    var imageBaseUrl = "{{ asset('images/') }}";
</script>
@endsection
