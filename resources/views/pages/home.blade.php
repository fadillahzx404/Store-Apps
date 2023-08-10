@extends('layouts.app')

@section('title')
Store Homepage
@endsection

@section('content')
<div class="page-content page-home">
    <!-- Carousel -->

    <section class="store-carousel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" data-aos="zoom-in">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            @foreach ($banners as $banner)
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="true" aria-label="Slide 1"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @foreach ($banners as $banner)
                            <div class="carousel-item {{ $loop->first ? ' active' : '' }}">
                                <img src="{{ Storage::url($banner->foto_banner) }}" class="d-block w-100 rounded" alt="...">
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trend Categories -->
    <section class="store-trend-categories">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>Trend Categories</h5>
                </div>
            </div>
            <div class="row">
                @php $incrementCategory = 0 @endphp
                @forelse ($categories as $category)
                <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="{{ $incrementCategory+= 100 }}">
                    <a href="{{ route('categories-detail', $category->slug) }}" class="component-categories d-block">
                        <div class="categories-image">
                            <img src="{{ Storage::url($category->photo) }}" alt="" class="w-100" />
                        </div>
                        <p class="categories-text">{{ $category->name }}</p>
                    </a>
                </div>
                @empty
                <div class="col-12 text-center text-warning py-5" data-aos="fade-up" data-aos-delay="100">
                    <div class="row">
                        <img src="/images/not_found.jpg" alt="" style="height: 300px;object-fit: contain;">
                        <h3>Categories Not Found !</h3>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Products -->
    <section class="store-new-products">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>New Products</h5>
                </div>
            </div>
            <div class="row">
                @php $incrementProduct = 0 @endphp
                @forelse ($products as $product)
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $incrementProduct+= 100 }}">
                    <a href="{{ route('detail', $product->slug) }}" class="component-products d-block">
                        <div class="product-thumbnail">
                            <div class="products-image" style="
                      @if($product->galleries->count())
                        background-image: url('{{ Storage::url($product->galleries->first()->photos) }}')
                      @else
                        background-color: #eee
                      @endif
                    "></div>
                        </div>
                        <div class="products-text">{{ $product->name }}</div>
                        <div class="products-price">Rp {{ number_format($product->price) }}</div>
                    </a>
                </div>
                @empty
                <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                    No Products Found
                </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection