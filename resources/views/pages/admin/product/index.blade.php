@extends('layouts.admin')

@section('title')
    Store Product Page
@endsection

@push('addon-style')
    <link rel="stylesheet" href="/assets/css/pages/fontawesome.css">
    <link rel="stylesheet" href="/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="/assets/css/pages/datatables.css">
@endpush

@section('content')
    <!-- Page Content -->
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Produk</h3>
                    <p class="text-subtitle text-muted">List all products</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Products</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalcreate">
                        Tambah Produk Baru
                    </button>

                    {{-- scroll modal --}}
                    <div class="modal fade" id="modalcreate" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Produk Baru</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <label>Nama Produk</label>
                                        <div class="form-group">
                                            <input name="name" type="text" placeholder="Nama Kategori"
                                                class="form-control" required>
                                        </div>

                                        <label>Kategori Produk</label>
                                        <div class="form-group">
                                            <select name="categories_id" class="form-control" required>
                                                <option value="">Pilih Kategori</option>
                                                @foreach ($categories as $categories)
                                                    <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <label>Harga Produk</label>
                                        <div class="form-group">
                                            <input name="price" type="number" placeholder="Harga Produk"
                                                class="form-control" required>
                                        </div>

                                        <label>Deskripsi Produk</label>
                                        <div class="form-group">
                                            <textarea name="description" id="editor" required></textarea>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                            <span class="">Batal</span>
                                        </button>

                                        <button type="submit" class="btn btn-primary ml-1">
                                            <span class="">Simpan</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- end scroll modal --}}

                </div>
                <div class="card-body table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($products as $item)
                                <tr>
                                    <th>{{ $no++ }}</th>
                                    <th>{{ $item->name }}</th>
                                    <th>{{ $item->category->name }}</th>
                                    <th>Rp {{ number_format($item->price) }}</th>
                                    <th>
                                        <div class="btn-group mb-1">
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle me-1" type="button"
                                                    id="action' .  $item->id . '" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    Aksi
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                                                    <a class="dropdown-item" href="{{ route('category.edit', $item->id) }}">
                                                        Sunting
                                                    </a>
                                                    <form action="{{ route('category.destroy', $item->id) }}"
                                                        method="POST">
                                                        {{ method_field('delete') }}
                                                        {{ csrf_field() }}
                                                        <button class="dropdown-item text-danger" type="submit">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- Basic Tables end -->
    </div>
@endsection

@push('addon-script')
    <script src="{{ url('/assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script>
        let jquery_datatable = $("#table1").DataTable();
    </script>

    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor');
    </script>
@endpush
