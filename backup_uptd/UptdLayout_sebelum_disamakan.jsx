import React, { useState } from 'react';
import { Head, router, usePage } from '@inertiajs/react';

export default function UptdLayout({ children, title = 'Dashboard' }) {
    const [sidebarOpen, setSidebarOpen] = useState(false);
    const { auth, url } = usePage().props;
    const currentUrl = usePage().url || url || window.location.pathname;
    const user = auth?.user;

    const menu = [
        { label: 'Dashboard', href: '/dashboard/uptd', icon: 'bi-grid-1x2' },
        { label: 'Data Laporan', href: '/uptd/laporan', icon: 'bi-clipboard-data' },
        { label: 'Data TPS Wilayah', href: '/uptd/tps', icon: 'bi-geo-alt' },
    ];

    const isActive = (href) => {
        if (href === '/dashboard/uptd') {
            return currentUrl.startsWith(href);
        }
        return currentUrl === href || currentUrl.startsWith(href + '?') ||
            currentUrl.startsWith(href + '/');
    };

    return (
        <div className="react-uptd">
            <Head title={`${title} | SI Pantau TPS`} />

            {sidebarOpen && (
                <button
                    className="uptd-overlay"
                    onClick={() => setSidebarOpen(false)}
                    aria-label="Tutup menu"
                />
            )}

            <aside className={`uptd-sidebar ${sidebarOpen ? 'open' : ''}`}>
                <div className="uptd-brand">
                    <div className="uptd-brand-icon">
                        <i className="bi bi-recycle" />
                    </div>
                    <div>
                        <strong>SI PANTAU TPS</strong>
                        <small>Portal UPTD</small>
                    </div>
                </div>

                <nav className="uptd-nav">
                    <span className="uptd-nav-label">MENU UTAMA</span>

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

                    <span className="uptd-nav-label account-label">AKUN</span>

                    <a
                        href="/uptd/pengaturan"
                        className={`uptd-nav-link ${isActive('/uptd/pengaturan') ? 'active' : ''}`}
                        onClick={() => setSidebarOpen(false)}
                    >
                        <i className="bi bi-gear" />
                        <span>Pengaturan</span>
                    </a>
                </nav>

                <div className="uptd-sidebar-footer">
                    <div className="uptd-user-avatar">
                        {(user?.name || 'U').charAt(0).toUpperCase()}
                    </div>
                    <div className="uptd-user-info">
                        <strong>{user?.name || 'Pengguna'}</strong>
                        <small>UPTD</small>
                    </div>
                    <button
                        className="uptd-logout"
                        title="Keluar"
                        onClick={() => router.post('/logout')}
                    >
                        <i className="bi bi-box-arrow-right" />
                    </button>
                </div>
            </aside>

            <div className="uptd-main">
                <header className="uptd-topbar">
                    <button
                        className="uptd-menu-toggle"
                        onClick={() => setSidebarOpen(true)}
                        aria-label="Buka menu"
                    >
                        <i className="bi bi-list" />
                    </button>
                    <div className="uptd-topbar-title">{title}</div>
                    <div className="uptd-topbar-badge">
                        <i className="bi bi-patch-check" /> UPTD
                    </div>
                </header>

                <main className="uptd-content">
                    {children}
                </main>
            </div>
        </div>
    );
}
