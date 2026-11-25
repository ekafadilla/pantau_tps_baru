@extends('layouts.supir')

@section('title', 'Status Kehadiran Supir')
@section('page-title', 'Status Kehadiran')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold mb-1">Status Kehadiran</h2>
        <p class="text-muted mb-0">
            Perbarui kondisi kehadiran agar UPTD mengetahui kesiapan Anda menerima tugas.
        </p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($adaTugasAktif)
        <div class="alert alert-info">
            <strong>Anda sedang memiliki tugas aktif.</strong>
            Status penugasan Anda akan tetap ditampilkan sebagai sedang bertugas oleh UPTD.
            Anda belum dapat mengubah status kehadiran menjadi tersedia sampai tugas selesai.
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <div class="mb-4">
                <div class="text-muted small">Status saat ini</div>
                <span class="badge bg-success fs-6 mt-1">
                    {{ ucfirst(str_replace('_', ' ', $supir->status_kehadiran ?? 'tidak diketahui')) }}
                </span>

                @if($supir->keterangan_kehadiran)
                    <p class="text-muted mt-2 mb-0">
                        Keterangan saat ini: {{ $supir->keterangan_kehadiran }}
                    </p>
                @endif
            </div>

            <hr>

            <form method="POST" action="{{ route('supir.kehadiran.update') }}">
                @csrf

                <div class="mb-3">
                    <label for="status_kehadiran" class="form-label fw-semibold">
                        Pilih Status Kehadiran
                    </label>

                    <select
                        name="status_kehadiran"
                        id="status_kehadiran"
                        class="form-select @error('status_kehadiran') is-invalid @enderror"
                        required
                    >
                        <option value="tersedia" @selected(old('status_kehadiran', $supir->status_kehadiran) === 'tersedia')>
                            Tersedia
                        </option>
                        <option value="izin" @selected(old('status_kehadiran', $supir->status_kehadiran) === 'izin')>
                            Izin
                        </option>
                        <option value="sakit" @selected(old('status_kehadiran', $supir->status_kehadiran) === 'sakit')>
                            Sakit
                        </option>
                        <option value="cuti" @selected(old('status_kehadiran', $supir->status_kehadiran) === 'cuti')>
                            Cuti
                        </option>
                        <option value="tidak_masuk" @selected(old('status_kehadiran', $supir->status_kehadiran) === 'tidak_masuk')>
                            Tidak Masuk
                        </option>
                    </select>

                    @error('status_kehadiran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="keterangan_kehadiran" class="form-label fw-semibold">
                        Keterangan
                    </label>

                    <textarea
                        name="keterangan_kehadiran"
                        id="keterangan_kehadiran"
                        rows="3"
                        maxlength="500"
                        class="form-control @error('keterangan_kehadiran') is-invalid @enderror"
                        placeholder="Contoh: izin keperluan keluarga atau sedang sakit."
                    >{{ old('keterangan_kehadiran', $supir->keterangan_kehadiran) }}</textarea>

                    <div class="form-text">
                        Wajib diisi jika memilih izin, sakit, cuti, atau tidak masuk.
                        Maksimal 500 karakter.
                    </div>

                    @error('keterangan_kehadiran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle me-1"></i>
                    Simpan Status Kehadiran
                </button>
            </form>
        </div>
    </div>
</div>
@endsection