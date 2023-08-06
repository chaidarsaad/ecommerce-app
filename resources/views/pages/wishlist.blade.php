@extends('layouts.app')

@section('title')
    Store Wishlist Page
@endsection

@section('content')
    <!-- Page Content -->
    <div class="page-content page-cart">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Favorit
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="store-cart">
            <div class="container">
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-12 table-responsive">
                        <table class="table table-borderless table-cart" aria-describedby="Cart">
                            <thead>
                                <tr>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Nama &amp; Harga</th>
                                    <th scope="col">Keranjang</th>
                                    <th scope="col">Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $totalPrice = 0 @endphp
                                @forelse ($wishlist as $wishlists)
                                    <tr>
                                        <td style="width: 20%;">
                                            @if ($wishlists->product->galleries->count())
                                                <img src="{{ Storage::url($wishlists->product->galleries->first()->photos) }}"
                                                    alt="" class="cart-image" />
                                            @endif
                                        </td>
                                        <td style="width: 35%;">
                                            <div class="product-title">{{ $wishlists->product->name }}</div>
                                            <div class="product-subtitle">Rp {{ number_format($wishlists->product->price) }}
                                            </div>
                                        </td>
                                        <td style="width: 35%;">
                                            <form action="{{ route('wishlist-cart', $wishlists->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-add-cart" type="submit">
                                                    Tambah
                                                </button>
                                            </form>
                                        </td>
                                        <td style="width: 20%;">
                                            <form action="{{ route('wishlist-delete', $wishlists->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-remove-cart" type="submit">
                                                    Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php $totalPrice += $wishlists->product->price @endphp
                                @empty
                                    <tr>
                                        <td>
                                            <h6 style="" class="">Favorit Kosong</h6>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('suksesdel'))
        <script>
            Swal.fire(
                'Produk Berhasil dihapus',
                '',
                'success'
            )
        </script>
    @endif

    @if (session('suksesadd'))
        <script>
            Swal.fire(
                'Produk Berhasil ditambahkan ke favorit',
                '',
                'success'
            )
        </script>
    @endif
@endpush
