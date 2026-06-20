# LATELINK SMAKENSA — UI Redesign Document

## 1. Design Philosophy

Simple, colorful, and functional. Move away from the heavy AdminLTE 3 dependency toward a clean, modern UI with a vibrant red-and-blue color scheme. Every element should serve a purpose — no unnecessary bloat.

### Color Palette

| Role | Color | Hex | Usage |
|------|-------|-----|-------|
| Primary | Blue | `#2563EB` | Navbar, buttons, links, active states |
| Secondary | Red | `#DC2626` | Accent, alerts, badges, highlights |
| Background | Light Gray | `#F1F5F9` | Page background |
| Surface | White | `#FFFFFF` | Cards, modals, dropdowns |
| Text Primary | Dark Gray | `#1E293B` | Headings, body text |
| Text Muted | Gray | `#64748B` | Labels, hints, secondary info |
| Success | Green | `#10B981` | Positive states, confirmed |
| Warning | Amber | `#F59E0B` | Warning states, pending |
| Border | Light | `#E2E8F0` | Borders, dividers |

### Typography

- **Font:** Inter (sans-serif) — clean, modern, highly readable
- **Headings:** `font-bold`, tight letter-spacing
- **Body:** `font-normal`, `text-sm` (14px) for density, `text-base` (16px) for readability

### Spacing & Sizing

- Use a 4px grid: `p-2` (8px), `p-4` (16px), `p-6` (24px), `p-8` (32px)
- Cards with `rounded-xl` (12px radius) and subtle shadows
- Buttons: `rounded-lg` (8px), `px-4 py-2` standard, `px-3 py-1.5` for small

---

## 2. Layout Architecture

### 2.1 Overall Structure

```
┌─────────────────────────────────────────────────────┐
│  Top Navbar (blue #2563EB)                          │
│  Logo · Navigation Links · User Menu                │
├──────────┬──────────────────────────────────────────┤
│ Sidebar  │  Main Content Area                       │
│ (white)  │  (bg-slate-50)                           │
│          │                                          │
│ 📊 Graf  │  ┌─────┐ ┌─────┐ ┌─────┐ ┌─────┐       │
│ 👥 Data  │  │Card │ │Card │ │Card │ │Card │       │
│ 📷 Scan  │  └─────┘ └─────┘ └─────┘ └─────┘       │
│          │                                          │
│          │  ┌──────────────────────────────────┐    │
│          │  │  Table / Chart / Form             │    │
│          │  └──────────────────────────────────┘    │
└──────────┴──────────────────────────────────────────┘
```

### 2.2 Navbar

- Fixed top, full-width, blue (`#2563EB`) background
- Left: hamburger menu toggle + app logo/name "LATELINK" in white
- Right: notification bell (red badge), user avatar dropdown

### 2.3 Sidebar

- White background, shadow-right
- Icons in blue, text in dark gray
- Active link: blue background with white text
- Collapsible (hamburger toggle)
- Menu groups with small uppercase headers

### 2.4 Main Content

- Padding: `p-6` (24px)
- Max-width container: `max-w-7xl mx-auto`
- Background: `bg-slate-50`

### 2.5 Cards

- White background, `rounded-xl`, shadow-sm
- Header with title (blue text) + optional action button (red)
- Padding: `p-6`
- Stat cards: large number, label, colored icon

---

## 3. Component Design

### 3.1 Buttons

| Type | Style |
|------|-------|
| Primary | Blue (`bg-blue-600 hover:bg-blue-700`) |
| Danger / Accent | Red (`bg-red-600 hover:bg-red-700`) |
| Outline | Border only, blue or red |
| Ghost | Transparent, colored text on hover |

All buttons: `rounded-lg px-4 py-2 font-medium text-sm transition-colors duration-200`

### 3.2 Tables

- Striped rows (white + slate-50 alternating)
- Header row: blue background, white text
- `rounded-lg` overflow hidden
- Responsive (horizontal scroll on mobile)
- Search bar above table with blue border on focus

### 3.3 Forms

- Labels: `text-sm font-medium text-slate-700`
- Inputs: `rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500`
- Red border + red text on validation errors
- Submit button: blue primary
- Reset/cancel button: red outline

### 3.4 Alerts & Badges

| Type | Color |
|------|-------|
| Success | Green (`bg-green-100 text-green-800`) |
| Warning | Amber (`bg-amber-100 text-amber-800`) |
| Error | Red (`bg-red-100 text-red-800`) |
| Info | Blue (`bg-blue-100 text-blue-800`) |

### 3.5 Modal / Dialog

- Overlay: `bg-black/50`
- Modal: white, `rounded-xl`, `shadow-2xl`
- Title: blue, bold
- Close button: top-right, red on hover
- Action buttons: blue confirm, red cancel

### 3.6 Empty States

- Illustration + title + description
- Blue call-to-action button
- Centered in card or page

### 3.7 Loading States

- Skeleton placeholders (animated shimmer)
- Spinner: blue (`text-blue-600`)

---

## 4. Page-by-Page Specification

### 4.1 Login Page (`/`)

```
┌─────────────────────────────────────────────┐
│                                             │
│     ┌─────────────────────────┐             │
│     │                         │             │
│     │    [Logo / Icon]        │             │
│     │    LATELINK             │             │
│     │    SMAKENSA             │             │
│     │                         │             │
│     │    ┌─────────────────┐ │             │
│     │    │ Username        │ │             │
│     │    └─────────────────┘ │             │
│     │    ┌─────────────────┐ │             │
│     │    │ Password        │ │             │
│     │    └─────────────────┘ │             │
│     │                         │             │
│     │    [🔵 Masuk]          │             │
│     │                         │             │
│     └─────────────────────────┘             │
│                                             │
│     Background: gradient blue-to-red blend  │
└─────────────────────────────────────────────┘
```

- Centered card with subtle shadow
- Background: diagonal gradient from blue `#2563EB` to red `#DC2626`
- Form card: white, `rounded-2xl`, `shadow-xl`, `p-8`
- Inputs: full-width, rounded, focus ring blue
- Button: blue `w-full`
- Error messages: red text below inputs

### 4.2 Dashboard Page (`/dashboard`)

```
┌─────────────────────────────────────────────┐
│ 📊 Dashboard                                 │
│                                              │
│ ┌──────┐ ┌──────┐ ┌──────┐ ┌──────┐        │
│ │ 120  │ │  12  │ │  18  │ │  47  │        │
│ │Total │ │ Hari │ │Minggu│ │Bulan │        │
│ │Siswa │ │ Ini  │ │  Ini │ │  Ini │        │
│ │  👥  │ │  ⏰  │ │  📊  │ │  📈  │        │
│ └──────┘ └──────┘ └──────┘ └──────┘        │
│                                              │
│ ┌──────────────────────────────────────┐     │
│ │  Grafik Keterlambatan (Chart.js)      │     │
│ │  ┌────────────────────────────────┐   │     │
│ │  │         Bar Chart              │   │     │
│ │  │  (blue bars, red highlight)    │   │     │
│ │  └────────────────────────────────┘   │     │
│ └──────────────────────────────────────┘     │
│                                              │
│ ┌──────────────┐  ┌──────────────────────┐   │
│ │  Siswa Paling│  │  Keterlambatan per   │   │
│ │  Sering Telat│  │  Jurusan             │   │
│ │  (table)     │  │  (pie/donut chart)   │   │
│ └──────────────┘  └──────────────────────┘   │
└─────────────────────────────────────────────┘
```

- 4 stat cards: blue icons, large numbers in bold
- Chart: blue bars with red accent on max value
- Bottom section: 2-column grid
  - Left: top late students table
  - Right: per-jurusan breakdown chart

### 4.3 Manage Students Page (`/manage`)

```
┌─────────────────────────────────────────────┐
│ 👥 Kelola Data Siswa                        │
│                                              │
│ ┌────────────────────────────────────────┐  │
│ │ [🔍 Search...]     [➕ Tambah Siswa]   │  │
│ ├────────────────────────────────────────┤  │
│ │ No │ NISN │ Nama │ Kelas │ Jurusan │   │  │
│ │    │      │      │       │  Telat  │   │  │
│ ├━━━━┿━━━━━━┿━━━━━━┿━━━━━━━┿━━━━━━━━━┤  │  │
│ │ 1  │1001  │Ahmad │ X-1   │ RPL   3 │   │  │
│ │ 2  │1002  │Bunga │ X-1   │ RPL   1 │   │  │
│ │ ...│      │      │       │         │   │  │
│ └────────────────────────────────────────┘  │
└─────────────────────────────────────────────┘
```

- Search bar with blue focus ring on left
- "Tambah Siswa" button in red (accent) on right
- DataTable with blue header and search/filter controls
- Action buttons per row: edit (blue), delete (red)
- Export buttons: simple CSV/Excel buttons in blue outline
- Pagination: blue active page indicator

### 4.4 Create/Edit Student Form

```
┌─────────────────────────────────────────────┐
│ ➕ Tambah Data Siswa / ✏️ Edit Data Siswa   │
│                                              │
│ ┌────────────────────────────────────────┐  │
│ │  NISN          ┌──────────────────┐    │  │
│ │                └──────────────────┘    │  │
│ │  Nama Siswa    ┌──────────────────┐    │  │
│ │                └──────────────────┘    │  │
│ │  Jenis Kelamin ○ Laki-laki  ○ Perempuan│  │
│ │  Kelas         ┌──────────────────┐    │  │
│ │                └──────────────────┘    │  │
│ │  Jurusan       ┌──────────────────┐    │  │
│ │                └──────────────────┘    │  │
│ │  Alamat        ┌──────────────────┐    │  │
│ │                └──────────────────┘    │  │
│ │  No HP         ┌──────────────────┐    │  │
│ │                └──────────────────┘    │  │
│ │  [🔵 Simpan]  [🔴 Batal]             │  │
│ └────────────────────────────────────────┘  │
└─────────────────────────────────────────────┘
```

- Two-column layout for denser forms
- Labels above inputs (not floating)
- Red asterisk `*` on required fields
- Submit button: blue full-width or inline
- Cancel button: red outline
- Success toast: green, auto-dismiss

### 4.5 QR Scan Page

```
┌─────────────────────────────────────────────┐
│ 📷 Scan Siswa                               │
│                                              │
│ ┌────────────────────────────────────────┐  │
│ │                                        │  │
│ │          [Camera Viewport]             │  │
│ │                                        │  │
│ │          🔵 Scan QR Code               │  │
│ └────────────────────────────────────────┘  │
│                                              │
│  ┌──────────────────┐  ┌──────────────────┐ │
│  │ Hasil Scan:      │  │ 5 Detik lalu     │ │
│  │ Ahmad Rizki      │  │ ✅ Tercatat      │ │
│  │ X-1 / RPL        │  │                  │ │
│  └──────────────────┘  └──────────────────┘ │
└─────────────────────────────────────────────┘
```

- Full-width camera viewport with rounded corners
- Blue scan button below viewport
- Result card: white, appears with slide animation
- Student info in blue, success badge in green
- Error state: red badge with shake animation

### 4.6 QR Code Display

```
┌─────────────────────────────────────────────┐
│ 📱 QR Code Siswa                            │
│                                              │
│  ┌──────────────────────────────────────┐   │
│  │  Nama: Ahmad Rizki Pratama           │   │
│  │  NISN: 1001001                       │   │
│  │  Kelas: X-1 / Jurusan: RPL           │   │
│  ├──────────────────────────────────────┤   │
│  │                                      │   │
│  │        ┌──────────────────┐          │   │
│  │        │                  │          │   │
│  │        │    QR Code       │          │   │
│  │        │                  │          │   │
│  │        └──────────────────┘          │   │
│  │                                      │   │
│  │        [🖨️ Cetak] [⬇️ Download]     │   │
│  └──────────────────────────────────────┘   │
└─────────────────────────────────────────────┘

┌─────────────────────────────────────────────┐
│  (List view for all students)               │
│  ┌──────────────────────────────────────┐   │
│  │ 🔍 Search...                        │   │
│  ├──────────────────────────────────────┤   │
│  │ 👤 Ahmad Rizki     X-1  [📱 Lihat]  │   │
│  │ 👤 Bunga Citra     X-1  [📱 Lihat]  │   │
│  │ ...                                 │   │
│  └──────────────────────────────────────┘   │
└─────────────────────────────────────────────┘
```

- Two views: individual QR + list to browse
- Student info card above QR code
- Blue action buttons: Print, Download
- List view: simple stacked list with blue "Lihat" buttons

### 4.7 Late Records Table

```
┌─────────────────────────────────────────────┐
│ ⏰ Tabel Siswa Terlambat                    │
│                                              │
│ ┌────────────────────────────────────────┐  │
│ │ [🔍 Search...]  [📅 Filter Tanggal]   │  │
│ ├────────────────────────────────────────┤  │
│ │ No │ Nama │ NISN │ Tanggal │ Telat    │  │
│ │    │      │      │         │ (Menit)  │  │
│ ├━━━━┿━━━━━━┿━━━━━━┿━━━━━━━━━┿━━━━━━━━━━┤  │
│ │ 1  │Ahmad │1001  │08/01/24│  3       │  │
│ │ 2  │Candra│1003  │09/01/24│  2       │  │
│ │ ...│      │      │         │          │  │
│ └────────────────────────────────────────┘  │
│                                              │
│  [🔴 Reset All]                             │
└─────────────────────────────────────────────┘
```

- Date range filter with blue accent
- Table: blue header, striped rows
- Reset button: red, with confirmation modal
- Export to Excel/PDF buttons

### 4.8 Jurusan & Kelas Management

- Same table pattern as Manage Students
- Cards with form inline or modal for create/edit
- Delete with red confirmation modal

---

## 5. Responsive Behavior

| Breakpoint | Behavior |
|------------|----------|
| `≥1024px` | Full sidebar + content |
| `768-1023px` | Collapsible sidebar (off-canvas), hamburger toggle |
| `<768px` | Bottom nav or hamburger, stacked cards, scrollable tables |

---

## 6. Transitions & Animations

- Page transitions: subtle fade-in (`opacity 0 → 1`, 200ms)
- Sidebar toggle: smooth slide (300ms ease)
- Button hover: background color transition (200ms)
- Modal: scale up + fade in (200ms)
- Toast notifications: slide in from right, auto-dismiss after 3s
- Table row hover: subtle background highlight

---

## 7. Implementation Approach

### Phase 1 — Foundation
- Replace AdminLTE 3 with Tailwind CSS (v3+)
- Create reusable Blade components:
  - `<x-button>` (blue/red variants)
  - `<x-card>`
  - `<x-input>`
  - `<x-table>`
  - `<x-modal>`
  - `<x-badge>`
  - `<x-alert>`
- Set up new master layout with Tailwind
- Remove unused JS/CSS plugins

### Phase 2 — Core Pages
- Redesign login page with gradient background
- Redesign dashboard with stat cards + charts
- Redesign manage page with DataTable
- Redesign create/edit forms

### Phase 3 — Advanced
- Add dark mode toggle (optional)
- Add loading skeletons
- Add empty state illustrations
- Mobile-responsive refinements

---

## 8. Before vs After Comparison

| Aspect | Before (AdminLTE 3) | After (Tailwind) |
|--------|-------------------|-------------------|
| CSS size | ~500KB (all plugins) | ~50KB (purged) |
| JS size | ~1.5MB (jQuery + plugins) | ~200KB (Alpine.js or vanilla) |
| Page load | 3-5s | <1s |
| Theme weight | Heavy, opinionated | Lightweight, custom |
| Color scheme | Dark teal/gray | Blue + Red (vibrant) |
| Responsive | OK | Excellent |
| Customization | Hard (override cascade) | Easy (utility classes) |

---

## 9. Accessibility

- All interactive elements focusable with visible focus ring (blue `ring-2`)
- Color contrast ratio ≥ 4.5:1 for text
- Form inputs have associated `<label>` elements
- Error messages linked via `aria-describedby`
- Semantic HTML: `<nav>`, `<main>`, `<header>`, `<section>`

---

## 10. Component Library (Blade Components)

```
app/
└── View/
    └── Components/
        ├── Button.php
        ├── Card.php
        ├── Input.php
        ├── Select.php
        ├── Modal.php
        ├── Badge.php
        ├── Alert.php
        └── Table.php

resources/
└── views/
    └── components/
        ├── button.blade.php
        ├── card.blade.php
        ├── input.blade.php
        ├── select.blade.php
        ├── modal.blade.php
        ├── badge.blade.php
        ├── alert.blade.php
        └── table.blade.php
```

Each component accepts props for variants (blue/red), sizes, and additional classes.
