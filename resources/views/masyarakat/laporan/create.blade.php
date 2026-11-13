
@extends('layouts.masyarakat')

@section('header', 'Buat Laporan')

@section('content')
<div class="page-heading">
    <div>
        <h1 class="page-title">Buat Laporan</h1>
        <p class="page-description">
            Laporkan kondisi TPS atau permasalahan sampah di lingkungan Anda.
        </p>
    </div>

    <a href="{{ route('masyarakat.laporan.index') }}" class="btn-app-outline">
        Kembali
    </a>
</div>

@if ($errors->any())
    <div class="form-alert form-alert-error">
        <strong>Laporan belum dapat dikirim.</strong>
        <p>Periksa kembali isian berikut:</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="form-alert form-alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="report-layout">
    <div class="app-panel report-form-panel">
        <div class="app-panel-header">
            <div>
                <h3 class="app-panel-title">Formulir Pengaduan</h3>
                <p class="panel-description">
                    Lengkapi informasi agar laporan dapat ditindaklanjuti.
                </p>
            </div>
        </div>

        <form action="{{ route('masyarakat.laporan.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="report-form">
            @csrf

            <div class="form-section">
                <h4 class="form-section-title">Informasi Laporan</h4>
                <p class="form-section-description">
                    Isi informasi dasar mengenai kondisi yang ditemukan.
                </p>

                <div class="form-group">
                    <label for="id_tps">
                        Pilih TPS <span class="required-mark">*</span>
                    </label>

                    <select name="id_tps" id="id_tps" required>
                        <option value="">-- Pilih TPS --</option>

                        @foreach ($tps as $item)
                            <option value="{{ $item->id_tps ?? $item->id }}"
                                @selected(old('id_tps') == ($item->id_tps ?? $item->id))>
                                {{ $item->nama_tps }}
                            </option>
                        @endforeach
                    </select>

                    @error('id_tps')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kategori_kondisi">
                        Kategori Kondisi <span class="required-mark">*</span>
                    </label>

                    <select name="kategori_kondisi"
                            id="kategori_kondisi"
                            required>
                        <option value="">-- Pilih Kategori --</option>

                        <option value="sampah_menumpuk"
                            @selected(old('kategori_kondisi') === 'sampah_menumpuk')>
                            Sampah Menumpuk
                        </option>

                        <option value="tps_penuh"
                            @selected(old('kategori_kondisi') === 'tps_penuh')>
                            TPS Penuh
                        </option>

                        <option value="sampah_berserakan"
                            @selected(old('kategori_kondisi') === 'sampah_berserakan')>
                            Sampah Berserakan
                        </option>

                        <option value="lainnya"
                            @selected(old('kategori_kondisi') === 'lainnya')>
                            Lainnya
                        </option>
                    </select>

                    @error('kategori_kondisi')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="lokasi">
                        Alamat atau Lokasi Kejadian
                        <span class="required-mark">*</span>
                    </label>

                    <textarea
                        name="lokasi"
                        id="lokasi"
                        rows="3"
                        placeholder="Tuliskan alamat atau lokasi yang mudah ditemukan..."
                        required>{{ old('lokasi') }}</textarea>

                    @error('lokasi')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="keterangan">
                        Deskripsi Laporan <span class="required-mark">*</span>
                    </label>

                    <textarea
                        name="keterangan"
                        id="keterangan"
                        rows="5"
                        placeholder="Jelaskan kondisi sampah yang ditemukan..."
                        required>{{ old('keterangan') }}</textarea>

                    <small class="field-hint">
                        Jelaskan kondisi yang ditemukan secara jelas dan sesuai fakta.
                    </small>

                    @error('keterangan')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-section">
                <h4 class="form-section-title">Penilaian Awal Kondisi TPS</h4>
                <p class="form-section-description">
                    Pilih kondisi yang paling sesuai dengan keadaan TPS saat Anda membuat laporan.
                    Penilaian ini digunakan sistem untuk memberikan rekomendasi tingkat urgensi awal.
                </p>

                <div class="form-group">
                    <label for="kepenuhan_tps">1. Tingkat Kepenuhan TPS <span class="required-mark">*</span></label>
                    <select name="kepenuhan_tps" id="kepenuhan_tps" required>
                        <option value="">-- Pilih kondisi --</option>
                        <option value="1" @selected(old('kepenuhan_tps') == '1')>1 - Masih banyak ruang kosong</option>
                        <option value="2" @selected(old('kepenuhan_tps') == '2')>2 - Mulai terisi</option>
                        <option value="3" @selected(old('kepenuhan_tps') == '3')>3 - Hampir penuh</option>
                        <option value="4" @selected(old('kepenuhan_tps') == '4')>4 - Penuh atau melebihi kapasitas</option>
                    </select>
                    @error('kepenuhan_tps')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sampah_meluber">2. Kondisi Sampah Meluber <span class="required-mark">*</span></label>
                    <select name="sampah_meluber" id="sampah_meluber" required>
                        <option value="">-- Pilih kondisi --</option>
                        <option value="1" @selected(old('sampah_meluber') == '1')>1 - Tidak ada sampah di luar TPS</option>
                        <option value="2" @selected(old('sampah_meluber') == '2')>2 - Sedikit sampah di sekitar TPS</option>
                        <option value="3" @selected(old('sampah_meluber') == '3')>3 - Cukup banyak sampah di luar TPS</option>
                        <option value="4" @selected(old('sampah_meluber') == '4')>4 - Sampah meluber secara luas</option>
                    </select>
                    @error('sampah_meluber')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="dampak_lingkungan">3. Dampak terhadap Lingkungan <span class="required-mark">*</span></label>
                    <select name="dampak_lingkungan" id="dampak_lingkungan" required>
                        <option value="">-- Pilih kondisi --</option>
                        <option value="1" @selected(old('dampak_lingkungan') == '1')>1 - Belum terlihat dampak lingkungan</option>
                        <option value="2" @selected(old('dampak_lingkungan') == '2')>2 - Mulai mengganggu lingkungan sekitar</option>
                        <option value="3" @selected(old('dampak_lingkungan') == '3')>3 - Mengganggu saluran air atau akses sekitar</option>
                        <option value="4" @selected(old('dampak_lingkungan') == '4')>4 - Menimbulkan dampak lingkungan serius</option>
                    </select>
                    @error('dampak_lingkungan')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="bau_hama">4. Bau Tidak Sedap dan Hama <span class="required-mark">*</span></label>
                    <select name="bau_hama" id="bau_hama" required>
                        <option value="">-- Pilih kondisi --</option>
                        <option value="1" @selected(old('bau_hama') == '1')>1 - Tidak ada bau atau hama</option>
                        <option value="2" @selected(old('bau_hama') == '2')>2 - Bau ringan atau sedikit hama</option>
                        <option value="3" @selected(old('bau_hama') == '3')>3 - Bau cukup menyengat atau terdapat hama</option>
                        <option value="4" @selected(old('bau_hama') == '4')>4 - Bau sangat menyengat atau banyak hama</option>
                    </select>
                    @error('bau_hama')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="gangguan_masyarakat">5. Gangguan terhadap Aktivitas Masyarakat <span class="required-mark">*</span></label>
                    <select name="gangguan_masyarakat" id="gangguan_masyarakat" required>
                        <option value="">-- Pilih kondisi --</option>
                        <option value="1" @selected(old('gangguan_masyarakat') == '1')>1 - Tidak mengganggu aktivitas</option>
                        <option value="2" @selected(old('gangguan_masyarakat') == '2')>2 - Sedikit mengganggu aktivitas</option>
                        <option value="3" @selected(old('gangguan_masyarakat') == '3')>3 - Mengganggu aktivitas masyarakat</option>
                        <option value="4" @selected(old('gangguan_masyarakat') == '4')>4 - Sangat mengganggu aktivitas masyarakat</option>
                    </select>
                    @error('gangguan_masyarakat')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <small class="field-hint">
                    Keterangan: semakin tinggi angka yang dipilih, semakin berat kondisi yang dilaporkan.
                    Pilih berdasarkan keadaan yang benar-benar terlihat.
                </small>
            </div>
            <div class="form-section">
                <h4 class="form-section-title">Foto Pendukung</h4>
                <p class="form-section-description">
                    Tambahkan foto sebagai bukti kondisi di lokasi.
                </p>

                <div class="form-group">
                    <label for="foto">
                        Unggah Foto <span class="required-mark">*</span>
                    </label>

                    <div class="upload-box">
                        <div class="upload-icon">+</div>

                        <strong>Pilih foto dari perangkat</strong>

                        <p>
                            Format gambar JPG, JPEG, atau PNG.
                        </p>

                        <input
                            type="file"
                            name="foto[]"
                            id="foto"
                            accept="image/jpeg,image/png,image/jpg"
                            multiple
                            required
                        >

                        <small class="field-hint">
                            Anda dapat memilih lebih dari satu foto jika diperlukan.
                        </small>
                    </div>

                    <div id="preview-foto" class="preview-foto"></div>

                    @error('foto')
                        <small class="field-error">{{ $message }}</small>
                    @enderror

                    @error('foto.*')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-note">
                <strong>Perhatian</strong>
                <p>
                    Pastikan informasi yang dimasukkan benar. Setelah dikirim,
                    laporan akan menunggu proses pemeriksaan oleh petugas.
                </p>
            </div>

            <div class="form-footer">
                <a href="{{ route('masyarakat.laporan.index') }}"
                   class="btn-app-outline">
                    Batal
                </a>

                <button type="submit" class="btn-app-primary">
                    Kirim Laporan
                </button>
            </div>
        </form>
    </div>

    <aside class="app-panel instruction-panel">
        <div class="app-panel-header">
            <h3 class="app-panel-title">Panduan Pelaporan</h3>
        </div>

        <div class="instruction-list">
            <div class="instruction-item">
                <div class="instruction-number">1</div>
                <div>
                    <strong>Pilih TPS</strong>
                    <p>Pilih TPS yang berkaitan dengan lokasi kejadian.</p>
                </div>
            </div>

            <div class="instruction-item">
                <div class="instruction-number">2</div>
                <div>
                    <strong>Isi informasi</strong>
                    <p>Jelaskan lokasi dan kondisi sampah dengan jelas.</p>
                </div>
            </div>

            <div class="instruction-item">
                <div class="instruction-number">3</div>
                <div>
                    <strong>Tambahkan foto</strong>
                    <p>Gunakan foto yang sesuai dengan kondisi sebenarnya.</p>
                </div>
            </div>

            <div class="instruction-item">
                <div class="instruction-number">4</div>
                <div>
                    <strong>Kirim laporan</strong>
                    <p>Pantau perkembangan laporan melalui menu Laporan Saya.</p>
                </div>
            </div>
        </div>
    </aside>
</div>

<style>
    .report-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 280px;
        align-items: start;
        gap: 20px;
    }

    .report-form-panel {
        min-width: 0;
    }

    .panel-description {
        margin: 5px 0 0;
        color: #718078;
        font-size: 13px;
    }

    .report-form {
        padding: 24px;
    }

    .form-section {
        padding-bottom: 24px;
        margin-bottom: 24px;
        border-bottom: 1px solid #e8eee9;
    }

    .form-section-title {
        margin: 0 0 6px;
        color: #26382f;
        font-size: 15px;
        font-weight: 700;
    }

    .form-section-description {
        margin: 0 0 22px;
        color: #718078;
        font-size: 13px;
        line-height: 1.6;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #405047;
        font-size: 13px;
        font-weight: 600;
    }

    .required-mark {
        color: #c24141;
    }

    .form-group input[type="text"],
    .form-group select,
    .form-group textarea {
        display: block;
        width: 100%;
        padding: 11px 12px;
        border: 1px solid #dce5de;
        border-radius: 7px;
        background: #fff;
        color: #26382f;
        font-family: inherit;
        font-size: 13px;
        outline: none;
        box-sizing: border-box;
    }

    .form-group select {
        height: 43px;
    }

    .form-group textarea {
        resize: vertical;
        line-height: 1.6;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #176b43;
        box-shadow: 0 0 0 3px rgba(23, 107, 67, .08);
    }

    .field-hint {
        display: block;
        margin-top: 7px;
        color: #718078;
        font-size: 11px;
        line-height: 1.6;
    }

    .field-error {
        display: block;
        margin-top: 6px;
        color: #b42318;
        font-size: 12px;
    }

    .upload-box {
        padding: 24px 16px;
        border: 1px dashed #b9cdbf;
        border-radius: 9px;
        background: #f8fbf8;
        text-align: center;
    }

    .upload-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        margin: 0 auto 12px;
        border-radius: 50%;
        background: #e2f1e7;
        color: #176b43;
        font-size: 25px;
    }

    .upload-box strong {
        display: block;
        color: #26382f;
        font-size: 13px;
    }

    .upload-box p {
        margin: 7px 0 14px;
        color: #718078;
        font-size: 12px;
    }

    .upload-box input[type="file"] {
        display: block;
        width: 100%;
        max-width: 320px;
        margin: 0 auto;
        color: #405047;
        font-size: 12px;
    }

    .preview-foto {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 10px;
        margin-top: 12px;
    }

    .preview-foto img {
        width: 100%;
        height: 100px;
        border: 1px solid #e1e9e3;
        border-radius: 7px;
        object-fit: cover;
    }

    .form-note {
        padding: 15px;
        margin-bottom: 24px;
        border: 1px solid #dce8df;
        border-radius: 8px;
        background: #f4f9f5;
    }

    .form-note strong {
        color: #176b43;
        font-size: 13px;
    }

    .form-note p {
        margin: 6px 0 0;
        color: #52685a;
        font-size: 12px;
        line-height: 1.7;
    }

    .form-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .form-footer .btn-app-primary,
    .form-footer .btn-app-outline,
    .page-heading .btn-app-outline {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 40px;
        padding: 0 16px;
        border-radius: 7px;
        font-family: inherit;
        font-size: 13px;
        text-decoration: none;
        cursor: pointer;
    }

    .form-footer .btn-app-outline,
    .page-heading .btn-app-outline {
        border: 1px solid #dce5de;
        background: #fff;
        color: #405047;
    }

    .form-footer .btn-app-primary {
        border: 1px solid #176b43;
    }

    .instruction-panel {
        overflow: hidden;
    }

    .instruction-list {
        padding: 20px;
    }

    .instruction-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 22px;
    }

    .instruction-item:last-child {
        margin-bottom: 0;
    }

    .instruction-number {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        flex-shrink: 0;
        border-radius: 50%;
        background: #e2f1e7;
        color: #176b43;
        font-size: 12px;
        font-weight: 700;
    }

    .instruction-item strong {
        display: block;
        margin: 2px 0 5px;
        color: #26382f;
        font-size: 13px;
    }

    .instruction-item p {
        margin: 0;
        color: #718078;
        font-size: 12px;
        line-height: 1.7;
    }

    .form-alert {
        padding: 15px 18px;
        margin-bottom: 20px;
        border-radius: 8px;
        font-size: 13px;
        line-height: 1.6;
    }

    .form-alert-error {
        border: 1px solid #f2c7c7;
        background: #fff5f5;
        color: #9f2929;
    }

    .form-alert-success {
        border: 1px solid #cde7d4;
        background: #f0faf2;
        color: #176b43;
    }

    .form-alert p {
        margin: 5px 0;
    }

    .form-alert ul {
        margin: 5px 0 0;
        padding-left: 20px;
    }

    @media (max-width: 1000px) {
        .report-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .report-form {
            padding: 18px;
        }

        .form-footer {
            flex-direction: column-reverse;
        }

        .form-footer .btn-app-primary,
        .form-footer .btn-app-outline {
            width: 100%;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputFoto = document.getElementById('foto');
        const preview = document.getElementById('preview-foto');

        if (!inputFoto || !preview) {
            return;
        }

        inputFoto.addEventListener('change', function () {
            preview.innerHTML = '';

            Array.from(inputFoto.files).forEach(function (file) {
                if (!file.type.startsWith('image/')) {
                    return;
                }

                const image = document.createElement('img');
                const reader = new FileReader();

                reader.onload = function (event) {
                    image.src = event.target.result;
                    image.alt = 'Pratinjau foto laporan';
                };

                reader.readAsDataURL(file);
                preview.appendChild(image);
            });
        });
    });
</script>
@endsection

