@extends(auth()->user()->role === 'admin' ? 'layouts.admin' : 'layouts.uptd')

@section('title', isset($armada->id) ? 'Edit Armada' : 'Tambah Armada')
@section('page-title', isset($armada->id) ? 'Edit Armada' : 'Tambah Armada')

@section('content')
@php
    $prefix = auth()->user()->role;
    $isEdit = isset($armada->id);

    $daftarStatus = [
        'tersedia' => 'Tersedia',
        'rusak' => 'Rusak',
        'perbaikan' => 'Dalam Perbaikan',
        'nonaktif' => 'Nonaktif',
    ];
@endphp

<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $isEdit ? 'Edit Data Armada' : 'Tambah Armada' }}</h4>
            <p class="text-muted mb-0">Lengkapi informasi kendaraan operasional.</p>
        </div>

        <a href="{{ route($prefix . '.armada.index') }}" class="btn btn-outline-secondary">
            Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Periksa kembali data yang dimasukkan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form
                action="{{ $isEdit
                    ? route($prefix . '.armada.update', $armada->id)
                    : route($prefix . '.armada.store') }}"
                method="POST">

                @csrf

                @if ($isEdit)
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="id_wilayah" class="form-label">Wilayah Kerja</label>

                    @if ($prefix === 'uptd')
                        <input type="hidden" name="id_wilayah"
                            value="{{ auth()->user()->id_wilayah }}">

                        <input type="text" class="form-control"
                            value="{{ $wilayah->first()->nama_wilayah ?? '-' }}"
                            readonly>
                    @else
                        <select name="id_wilayah" id="id_wilayah"
                            class="form-select @error('id_wilayah') is-invalid @enderror"
                            required>
                            <option value="">-- Pilih Wilayah --</option>
                            @foreach ($wilayah as $itemWilayah)
                                <option value="{{ $itemWilayah->id }}"
                                    @selected(old('id_wilayah', $armada->id_wilayah ?? '') == $itemWilayah->id)>
                                    {{ $itemWilayah->nama_wilayah }}
                                </option>
                            @endforeach
                        </select>
                    @endif

                    @error('id_wilayah')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kode_armada" class="form-label">Kode Armada</label>
                    <input type="text" name="kode_armada" id="kode_armada"
                        class="form-control @error('kode_armada') is-invalid @enderror"
                        value="{{ old('kode_armada', $armada->kode_armada ?? '') }}"
                        placeholder="Contoh: ARM-001" required>
                    @error('kode_armada')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="jenis_armada" class="form-label">Jenis Armada</label>
                        <input type="text" name="jenis_armada" id="jenis_armada"
                            class="form-control @error('jenis_armada') is-invalid @enderror"
                            value="{{ old('jenis_armada', $armada->jenis_armada ?? '') }}"
                            placeholder="Contoh: Truk pengangkut sampah">
                        @error('jenis_armada')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="nomor_polisi" class="form-label">Nomor Polisi</label>
                        <input type="text" name="nomor_polisi" id="nomor_polisi"
                            class="form-control @error('nomor_polisi') is-invalid @enderror"
                            value="{{ old('nomor_polisi', $armada->nomor_polisi ?? '') }}"
                            placeholder="Contoh: E 1234 XX">
                        @error('nomor_polisi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="status_armada" class="form-label">Status Armada</label>
                    <select name="status_armada" id="status_armada"
                        class="form-select @error('status_armada') is-invalid @enderror"
                        required>
                        @foreach ($daftarStatus as $nilai => $label)
                            <option value="{{ $nilai }}"
                                @selected(old('status_armada', $armada->status_armada ?? 'tersedia') === $nilai)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('status_armada')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="form-text">
                        Status "Sedang Digunakan" akan diatur otomatis ketika armada mendapat penugasan aktif.
                    </div>
                </div>

                <div class="mb-4">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="3"
                        class="form-control @error('keterangan') is-invalid @enderror"
                        placeholder="Catatan kondisi atau informasi tambahan">{{ old('keterangan', $armada->keterangan ?? '') }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        {{ $isEdit ? 'Simpan Perubahan' : 'Tambah Armada' }}
                    </button>

                    <a href="{{ route($prefix . '.armada.index') }}"
                        class="btn btn-light border">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection