@extends('layouts.admin')

@section('title')
    Store Category Page
@endsection

@push('addon-style')
    <link rel="stylesheet" href="/assets/css/pages/fontawesome.css">
    <link rel="stylesheet" href="/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="/assets/css/pages/datatables.css">
    <link rel="stylesheet" href="/assets/extensions/toastify-js/src/toastify.css" />
@endpush

@section('content')
    <!-- Page Content -->
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Category</h3>
                    <p class="text-subtitle text-muted">List all categories</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Categories</li>
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
                        Tambah Kategori Baru
                    </button>
                    <div class="modal fade text-left" id="modalcreate" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel33" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel33">Tambah kategori Baru</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>

                                {{-- modal --}}
                                <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <label>Nama Kategori</label>
                                        <div class="form-group">
                                            <input name="name" type="text" placeholder="Nama Kategori"
                                                class="form-control" required>
                                        </div>
                                        <label>Foto Kategori</label>
                                        <div class="form-group">
                                            <input type="file" name="photo" placeholder="Foto Kategori"
                                                class="form-control" accept="image/*" required>
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
                                <th>Nama</th>
                                <th>Photo</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($categories as $item)
                                <tr>
                                    {{-- <th>{{ $item->id }}</th> --}}
                                    <th>{{ $no++ }}</th>
                                    <th>{{ $item->name }}</th>
                                    <th>
                                        <img src="{{ Storage::url($item->photo) }}" style="max-height: 40px;" />
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

    <script src="/assets/extensions/toastify-js/src/toastify.js"></script>
    <script src="/assets/js/pages/toastify.js"></script>
    @if (session('delete-category'))
        <script>
            Toastify({
                text: "Kategori Berhasil Dihapus",
                duration: 7000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: "#4fbe87",
            }).showToast();
        </script>
    @endif
    @if (session('add-category'))
        <script>
            Toastify({
                text: "Berhasil Menambah Kategori",
                duration: 7000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: "#4fbe87",
            }).showToast();
        </script>
    @endif
    @if (session('update-category'))
        <script>
            Toastify({
                text: "Berhasil Diupdate",
                duration: 7000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: "#4fbe87",
            }).showToast();
        </script>
    @endif
    @if (session('failed-add'))
        <script>
            Toastify({
                text: "Kategori Yang Ditambahkan Sudah Ada",
                duration: 7000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: "#FF0000",
            }).showToast();
        </script>
    @endif
@endpush
