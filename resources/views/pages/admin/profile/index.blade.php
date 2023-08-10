@extends('layouts.admin')

@section('title')
Profile User
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Profile User</h2>
            <p class="dashboard-subtitle">
                Edit Profile User
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-12 mt-1 d-flex justify-content-center">
                                        <div class="form-group ">
                                            <img src="{{ Auth::user()->photo_profile == 0||Auth::user()->photo_profile == 'NULL' ? '/images/user.png' : Auth::user()->photo_profile}}" alt="" style="height: 150px;">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <form action="{{ route('profile-setting-update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" id="file" name="photo_profile" style="display: none" onchange="form.submit()"/>
                                        <div class="fa-3x">
                                        <button class="btn btn-light btn-block" type="button" onclick="thisFileUpload()">
                                            <i class="fa-sharp fa-solid fa-pen-to-square pr-2"></i>Ubah Foto Profile
                                        </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('profile-setting-account') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nama User</label>
                                            <input type="text" name="name" class="form-control" required value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Email User</label>
                                            <input type="email" name="email" class="form-control" required value="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Password User</label>
                                            <input type="password" name="password" class="form-control">
                                            <small>Kosongkan jika tidak ingin menggubah password</small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Roles</label>
                                            <select name="roles" required class="form-control" id="">
                                                <option value="{{ $user->roles }}" selected>Tidak diganti ({{ $user->roles }})</option>
                                                <option value="ADMIN">Admin</option>
                                                <option value="USER">User</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-success px-5">
                                            Save Now
                                        </button>
                                    </div>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

@push('addon-script')
<script>
    function thisFileUpload() {
        document.getElementById("file").click();
    }
</script>
<script src="https://kit.fontawesome.com/d3336582c4.js" crossorigin="anonymous"></script>
@endpush
