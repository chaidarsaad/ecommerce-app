@extends('layouts.admin')

@section('title')
    Store Add Category Page
@endsection

@push('addon-style')
@endpush

@section('content')
    <!-- Page Content -->
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Category</h3>
                    <p class="text-subtitle text-muted">Add New Category</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add New Category</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary" href="{{ route('category.index') }}">Kembali</a>
                </div>

                <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nama Category</label>
                                    <input name="name" type="text" class="form-control" id="" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="photo">Foto</label>
                                    <input required class="form-control" type="file" id="" name="photo"
                                        accept="image/*" />
                                </div>

                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    <button type="submit" class="btn btn-primary px-5">
                                        Save Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </section>
    </div>
@endsection

@push('addon-script')
@endpush
