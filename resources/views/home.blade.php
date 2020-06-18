@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        @if($checkIfCourir == 0)
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Alamatku <a class="btn btn-primary float-right"
                        href="{{ url('address') }}">Tambah</a></div>
                <ul class="list-group">
                    @if($addresses->isNotEmpty())
                    @foreach($addresses as $address)
                    <form id="logout-form-{{ $address->id }}" action="{{ url('address/delete/' . $address->id) }}"
                        method="POST" style="display: none;">
                        @csrf
                    </form>
                    <li class="list-group-item">
                        {{ $address->address }}
                        <div class="row mt-3">
                            <div class="col-6">
                                <a class="btn btn-warning btn-sm w-100" href="{{ url('address/' . $address->id) }}"><i
                                        class="fas fa-pencil-alt"></i></a>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-danger btn-sm w-100"
                                    onclick="event.preventDefault(); document.getElementById('logout-form-{{ $address->id }}').submit();"><i
                                        class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </li>
                    @endforeach
                    @else
                    <ul class="list-group">
                        <li class="list-group-item">Belum ada data</li>
                    </ul>
                    @endif
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Belanja</div>

                <div class="card-body">
                    <a class="btn btn-primary" href="{{ url('belanja') }}">Mulai berbelanja</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Pesananku</div>

                <div class="card-body">
                    <ul class="list-group">
                        @if($orders->isEmpty())
                        <li class="list-group-item">Belum ada pesanan</li>
                        @else
                        @foreach($orders as $order)
                        <li class="list-group-item">
                            <b>Produk:</b> {{ $order->product->nama }}<br>
                            <b>Pengirim:</b> {{ $order->courir->user->name }}<br>
                            <b>Alamat:</b> {{ $order->address->address ?? "Halaman dihapus" }}
                            @if($order->address)
                            <a href="{{ url('transaksi/' . $order->id) }}" class="btn-block btn btn-sm btn-primary"><i
                                    class="fas fa-search mr-1"></i> Detail</a>
                            @else
                            <button class="btn-block btn btn-sm btn-primary" disabled><i
                                class="fas fa-search mr-1"></i> Detail</button>
                            @endif
                        </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        @else
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Pesanan user</div>

                <div class="card-body">
                    <ul class="list-group">
                        @if($orderCourir->isEmpty())
                        <li class="list-group-item">Belum ada pesanan</li>
                        @else
                        @foreach($orderCourir as $order)
                        <li class="list-group-item">
                            <b>Produk:</b> {{ $order->product->nama }}<br>
                            <b>Pelanggan:</b> {{ $order->user->name }}<br>
                            <b>Alamat:</b> {{ $order->address->address ?? 'Alamat dihapus' }}
                            @if($order->address)
                            <a href="{{ url('transaksi/' . $order->id) }}" class="btn-block btn btn-sm btn-primary"><i
                                    class="fas fa-search mr-1"></i> Detail</a>
                            @else
                            <button class="btn-block btn btn-sm btn-primary" disabled><i
                                class="fas fa-search mr-1"></i> Detail</button>
                            @endif
                        </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
