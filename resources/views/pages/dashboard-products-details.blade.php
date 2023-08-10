@extends('layouts.dashboard')

@section('title')
Store Dashboard Product Detail
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Shirup Marzan</h2>
            <p class="dashboard-subtitle">Product Details</p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('dashboard-product-update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Product Name</label>
                                            <input type="text" class="form-control" value="Papel La Casa" name="name" value="{{ $product->name }}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="price">Price</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="number" name="price" class="form-control" aria-label="Amount (to the nearest dollar)" value="100000" value="{{ number_format($product->price) }}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label">kategori</label>
                                            <select name="categories_id" class="form-control">
                                                <option value="{{ $product->categories_id }}">Tidak Diganti ({{ $product->category->name }})</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Description</label>
                                            <div class="ck-content">
                                                <textarea class="ck-content" name="description" id="editor">{!! $product->description !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <a href="{{ route('dashboard-product') }}" class="btn btn-danger px-5 mr-3">
                                            Cancel
                                        </a>
                                        <button type="submit" class="btn btn-success px-5">
                                            Save Now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @foreach ($product->galleries as $gallery)
                                <div class="col-md-4">
                                    <div class="gallery-container">
                                        <img src="{{ Storage::url($gallery->photos ?? '') }}" alt="" class="w-100" />
                                        <a href="{{ route('dashboard-product-gallery-delete', $gallery->id) }}" class="delete-gallery">
                                            <img src="/images/icon-delete.svg" alt="" />
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                                <div class="col-12">
                                    <form action="{{ route('dashboard-product-gallery-upload') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="products_id" value="{{ $product->id }}">
                                        <input type="file" id="file" name="photos" style="display: none" onchange="form.submit()"/>
                                        <button class="btn btn-secondary btn-block mt-2" type="button" onclick="thisFileUpload()">
                                            Add Photo
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
<script>
    function thisFileUpload() {
        document.getElementById("file").click();
    }
</script>
<script>
    ClassicEditor.create(document.querySelector("#editor")).catch((error) => {
        console.error(error);
    });
</script>
@endpush
