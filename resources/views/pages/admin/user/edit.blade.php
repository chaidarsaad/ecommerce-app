@extends('layouts.admin')

@section('title')
    Store Edit Akun Page
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
                    <p class="text-subtitle text-muted">Edit Akun {{ $item->name }}</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Akun</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary" href="{{ route('account.index') }}">Kembali</a>
                </div>

                <form action="{{ route('account.update', $item->id) }}" method="post" enctype="multipart/form-data">
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
                                    <label>Nama User</label>
                                    <input type="text" class="form-control" name="name" value="{{ $item->name }}"
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email User</label>
                                    <input type="text" class="form-control" name="email" value="{{ $item->email }}"
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password User</label>
                                    <input type="text" class="form-control" name="password" />
                                    <small>Kosongkan jika tidak ingin mengganti password</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Roles</label>
                                    <select name="roles" required class="form-control">
                                        <option value="{{ $item->roles }}" selected>Tidak diganti</option>
                                        <option value="ADMIN">Admin</option>
                                        <option value="USER">User</option>
                                    </select>
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
