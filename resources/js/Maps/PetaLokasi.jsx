import React, { useCallback, useEffect, useMemo, useRef, useState } from 'react';
import L from 'leaflet';

const PUSAT_DEFAULT = [-6.3276, 108.3247]; // Indramayu
const OSM = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';

const WARNA = {
    tps: '#176b43',
    laporan: '#d9480f',
    supir: '#1c64c8',
    saya: '#7b3fc4',
    pilihan: '#d9480f',
};

const LABEL = {
    tps: 'TPS',
    laporan: 'Laporan',
    supir: 'Supir',
    saya: 'Posisi saya',
    pilihan: 'Lokasi dipilih',
};

function ikon(type, redup = false) {
    const warna = redup ? '#8b948e' : (WARNA[type] || WARNA.tps);
    const html = `
        <svg width="30" height="40" viewBox="0 0 30 40" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 1C7.3 1 1 7.2 1 14.8 1 25 15 39 15 39s14-14 14-24.2C29 7.2 22.7 1 15 1z"
                  fill="${warna}" stroke="#fff" stroke-width="2"/>
            <circle cx="15" cy="15" r="5.5" fill="#fff"/>
        </svg>`;

    return L.divIcon({
        className: 'peta-pin',
        html,
        iconSize: [30, 40],
        iconAnchor: [15, 38],
        popupAnchor: [0, -34],
    });
}

function ikonSaya() {
    return L.divIcon({
        className: 'peta-saya',
        html: '<span></span>',
        iconSize: [22, 22],
        iconAnchor: [11, 11],
    });
}

// Popup dibangun dengan DOM + textContent agar teks dari database tidak bisa menyisipkan HTML.
function bangunPopup(m) {
    const el = document.createElement('div');
    el.className = 'peta-popup';

    const judul = document.createElement('strong');
    judul.textContent = m.title || LABEL[m.type] || 'Lokasi';
    el.appendChild(judul);

    if (m.subtitle) {
        const sub = document.createElement('div');
        sub.textContent = m.subtitle;
        el.appendChild(sub);
    }

    if (m.url && /^(\/|https?:\/\/)/.test(m.url)) {
        const a = document.createElement('a');
        a.href = m.url;
        a.textContent = 'Lihat detail';
        el.appendChild(a);
    }

    return el;
}

function formatKoordinat(lat, lng) {
    return `${Number(lat).toFixed(6)}, ${Number(lng).toFixed(6)}`;
}

function pesanGeolocationError(error) {
    if (error.code === error.PERMISSION_DENIED) {
        return 'Akses lokasi ditolak. Izinkan lokasi pada browser lalu coba lagi.';
    }
    if (error.code === error.POSITION_UNAVAILABLE) return 'Lokasi perangkat tidak tersedia.';
    if (error.code === error.TIMEOUT) return 'Pengambilan lokasi terlalu lama. Coba lagi.';
    return 'Lokasi tidak dapat ditemukan.';
}

function jarakMeter(a, b) {
    return L.latLng(a).distanceTo(L.latLng(b));
}
/**
 * Props (dari data-config Blade):
 *  mode        : 'view' | 'picker' | 'live'
 *  markers     : [{id,type,lat,lng,title,subtitle,url,menit}]
 *  height      : px
 *  tombolSaya  : tampilkan tombol "Lokasi Saya" (mode view)
 *  latInput / lngInput : id input form (mode picker)
 *  pollUrl     : endpoint JSON posisi supir (refresh tiap 30 detik)
 *  shareUrl    : endpoint POST posisi supir (mode live)
 *  csrf        : token CSRF
 *  tujuan      : {lat,lng,label} untuk tombol navigasi (mode live)
 */
export default function PetaLokasi({
    mode = 'view',
    markers = [],
    filterable = false,
    height = 360,
    tombolSaya = false,
    latInput = 'latitude',
    lngInput = 'longitude',
    pollUrl = null,
    shareUrl = null,
    csrf = '',
    tujuan = null,
}) {
    const elRef = useRef(null);
    const mapRef = useRef(null);
    const layerRef = useRef(null);
    const dinamisRef = useRef(null); // marker supir hasil polling
    const sayaRef = useRef(null);
    const pilihanRef = useRef(null);
    const sudahFitRef = useRef(false);
    const watchRef = useRef(null);
    const terakhirKirimRef = useRef({ waktu: 0, posisi: null });

    const [status, setStatus] = useState('');
    const [sibuk, setSibuk] = useState(false);
    const [berbagi, setBerbagi] = useState(false);
    const [posisiSaya, setPosisiSaya] = useState(null);
    const [markerSupir, setMarkerSupir] = useState([]);
    const [markerAktif, setMarkerAktif] = useState(markers);
    const [filterWilayah, setFilterWilayah] = useState('semua');
    const [filterStatus, setFilterStatus] = useState('semua');

    useEffect(() => {
        setMarkerAktif(markers);
    }, [markers]);

    useEffect(() => {
        if (!filterable) return undefined;

        const perbaruiMarker = (event) => {
            const dataBaru = event.detail;
            setMarkerAktif(Array.isArray(dataBaru) ? dataBaru : []);
        };

        window.addEventListener('landing:tps-updated', perbaruiMarker);

        return () => {
            window.removeEventListener('landing:tps-updated', perbaruiMarker);
        };
    }, [filterable]);

    const daftarWilayah = useMemo(
        () => [...new Set(
            markerAktif
                .map((m) => m.wilayah)
                .filter((w) => typeof w === 'string' && w.trim() !== '')
        )].sort((a, b) => a.localeCompare(b, 'id')),
        [markerAktif]
    );

    const semuaStatis = useMemo(
        () => markerAktif.filter((m) => {
            if (
                m.lat === null || m.lat === undefined || m.lat === '' ||
                m.lng === null || m.lng === undefined || m.lng === ''
            ) return false;

            const lat = Number(m.lat);
            const lng = Number(m.lng);

            if (
                !Number.isFinite(lat) ||
                !Number.isFinite(lng) ||
                Math.abs(lat) > 90 ||
                Math.abs(lng) > 180
            ) return false;

            if (filterable && filterWilayah !== 'semua' && m.wilayah !== filterWilayah) {
                return false;
            }

            if (filterable && filterStatus !== 'semua' && m.status !== filterStatus) {
                return false;
            }

            return true;
        }),
        [markerAktif, filterable, filterWilayah, filterStatus]
    );

    const tipeAda = useMemo(() => {
        const t = new Set(semuaStatis.map((m) => m.type));
        markerSupir.forEach((m) => t.add(m.type));
        if (mode === 'live') t.add('saya');
        if (mode === 'picker') t.add('pilihan');
        return [...t];
    }, [semuaStatis, markerSupir, mode]);

    /* ---------- inisialisasi peta ---------- */
    useEffect(() => {
        if (!elRef.current || mapRef.current) return undefined;

        const map = L.map(elRef.current, { scrollWheelZoom: false }).setView(PUSAT_DEFAULT, 12);

        L.tileLayer(OSM, {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            maxZoom: 19,
        }).addTo(map);

        // scroll-zoom baru aktif setelah peta diklik, supaya tidak mengganggu scroll halaman
        map.on('click focus', () => map.scrollWheelZoom.enable());
        map.on('mouseout', () => map.scrollWheelZoom.disable());

        layerRef.current = L.layerGroup().addTo(map);
        dinamisRef.current = L.layerGroup().addTo(map);
        mapRef.current = map;

        const t = setTimeout(() => map.invalidateSize(), 150);
        const onResize = () => map.invalidateSize();
        window.addEventListener('resize', onResize);

        return () => {
            clearTimeout(t);
            window.removeEventListener('resize', onResize);
            map.remove();
            mapRef.current = null;
        };
    }, []);

    /* ---------- marker statis ---------- */
    useEffect(() => {
        const map = mapRef.current;
        const layer = layerRef.current;
        if (!map || !layer) return;

        layer.clearLayers();

        semuaStatis.forEach((m) => {
            L.marker([Number(m.lat), Number(m.lng)], { icon: ikon(m.type) })
                .bindPopup(bangunPopup(m))
                .addTo(layer);
        });

        if (!sudahFitRef.current && semuaStatis.length && mode !== 'picker') {
            const bounds = L.latLngBounds(semuaStatis.map((m) => [Number(m.lat), Number(m.lng)]));
            if (semuaStatis.length === 1) {
                map.setView(bounds.getCenter(), 16);
            } else {
                map.fitBounds(bounds, { padding: [36, 36], maxZoom: 16 });
            }
            sudahFitRef.current = true;
        }
    }, [semuaStatis, mode]);

    /* ---------- marker supir (polling) ---------- */
    useEffect(() => {
        const layer = dinamisRef.current;
        if (!layer) return;

        layer.clearLayers();

        markerSupir.forEach((m) => {
            const redup = Number(m.menit) > 15;
            L.marker([m.lat, m.lng], { icon: ikon('supir', redup) })
                .bindPopup(bangunPopup(m))
                .addTo(layer);
        });
    }, [markerSupir]);

    useEffect(() => {
        if (!pollUrl) return undefined;

        let batal = false;

        const ambil = async () => {
            try {
                const res = await fetch(pollUrl, {
                    headers: { Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                    credentials: 'same-origin',
                });
                if (!res.ok) return;
                const data = await res.json();
                if (!batal) setMarkerSupir(Array.isArray(data.markers) ? data.markers : []);
            } catch {
                /* jaringan putus: biarkan marker terakhir */
            }
        };

        ambil();
        const timer = setInterval(ambil, 30000);

        return () => {
            batal = true;
            clearInterval(timer);
        };
    }, [pollUrl]);

    /* ---------- marker "posisi saya" ---------- */
    const tampilkanSaya = useCallback((lat, lng, akurasi) => {
        const map = mapRef.current;
        if (!map) return;

        if (sayaRef.current) {
            sayaRef.current.setLatLng([lat, lng]);
        } else {
            sayaRef.current = L.marker([lat, lng], { icon: ikonSaya(), zIndexOffset: 1000 })
                .bindPopup('Posisi Anda saat ini')
                .addTo(map);
        }
        setPosisiSaya({ lat, lng, akurasi });
    }, []);

    /* ---------- mode view: tombol lokasi saya ---------- */
    const lokasiSayaSekali = () => {
        if (!navigator.geolocation) {
            setStatus('Browser tidak mendukung fitur lokasi.');
            return;
        }
        setSibuk(true);
        setStatus('Mengambil lokasi perangkat...');

        navigator.geolocation.getCurrentPosition(
            (p) => {
                tampilkanSaya(p.coords.latitude, p.coords.longitude, p.coords.accuracy);
                mapRef.current?.setView([p.coords.latitude, p.coords.longitude], 16);
                setStatus(`Akurasi sekitar ${Math.round(p.coords.accuracy)} meter.`);
                setSibuk(false);
            },
            (e) => {
                setStatus(pesanGeolocationError(e));
                setSibuk(false);
            },
            { enableHighAccuracy: true, timeout: 15000, maximumAge: 0 }
        );
    };

    /* ---------- mode picker ---------- */
    const setPilihan = useCallback(
        (lat, lng, { geser = true, pesan = '' } = {}) => {
            const map = mapRef.current;
            if (!map) return;

            const la = Number(lat);
            const ln = Number(lng);
            if (!Number.isFinite(la) || !Number.isFinite(ln)) return;

            const inLat = document.getElementById(latInput);
            const inLng = document.getElementById(lngInput);
            if (inLat) inLat.value = la.toFixed(7);
            if (inLng) inLng.value = ln.toFixed(7);

            if (pilihanRef.current) {
                pilihanRef.current.setLatLng([la, ln]);
            } else {
                const marker = L.marker([la, ln], { icon: ikon('pilihan'), draggable: true })
                    .bindPopup('Lokasi dipilih (geser untuk menyesuaikan)')
                    .addTo(map);
                marker.on('dragend', () => {
                    const p = marker.getLatLng();
                    setPilihan(p.lat, p.lng, { geser: false, pesan: 'Posisi pin disesuaikan.' });
                });
                pilihanRef.current = marker;
            }

            if (geser) map.setView([la, ln], Math.max(map.getZoom(), 17));
            setStatus(pesan || `Lokasi dipilih: ${formatKoordinat(la, ln)}`);
        },
        [latInput, lngInput]
    );

    useEffect(() => {
        if (mode !== 'picker') return undefined;
        const map = mapRef.current;
        if (!map) return undefined;

        const awalLat = parseFloat(document.getElementById(latInput)?.value);
        const awalLng = parseFloat(document.getElementById(lngInput)?.value);
        if (Number.isFinite(awalLat) && Number.isFinite(awalLng)) {
            setPilihan(awalLat, awalLng);
        } else if (semuaStatis.length) {
            map.fitBounds(
                L.latLngBounds(semuaStatis.map((m) => [Number(m.lat), Number(m.lng)])),
                { padding: [36, 36], maxZoom: 15 }
            );
        }

        const onClick = (e) => setPilihan(e.latlng.lat, e.latlng.lng, { geser: false });
        map.on('click', onClick);

        // kalau koordinat diketik manual di input, pin ikut pindah
        const sinkron = () => {
            const la = parseFloat(document.getElementById(latInput)?.value);
            const ln = parseFloat(document.getElementById(lngInput)?.value);
            if (Number.isFinite(la) && Number.isFinite(ln) && Math.abs(la) <= 90 && Math.abs(ln) <= 180) {
                setPilihan(la, ln);
            }
        };
        const a = document.getElementById(latInput);
        const b = document.getElementById(lngInput);
        a?.addEventListener('change', sinkron);
        b?.addEventListener('change', sinkron);

        return () => {
            map.off('click', onClick);
            a?.removeEventListener('change', sinkron);
            b?.removeEventListener('change', sinkron);
        };
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [mode, setPilihan]);

    const gunakanLokasiSaya = () => {
        if (!navigator.geolocation) {
            setStatus('Browser tidak mendukung fitur lokasi.');
            return;
        }
        setSibuk(true);
        setStatus('Sedang mengambil lokasi perangkat...');

        navigator.geolocation.getCurrentPosition(
            (p) => {
                setPilihan(p.coords.latitude, p.coords.longitude, {
                    pesan: `Lokasi ditemukan. Akurasi sekitar ${Math.round(p.coords.accuracy)} meter. Geser pin bila perlu.`,
                });
                setSibuk(false);
            },
            (e) => {
                setStatus(pesanGeolocationError(e));
                setSibuk(false);
            },
            { enableHighAccuracy: true, timeout: 15000, maximumAge: 0 }
        );
    };

    /* ---------- mode live (supir) ---------- */
    const kirimPosisi = useCallback(
        async (lat, lng, akurasi) => {
            if (!shareUrl) return;

            const sekarang = Date.now();
            const { waktu, posisi } = terakhirKirimRef.current;
            const bergerak = posisi ? jarakMeter(posisi, [lat, lng]) : Infinity;

            // kirim paling cepat tiap 15 dtk, kecuali bergeser > 25 m
            if (sekarang - waktu < 15000 && bergerak < 25) return;

            terakhirKirimRef.current = { waktu: sekarang, posisi: [lat, lng] };

            try {
                const res = await fetch(shareUrl, {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        Accept: 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify({ latitude: lat, longitude: lng, akurasi }),
                });
                if (!res.ok) throw new Error(String(res.status));
                setStatus(`Lokasi dibagikan ke UPTD. Akurasi sekitar ${Math.round(akurasi)} meter.`);
            } catch {
                setStatus('Gagal mengirim lokasi ke server. Akan dicoba lagi.');
                terakhirKirimRef.current = { waktu: 0, posisi: null };
            }
        },
        [shareUrl, csrf]
    );

    const berhentiLokal = () => {
        if (watchRef.current !== null) {
            navigator.geolocation.clearWatch(watchRef.current);
            watchRef.current = null;
        }
        setBerbagi(false);
    };

    const mulaiBerbagi = () => {
        if (!navigator.geolocation) {
            setStatus('Browser tidak mendukung fitur lokasi.');
            return;
        }
        if (watchRef.current !== null) return;

        setSibuk(true);
        setStatus('Meminta izin lokasi...');
        let pertama = true;

        watchRef.current = navigator.geolocation.watchPosition(
            (p) => {
                const { latitude, longitude, accuracy } = p.coords;
                tampilkanSaya(latitude, longitude, accuracy);
                if (pertama) {
                    mapRef.current?.setView([latitude, longitude], 16);
                    pertama = false;
                    setSibuk(false);
                    setBerbagi(true);
                }
                kirimPosisi(latitude, longitude, accuracy);
            },
            (e) => {
                setStatus(pesanGeolocationError(e));
                setSibuk(false);
                if (e.code === e.PERMISSION_DENIED) berhentiLokal();
            },
            { enableHighAccuracy: true, timeout: 20000, maximumAge: 5000 }
        );
    };

    const hentikanBerbagi = async () => {
        berhentiLokal();
        terakhirKirimRef.current = { waktu: 0, posisi: null };

        try {
            await fetch(shareUrl, {
                method: 'DELETE',
                credentials: 'same-origin',
                headers: {
                    Accept: 'application/json',
                    'X-CSRF-TOKEN': csrf,
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });
            setStatus('Berbagi lokasi dihentikan. Posisi Anda dihapus dari peta UPTD.');
        } catch {
            setStatus('Berbagi dihentikan di perangkat, tetapi server belum merespons.');
        }
    };

    useEffect(() => () => {
        if (watchRef.current !== null) navigator.geolocation.clearWatch(watchRef.current);
    }, []);

    const urlNavigasi = tujuan && Number.isFinite(Number(tujuan.lat)) && Number.isFinite(Number(tujuan.lng))
        ? `https://www.google.com/maps/dir/?api=1&destination=${tujuan.lat},${tujuan.lng}`
            + (posisiSaya ? `&origin=${posisiSaya.lat},${posisiSaya.lng}` : '')
        : null;

    return (
        <div className="peta">
            <div className="peta-toolbar">
                {filterable && (
                    <>
                        <label className="peta-filter-label">
                            Wilayah
                            <select
                                className="peta-filter"
                                value={filterWilayah}
                                onChange={(e) => setFilterWilayah(e.target.value)}
                            >
                                <option value="semua">Semua wilayah</option>
                                {daftarWilayah.map((wilayah) => (
                                    <option key={wilayah} value={wilayah}>{wilayah}</option>
                                ))}
                            </select>
                        </label>

                        <label className="peta-filter-label">
                            Status TPS
                            <select
                                className="peta-filter"
                                value={filterStatus}
                                onChange={(e) => setFilterStatus(e.target.value)}
                            >
                                <option value="semua">Semua status</option>
                                <option value="bersih">Bersih</option>
                                <option value="terlapor">Terlapor</option>
                            </select>
                        </label>

                        <span className="peta-filter-count">
                            {semuaStatis.length} titik ditampilkan
                        </span>
                    </>
                )}

                {mode === 'picker' && (
                    <button type="button" className="peta-btn" onClick={gunakanLokasiSaya} disabled={sibuk}>
                        {sibuk ? 'Mengambil lokasi...' : 'Gunakan Lokasi Saya'}
                    </button>
                )}

                {mode === 'view' && tombolSaya && (
                    <button type="button" className="peta-btn" onClick={lokasiSayaSekali} disabled={sibuk}>
                        {sibuk ? 'Mengambil lokasi...' : 'Tunjukkan Lokasi Saya'}
                    </button>
                )}

                {mode === 'live' && !berbagi && (
                    <button type="button" className="peta-btn" onClick={mulaiBerbagi} disabled={sibuk}>
                        {sibuk ? 'Menunggu GPS...' : 'Bagikan Lokasi Saya'}
                    </button>
                )}

                {mode === 'live' && berbagi && (
                    <button type="button" className="peta-btn peta-btn-bahaya" onClick={hentikanBerbagi}>
                        Hentikan Berbagi
                    </button>
                )}

                {urlNavigasi && (
                    <a className="peta-btn peta-btn-garis" href={urlNavigasi} target="_blank" rel="noopener noreferrer">
                        Navigasi ke {tujuan.label || 'tujuan'}
                    </a>
                )}

                {mode === 'live' && (
                    <span className={`peta-lencana ${berbagi ? 'aktif' : ''}`}>
                        {berbagi ? 'Lokasi sedang dibagikan' : 'Lokasi tidak dibagikan'}
                    </span>
                )}
            </div>

            {status && <div className="peta-status" role="status">{status}</div>}

            <div ref={elRef} className="peta-kanvas" style={{ height }} />

            {tipeAda.length > 0 && (
                <div className="peta-legenda">
                    {tipeAda.map((t) => (
                        <span key={t}>
                            <i style={{ background: WARNA[t] }} />
                            {LABEL[t]}
                        </span>
                    ))}
                </div>
            )}

            {mode === 'live' && (
                <p className="peta-catatan">
                    Lokasi hanya dibagikan selama halaman ini terbuka dan tombol berbagi aktif.
                    Tekan &ldquo;Hentikan Berbagi&rdquo; kapan saja untuk menghapusnya.
                </p>
            )}

            {semuaStatis.length === 0 && markerSupir.length === 0 && mode !== 'picker' && (
                <p className="peta-catatan">
                    {filterable && markerAktif.length > 0
                        ? 'Tidak ada TPS yang cocok dengan filter yang dipilih.'
                        : 'Belum ada titik koordinat TPS yang bisa ditampilkan.'}
                </p>
            )}
        </div>
    );
}
