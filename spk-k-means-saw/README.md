# 🧗‍♂️ SPK PANJAT - Sistem Pendukung Keputusan Seleksi Atlet Panjat Tebing

[!Stack]
[!Security]
[!Python Engine]

Sistem Pendukung Keputusan (SPK) berbasis web yang dirancang khusus untuk mempermudah pelatih dan manajemen dalam menyeleksi serta merekomendasikan atlet panjat tebing terbaik untuk mengikuti perlombaan. 

Sistem ini mengombinasikan **K-Means Clustering** untuk mengelompokkan spesialisasi kompetensi atlet secara cerdas dan metode **Simple Additive Weighting (SAW)** untuk melakukan perankingan performa berdasarkan 10 kriteria penilaian ($C_1$ - $C_{10}$).

---

## 🚀 Fitur Utama Sistem

- **🛡️ Secure Authentication:** Pintu masuk sistem multi-user terproteksi enkripsi `bcrypt` dan verifikasi token fisik `JWT (JSON Web Token)` dengan masa aktif 2 jam.
- **🤖 Alur Analisis Cerdas (Hybrid Engine):** 
  - **K-Means Clustering (2 Kluster):** Membagi atlet secara otomatis ke dalam kelompok **Speed Specialist** (Cluster 0) dan **Lead Specialist** (Cluster 1).
  - **Validasi Akurasi Label Dinamis:** Python engine otomatis mengukur nilai rata-rata kriteria $C_1$ (Kecepatan). Kluster dengan rata-rata $C_1$ tertinggi *Speed Specialist* algoritma K-Means.
- **🎯 Pembobotan SAW Terpisah (Kategori Spesifik):** Kalkulasi skor akhir menggunakan metode *Simple Additive Weighting* (SAW) dengan matriks ternormalisasi tipe keuntungan (*benefit*). Nilai bobot diambil dinamis dari basis data berdasarkan tipe kluster atlet (**Bobot Speed** untuk Cluster 0, **Bobot Lead** untuk Cluster 1).
- **📈 Manajemen Perangkingan Lokal:** Proses pemeringkatan atlet yang ingin mengikuti perlombaan maka dari itu dihitung ulang dari peringkat 1 pada masing-masing kluster terpisah.
- **📋 CRUD Atlet Terproteksi:** Pengelolaan data performa bulanan atlet yang sinkron dengan basis data MySQL melalui endpoint Node.js terenkripsi.
- **📥 Export & Cetak Laporan:** Integrasi konversi data tabel antarmuka React menjadi file dokumen Excel (`.xlsx`) secara instan serta fitur cetak laporan ramah kertas.

---

## 🛠️ Arsitektur & Spesifikasi Teknologi

Sistem mengadopsi arsitektur terpisah (*Decoupled Architecture*) dengan pembagian tugas sebagai berikut:

- **Frontend App:** React (Functional Components, Hooks `useState` & `useEffect`, Tailwind CSS, Lucide Icons, SheetJS/XLSX Library).
- **Secure Backend API:** Node.js, Express.js, MySQL2 Drivers, CORS Security Policy, JWT, Bcrypt, Dotenv.
- **Data Analytics Engine:** Python 3 (Pandas, NumPy, Scikit-Learn `KMeans`, Python-Dotenv, MySQL Connector) yang dieksekusi asinkron dari Node.js melalui metode `child_process.spawn`.
- **Database Server:** MySQL Server (Menyimpan data otentikasi `users`, data performa `atlet`, dan parameter `kriteria`).

---

## 📡 Dokumentasi Endpoint API Backend (`http://localhost:5000`)

Seluruh manajemen data wajib menyertakan token akses pada header request:  
`Authorization: Bearer <JWT_TOKEN>`


| Metode | Endpoint | Proteksi JWT | Deskripsi |
| :--- | :--- | :---: | :--- |
| **POST** | `/api/auth/signin` | ❌ No | Autentikasi pengguna, menghasilkan token akses dan profil. |
| **POST** | `/api/atlet` | 🔑 Yes | Menyimpan parameter performa bulanan baru atlet ke database. |
| **PUT** | `/api/atlet/:id` | 🔑 Yes | Memperbarui 10 nilai kriteria komparatif atlet berdasarkan ID. |
| **DELETE** | `/api/atlet/:id` | 🔑 Yes | Menghapus data riwayat performa atlet dari database. |
| **GET** | `/api/proses-spk` | 🔑 Yes | Memanggil skrip logika Python untuk memproses K-Means + SAW. |
| **POST** | `/api/bobot/:kategori` | 🔑 Yes | Memperbarui bobot kriteria terpisah (`speed` atau `lead`). |

---

## ⚙️ Langkah Instalasi dan Pengaktifan

### 1. Struktur Basis Data (MySQL)
Pastikan database MySQL bernama `spk_climbing` telah dibuat dengan tabel minimal sebagai berikut:
- **Tabel `users`:** Menyimpan `username`, `password` (string/hash), dan `nama_lengkap`.
- **Tabel `atlet`:** Menyimpan properti `id`, `nama_atlet`, `c1` s/d `c10`, `bulan`, `tahun`, `cluster`, `skor_saw`, dan `ranking_nasional`.
- **Tabel `kriteria`:** Menyimpan id kriteria, `bobot_speed`, dan `bobot_lead`.

### 2. Setup Sisi Backend & Script Engine (Node.js & Python)
1. Masuk ke dalam direktori backend proyek Anda.
2. Buat sebuah file bernama `.env` di akar folder backend, lalu isi konfigurasi berikut:
   ```env
   PORT=5000
   DB_HOST=localhost
   DB_USER=root
   DB_PASS=
   DB_NAME=spk_climbing
   JWT_SECRET=KUNCI_RAHASIA_SUPER_KETAT_SPK
   ```
3. Instal seluruh dependensi paket Node.js yang diperlukan:
   ```bash
   npm install express mysql2 cors dotenv bcrypt jsonwebtoken
   ```
4. Pastikan file skrip analisis Python bernama `spk_logic.py` diletakkan di dalam folder root yang sama dengan file utama backend (`index.js` / `server.js`).
5. Instal dependensi library python yang dibutuhkan oleh engine analitik:
   ```bash
   pip install pandas numpy scikit-learn mysql-connector-python python-dotenv
   ```
6. Jalankan server backend Anda:
   ```bash
   node index.js
   ```

### 3. Setup Sisi Frontend (React)
1. Buka terminal baru dan masuk ke dalam folder repositori aplikasi React Anda.
2. Jalankan instalasi pustaka visual icon dan pustaka penunjang dokumen Excel:
   ```bash
   npm install lucide-react xlsx
   ```
3. Pastikan konfigurasi panggil API diarahkan ke port backend (`http://localhost:5000`).
4. Jalankan aplikasi React di lingkungan lokal Anda (Bawaan berjalan di port `http://localhost:5173` / `http://localhost:3000`):
   ```bash
   npm run dev
   ```

---

## 📊 Matriks Alur Data Analitik Python (`spk_logic.py`)

1. **Argument Parsing:** Menerima input argumen `sys.argv` (Bulan dan Tahun) yang dilempar dari query parameter Node.js.
2. **Strict Filtering:** Menarik data atlet dari database MySQL secara spesifik hanya pada bulan dan tahun terpilih.
3. **K-Means Execution:** Memetakan atlet ke dalam 2 kelompok kompetensi menggunakan pustaka `sklearn.cluster.KMeans` dengan inisialisasi otomatis (`n_init='auto'`).
4. **SAW Normalization:** Rumus normalisasi elemen matriks keputusan tipe keuntungan (*benefit*):
   $$R_{ij} = \frac{X_{ij}}{\max(X_{ij})}$$
5. **Score Weighting:** Total skor dihitung berdasarkan perkalian baris matriks ternormalisasi dengan bobot kriteria yang bersesuaian dengan kluster bentukan ($W_{speed}$ atau $W_{lead}$):
   $$\text{Skor SAW} = \sum (R_{ij} \times W_{j})$$
6. **Database Sync & Output:** Menyimpan hasil kalkulasi (`cluster`, `skor_saw`, `ranking_nasional`) kembali ke tabel `atlet` MySQL dan mencetak hasil akhir dalam format baris JSON terstruktur untuk dikonsumsi oleh Frontend.

## 📄 Lisensi

Aplikasi ini dilisensikan di bawah **Lisensi MIT**. Hak Cipta dilindungi undang-undang.
