@extends('layouts.admin')

@section('title')
    Store User Page
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
                    <h3>User</h3>
                    <p class="text-subtitle text-muted">List all users</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Users</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($users as $item)
                                <tr>
                                    <th>{{ $no++ }}</th>
                                    <th>{{ $item->name }}</th>
                                    <th>{{ $item->email }}</th>
                                    <th>{{ $item->roles }}</th>
                                    <th>
                                        <div class="btn-group mb-1">
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle me-1" type="button"
                                                    id="action' .  $item->id . '" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    Aksi
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('account.edit', $item->id) }}">
                                                        Sunting
                                                    </a>
                                                    <form action="{{ route('account.destroy', $item->id) }}" method="POST">
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
    @if (session('top-center'))
        <script>
            Toastify({
                text: "Akun Berhasil Dihapus",
                duration: 7000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: "#4fbe87",
            }).showToast();
        </script>
    @endif
    @if (session('top-center-edit'))
        <script>
            Toastify({
                text: "Akun Berhasil Diupdate",
                duration: 7000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: "#4fbe87",
            }).showToast();
        </script>
    @endif
@endpush
