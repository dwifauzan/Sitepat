# LATELINK SMAKENSA — UI/UX Redesign Document
> **Versi:** 2.0 · **Sistem:** Student Late Attendance Tracking · **Sekolah:** SMKN 1 Bondowoso

---

## Daftar Isi

1. [Design Philosophy & Visual Identity](#1-design-philosophy--visual-identity)
2. [Design Tokens](#2-design-tokens)
3. [Layout Architecture](#3-layout-architecture)
4. [Component Library](#4-component-library)
5. [Page-by-Page Specification](#5-page-by-page-specification)
6. [Navigation & States](#6-navigation--states)
7. [Responsive Behavior](#7-responsive-behavior)
8. [Transitions & Animations](#8-transitions--animations)
9. [Accessibility](#9-accessibility)
10. [Implementation Roadmap](#10-implementation-roadmap)
11. [Before vs After Comparison](#11-before-vs-after-comparison)
12. [Blade Component Structure](#12-blade-component-structure)

---

## 1. Design Philosophy & Visual Identity

### Filosofi

LateLink adalah alat operasional yang dipakai operator setiap hari, bukan showcase produk. Prioritas desain diurutkan sebagai berikut:

1. **Kejelasan** — informasi paling penting harus terlihat dalam 3 detik
2. **Kecepatan** — interaksi sesedikit mungkin untuk mencatat keterlambatan
3. **Kepercayaan** — tampilan formal dan konsisten memberi rasa aman pada pengguna institusi

### Prinsip Visual

- **Tegas, bukan ramai** — merah dan biru digunakan dengan proporsi yang disiplin: biru untuk navigasi dan aksi utama, merah hanya untuk aksen dan bahaya
- **Data di depan** — angka dan tabel mendapat hierarki visual tertinggi
- **Status selalu jelas** — setiap elemen interaktif memiliki state yang terbaca: normal, hover, active, disabled, error, success

### Tone & Voice (UI Copy)

| Konteks | Hindari | Gunakan |
|---------|---------|---------|
| Tombol aksi | "Submit", "OK" | "Simpan Data", "Tambah Siswa" |
| Error | "Terjadi kesalahan" | "NISN tidak ditemukan. Periksa kembali." |
| Empty state | — | "Belum ada siswa terlambat hari ini." |
| Konfirmasi hapus | "Yakin?" | "Hapus data Ahmad Rizki? Tindakan ini tidak bisa dibatalkan." |

---

## 2. Design Tokens

### 2.1 Color Palette

```
Primary Palette
───────────────────────────────────────────────────
Blue-600     #2563EB   Navbar, CTA buttons, active state
Blue-50      #EFF6FF   Blue subtle background, info chips
Blue-700     #1D4ED8   Blue hover state

Red-600      #DC2626   Accent, danger, delete, alerts
Red-50       #FEF2F2   Red subtle background, error chips
Red-700      #B91C1C   Red hover state

Neutral Palette
───────────────────────────────────────────────────
Slate-900    #0F172A   Sidebar active, headings (H1)
Slate-800    #1E293B   Text primary (body)
Slate-500    #64748B   Text muted, labels, hints
Slate-300    #CBD5E1   Borders, dividers
Slate-100    #F1F5F9   Page background
White        #FFFFFF   Cards, modals, dropdowns

Status Colors
───────────────────────────────────────────────────
Green-600    #059669   Success, confirmed
Green-100    #D1FAE5   Success background
Amber-500    #F59E0B   Warning, pending
Amber-100    #FEF3C7   Warning background
```

### 2.2 Typography

```
Font Stack
───────────────────────────────────────
Display    : Inter, sans-serif
Body       : Inter, sans-serif
Monospace  : JetBrains Mono (NISN, kode)
```

| Token | Size | Weight | Line Height | Penggunaan |
|-------|------|--------|-------------|------------|
| `text-heading-1` | 24px | 700 | 1.2 | Page title |
| `text-heading-2` | 18px | 600 | 1.3 | Section heading, card title |
| `text-heading-3` | 15px | 600 | 1.4 | Sub-section, table header |
| `text-body` | 14px | 400 | 1.5 | Body text, form labels |
| `text-small` | 12px | 400 | 1.4 | Hints, muted info |
| `text-mono` | 13px | 500 | 1.4 | NISN, kode QR |

### 2.3 Spacing Scale (4px grid)

| Token | Value | Penggunaan |
|-------|-------|------------|
| `space-1` | 4px | Icon gap, inline spacing |
| `space-2` | 8px | Compact padding |
| `space-4` | 16px | Standard padding, gap antar form field |
| `space-6` | 24px | Card padding, section gap |
| `space-8` | 32px | Page padding, section separator |
| `space-12` | 48px | Hero spacing |

### 2.4 Elevation (Shadow)

| Level | Value | Penggunaan |
|-------|-------|------------|
| `shadow-sm` | `0 1px 2px rgba(0,0,0,0.05)` | Card default |
| `shadow-md` | `0 4px 6px rgba(0,0,0,0.07)` | Card hover, dropdown |
| `shadow-xl` | `0 20px 25px rgba(0,0,0,0.10)` | Modal, dialog |

### 2.5 Border Radius

| Token | Value | Penggunaan |
|-------|-------|------------|
| `rounded-sm` | 4px | Badge, chip, tag kecil |
| `rounded-md` | 6px | Input, select |
| `rounded-lg` | 8px | Button, alert |
| `rounded-xl` | 12px | Card |
| `rounded-2xl` | 16px | Modal, login card |

---

## 3. Layout Architecture

### 3.1 Shell Utama

```
┌──────────────────────────────────────────────────────────────┐
│  TOP NAVBAR (h-14, bg-blue-600, fixed)                       │
│  [☰] [LATELINK · SMAKENSA]          [🔔 3]  [👤 Admin ▾]   │
├─────────────┬────────────────────────────────────────────────┤
│  SIDEBAR    │  MAIN CONTENT                                   │
│  (w-64)     │  (bg-slate-100, p-6)                           │
│  bg-white   │                                                 │
│  shadow-r   │   ┌─ Page Header ─────────────────────────┐    │
│             │   │  <h1> + breadcrumb + page action btn   │    │
│  ─ MENU ─   │   └───────────────────────────────────────┘    │
│             │                                                 │
│  [📊 Dasbor]│   ┌─ Content Area ────────────────────────┐    │
│  [👥 Siswa] │   │                                        │    │
│  [📷 Scan]  │   │   Cards / Table / Form / Chart         │    │
│  ─ MASTER ─ │   │                                        │    │
│  [🏫 Kelas] │   └───────────────────────────────────────┘    │
│  [📚 Jurusn]│                                                 │
│  ─ ADMIN ─  │                                                 │
│  [👤 User]  │                                                 │
│  [⚙️ Log]   │                                                 │
└─────────────┴────────────────────────────────────────────────┘
```

### 3.2 Navbar

| Elemen | Detail |
|--------|--------|
| Background | `bg-blue-600` |
| Height | `h-14` (56px) |
| Posisi | `fixed top-0 left-0 right-0 z-50` |
| Kiri | Hamburger toggle + Logo text "LATELINK" (white, font-bold) + divider + "SMAKENSA" (white/70) |
| Kanan | Notification bell dengan badge merah · Avatar dropdown (Nama + Role + Logout) |
| Shadow | `shadow-md` |

### 3.3 Sidebar

| Elemen | Detail |
|--------|--------|
| Width | `w-64` (256px) desktop, off-canvas mobile |
| Background | `bg-white` |
| Posisi | `fixed left-0 top-14 bottom-0` |
| Shadow | `shadow-r-sm` (border-right) |
| Menu groups | Uppercase label `text-xs font-semibold text-slate-400 tracking-widest px-4 mb-2` |
| Menu item | `flex items-center gap-3 px-4 py-2.5 rounded-lg mx-2 text-slate-600` |
| Active item | `bg-blue-600 text-white font-medium` |
| Hover item | `bg-slate-100 text-slate-900` |
| Icon | 18px, warna mengikuti teks |

**Struktur Menu Sidebar:**
```
── UTAMA ────────────────────
  📊  Dashboard
  👥  Data Siswa
  📷  Scan Keterlambatan
  ⏰  Rekap Keterlambatan

── MASTER DATA ──────────────
  🏫  Kelas
  📚  Jurusan

── MANAJEMEN ────────────────
  👤  Pengguna            [Admin only]
```

> **Catatan:** Menu "Pengguna" hanya muncul jika `role_id == 1` (admin).

### 3.4 Page Header

Setiap halaman memiliki page header seragam di bawah navbar:

```
┌──────────────────────────────────────────────────────────────┐
│  ← Beranda / Kelola Data Siswa                               │
│  Kelola Data Siswa               [+ Tambah Siswa]           │
└──────────────────────────────────────────────────────────────┘
```

- Breadcrumb: `text-sm text-slate-500`
- H1: `text-2xl font-bold text-slate-900`
- CTA button: di kanan, merah untuk aksi utama halaman tersebut

---

## 4. Component Library

### 4.1 Buttons

```
Variant   Example                      CSS Classes
──────────────────────────────────────────────────────────────
Primary   [  Simpan Data  ]            bg-blue-600 hover:bg-blue-700 text-white
Danger    [  Hapus  ]                  bg-red-600 hover:bg-red-700 text-white
Outline   [  Batal  ]                  border border-slate-300 text-slate-700 hover:bg-slate-50
Outline   [  Batal  ]  (red)           border border-red-600 text-red-600 hover:bg-red-50
Ghost     [  Lihat  ]                  text-blue-600 hover:underline hover:bg-blue-50
Icon-btn  [ 🖊 ]  [ 🗑 ]             p-2 rounded-md, blue/red icon
──────────────────────────────────────────────────────────────
Semua: rounded-lg px-4 py-2 text-sm font-medium transition-colors duration-150
Small:  px-3 py-1.5 text-xs
```

**State terdisabled:** `opacity-50 cursor-not-allowed pointer-events-none`

### 4.2 Form Inputs

```
Label + Input
─────────────────────────────────────────────
<label>  Nama Siswa *
         ┌──────────────────────────────────┐
         │ Ahmad Rizki Pratama              │
         └──────────────────────────────────┘
         hint text (text-xs text-slate-400)
```

| State | Border |
|-------|--------|
| Default | `border-slate-300` |
| Focus | `border-blue-500 ring-2 ring-blue-100` |
| Error | `border-red-500 ring-2 ring-red-100` |
| Disabled | `bg-slate-100 text-slate-400 cursor-not-allowed` |

**Error message:** `text-xs text-red-600 mt-1 flex items-center gap-1` + icon ⚠️

### 4.3 Cards

```
┌─ Card ──────────────────────────────────────────────┐
│  Card Title                          [Action btn]   │
│  ─────────────────────────────────────────────────  │
│  Content area (p-6)                                 │
│                                                     │
└─────────────────────────────────────────────────────┘
CSS: bg-white rounded-xl shadow-sm border border-slate-200
```

**Stat Card:**
```
┌────────────────────────────┐
│  📊                    ↗   │
│  247                       │
│  Total Siswa               │
│  ─────────────────         │
│  +3 dari kemarin           │
└────────────────────────────┘
```

### 4.4 Badges & Status Chips

```
Variant      Contoh                  CSS
──────────────────────────────────────────────────────
Merah        [● Terlambat]          bg-red-100 text-red-700 rounded-full px-2.5 py-0.5 text-xs font-medium
Hijau        [● Hadir]              bg-green-100 text-green-700
Amber        [● Pending]            bg-amber-100 text-amber-700
Biru         [● Admin]              bg-blue-100 text-blue-700
Abu          [● Tidak Aktif]        bg-slate-100 text-slate-600
```

### 4.5 Tables

```
┌──────────────────────────────────────────────────────┐
│  [🔍 Cari siswa...]              [CSV] [Excel]       │
├──────────────────────────────────────────────────────┤
│  No  │  Nama Siswa   │  NISN     │  Kelas  │  Aksi  │
│      │  (sortable ↕) │           │         │        │
├──────┼───────────────┼───────────┼─────────┼────────┤
│   1  │  Ahmad Rizki  │  0012345  │  X RPL  │ 🖊 🗑  │
│   2  │  Bunga Citra  │  0012346  │  X RPL  │ 🖊 🗑  │
├──────────────────────────────────────────────────────┤
│  Menampilkan 1–10 dari 247     [< 1 2 3 ... >]       │
└──────────────────────────────────────────────────────┘
```

- Header: `bg-slate-50 text-slate-600 text-xs font-semibold uppercase tracking-wide`
- Row hover: `hover:bg-blue-50 transition-colors`
- Striping: tidak digunakan (hover lebih bersih)
- Pagination: `text-sm`, active page `bg-blue-600 text-white rounded-md`

### 4.6 Alerts & Toast Notifications

```
Inline Alert (full-width):
┌─ ✅ ─────────────────────────────────────────── ✕ ─┐
│  Data siswa berhasil disimpan.                      │
└─────────────────────────────────────────────────────┘

Toast (pojok kanan bawah, auto-dismiss 3s):
                              ┌──────────────────────┐
                              │ ✅  Berhasil disimpan │
                              └──────────────────────┘
```

| Type | Icon | Warna |
|------|------|-------|
| Success | ✅ | `bg-green-50 border-green-200 text-green-800` |
| Error | ❌ | `bg-red-50 border-red-200 text-red-800` |
| Warning | ⚠️ | `bg-amber-50 border-amber-200 text-amber-800` |
| Info | ℹ️ | `bg-blue-50 border-blue-200 text-blue-800` |

### 4.7 Modal / Dialog

```
                      ┌──────────────────────────────┐
▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓│  Hapus Data Siswa          ✕ │▓▓▓▓▓
▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓│──────────────────────────────│▓▓▓▓▓
▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓│                              │▓▓▓▓▓
▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓│  Hapus data Ahmad Rizki?     │▓▓▓▓▓
▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓│  Tindakan ini tidak bisa     │▓▓▓▓▓
▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓│  dibatalkan.                 │▓▓▓▓▓
▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓│                              │▓▓▓▓▓
▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓│   [Batal]    [Hapus Data]    │▓▓▓▓▓
▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓└──────────────────────────────┘▓▓▓▓▓
```

- Overlay: `bg-slate-900/60 backdrop-blur-sm`
- Modal: `bg-white rounded-2xl shadow-xl max-w-md w-full p-6`
- Tombol konfirmasi destruktif: `bg-red-600`

### 4.8 Empty States

```
┌─────────────────────────────────────────────────────┐
│                                                     │
│                  📭                                 │
│                                                     │
│       Belum ada siswa terlambat hari ini.           │
│       Scan QR siswa untuk mencatat keterlambatan.   │
│                                                     │
│               [Mulai Scan QR]                       │
│                                                     │
└─────────────────────────────────────────────────────┘
```

### 4.9 Loading States

- **Skeleton:** `animate-pulse bg-slate-200 rounded` mengisi area loading
- **Spinner inline:** `animate-spin border-2 border-blue-600 border-t-transparent rounded-full w-4 h-4`
- **Full-page loader:** spinner centered di atas overlay semi-transparan

---

## 5. Page-by-Page Specification

### 5.1 Login Page (`GET /`)

**Route:** `LoginController@login` · `POST /login/exceute`

```
┌──────────────────────────────────────────────────────────────┐
│                                                              │
│  ╔══════════════════════════════════════════╗               │
│  ║                                          ║               │
│  ║   🏫                                    ║               │
│  ║   LATELINK                              ║               │
│  ║   SMKN 1 Bondowoso                      ║               │
│  ║                                          ║               │
│  ║   ┌────────────────────────────────┐    ║               │
│  ║   │ 👤  Username                   │    ║               │
│  ║   └────────────────────────────────┘    ║               │
│  ║   ┌────────────────────────────────┐    ║               │
│  ║   │ 🔒  Password            [👁]   │    ║               │
│  ║   └────────────────────────────────┘    ║               │
│  ║                                          ║               │
│  ║   [  Masuk ke Sistem  ]  (full-width)   ║               │
│  ║                                          ║               │
│  ║   ── atau ──                            ║               │
│  ║   ⚠️ Username / password salah          ║  (if error)   │
│  ║                                          ║               │
│  ╚══════════════════════════════════════════╝               │
│                                                              │
│  Background: gradient diagonal #2563EB → #7C3AED → #DC2626  │
│  (biru ke ungu ke merah — warna merah SMKN1)                │
└──────────────────────────────────────────────────────────────┘
```

**Spesifikasi:**
- Background: `bg-gradient-to-br from-blue-600 via-violet-700 to-red-600`, full-screen
- Login card: `bg-white/95 backdrop-blur rounded-2xl shadow-2xl p-8 w-full max-w-sm`
- Logo icon: glyph jam atau QR code, warna biru
- Input field: `rounded-lg border border-slate-300`, icon leading, reveal-password toggle
- Submit button: `bg-blue-600 w-full`, teks "Masuk ke Sistem"
- Auth menggunakan `name + password` (sesuai `Auth::attempt` di `LoginController`)
- Error: alert merah `bg-red-50 border-red-200` di atas form, **bukan** di bawah input individual
- Footer card: `text-xs text-slate-400 text-center mt-4` — "© 2024 SMKN 1 Bondowoso"

---

### 5.2 Dashboard (`GET /dashboard`)

**Route:** `AllController@dash` · **Role:** Admin & Operator

```
┌──────────────────────────────────────────────────────────────┐
│  Dashboard                                                   │
│  Senin, 08 Januari 2024                                      │
│                                                              │
│  ┌──────────────┐ ┌──────────────┐ ┌──────────────┐ ┌────── │
│  │ 📊           │ │ ⏰           │ │ 📅           │ │ 🗓    │
│  │ 247          │ │ 12           │ │ 47           │ │ 184   │
│  │ Total Siswa  │ │ Telat Hari   │ │ Telat Minggu │ │ Telat │
│  │              │ │ Ini          │ │ Ini          │ │ Bulan │
│  └──────────────┘ └──────────────┘ └──────────────┘ └────── │
│                                                              │
│  ┌─ Grafik Keterlambatan Mingguan ──────────────────────┐    │
│  │  (Chart.js Bar Chart)                                │    │
│  │                                                      │    │
│  │    40 ┤   ██                                        │    │
│  │    30 ┤   ██  ██                                    │    │
│  │    20 ┤   ██  ██  ██  ██                            │    │
│  │    10 ┤   ██  ██  ██  ██  ██  ██                   │    │
│  │       └──────────────────────────────               │    │
│  │         Sen Sel Rab Kam Jum Sab                     │    │
│  │                                                     │    │
│  │  ● Bar: bg-blue-500 · ● Tertinggi: bg-red-500       │    │
│  └──────────────────────────────────────────────────── ┘    │
│                                                              │
│  ┌─ Siswa Paling Sering Telat ─┐  ┌─ Telat per Jurusan ──┐  │
│  │  # │ Nama       │ Telat     │  │  (Donut Chart.js)    │  │
│  │  1 │ Ahmad R.   │ ██ 8x     │  │                      │  │
│  │  2 │ Bunga C.   │ ██ 6x     │  │   RPL  ●  42%        │  │
│  │  3 │ Dani S.    │ ██ 5x     │  │   TKJ  ●  31%        │  │
│  └────────────────────────────┘  │   TKR  ●  27%        │  │
│                                  └──────────────────────┘  │
└──────────────────────────────────────────────────────────────┘
```

**Spesifikasi:**
- 4 stat card: `grid grid-cols-2 lg:grid-cols-4 gap-4`
  - Tiap card: icon warna biru (bg-blue-50), angka besar `text-3xl font-bold text-slate-900`, label `text-sm text-slate-500`
  - Kecuali "Telat Hari Ini": angka berwarna merah jika > 0
- Bar Chart: data dari query mingguan sesuai `dash()` di AllController
  - Bar default: `rgba(37, 99, 235, 0.8)` (biru)
  - Bar dengan nilai tertinggi: `rgba(220, 38, 38, 0.9)` (merah)
- Bottom grid: `grid grid-cols-1 lg:grid-cols-2 gap-6`
- Top-late table: 5 siswa teratas berdasarkan kolom `Telat` di `datasiswa`
- Donut chart: breakdown per `jurusan_id`

---

### 5.3 Halaman Kelola Siswa (`GET /manage`)

**Route:** `AllController@manage` · **Role:** Admin & Operator

```
┌──────────────────────────────────────────────────────────────┐
│  Kelola Data Siswa                    [+ Tambah Siswa]       │
│                                                              │
│  ┌──────────────────────────────────────────────────────┐   │
│  │  [🔍 Cari nama atau NISN...]    [📥 Export ▾]        │   │
│  ├──────┬────────────────┬───────────┬────────┬─────────┤   │
│  │  No  │  Nama Siswa ↕  │  NISN     │ Kelas  │  Aksi  │   │
│  ├──────┼────────────────┼───────────┼────────┼─────────┤   │
│  │   1  │  Ahmad Rizki   │  00123    │ X RPL  │ 🖊  🗑  │   │
│  │   2  │  Bunga Citra   │  00124    │ X TKJ  │ 🖊  🗑  │   │
│  │   3  │  Candra Purn.  │  00125    │ XI RPL │ 🖊  🗑  │   │
│  ├──────────────────────────────────────────────────────┤   │
│  │  Menampilkan 1–10 dari 247 siswa    [< 1 2 3 ... >]  │   │
│  └──────────────────────────────────────────────────────┘   │
│                                                              │
│   [🔴 Reset Semua Counter Telat]   (pojok kiri bawah)       │
└──────────────────────────────────────────────────────────────┘
```

**Spesifikasi:**
- Tombol "+ Tambah Siswa": `bg-red-600` (merah, aksen utama halaman)
- Tombol Edit: icon `pencil`, `text-blue-600 hover:bg-blue-50`
- Tombol Hapus: icon `trash`, `text-red-600 hover:bg-red-50`
  - Klik hapus → modal konfirmasi dengan nama siswa
- "Reset Semua Counter Telat": `border border-red-600 text-red-600` (outline merah), klik → modal konfirmasi
  - Memanggil `POST /reset-telat` → `AllController@reset`
- Export dropdown: CSV dan Excel
- DataTable: client-side, bukan yajra (sesuai implementasi aktual)
- Kolom "Kelas" menampilkan `Tingkat_kelas + ' ' + Nama_kelas`

---

### 5.4 Form Tambah / Edit Siswa

**Route:** `GET /create/data` · `POST /create/action/data`

```
┌──────────────────────────────────────────────────────────────┐
│  ← Kelola Data Siswa / Tambah Siswa Baru                     │
│  Tambah Siswa Baru                                           │
│                                                              │
│  ┌─ Informasi Pribadi ──────────────────────────────────┐   │
│  │                                                      │   │
│  │  NISN *                  Nama Siswa *                │   │
│  │  ┌───────────────────┐   ┌───────────────────────┐  │   │
│  │  │ (angka 10 digit)  │   │ Nama lengkap siswa    │  │   │
│  │  └───────────────────┘   └───────────────────────┘  │   │
│  │                                                      │   │
│  │  Jenis Kelamin *         Alamat                      │   │
│  │  ○ Laki-laki             ┌───────────────────────┐  │   │
│  │  ○ Perempuan             │                       │  │   │
│  │                          └───────────────────────┘  │   │
│  │                                                      │   │
│  │  No. HP Siswa                                        │   │
│  │  ┌───────────────────────────────────────────────┐  │   │
│  │  └───────────────────────────────────────────────┘  │   │
│  └──────────────────────────────────────────────────── ┘   │
│                                                              │
│  ┌─ Kelas & Jurusan ────────────────────────────────────┐   │
│  │  Kelas *                 Jurusan *                   │   │
│  │  ┌── Select ──────────┐  ┌── Select ──────────────┐  │   │
│  │  │ Pilih kelas ▾      │  │ Pilih jurusan ▾        │  │   │
│  │  └───────────────────┘   └───────────────────────┘  │   │
│  └──────────────────────────────────────────────────── ┘   │
│                                                              │
│  ┌─ Data Orang Tua ─────────────────────────────────────┐   │
│  │  Nama Ayah               Nama Ibu                    │   │
│  │  ┌───────────────────┐   ┌───────────────────────┐  │   │
│  │  └───────────────────┘   └───────────────────────┘  │   │
│  │                                                      │   │
│  │  No. HP Ayah             No. HP Ibu                  │   │
│  │  ┌───────────────────┐   ┌───────────────────────┐  │   │
│  │  └───────────────────┘   └───────────────────────┘  │   │
│  └──────────────────────────────────────────────────── ┘   │
│                                                              │
│                            [Batal]  [  Simpan Siswa  ]      │
└──────────────────────────────────────────────────────────────┘
```

**Spesifikasi:**
- Layout: dikelompokkan dalam 3 section card (Pribadi, Kelas/Jurusan, Orang Tua)
- Grid form: `grid grid-cols-1 md:grid-cols-2 gap-4` per section
- NISN: `type="text" maxlength="20" pattern="[0-9]+"` + monospace font
- Select Kelas: populated dari `kelas` table (menampilkan `Tingkat_kelas + Nama_kelas`)
- Select Jurusan: populated dari `jurusan` table
- Tombol "Simpan Siswa": `bg-blue-600`
- Tombol "Batal": `border border-slate-300 text-slate-600`
- Validasi error: per-field `text-xs text-red-600`

---

### 5.5 QR Scanner (`GET /Scan/Siswa`)

**Route:** `QrController@scanSiswa` + `QrController@scanacti`

```
┌──────────────────────────────────────────────────────────────┐
│  Scan Keterlambatan                                           │
│  Beranda / Scan Keterlambatan                                 │
│                                                              │
│  ┌ Pindai QR Siswa ──────────────── [● Kamera] ──────────┐  │
│  │                                                        │  │
│  │   ┌──────────────────────────────────────────────┐    │  │
│  │   │                                              │    │  │
│  │   │           ┌──┐                    ┌──┐       │    │  │
│  │   │           └──┘                    └──┘       │    │  │
│  │   │               [Camera Viewport]              │    │  │
│  │   │                    ────                      │    │  │
│  │   │           ┌──┐                    ┌──┐       │    │  │
│  │   │           └──┘                    └──┘       │    │  │
│  │   │                                              │    │  │
│  │   └──────────────────────────────────────────────┘    │  │
│  │                                                        │  │
│  │  Arahkan QR code ke dalam bingkai kamera               │  │
│  └────────────────────────────────────────────────────────┘  │
│                                                              │
│  ┌─ Hasil Scan ──────────────────────────────────────────┐   │
│  │  ✅  Ahmad Rizki Pratama                              │   │
│  │      NISN: 0012345 · X RPL                            │   │
│  │      Tercatat terlambat — 08 Jan 2024, 07:34 WIB      │   │
│  └───────────────────────────────────────────────────────┘   │
│                                                              │
│  atau                                                        │
│                                                              │
│  ┌─ ⚠️ ──────────────────────────────────────────────────┐  │
│  │  Ahmad Rizki Pratama                                   │  │
│  │  Sudah tercatat terlambat hari ini.                    │  │
│  └───────────────────────────────────────────────────────┘  │
│                                                              │
│  atau                                                        │
│                                                              │
│  ┌─ ❌ ──────────────────────────────────────────────────┐  │
│  │  NISN tidak ditemukan.                                 │  │
│  │  Pastikan kartu siswa terdaftar di sistem.            │  │
│  └───────────────────────────────────────────────────────┘  │
└──────────────────────────────────────────────────────────────┘
```

**Spesifikasi:**
- Layout: `max-w-lg mx-auto` — mobile-first, full-width on small screens, centered on desktop
- Scanner card: `bg-white rounded-xl shadow-sm border border-slate-200`, padding `p-4 sm:p-5`
- Header: title "Pindai QR Siswa" (left) + live status badge (right)
  - Status badge: `bg-slate-100 text-slate-500` (idle) / `bg-green-50 text-green-700` (scanning)
  - Status dot: `w-1.5 h-1.5 rounded-full`, grey when idle, green when active
- Scan guide overlay: 4 corner brackets (`w-8 h-8 border-2 border-blue-400`) in a 256-280px square
  - Animated scan line: `w-0.5 h-8 bg-blue-400/50 rounded-full animate-pulse` centered vertically
- Hint text: "Arahkan QR code ke dalam bingkai kamera" (centered, `text-xs text-slate-400`)
- QR scanner: `html5-qrcode` v2.3.8 (CDN), auto-start via `Html5QrcodeScanner`
- Camera toggle button: styled with `::before` pseudo-element using Font Awesome `\f0c6` (paperclip) icon — no MutationObserver hack needed
- Camera selector dropdown: `border-slate-300`, rounded, focus ring blue
- **Hasil sukses (hijau):** `bg-green-50 border border-green-200 rounded-xl p-4`, slide-up animation
  - Icon: checkmark circle SVG `w-9 h-9`
  - Nama siswa: `font-semibold text-green-800 text-sm`
  - NISN + kelas: `text-xs text-green-700`
  - Timestamp: "Tercatat terlambat — 08 Jan 2024, 07:34 WIB" (`text-xs text-green-600`)
  - Dismiss button: `text-green-400 hover:text-green-600`
- **Hasil duplikat (amber):** `bg-amber-50 border border-amber-200 rounded-xl p-4`, fade-in animation
  - Icon: warning triangle SVG
  - Message: "Sudah tercatat terlambat hari ini."
- **Hasil error (merah):** `bg-red-50 border border-red-200 rounded-xl p-4`, shake animation
  - Icon: X circle SVG
  - Message: "NISN tidak ditemukan. Pastikan kartu siswa terdaftar di sistem."
- Scan action: `POST /qrscan/action` → `QrController@scanacti`
- Setelah scan sukses: hasil tetap tampil, kamera siap scan berikutnya (tidak reload page — flash session)
- **Responsive:** Scanner viewport fills available width on mobile, capped at `max-w-lg` (32rem) on desktop.
  - QR box size: 280x280px (shrinks proportionally on small viewports via html5-qrcode)
- **Live status update:** JavaScript interval (500ms) reads html5-qrcode's native status span and updates the status badge accordingly
- Scan overlay hidden until video stream is ready (`readyState >= 2`)

---

### 5.6 QR Code Siswa (`GET /qrcode/{id}`)

**Route:** `AllController@qrCode($id)`

```
┌──────────────────────────────────────────────────────────────┐
│  QR Code Siswa                              [← Kembali]      │
│                                                              │
│  ┌─────────────────────────────────────────────────────┐    │
│  │                                                     │    │
│  │  Ahmad Rizki Pratama                                │    │
│  │  NISN: 0012345 · X RPL · SMKN 1 Bondowoso         │    │
│  │                                                     │    │
│  │  ┌───────────────────────────────────────────────┐ │    │
│  │  │                                               │ │    │
│  │  │         ┌─────────────────────┐               │ │    │
│  │  │         │                     │               │ │    │
│  │  │         │    [QR Code SVG]    │               │ │    │
│  │  │         │    (dari NISN)      │               │ │    │
│  │  │         │                     │               │ │    │
│  │  │         └─────────────────────┘               │ │    │
│  │  │                                               │ │    │
│  │  │          [🖨️ Cetak]   [⬇️ Download PNG]      │ │    │
│  │  └───────────────────────────────────────────────┘ │    │
│  └─────────────────────────────────────────────────── ┘    │
└──────────────────────────────────────────────────────────────┘
```

**Spesifikasi:**
- QR code di-generate oleh `simplesoftwareio/simple-qrcode` dari `Nisn` siswa
- Nama + NISN + Kelas tampil di atas QR code, sebagai header identitas
- Tombol "Cetak": trigger `window.print()` dengan print stylesheet yang menyembunyikan navbar/sidebar
- Tombol "Download PNG": konversi SVG QR ke canvas lalu download

---

### 5.7 Rekap Keterlambatan (`GET /qrscan/lateSiswa`)

**Route:** `QrController@lateTable`

```
┌──────────────────────────────────────────────────────────────┐
│  Rekap Keterlambatan                                         │
│                                                              │
│  ┌─ Filter ─────────────────────────────────────────────┐   │
│  │  [🔍 Cari nama...]  [📅 Pilih tanggal]  [📚 Jurusan] │   │
│  └──────────────────────────────────────────────────────┘   │
│                                                              │
│  ┌──────────────────────────────────────────────────────┐   │
│  │  No │ Nama Siswa  │ NISN   │ Kelas │ Tanggal │ Telat │   │
│  ├─────┼─────────────┼────────┼───────┼─────────┼───────┤   │
│  │  1  │ Ahmad R.    │ 00123  │ X RPL │ 08/1/24 │  3x   │   │
│  │  2  │ Candra P.   │ 00125  │ XIRPL │ 08/1/24 │  2x   │   │
│  ├──────────────────────────────────────────────────────┤   │
│  │  Menampilkan 1–10 dari 34        [< 1 2 3 ... >]     │   │
│  └──────────────────────────────────────────────────────┘   │
│                                                              │
│  [🔴 Reset Semua Counter]           [📥 Export Excel]       │
└──────────────────────────────────────────────────────────────┘
```

**Spesifikasi:**
- Filter tanggal: date picker native `<input type="date">`
- Filter jurusan: select dropdown populated dari `jurusan` table
- Kolom "Telat": badge merah jika ≥ 3, amber jika 2, hijau jika 1
- Tombol "Reset Semua Counter": memanggil `POST /reset-telat`, modal konfirmasi dahulu
- Export: generate Excel dari data yang tersaring

---

### 5.8 Manajemen Kelas (`GET /kelas/manage`)

**Route:** `kelasController@kelas`

```
┌──────────────────────────────────────────────────────────────┐
│  Manajemen Kelas                          [+ Tambah Kelas]   │
│                                                              │
│  ┌─ Tambah Kelas (inline form) ─────────────────────────┐   │
│  │  Tingkat  ┌────────┐  Nama Kelas ┌────────────────┐  │   │
│  │           │ X  ▾   │             │ RPL 1          │  │   │
│  │           └────────┘             └────────────────┘  │   │
│  │  Wali Kelas ┌──────────────────────────┐ [Simpan]   │   │
│  │             │ Nama guru                │            │   │
│  │             └──────────────────────────┘            │   │
│  └──────────────────────────────────────────────────── ┘   │
│                                                              │
│  ┌─ Daftar Kelas ───────────────────────────────────────┐   │
│  │  No │ Tingkat │ Nama Kelas │ Wali Kelas │   Aksi     │   │
│  ├─────┼─────────┼────────────┼────────────┼────────────┤   │
│  │  1  │    X    │   RPL 1    │ Bu Sari    │  🖊  🗑    │   │
│  │  2  │    X    │   TKJ 1    │ Pak Budi   │  🖊  🗑    │   │
│  └──────────────────────────────────────────────────────┘   │
└──────────────────────────────────────────────────────────────┘
```

**Spesifikasi:**
- Tingkat Kelas: select `[X, XI, XII]`
- Form inline di atas tabel (collapsed by default, expand saat klik "+ Tambah")
- Hapus: modal konfirmasi; jika kelas masih memiliki siswa, tampilkan error

---

### 5.9 Manajemen Jurusan (`GET /jurusan/manage`)

**Route:** `jurusanController@jurusan`

Sama dengan pola Manajemen Kelas, dengan kolom:
- Nama Jurusan (`Nama_jurusan`)
- Kepala Program (`Nama_kaproli`)
- Aksi (Edit, Hapus)

---

### 5.10 Manajemen Pengguna (`GET /dashboard`) [Admin Only]

**Route:** `AllController@dash`, `dashCreate`, `dashUpdate`, `dashDelete`

```
┌──────────────────────────────────────────────────────────────┐
│  Manajemen Pengguna                    [+ Tambah Pengguna]   │
│                                                              │
│  ┌──────────────────────────────────────────────────────┐   │
│  │  No │ Nama        │ Email         │ Role     │ Aksi  │   │
│  ├─────┼─────────────┼───────────────┼──────────┼───────┤   │
│  │  1  │ Admin       │ admin@...     │ [Admin]  │ 🖊 🗑 │   │
│  │  2  │ Operator    │ op@...        │ [Operat] │ 🖊 🗑 │   │
│  └──────────────────────────────────────────────────────┘   │
└──────────────────────────────────────────────────────────────┘
```

**Spesifikasi:**
- Halaman ini hanya dapat diakses jika `Auth::user()->role_id == 1`
- Role badge: biru untuk Admin, abu untuk Operator
- Menu sidebar untuk halaman ini hanya muncul untuk role admin

---

## 6. Navigation & States

### 6.1 Breadcrumb

Semua halaman non-dashboard menggunakan breadcrumb:
```
Beranda / Kelola Data Siswa / Tambah Siswa
```
Format: `text-sm text-slate-500`, separator `/`, halaman aktif `text-slate-800 font-medium`

### 6.2 Sidebar Active States

| Kondisi | Style |
|---------|-------|
| Link aktif | `bg-blue-600 text-white font-medium rounded-lg` |
| Link hover | `bg-slate-100 text-slate-900 rounded-lg` |
| Link default | `text-slate-600` |
| Group label | `text-xs text-slate-400 uppercase tracking-widest` |

### 6.3 Page-Level Permissions

| Halaman | Admin | Operator |
|---------|-------|----------|
| Dashboard | ✅ | ✅ |
| Kelola Siswa | ✅ | ✅ |
| Tambah/Edit Siswa | ✅ | ✅ |
| Reset Telat | ✅ | ❌ |
| QR Scan | ✅ | ✅ |
| QR Code Display | ✅ | ✅ |
| Rekap Keterlambatan | ✅ | ✅ |
| Manajemen Kelas | ✅ | ❌ |
| Manajemen Jurusan | ✅ | ❌ |
| Manajemen Pengguna | ✅ | ❌ |

> Implementasi: pengecekan `Auth::user()->role_id == 1` di controller method terkait.

---

## 7. Responsive Behavior

| Breakpoint | Layout |
|------------|--------|
| `≥ 1024px` | Sidebar permanen, konten penuh `ml-64` |
| `768–1023px` | Sidebar off-canvas (slide-in dari kiri), hamburger toggle di navbar |
| `< 768px` | Sidebar off-canvas, stat cards 2-kolom, tabel scroll horizontal, form satu kolom |

**Mobile-specific:**
- Navbar: hanya logo + hamburger
- Bottom sheet untuk modal konfirmasi (bukan center dialog)
- QR scanner mengisi layar penuh
- Tombol aksi tabel: icon saja (tanpa label teks)

---

## 8. Transitions & Animations

| Elemen | Animasi | Durasi |
|--------|---------|--------|
| Page load | Fade-in `opacity-0 → 1` | 150ms |
| Sidebar toggle | Slide `translateX(-100% → 0)` | 250ms ease |
| Modal buka | Scale `0.95 → 1` + fade | 200ms |
| Modal tutup | Reverse + fade | 150ms |
| Toast masuk | Slide dari kanan `translateX(100% → 0)` | 200ms |
| Toast keluar | Fade out setelah 3 detik | 150ms |
| Button hover | Background transition | 150ms |
| Scan result | Slide dari bawah `translateY(20px → 0)` + fade | 250ms |
| Scan error | Shake `@keyframes shake` 3x | 300ms |
| Row hover | `bg-blue-50` transition | 100ms |
| Skeleton | Shimmer `animate-pulse` | loop |

**Prinsip:** Semua animasi menggunakan `transition` CSS. Tidak ada animasi saat `prefers-reduced-motion: reduce`.

---

## 9. Accessibility

| Aspek | Implementasi |
|-------|--------------|
| Focus ring | `focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2` di semua elemen interaktif |
| Kontras warna | Semua kombinasi teks ≥ 4.5:1 (WCAG AA) |
| Label form | `<label for="...">` eksplisit untuk setiap input |
| Error handling | `aria-invalid="true"` + `aria-describedby` ke pesan error |
| Modal trap | Focus dikunci dalam modal saat terbuka |
| Skip link | `<a href="#main-content">` tersembunyi, muncul saat fokus |
| Semantic HTML | `<nav>`, `<main>`, `<header>`, `<section>`, `<article>` |
| Tabel | `<thead>`, `<th scope="col">`, `<caption>` |
| Tombol icon | `aria-label` wajib untuk tombol tanpa label teks |
| Reduced motion | Semua `transition` dibungkus `@media (prefers-reduced-motion: no-preference)` |

---

## 10. Implementation Roadmap

### Phase 1 — Foundation (Minggu 1–2)
- [ ] Install Tailwind CSS v3 + konfigurasi `tailwind.config.js` dengan design tokens
- [ ] Hapus AdminLTE 3, ganti dengan master layout Tailwind
- [ ] Buat Blade components dasar: `<x-button>`, `<x-card>`, `<x-input>`, `<x-select>`, `<x-badge>`, `<x-alert>`, `<x-modal>`
- [ ] Buat layout: navbar, sidebar, page-header
- [ ] Redesign login page

### Phase 2 — Core Pages (Minggu 3–4)
- [ ] Dashboard + stat cards + Chart.js integration
- [ ] Kelola Siswa (tabel + search)
- [ ] Form Tambah/Edit Siswa
- [ ] QR Scanner page
- [ ] QR Code display page
- [ ] Rekap Keterlambatan

### Phase 3 — Master & Admin (Minggu 5)
- [ ] Manajemen Kelas
- [ ] Manajemen Jurusan
- [ ] Manajemen Pengguna (admin-only)
- [ ] 404 page

### Phase 4 — Polish (Minggu 6)
- [ ] Loading skeletons
- [ ] Empty states
- [ ] Toast notification system
- [ ] Responsive refinements mobile
- [ ] Print stylesheet untuk QR code
- [ ] Accessibility audit

---

## 11. Before vs After Comparison

| Aspek | Before (AdminLTE 3) | After (Tailwind CSS) |
|-------|---------------------|----------------------|
| CSS bundle | ~500KB (semua plugin) | ~50KB (purged) |
| JS bundle | ~1.5MB (jQuery + plugins) | ~200KB (Alpine.js atau vanilla) |
| Page load | 3–5 detik | < 1 detik |
| Customization | Sulit (cascade override) | Mudah (utility classes) |
| Color scheme | Dark teal/gray | Biru + Merah (institusi) |
| Responsive | Cukup | Excellent |
| Bootstrap version | 4 (mixed dengan BS5) | Tidak diperlukan |
| Component reuse | Partial (AdminLTE widgets) | Full (Blade components) |
| Accessibility | Minimal | WCAG AA compliant |
| Print support | Tidak ada | Ya (QR code print) |

---

## 12. Blade Component Structure

```
app/
└── View/
    └── Components/
        ├── Button.php       # variant: primary|danger|outline|ghost, size: sm|md|lg
        ├── Card.php         # title, action slot
        ├── StatCard.php     # value, label, icon, variant: default|danger
        ├── Input.php        # label, hint, error, leading-icon
        ├── Select.php       # label, options, placeholder, error
        ├── Textarea.php     # label, hint, error
        ├── Modal.php        # id, title, size: sm|md|lg
        ├── Badge.php        # variant: blue|red|green|amber|gray
        ├── Alert.php        # type: success|error|warning|info, dismissible
        ├── Table.php        # wrapper dengan overflow handling
        ├── PageHeader.php   # title, breadcrumb, action slot
        └── EmptyState.php   # icon, title, description, action

resources/
└── views/
    ├── components/
    │   ├── button.blade.php
    │   ├── card.blade.php
    │   ├── stat-card.blade.php
    │   ├── input.blade.php
    │   ├── select.blade.php
    │   ├── textarea.blade.php
    │   ├── modal.blade.php
    │   ├── badge.blade.php
    │   ├── alert.blade.php
    │   ├── table.blade.php
    │   ├── page-header.blade.php
    │   └── empty-state.blade.php
    └── template/
        ├── master.blade.php   # layout utama (Tailwind)
        ├── navbar.blade.php
        └── sidebar.blade.php
```

**Contoh penggunaan komponen:**

```blade
{{-- Stat card --}}
<x-stat-card value="247" label="Total Siswa" icon="users" />
<x-stat-card value="{{ $telatHariIni }}" label="Telat Hari Ini"
             icon="clock" :variant="$telatHariIni > 0 ? 'danger' : 'default'" />

{{-- Tombol dengan variant --}}
<x-button variant="primary">Simpan Data</x-button>
<x-button variant="danger" size="sm">Hapus</x-button>

{{-- Alert dismissible --}}
<x-alert type="success" :dismissible="true">
    Data siswa berhasil disimpan.
</x-alert>

{{-- Modal konfirmasi hapus --}}
<x-modal id="confirm-delete" title="Hapus Data Siswa" size="sm">
    <p>Hapus data <strong>{{ $siswa->Nama_siswa }}</strong>? Tindakan ini tidak bisa dibatalkan.</p>
    <x-slot name="footer">
        <x-button variant="outline" @click="closeModal">Batal</x-button>
        <x-button variant="danger" wire:click="delete">Hapus Data</x-button>
    </x-slot>
</x-modal>
```

---

*LateLink SMAKENSA UI Redesign — Design Document v2.0*
*SMKN 1 Bondowoso · Laravel 9 + Tailwind CSS v3*