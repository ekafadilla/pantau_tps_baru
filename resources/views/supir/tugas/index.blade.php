@extends('layouts.supir')

@section('page-title', 'Daftar Tugas')

@section('content')
<div class="container">
    <h2>Daftar Tugas Penanganan</h2>
    <p>Berikut daftar laporan yang ditugaskan kepada Anda.</p>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($tugas->isEmpty())
        <div class="alert alert-info">
            Belum ada tugas penanganan yang ditugaskan kepada Anda.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Lokasi TPS</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Target Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tugas as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $item->tps->nama_tps ?? $item->lokasi ?? '-' }}
                            </td>
                            <td>{{ $item->kategori_kondisi }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $item->status_laporan)) }}</td>
                            <td>
                                {{ $item->target_waktu
                                    ? \Carbon\Carbon::parse($item->target_waktu)->format('d-m-Y H:i')
                                    : '-' }}
                            </td>
                            <td>
                                <a href="{{ route('supir.tugas.show', $item->id) }}"
                                   class="btn btn-sm btn-success">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection