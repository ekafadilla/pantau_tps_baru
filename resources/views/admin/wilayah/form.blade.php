@extends('layouts.admin')

@section('title', isset($wilayah) ? 'Edit Wilayah' : 'Tambah Wilayah')
@section('page-title', 'Data Wilayah')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.wilayah.index') }}"
           class="text-decoration-none text-success">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Data Wilayah
        </a>
        <h2 class="fw-bold mt-3 mb-1" style="font-size:23px">
            {{ isset($wilayah) ? 'Edit Wilayah' : 'Tambah Wilayah' }}
        </h2>
        <p class="text-secondary mb-0">
            {{ isset($wilayah) ? 'Perbarui informasi wilayah.' : 'Masukkan informasi wilayah baru.' }}
        </p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Data belum dapat disimpan.</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="panel">
        <div class="panel-heading">
            Informasi Wilayah
        </div>

        <form
            action="{{ isset($wilayah) ? route('admin.wilayah.update', $wilayah->id) : route('admin.wilayah.store') }}"
            method="POST"
        >
            @csrf

            @if (isset($wilayah))
                @method('PUT')
            @endif

            <div class="p-4">
                <div class="mb-3">
                    <label for="nama_wilayah" class="form-label fw-semibold">
                        Nama Wilayah <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        id="nama_wilayah"
                        name="nama_wilayah"
                        class="form-control @error('nama_wilayah') is-invalid @enderror"
                        value="{{ old('nama_wilayah', $wilayah->nama_wilayah ?? '') }}"
                        placeholder="Contoh: UPTD Indramayu"
                        maxlength="100"
                        required
                    >

                    @error('nama_wilayah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="keterangan" class="form-label fw-semibold">
                        Keterangan
                    </label>

                    <textarea
                        id="keterangan"
                        name="keterangan"
                        class="form-control @error('keterangan') is-invalid @enderror"
                        rows="4"
                        placeholder="Masukkan keterangan wilayah jika diperlukan"
                    >{{ old('keterangan', $wilayah->keterangan ?? '') }}</textarea>

                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="form-text">
                        Keterangan bersifat opsional.
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.wilayah.index') }}"
                       class="btn btn-outline-secondary">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ isset($wilayah) ? 'Simpan Perubahan' : 'Simpan Wilayah' }}
                    </button>
                </div>
            </div>
        </form>
    </section>
@endsection