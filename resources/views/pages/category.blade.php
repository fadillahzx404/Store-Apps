@extends('layouts.app')

@section('title')
Store Category Page
@endsection

@section('content')
<div class="page-content page-home">
    <!-- Trend Categories -->
    <section class="store-trend-categories">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>All Categories</h5>
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
                <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                    No Categories Found
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
                    <h5>All Products</h5>
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
                        <div class="products-price">Rp {{ number_format($product->price,2) }}</div>
                    </a>
                </div>
                @empty
                <div class="col-12 text-center text-warning py-5" data-aos="fade-up" data-aos-delay="100">
                    <div class="row">
                        <img src="/images/not_found.jpg" alt="" style="height: 300px;object-fit: contain;">
                        <h3>Product Not Found !</h3>
                    </div>
                </div>
                @endforelse
            </div>
            <div class="row">
                <div class="col-12 mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
