@extends('layouts.template')
@section('content')
<title>Data Transaksi | WiLet</title>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pemasangan Baru</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if( Session::get('masuk') !="")
            <div class='alert alert-success'><center><b>{{Session::get('masuk')}}</b></center></div>
            @endif
            @if( Session::get('update') !="")
            <div class='alert alert-success'><center><b>{{Session::get('update')}}</b></center></div>
            @endif
            <a href="/transaksi/tambah" class="btn btn-success">Tambah Data</a>
            <br>
            <br>
            <table id="dataTable" class="table table-bordered" cellspacing="0">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Outlet</th>
                        <th rowspan="2">Nama Pelanggan</th>
                        <th rowspan="2">Tanggal</th>
                        <th rowspan="2">Internet</th>
                        <th rowspan="2">Bayar</th>
                        <th colspan="2" class="text-center">Status Pemasangan & Pembayaran</th>
                        <th rowspan="2">View</th>
                    </tr>
                    <tr>
                        <th>Status Pemasangan</th>
                        <th>Status Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $i => $u)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$u->nama_outlet}}</td>
                        <td>{{$u->nama_member}}</td>
                        <td>{{$u->tgl_transaksi}}</td>
                        <td>{{$u->status_pemasangan}}</td>
                        @if($u->status_bayar == 'belum_dibayar')
                        <td>Belum Dibayar</td>
                        @else
                        <td>Lunas</td>
                        @endif
                        @if($u->status_pemasangan == 'baru')
                        <td><a href="/transaksi/pakaian1/{{ $u->id_transaksi}}" class="btn btn-warning btn-sm">Proses</a></td>
                        @elseif($u->status_pemasangan =='proses')
                        <td><a href="/transaksi/pakaian2/{{ $u->id_transaksi}}" class="btn btn-warning btn-sm">Selesai</a></td>
                        @elseif($u->status_pemasangan =='selesai')
                        <td><a href="/transaksi/pakaian3/{{ $u->id_transaksi}}" class="btn btn-warning btn-sm">Terhubung</a></td>
                        @else
                        <td> Terhubung</td>
                        @endif

                        @if($u->status_bayar == 'belum_dibayar')
                        <td><a href="/transaksi/bayar1/{{ $u->id_transaksi}}" class="btn btn-warning btn-sm">Lunas</a></td>
                        @else
                        <td> Lunas</td>
                        @endif
                        <td><a href="/transaksi/show/{{ $u->id_transaksi}}" class="btn btn-success btn-sm">Detail</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
