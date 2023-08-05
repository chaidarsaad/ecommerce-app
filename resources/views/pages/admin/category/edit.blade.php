@extends('layouts.admin')

@section('title')
    Store Edit Category Page
@endsection

@push('addon-style')
    <link rel="stylesheet" href="/assets/extensions/toastify-js/src/toastify.css" />
@endpush

@section('content')
    <!-- Page Content -->
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Category</h3>
                    <p class="text-subtitle text-muted">Edit Category {{ $item->name }}</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
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

                <form action="{{ route('category.update', $item->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
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
                                    <input name="name" type="text" class="form-control" id="name" required
                                        value="{{ $item->name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="photo">Foto</label>
                                    <input class="form-control" type="file" id="photo" name="photo"
                                        accept="image/*" />
                                    <small>Kosongkan jika tidak ingin mengubah foto</small>
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
    <script src="/assets/extensions/toastify-js/src/toastify.js"></script>
    <script src="/assets/js/pages/toastify.js"></script>
    @if (session('failed-add'))
        <script>
            Toastify({
                text: "Kategori Sudah Ada",
                duration: 7000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: "#FF0000",
            }).showToast();
        </script>
    @endif
@endpush
