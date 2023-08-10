@extends('layouts.dashboard')

@section('title')
Store Dashboard Product Detail
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Create New Product</h2>
            <p class="dashboard-subtitle">Create your own product</p>
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
                    <form action="{{ route('dashboard-product-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Product Name</label>
                                            <input type="text" class="form-control" name="name" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="price">Price</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" name="price"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Kategori Product</label>
                                            <select name="categories_id" class="form-control">
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
                                                <textarea name="description" id="editor"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Thumbnail</label>
                                            <input type="file" class="form-control" name="photo" />
                                            <p class="text-muted" style="font-size:12px;padding:8px 0px 0 8px;">
                                                *Kamu dapat memilih lebih dari satu file
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <a href="dashboard_products.html" class="btn btn-danger px-5 mr-3">
                                            Cancel
                                        </a>
                                        <button class="btn btn-success px-5">
                                            Save Now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector("#editor")).catch((error) => {
        console.error(error);
    });
</script>
@endpush
