import React, { useEffect, useRef, useState } from 'react';
import { createRoot } from 'react-dom/client';
import L from 'leaflet';

function ReportLocationPicker() {
    const mapElement = useRef(null);
    const mapRef = useRef(null);
    const markerRef = useRef(null);

    const [loading, setLoading] = useState(false);
    const [status, setStatus] = useState('');

    useEffect(() => {
        if (!mapElement.current || mapRef.current) {
            return;
        }

        const map = L.map(mapElement.current, {
            scrollWheelZoom: true,
        }).setView([-6.3276, 108.3247], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
            maxZoom: 19,
        }).addTo(map);

        mapRef.current = map;

        setTimeout(() => {
            map.invalidateSize();
        }, 100);

        return () => {
            map.remove();
            mapRef.current = null;
        };
    }, []);

    function setLocation(latitude, longitude, accuracy = null) {
        const lat = Number(latitude);
        const lng = Number(longitude);

        if (!Number.isFinite(lat) || !Number.isFinite(lng)) {
            setStatus('Koordinat lokasi tidak valid.');
            return;
        }

        const latInput = document.getElementById('latitude');
        const lngInput = document.getElementById('longitude');

        if (latInput) {
            latInput.value = lat.toFixed(7);
        }

        if (lngInput) {
            lngInput.value = lng.toFixed(7);
        }

        if (markerRef.current) {
            markerRef.current.setLatLng([lat, lng]);
        } else {
            markerRef.current = L.circleMarker([lat, lng], {
                radius: 9,
                color: '#125735',
                weight: 3,
                fillColor: '#2c8058',
                fillOpacity: 1,
            })
                .addTo(mapRef.current)
                .bindPopup('Lokasi laporan')
                .openPopup();
        }

        mapRef.current.setView([lat, lng], 17);

        if (accuracy !== null) {
            setStatus(
                `Lokasi ditemukan. Akurasi sekitar ${Math.round(accuracy)} meter.`
            );
        } else {
            setStatus('Lokasi berhasil ditemukan.');
        }
    }

    function getCurrentLocation() {
        if (!navigator.geolocation) {
            setStatus('Browser tidak mendukung fitur lokasi.');
            return;
        }

        setLoading(true);
        setStatus('Sedang mengambil lokasi perangkat...');

        navigator.geolocation.getCurrentPosition(
            (position) => {
                setLocation(
                    position.coords.latitude,
                    position.coords.longitude,
                    position.coords.accuracy
                );

                setLoading(false);
            },
            (error) => {
                setLoading(false);

                if (error.code === error.PERMISSION_DENIED) {
                    setStatus(
                        'Akses lokasi ditolak. Izinkan lokasi pada browser lalu coba lagi.'
                    );
                } else if (error.code === error.POSITION_UNAVAILABLE) {
                    setStatus('Lokasi perangkat tidak tersedia.');
                } else if (error.code === error.TIMEOUT) {
                    setStatus('Pengambilan lokasi terlalu lama. Silakan coba lagi.');
                } else {
                    setStatus('Lokasi tidak dapat ditemukan.');
                }
            },
            {
                enableHighAccuracy: true,
                timeout: 15000,
                maximumAge: 0,
            }
        );
    }

    return (
        <div className="report-location-picker">
            <button
                type="button"
                className="report-location-button"
                onClick={getCurrentLocation}
                disabled={loading}
            >
                {loading ? 'Mengambil Lokasi...' : 'Gunakan Lokasi Saya'}
            </button>

            {status && (
                <div className="report-location-status">
                    {status}
                </div>
            )}

            <div
                ref={mapElement}
                className="report-location-map"
            />
        </div>
    );
}

function mountReportLocationPicker() {
    const element = document.getElementById('report-location-picker');

    if (!element || element.dataset.reactMounted === 'true') {
        return;
    }

    element.dataset.reactMounted = 'true';

    createRoot(element).render(
        <ReportLocationPicker />
    );
}

if (document.readyState === 'loading') {
    document.addEventListener(
        'DOMContentLoaded',
        mountReportLocationPicker,
        { once: true }
    );
} else {
    mountReportLocationPicker();
}
