@extends('layouts.admin')

@section('title')
    Store Category Page
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
                    <h3>Foto Produk</h3>
                    <p class="text-subtitle text-muted">List all Foto Produk</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Produk Galeri</li>
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
                        Tambah Foto Produk Baru
                    </button>
                    <div class="modal fade text-left" id="modalcreate" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel33" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel33">Tambah Produk Galeri Baru</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>

                                {{-- modal --}}
                                <form action="{{ route('gallery.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <label>Produk</label>
                                        <div class="form-group">
                                            <select name="products_id" class="form-control" required>
                                                <option value="">Pilih Produk</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label>Foto Produk</label>
                                        <div class="form-group">
                                            <input type="file" name="photos" placeholder="Foto Produk"
                                                class="form-control" accept="image/*" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                            <span class="">Batal</span>
                                        </button>
                                        <button id="top-center" type="submit" class="btn btn-primary ml-1">
                                            <span class="">Simpan</span>
                                        </button>
                                    </div>
                                </form>
                                {{-- end modal --}}

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($galleries as $item)
                                <tr>
                                    <th>{{ $no++ }}</th>
                                    <th>{{ $item->product->name }}</th>
                                    <th>
                                        <img src="{{ Storage::url($item->photos) }}" style="max-height: 80px;" />
                                    </th>
                                    <th>
                                        <div class="btn-group mb-1">
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle me-1" type="button"
                                                    id="action' .  $item->id . '" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    Aksi
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                                                    <form action="{{ route('gallery.destroy', $item->id) }}" method="POST">
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
                    <div class="col-12 col-md-4">
                        <button
                            id="top-center"
                            class="btn btn-outline-primary btn-block btn-lg"
                        >
                            Top Center
                        </button>
                    </div>
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
@endpush
