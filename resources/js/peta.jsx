import React from 'react';
import { createRoot } from 'react-dom/client';
import 'leaflet/dist/leaflet.css';
import '../css/peta.css';
import PetaLokasi from './Maps/PetaLokasi';

/**
 * Mount semua <div data-peta data-config='{...}'> yang ada di halaman Blade.
 * Aman dipanggil ulang: elemen yang sudah ter-mount dilewati.
 */
function pasangPeta() {
    document.querySelectorAll('[data-peta]').forEach((el) => {
        if (el.dataset.petaMounted === 'true') return;

        let config = {};
        try {
            config = JSON.parse(el.dataset.config || '{}');
        } catch (e) {
            console.error('Konfigurasi peta tidak valid', e);
            return;
        }

        el.dataset.petaMounted = 'true';
        createRoot(el).render(<PetaLokasi {...config} />);
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', pasangPeta, { once: true });
} else {
    pasangPeta();
}