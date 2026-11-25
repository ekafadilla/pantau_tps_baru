@extends('layouts.admin')

@section('title', isset($tps) ? 'Edit Data TPS' : 'Tambah Data TPS')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">{{ isset($tps) ? 'Edit Data TPS' : 'Tambah Data TPS' }}</h2>
            <p class="text-muted mb-0">Lengkapi informasi tempat pembuangan sampah.</p>
        </div>
        <a href="{{ route('admin.tps.index') }}" class="btn btn-outline-secondary">
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
                action="{{ isset($tps) ? route('admin.tps.update', $tps->id) : route('admin.tps.store') }}"
                method="POST"
            >
                @csrf

                @if (isset($tps))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="id_wilayah" class="form-label">Wilayah UPTD</label>
                    <select name="id_wilayah" id="id_wilayah"
                        class="form-select @error('id_wilayah') is-invalid @enderror" required>
                        <option value="">-- Pilih Wilayah --</option>
                        @foreach ($wilayah as $item)
                            <option value="{{ $item->id }}"
                                @selected(old('id_wilayah', $tps->id_wilayah ?? '') == $item->id)>
                                {{ $item->nama_wilayah }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_wilayah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_tps" class="form-label">Nama TPS</label>
                    <input type="text" name="nama_tps" id="nama_tps"
                        class="form-control @error('nama_tps') is-invalid @enderror"
                        value="{{ old('nama_tps', $tps->nama_tps ?? '') }}"
                        placeholder="Masukkan nama TPS" required>
                    @error('nama_tps')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat TPS</label>
                    <textarea name="alamat" id="alamat" rows="3"
                        class="form-control @error('alamat') is-invalid @enderror"
                        placeholder="Masukkan alamat lengkap TPS" required>{{ old('alamat', $tps->alamat ?? '') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="latitude" class="form-label">Latitude (opsional)</label>
                        <input type="number" step="any" name="latitude" id="latitude"
                            class="form-control @error('latitude') is-invalid @enderror"
                            value="{{ old('latitude', $tps->latitude ?? '') }}"
                            placeholder="Contoh: -6.3265">
                        @error('latitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="longitude" class="form-label">Longitude (opsional)</label>
                        <input type="number" step="any" name="longitude" id="longitude"
                            class="form-control @error('longitude') is-invalid @enderror"
                            value="{{ old('longitude', $tps->longitude ?? '') }}"
                            placeholder="Contoh: 108.3200">
                        @error('longitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="keterangan" class="form-label">Keterangan (opsional)</label>
                    <textarea name="keterangan" id="keterangan" rows="3"
                        class="form-control @error('keterangan') is-invalid @enderror"
                        placeholder="Tambahkan keterangan jika diperlukan">{{ old('keterangan', $tps->keterangan ?? '') }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        {{ isset($tps) ? 'Simpan Perubahan' : 'Tambah Data TPS' }}
                    </button>
                    <a href="{{ route('admin.tps.index') }}" class="btn btn-light border">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection