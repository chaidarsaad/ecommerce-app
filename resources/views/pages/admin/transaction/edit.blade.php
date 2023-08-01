@extends('layouts.admin')

@section('title')
    Store Edit Produk Page
@endsection

@push('addon-style')
@endpush

@section('content')
    <!-- Page Content -->
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Produk</h3>
                    <p class="text-subtitle text-muted">Edit Produk {{ $item->name }}</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Produk</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary" href="{{ route('product.index') }}">Kembali</a>
                </div>

                <form action="{{ route('product.update', $item->id) }}" method="post" enctype="multipart/form-data">
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
                                    <label for="name">Nama Produk</label>
                                    <input name="name" type="text" class="form-control" id="name" required
                                        value="{{ $item->name }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="categories_id ">Kategori Produk</label>
                                    <select name="categories_id" class="form-control" required>
                                        <option value="{{ $item->categories_id }}">{{ $item->category->name }}</option>
                                        <option value="" disabled>Pilih Kategori</option>
                                        @foreach ($categories as $categories)
                                            <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="price">Harga Produk</label>
                                    <input name="price" type="number" class="form-control" id="price" required
                                        value="{{ $item->price }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Nama Category</label>
                                    <textarea name="description" id="editor">{!! $item->description !!}</textarea>
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
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor');
    </script>
@endpush
