import React, { useState } from 'react';
import { Head, router, usePage } from '@inertiajs/react';

export default function UptdLayout({ children, title = 'Dashboard' }) {
    const [sidebarOpen, setSidebarOpen] = useState(false);
    const { auth, url } = usePage().props;
    const currentUrl = usePage().url || url || window.location.pathname;
    const user = auth?.user;

    const menu = [
        { label: 'Dashboard', href: '/dashboard/uptd', icon: 'bi-grid' },
        { label: 'Data Laporan', href: '/uptd/laporan', icon: 'bi-file-earmark-text' },
        { label: 'Data TPS Wilayah', href: '/uptd/tps', icon: 'bi-geo-alt' },
    ];

    const isActive = (href) => {
        if (href === '/dashboard/uptd') {
            return currentUrl.startsWith(href);
        }

        return currentUrl === href ||
            currentUrl.startsWith(href + '?') ||
            currentUrl.startsWith(href + '/');
    };

    return (
        <div className="react-uptd">
            <Head title={`${title} | SI Pantau TPS`} />

            {sidebarOpen && (
                <button
                    type="button"
                    className="uptd-overlay"
                    onClick={() => setSidebarOpen(false)}
                    aria-label="Tutup menu"
                />
            )}

            <aside className={`uptd-sidebar ${sidebarOpen ? 'open' : ''}`}>
                <div className="uptd-brand">
                    <i className="bi bi-recycle" />
                    <span>SI PANTAU TPS</span>
                </div>

                <nav className="uptd-nav">
                    <div className="uptd-nav-label">Menu Utama</div>

                    {menu.map((item) => (
                        <a
                            key={item.href}
                            href={item.href}
                            className={`uptd-nav-link ${isActive(item.href) ? 'active' : ''}`}
                            onClick={() => setSidebarOpen(false)}
                        >
                            <i className={`bi ${item.icon}`} />
                            <span>{item.label}</span>
                        </a>
                    ))}
                </nav>

                <div className="uptd-sidebar-footer">
                    <button
                        type="button"
                        className="uptd-logout"
                        onClick={() => router.post('/logout')}
                    >
                        <i className="bi bi-box-arrow-right" />
                        <span>Keluar</span>
                    </button>
                </div>
            </aside>

            <div className="uptd-main">
                <header className="uptd-topbar">
                    <button
                        type="button"
                        className="uptd-menu-toggle"
                        onClick={() => setSidebarOpen(true)}
                        aria-label="Buka menu"
                    >
                        <i className="bi bi-list" />
                    </button>

                    <div className="uptd-topbar-title">{title}</div>

                    <a
                        href="/pengaturan"
                        className="uptd-profile-link"
                        title="Pengaturan Akun"
                        aria-label="Buka pengaturan akun"
                    >
                        <div className="uptd-profile-avatar">
                            {(user?.name || 'U').charAt(0).toUpperCase()}
                        </div>
                        <div className="uptd-profile-info">
                            <strong>{user?.name || 'Pengguna'}</strong>
                            <span>UPTD</span>
                        </div>
                    </a>
                </header>

                <main className="uptd-content">
                    {children}
                </main>
            </div>
        </div>
    );
}
