@extends('layouts.admin')

@section('title')
Banner
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Banner</h2>
            <p class="dashboard-subtitle">
                List of Banner
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('banner.create') }}" class="btn btn-primary mb-3">
                                + Tambah Banner Baru
                            </a>
                            <div class="table-responsive">
                                <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nama Banner</th>
                                            <th>Foto Banner</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
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
<script>
    var datatable = $('#crudTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
            url: '{!! url()->current() !!}',
        },
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'name_banner',
                name: 'name_banner'
            },
            {
                data: 'foto_banner',
                name: 'foto_banner'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searcable: false,
                width: '15%',
            },
        ]
    })
</script>
@endpush
