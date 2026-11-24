@extends('components.layout')

@section('content')
@php
@endphp

<h1> Detil Pengadaan #{{ $data->ID_Pengadaan }} </h1>

<a href="{{ route('pengadaan.index') }}"> Back </a>

@if (session('success'))
    <div>{{ session('success') }}</div>
@endif
@include('components.errors')

<table class="info">
    <tr><th>Tanggal</th><td>{{ $data->Tanggal }}</td></tr>
    <tr><th>Vendor</th><td>{{ $data->Vendor }}</td></tr>
    <tr><th>Dibuat oleh</th><td>{{ $data->Dibuat_oleh }}</td></tr>
    <tr><th>Status</th><td>{{ $data->Status }}</td></tr>
    <tr><th>Subtotal</th><td>{{ $data->Subtotal }}</td></tr>
    <tr><th>PPN</th><td>{{ $data->PPN }}</td></tr>
    <tr><th>Total</th><td><strong>{{ $data->Total }}</strong></td></tr>
</table>

<div class="actions">
    @if ($draf)
        <form class="inline" method="POST" action="{{ route('pengadaan.kirim', $data->ID_Pengadaan) }}"
            onsubmit="return confirm('Kirim pengadaan ini? Barang tidak bisa diubah lagi setelah dikirim.')">
            @csrf
            <button type="submit" class="primary" @disabled(empty($items))> Kirim Pesanan </button>
        </form>
    @endif
    @if ($bisaBatal)
        <form class="inline" method="POST" action="{{ route('pengadaan.destroy', $data->ID_Pengadaan) }}"
            onsubmit="return confirm('Batalkan pengadaan #{{ $data->ID_Pengadaan }}?')">
            @csrf
            @method('DELETE')
            <button type="submit"> Batalkan </button>
        </form>
    @endif
    @if ($draf && empty($items))
        <p class="hint"> Tambahkan minimal 1 barang sebelum mengirim pesanan. </p>
    @endif
</div>

<h2> Barang </h2>
<table>
    <thead>
        <tr>
            <th>Barang</th>
            <th>Harga Satuan</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
            @if ($draf) <th>Action</th> @endif
        </tr>
    </thead>
    <tbody>
    @forelse ($items as $i)
        <tr>
            <td> {{ $i->barang }} </td>
            @if ($draf)
                <td> <input class="row-input" form="item-{{ $i->iddetil_pengadaan }}" type="number" min="1" name="harga_satuan" value="{{ $i->harga_satuan }}" required> </td>
                <td> <input class="row-input" form="item-{{ $i->iddetil_pengadaan }}" type="number" min="1" name="jumlah" value="{{ $i->jumlah }}" required> </td>
            @else
                <td> {{ $i->harga_format }} </td>
                <td> {{ $i->jumlah }} </td>
            @endif
            <td> {{ $i->subtotal_format }} </td>
            @if ($draf)
                <td>
                    <form class="inline" id="item-{{ $i->iddetil_pengadaan }}" method="POST"
                        action="{{ route('pengadaan.items.update', [$data->ID_Pengadaan, $i->iddetil_pengadaan]) }}">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="primary"> Simpan </button>
                    </form>
                    <form class="inline" method="POST"
                        action="{{ route('pengadaan.items.destroy', [$data->ID_Pengadaan, $i->iddetil_pengadaan]) }}"
                        onsubmit="return confirm({{ Js::from('Hapus ' . $i->barang . ' dari pengadaan?') }})">
                        @csrf
                        @method('DELETE')
                        <button type="submit"> Hapus </button>
                    </form>
                </td>
            @endif
        </tr>
    @empty
        <tr>
            <td colspan="{{ $draf ? 5 : 4 }}" class="no-data"> Belum ada barang. </td>
        </tr>
    @endforelse
    </tbody>
</table>

@if ($draf)
    <h2> Tambah Barang </h2>
    @if (empty($barang))
        <p class="hint"> Semua barang sudah ada di pengadaan ini. </p>
    @else
        <form method="POST" action="{{ route('pengadaan.items.store', $data->ID_Pengadaan) }}">
            @csrf

            <label> Barang </label>
            <select name="idbarang" id="pilih-barang" required>
                <option value="" disabled @selected(old('idbarang') === null)> Pilih Barang </option>
                @foreach ($barang as $b)
                    <option value="{{ $b->idbarang }}" data-harga="{{ $b->harga }}"
                        @selected((string) old('idbarang') === (string) $b->idbarang)> {{ $b->nama }} </option>
                @endforeach
            </select>

            <label> Harga Satuan </label>
            <input type="number" min="1" name="harga_satuan" id="harga-satuan" value="{{ old('harga_satuan') }}" required>

            <label> Jumlah </label>
            <input type="number" min="1" name="jumlah" value="{{ old('jumlah') }}" required>

            <button type="submit"> Tambah </button>
        </form>

        <script>
            const pilih = document.getElementById('pilih-barang');
            const harga = document.getElementById('harga-satuan');
            function isiPlaceholder() {
                const opsi = pilih.options[pilih.selectedIndex];
                harga.placeholder = opsi && opsi.dataset.harga ? 'Harga katalog: ' + opsi.dataset.harga : '';
            }
            pilih.addEventListener('change', isiPlaceholder);
            isiPlaceholder();
        </script>
    @endif
@endif
@endsection
