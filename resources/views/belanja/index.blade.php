@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Mulai belanja</div>

                <div class="card-body">
                    Silahkan berbelanja di toko kami
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($data as $produk)
        <div class="col-md-3 mt-5">
            <div class="card">
                <div class="card-header"><b>{{ $produk->nama }}</b></div>

                <div class="card-body text-center">
                    <button class="btn btn-success btn-beli" data-id="{{ $produk->id }}"
                        data-nama="{{ $produk->nama }}">Beli produk</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="modal fade" id="modalProduk" tabindex="-1" role="dialog" aria-labelledby="modalProdukLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalProdukLabel">Beli produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('transaksi/add') }}" method="post" id="transaksiForm">
                    @csrf
                    <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="product">Nama produk</label>
                        <input type="text" name="product" id="product" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address_id">Pilih Alamat</label>
                        <select name="address_id" id="address_id" class="custom-select">
                            <option>Pilih alamat</option>
                            @foreach($address as $addr)
                            <option value="{{ $addr->id }}">{{ $addr->address }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="courir_id">Pilih Kurirs</label>
                        <select name="courir_id" id="courir_id" class="custom-select">
                            <option>Pilih Kurir</option>
                            @foreach($courirs as $kurir)
                            <option value="{{ $kurir->id }}">{{ $kurir->user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="transaksiForm" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $('.btn-beli').on('click', function () {
        var id = $(this).data('id');
        var nama = $(this).data('nama');

        $('#product_id').val(id);
        $('#product').val(nama);
        $('#modalProduk').modal('show');
    });

</script>
@endpush
