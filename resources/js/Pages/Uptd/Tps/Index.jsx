import React, { useEffect, useRef, useState } from 'react';
import { Link, router } from '@inertiajs/react';
import L from 'leaflet';
import UptdLayout from '../../../Layouts/UptdLayout';

function TpsMap({ locations }) {
    const mapElement = useRef(null);

    useEffect(() => {
        if (!mapElement.current || !locations?.length) return;

        const map = L.map(mapElement.current, {
            scrollWheelZoom: false,
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            maxZoom: 19,
        }).addTo(map);

        const bounds = [];

        locations.forEach((item) => {
            const lat = Number(item.latitude);
            const lng = Number(item.longitude);

            if (!Number.isFinite(lat) || !Number.isFinite(lng)) return;

            const marker = L.circleMarker([lat, lng], {
                radius: 8,
                color: '#125735',
                weight: 2,
                fillColor: '#2c8058',
                fillOpacity: 0.9,
            }).addTo(map);

            const popup = document.createElement('div');
            const name = document.createElement('strong');
            const address = document.createElement('div');

            name.textContent = item.nama_tps || 'TPS';
            address.textContent = item.alamat || 'Alamat belum tersedia';
            address.style.marginTop = '5px';
            address.style.fontSize = '12px';

            popup.append(name, address);
            marker.bindPopup(popup);

            bounds.push([lat, lng]);
        });

        if (bounds.length === 1) {
            map.setView(bounds[0], 15);
        } else if (bounds.length > 1) {
            map.fitBounds(bounds, { padding: [30, 30], maxZoom: 15 });
        }

        setTimeout(() => map.invalidateSize(), 100);

        return () => map.remove();
    }, [locations]);

    if (!locations?.length) {
        return (
            <div className="tps-map-empty">
                <i className="bi bi-geo-alt" />
                <strong>Belum ada koordinat TPS</strong>
                <span>Lokasi TPS akan tampil di peta setelah koordinat tersedia.</span>
            </div>
        );
    }

    return <div ref={mapElement} className="tps-leaflet-map" />;
}

function StatCard({ label, value, note, icon }) {
    return (
        <div className="tps-stat-card">
            <div className="tps-stat-top">
                <span>{label}</span>
                <div className="tps-stat-icon">
                    <i className={`bi ${icon}`} />
                </div>
            </div>
            <div className="tps-stat-number">{value ?? 0}</div>
            <div className="tps-stat-note">{note}</div>
        </div>
    );
}

export default function Index({
    tps,
    tpsUntukPeta = [],
    totalTps = 0,
    totalDenganKoordinat = 0,
    totalTanpaKoordinat = 0,
    filters = {},
}) {
    const [keyword, setKeyword] = useState(filters.cari || '');

    const rows = tps?.data || [];
    const pagination = tps?.links || [];

    function search(event) {
        event.preventDefault();

        router.get('/uptd/tps', {
            cari: keyword.trim() || undefined,
        }, {
            preserveState: true,
            preserveScroll: true,
            replace: true,
        });
    }

    function paginationLabel(label) {
        if (label.includes('Previous')) return '‹';
        if (label.includes('Next')) return '›';
        return label;
    }

    return (
        <UptdLayout title="Data TPS Wilayah">
            <div className="tps-react-page">
                <div className="tps-page-heading">
                    <h1>Data TPS Wilayah</h1>
                    <p>Informasi tempat pembuangan sampah yang berada di wilayah kerja Anda.</p>
                </div>

                <section className="tps-stats-grid">
                    <StatCard
                        label="Total TPS Wilayah"
                        value={totalTps}
                        note="Seluruh TPS yang terdaftar"
                        icon="bi-recycle"
                    />
                    <StatCard
                        label="Lokasi Tersedia"
                        value={totalDenganKoordinat}
                        note="TPS dengan koordinat lokasi"
                        icon="bi-geo-alt"
                    />
                    <StatCard
                        label="Lokasi Belum Tersedia"
                        value={totalTanpaKoordinat}
                        note="TPS tanpa koordinat lokasi"
                        icon="bi-geo"
                    />
                </section>

                <section className="tps-panel">
                    <div className="tps-panel-heading">
                        <div>
                            <h2>Peta Sebaran TPS</h2>
                            <p>Lokasi TPS yang sudah memiliki koordinat di wilayah kerja Anda.</p>
                        </div>
                        <span className="tps-map-count">
                            <i className="bi bi-geo-alt-fill" />
                            {tpsUntukPeta.length} titik lokasi
                        </span>
                    </div>

                    <div className="tps-map-container">
                        <TpsMap locations={tpsUntukPeta} />
                    </div>
                    <div className="tps-map-footnote">
                        <i className="bi bi-info-circle" />
                        Peta menggunakan OpenStreetMap. Klik penanda untuk melihat informasi TPS.
                    </div>
                </section>

                <section className="tps-panel">
                    <div className="tps-panel-heading">
                        <div>
                            <h2>Daftar TPS Wilayah</h2>
                            <p>Daftar lokasi TPS beserta alamat dan informasi koordinatnya.</p>
                        </div>
                    </div>

                    <div className="tps-toolbar">
                        <form className="tps-search-form" onSubmit={search}>
                            <div className="tps-search-input">
                                <i className="bi bi-search" />
                                <input
                                    type="text"
                                    value={keyword}
                                    onChange={(event) => setKeyword(event.target.value)}
                                    placeholder="Cari nama TPS atau alamat..."
                                    aria-label="Cari nama TPS atau alamat"
                                />
                            </div>
                            <button type="submit" className="tps-btn-search">
                                Cari
                            </button>
                            {filters.cari && (
                                <Link href="/uptd/tps" className="tps-btn-reset">
                                    Reset
                                </Link>
                            )}
                        </form>

                        <div className="tps-result-info">
                            Menampilkan <strong>{rows.length}</strong> dari{' '}
                            <strong>{tps?.total || 0}</strong> hasil pencarian
                        </div>
                    </div>

                    <div className="tps-table-scroll">
                        <table className="tps-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Informasi TPS</th>
                                    <th>Koordinat Lokasi</th>
                                    <th>Status Lokasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {rows.length > 0 ? rows.map((item, index) => {
                                    const hasCoordinates =
                                        item.latitude !== null &&
                                        item.latitude !== '' &&
                                        item.longitude !== null &&
                                        item.longitude !== '';

                                    return (
                                        <tr key={item.id}>
                                            <td className="tps-row-number">
                                                {(tps.from || 1) + index}
                                            </td>
                                            <td>
                                                <strong className="tps-row-name">{item.nama_tps}</strong>
                                                <span className="tps-row-address">
                                                    <i className="bi bi-geo-alt" />
                                                    {item.alamat || 'Alamat belum tersedia'}
                                                </span>
                                            </td>
                                            <td className="tps-coordinate">
                                                {hasCoordinates ? (
                                                    <>
                                                        {item.latitude}<br />
                                                        {item.longitude}
                                                    </>
                                                ) : 'Belum tersedia'}
                                            </td>
                                            <td>
                                                {hasCoordinates ? (
                                                    <span className="tps-status available">
                                                        <i className="bi bi-check-circle-fill" /> Tersedia
                                                    </span>
                                                ) : (
                                                    <span className="tps-status missing">
                                                        <i className="bi bi-exclamation-circle-fill" /> Belum ada
                                                    </span>
                                                )}
                                            </td>
                                            <td>
                                                {hasCoordinates ? (
                                                    <a
                                                        className="tps-map-link"
                                                        href={`https://www.google.com/maps?q=${encodeURIComponent(item.latitude)},${encodeURIComponent(item.longitude)}`}
                                                        target="_blank"
                                                        rel="noopener noreferrer"
                                                    >
                                                        <i className="bi bi-map" /> Lihat Peta
                                                    </a>
                                                ) : <span className="tps-muted">—</span>}
                                            </td>
                                        </tr>
                                    );
                                }) : (
                                    <tr>
                                        <td colSpan="5" className="tps-empty-row">
                                            <i className="bi bi-inbox" />
                                            <strong>
                                                {filters.cari ? 'TPS Tidak Ditemukan' : 'Belum Ada Data TPS'}
                                            </strong>
                                            <span>
                                                {filters.cari
                                                    ? 'Tidak ada TPS yang sesuai dengan kata kunci pencarian.'
                                                    : 'Belum ada TPS yang terdaftar di wilayah kerja Anda.'}
                                            </span>
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>

                    {pagination.length > 3 && (
                        <div className="tps-pagination">
                            {pagination.map((link, index) => (
                                link.url ? (
                                    <Link
                                        key={index}
                                        href={link.url}
                                        className={`tps-page-link ${link.active ? 'active' : ''}`}
                                        preserveScroll
                                    >
                                        {paginationLabel(link.label)}
                                    </Link>
                                ) : (
                                    <span key={index} className="tps-page-link disabled">
                                        {paginationLabel(link.label)}
                                    </span>
                                )
                            ))}
                        </div>
                    )}
                </section>
            </div>
        </UptdLayout>
    );
}