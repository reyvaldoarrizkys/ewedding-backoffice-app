# DOKUMEN PANDUAN PENGGUNA DAN KODE PROGRAM
## APLIKASI SISTEM INFORMASI WEDDING ORGANIZER (SIWO) "E-WEDDING"

**Pencipta:**  
Reyvaldo Arrizky Safaatulloh  
aldo354@gmail.com | 087749298785  

---

### PENDAHULUAN
 
Puji syukur ke hadirat Tuhan Yang Maha Esa, karena atas rahmat dan karunia-Nya dokumen panduan penggunaan aplikasi ini dapat disusun dan diselesaikan dengan baik. Dokumen ini disusun sebagai pedoman bagi pengguna dalam memahami serta mengoperasikan aplikasi secara tepat dan efektif.
 
Dokumen panduan ini bertujuan untuk memberikan informasi yang terstruktur mengenai tata cara penggunaan aplikasi, fungsi-fungsi utama, serta alur operasional yang tersedia pada Sistem Informasi Wedding Organizer (SIWO) EWedding. Dengan adanya panduan ini, diharapkan pengguna, baik Owner (Ibu Fitria Agustina) maupun Staf Administrasi Wedding Organizer Raturiasfitrie, dapat memahami manfaat aplikasi secara menyeluruh dan menggunakannya sesuai dengan ketentuan operasional yang telah ditetapkan.
 
Keberadaan dokumen ini diharapkan dapat membantu meminimalkan kesalahan penggunaan (*human error*), mengurangi kendala teknis, serta mendukung pemanfaatan aplikasi secara optimal dalam menunjang otomatisasi administrasi, akurasi pendataan klien, dan peningkatan produktivitas internal mitra. Panduan ini dapat digunakan baik oleh pengguna baru maupun pengguna yang telah berpengalaman sebagai referensi dalam pengoperasian aplikasi.
 
Akhir kata, semoga dokumen panduan ini dapat memberikan manfaat dan menjadi acuan yang berguna dalam mendukung kelancaran serta keberhasilan transformasi digital pada organisasi.
 
<div align="right">
Depok, 26 Juni 2026<br><br><br>
Penyusun
</div>

---

### DAFTAR ISI
 
1. **URAIAN CIPTAAN**
2. **USER GUIDE (PANDUAN PENGGUNA)**
   - 2.1 Lingkungan Pengembangan
   - 2.2 Cara Menjalankan Program
     - 2.2.1 Persiapan Direktori dan Server Lokal
     - 2.2.2 Konfigurasi Environment File (.env)
     - 2.2.3 Instalasi Paket Dependensi (PHP & JS)
     - 2.2.4 Migrasi Skema Basis Data dan Seeding
     - 2.2.5 Kompilasi Aset Frontend (Vite)
     - 2.2.6 Menjalankan Development Server Lokal
     - 2.2.7 Akses Halaman Web Melalui Browser
   - 2.3 Hak Akses Pengguna
     - 2.3.1 Hak Akses Pengguna Peran Admin
     - 2.3.2 Hak Akses Pengguna Peran Staff WO
   - 2.4 Alur Penggunaan (Workflow)
     - 2.4.1 Proses Autentikasi (Login)
     - 2.4.2 Manajemen Data Master Klien
     - 2.4.3 Manajemen Transaksi dan Pemesanan (Booking Order)
     - 2.4.4 Sinkronisasi Finansial dan Riwayat Pembayaran Otomatis
     - 2.4.5 Manajemen Buku Besar dan Cetak Laporan Keuangan (Khusus Admin)
3. **SOURCE CODE (KODE PROGRAM)**
   - 3.1 Kode Program Backend Controller
     - 3.1.1 Logika Perhitungan Biaya & Sinkronisasi Keuangan Otomatis
   - 3.2 Kode Program Frontend & Interaction Script
     - 3.2.1 Script JavaScript Perhitungan Biaya Akhir (Auto-Sum)
   - 3.3 Kode Program Konfigurasi Keamanan (Access Control)
     - 3.3.1 Implementasi Pembatasan Hak Akses Controller Middleware
   - 3.4 Kode Program Skema Basis Data (Database Schema)
     - 3.4.1 Konfigurasi Migration Relasi Fisik Tabel Orders ke Users

---

### 1. URAIAN CIPTAAN
Sistem Informasi "EWedding" (SIWO) adalah sebuah program komputer berbasis platform web (*back-end admin*) yang dirancang khusus untuk mendigitalisasi, mengintegrasikan, dan menyentralisasikan seluruh proses bisnis operasional pada usaha jasa Wedding Organizer Raturiasfitrie Depok. Aplikasi ini dibangun untuk mengatasi kelemahan tata kelola konvensional/semi-manual yang memicu inefisiensi, risiko *human error* (seperti *double-booking* atau salah ketik), hambatan akses data secara real-time, serta lamanya durasi penyusunan rekapitulasi keuangan bulanan.

Tujuan utama dari pembuatan aplikasi ini adalah menghasilkan platform manajemen internal yang terstruktur untuk mempercepat pengambilan keputusan bisnis. EWedding mengintegrasikan empat fungsi eksekutif inti (*back-end management*):
- **Manajemen Klien & Pemesanan:** Mengelola pendaftaran data master klien, paket pernikahan, dan pencatatan transaksi masuk.
- **Manajemen Keuangan Terintegrasi:** Mengakomodasi logika transaksi yang kompleks, mencakup pencatatan uang muka (DP), skema cicilan, pelunasan, hingga kalkulasi biaya kustom tambahan (*auto-sum*) dan pembuatan invoice otomatis.
- **Manajemen Staf & Hak Akses:** Mengatur otorisasi keamanan digital berdasarkan pembatasan wilayah kerja antar pengguna.
- **Penjadwalan & Agenda Acara:** Menyediakan visualisasi kalender terpusat untuk memantau waktu pertemuan dengan klien serta timeline hari-H guna menghindari bentrok jadwal operasional lapangan.

Ciptaan ini dikembangkan menggunakan Laravel Framework dengan pola arsitektur *Model-View-Controller* (MVC), bahasa pemrograman PHP, dan sistem manajemen basis data relasional MySQL/MariaDB.

---

### 2. USER GUIDE (PANDUAN PENGGUNA)

#### 2.1 Lingkungan Pengembangan
Sistem ini dirancang dan dikonstruksi untuk beroperasi pada spesifikasi lingkungan perangkat lunak dan perangkat keras berikut:
*   **Bahasa Pemrograman Backend:** PHP (Hypertext Preprocessor) Versi 8.2.x.
*   **Bahasa Client-Side & Markup:** HTML5, CSS3, dan JavaScript (ES6+ untuk kalkulasi dinamis).
*   **Framework Aplikasi Web:** Laravel Framework Versi 12.x.
*   **Front-end Compiler & Bundler:** Vite Bundler dengan Plugin `@tailwindcss/vite` Versi 4.0.0.
*   **Pustaka Manajemen Keamanan:** Spatie Laravel Permission Versi 6.25 (Pemisahan dinamis peran Admin dan Staff WO).
*   **Database Management System:** MySQL / MariaDB.
*   **Perangkat Lunak Pendukung:** Visual Studio Code (IDE), Git (Version Control System), Google Chrome / Mozilla Firefox (Web Browser), dan XAMPP atau Laragon (Local Web Server Environment).

#### 2.2 Cara Menjalankan Program

##### 2.2.1 Persiapan Direktori dan Server Lokal
*   Ekstrak berkas proyek EWedding atau salin folder kode program utama ke direktori server lokal Anda (`C:/xampp/htdocs` pada XAMPP atau `C:/laragon/www` pada Laragon).
*   Buka panel kontrol server lokal (XAMPP/Laragon) Anda, lalu aktifkan modul layanan **Apache** dan **MySQL**.

##### 2.2.2 Konfigurasi Environment File (.env)
*   Buka folder proyek EWedding menggunakan text editor (seperti VS Code).
*   Cari file bernama `.env.example`, lalu buat salinannya dengan nama `.env`.
*   Sesuaikan konfigurasi koneksi basis data Anda di dalam berkas `.env` tersebut:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=ewedding
    DB_USERNAME=root
    DB_PASSWORD=
    ```

##### 2.2.3 Instalasi Paket Dependensi (PHP & JS)
Buka terminal (*Command Prompt* / *Git Bash* / *Terminal VS Code*) tepat di direktori proyek, lalu jalankan perintah-perintah berikut secara berurutan:
*   Menginstal seluruh paket PHP yang dibutuhkan:
    ```bash
    composer install
    ```
*   Menginstal paket-paket JavaScript dan Tailwind CSS:
    ```bash
    npm install
    ```
*   Membuat kunci enkripsi aplikasi Laravel:
    ```bash
    php artisan key:generate
    ```

##### 2.2.4 Migrasi Skema Basis Data dan Seeding
*   Buka peramban web (browser) lalu akses halaman **phpMyAdmin** (`http://localhost/phpmyadmin`).
*   Buat database baru dengan nama `ewedding`.
*   Jalankan migrasi skema tabel basis data ke MySQL melalui terminal proyek:
    ```bash
    php artisan migrate
    ```
*   Isi basis data dengan akun default dan peran (*seeder*):
    ```bash
    php artisan db:seed
    ```
    *(Proses ini akan otomatis mendaftarkan akun default: Admin dengan email `admin@ewedding.test` dan Staff WO dengan email `staff@ewedding.test`, keduanya menggunakan kata sandi `password`)*
*   *Alternatif (Impor SQL):* Anda juga dapat mengimpor struktur data secara manual dengan memilih database `ewedding` di phpMyAdmin, klik menu **Import**, pilih berkas basis data bawaan `ewedding.sql` dari folder proyek, lalu klik **Go**.

##### 2.2.5 Kompilasi Aset Frontend (Vite)
Kompilasikan aset-aset front-end menggunakan perintah:
*   Untuk mode pengembangan lokal (hot-reload):
    ```bash
    npm run dev
    ```
*   Atau untuk membangun berkas siap produksi:
    ```bash
    npm run build
    ```

##### 2.2.6 Menjalankan Development Server Lokal
Jalankan server lokal Laravel dengan perintah Artisan di terminal:
```bash
php artisan serve
```
atau menggunakan skrip alternatif bawaan proyek:
```bash
composer dev
```

##### 2.2.7 Akses Halaman Web Melalui Browser
Buka peramban web, lalu akses alamat URL lokal default aplikasi:
`http://127.0.0.1:8000` atau `http://localhost:8000`.

---

#### 2.3 Hak Akses Pengguna
Pembagian wilayah kerja dan otorisasi keamanan digital di dalam aplikasi EWedding dikelola menggunakan *Role-Based Access Control* (RBAC) dengan dua peran utama:

##### 2.3.1 Hak Akses Pengguna Peran Admin
*   **Deskripsi Peran:** Memiliki kewenangan absolut terhadap seluruh konfigurasi data dan operasional keuangan (Owner Raturiasfitrie / Ibu Fitria Agustina).
*   **Hak Akses Modul:**
    *   Mengelola **Laporan Keuangan** (Melihat neraca kas pemasukan dan pengeluaran, mencatat transaksi pengeluaran manual, dan melakukan cetak laporan buku besar keuangan).
    *   Mengelola **Manajemen Pengguna / Staf** (Menambah, mengedit, memblokir, atau menghapus akun pengguna/staf WO).
    *   Mengelola **Paket Pernikahan** (Membuat, mengedit detail/harga, menonaktifkan, atau menghapus katalog paket pernikahan).
    *   Mengelola **Informasi / Pengumuman** (Membuat dan memublikasikan pengumuman penting untuk dibaca oleh seluruh staf).
    *   Mengelola data master **Klien** dan **Transaksi Pesanan**.
*   **Akun Default:** `admin@ewedding.test` | Kata Sandi: `password`

##### 2.3.2 Hak Akses Pengguna Peran Staff WO
*   **Deskripsi Peran:** Bertanggung jawab mencatat data klien baru dan melakukan entri pesanan pernikahan di lapangan (Staf Administrasi Lapangan).
*   **Hak Akses Modul:**
    *   Mengelola data master **Klien** (Menambah, melihat, dan memperbarui profil calon pengantin).
    *   Mengelola **Transaksi Pesanan** (Mencatat pesanan paket pernikahan, menambahkan biaya kustom, dan memperbarui status pesanan).
    *   Akses baca (*Read-only*) terhadap katalog **Paket Pernikahan** dan **Informasi/Pengumuman** melalui modal tampilan detail popup (tidak dapat menambah, mengedit, atau menghapusnya).
    *   **Dilarang Keras** mengakses modul **Laporan Keuangan** dan **Manajemen Pengguna** (Sistem akan otomatis memblokir akses dan mengembalikan kode respons 403 Forbidden).
*   **Akun Default:** `staff@ewedding.test` | Kata Sandi: `password`

---

#### 2.4 Alur Penggunaan (Workflow)

##### 2.4.1 Proses Autentikasi (Login)
Pengguna memasukkan email dan kata sandi di halaman login. Sistem memvalidasi kredensial serta mencocokkan perannya untuk memberikan izin akses menu yang sesuai di halaman Dashboard.

##### 2.4.2 Manajemen Data Master Klien
Sebelum memesan paket, Staff WO atau Admin mendaftarkan data profil klien baru (Nama Klien, No. Telepon, Alamat, Email) pada modul **Klien**.

##### 2.4.3 Manajemen Transaksi dan Pemesanan (Booking Order)
*   Masuk ke menu **Pesanan**, klik **Buat Pesanan Baru**.
*   Pilih nama klien yang telah terdaftar, kemudian pilih paket pernikahan yang diinginkan.
*   Sistem secara otomatis menarik nilai harga paket dari database.
*   Masukkan nominal **Biaya Tambahan** (opsional) beserta keterangan detailnya (misal: tambahan transport atau custom dekorasi).
*   JavaScript di sisi client secara dinamis menjumlahkan `Harga Paket + Biaya Tambahan` dan menuliskannya di kolom **Total Harga Akhir** secara real-time (*auto-sum*).
*   Tentukan tanggal pemesanan, tanggal pelaksanaan acara, status pesanan (Pending, Dikonfirmasi, Selesai, Batal), dan status pembayaran (Belum Lunas, DP, Lunas).

##### 2.4.4 Sinkronisasi Finansial dan Riwayat Pembayaran Otomatis
*   Ketika pesanan disimpan dengan status **DP (Uang Muka)**, sistem secara otomatis mencatat pembayaran senilai 50% dari total harga akhir pada tabel `payments`, serta mengirim data tersebut ke tabel `financial_reports` sebagai transaksi **Pemasukan**.
*   Jika disimpan dengan status **Lunas**, sistem mencatat pembayaran 100% dari total harga akhir pada tabel `payments`, lalu mengirim data transaksi tersebut sebagai **Pemasukan** di tabel laporan keuangan.
*   *User ID* staf pelaksana diikat secara fisik pada kolom `user_id` transaksi pesanan untuk keperluan pelacakan aktivitas (*auditing*).

##### 2.4.5 Manajemen Buku Besar dan Cetak Laporan Keuangan (Khusus Admin)
*   Admin memantau total pemasukan, pengeluaran, dan sisa saldo kas di halaman **Laporan Keuangan**.
*   Untuk pengeluaran organisasi (pembayaran vendor katering, sewa tenda, transportasi), Admin mencatatnya secara manual melalui tombol **Catat Transaksi Kas** dengan memilih tipe **Pengeluaran**.
*   Untuk pelaporan bulanan, Admin menekan tombol **Cetak Laporan** yang memicu dialog cetak browser (`window.print()`). Tampilan cetak telah dioptimalkan secara visual menggunakan CSS `@media print` untuk menghasilkan dokumen buku besar yang bersih dan rapi (tanpa sidebar dan tombol navigasi).

---

### 3. SOURCE CODE (KODE PROGRAM)

#### 3.1 Kode Program Backend Controller

##### 3.1.1 Logika Perhitungan Biaya & Sinkronisasi Keuangan Otomatis
Berkas: `app/Http/Controllers/OrderController.php` (Fungsi `store()`)
Potongan kode berikut menunjukkan bagaimana sistem melakukan perhitungan harga akhir (`total_harga = harga_paket + biaya_tambahan`), mencatat `user_id` penginput, serta menyinkronkan data pembayaran secara otomatis ke jurnal buku besar keuangan sebagai transaksi pemasukan:
```php
public function store(Request $request)
{
    $validated = $request->validate([
        'client_id' => 'required|exists:clients,id|unique:orders,client_id',
        'package_id' => 'required|exists:packages,id',
        'biaya_tambahan' => 'nullable|numeric|min:0',
        'keterangan_tambahan' => 'nullable|string|max:255',
        'tanggal_pesan' => 'required|date',
        'tanggal_acara' => 'required|date|after_or_equal:tanggal_pesan',
        'status_pesanan' => 'required|in:Pending,Dikonfirmasi,Selesai,Batal',
        'status_pembayaran' => 'required|in:Belum Lunas,DP,Lunas',
    ], [
        'client_id.unique' => 'Klien ini sudah memiliki pesanan aktif. Satu klien hanya bisa didaftarkan pada satu pesanan.',
    ]);

    $package = Package::findOrFail($validated['package_id']);
    $biayaTambahan = $validated['biaya_tambahan'] ?? 0;
    $validated['biaya_tambahan'] = $biayaTambahan;
    
    // Auto-sum total harga di sisi server
    $validated['total_harga'] = $package->harga + $biayaTambahan;
    $validated['user_id'] = Auth::id(); // Mencatat ID pengguna/staf yang menginput

    $order = Order::create($validated);

    // Sinkronisasi otomatis ke riwayat pembayaran dan laporan keuangan
    if ($validated['status_pembayaran'] === 'DP') {
        $nominal = $validated['total_harga'] * 0.5; // Otomatis DP 50%
        $order->payments()->create([
            'tanggal_bayar' => now(),
            'jumlah_bayar' => $nominal,
            'metode_pembayaran' => 'Otomatis (Sistem DP 50%)',
        ]);
        FinancialReport::create([
            'jenis_transaksi' => 'Pemasukan',
            'deskripsi' => 'Pembayaran DP 50% Pesanan #' . str_pad($order->id, 4, '0', STR_PAD_LEFT) . ' - ' . $order->client->nama_klien,
            'jumlah' => $nominal,
            'tanggal_transaksi' => now(),
            'order_id' => $order->id
        ]);
    } elseif ($validated['status_pembayaran'] === 'Lunas') {
        $nominal = $validated['total_harga']; // Otomatis Lunas 100%
        $order->payments()->create([
            'tanggal_bayar' => now(),
            'jumlah_bayar' => $nominal,
            'metode_pembayaran' => 'Otomatis (Sistem Lunas 100%)',
        ]);
        FinancialReport::create([
            'jenis_transaksi' => 'Pemasukan',
            'deskripsi' => 'Pembayaran Lunas 100% Pesanan #' . str_pad($order->id, 4, '0', STR_PAD_LEFT) . ' - ' . $order->client->nama_klien,
            'jumlah' => $nominal,
            'tanggal_transaksi' => now(),
            'order_id' => $order->id
        ]);
    }

    return redirect()->route('orders.index')->with('success', 'Pesanan berhasil ditambahkan.');
}
```

---

#### 3.2 Kode Program Frontend & Interaction Script

##### 3.2.1 Script JavaScript Perhitungan Biaya Akhir (Auto-Sum)
Berkas: `resources/views/orders/create.blade.php` (Bagian Script)
Menjamin kelancaran antarmuka dengan menghitung total biaya di browser secara langsung setiap kali paket dipilih atau nominal biaya tambahan diketik oleh staf:
```javascript
document.addEventListener('DOMContentLoaded', function() {
    const packageSelect = document.getElementById('package_id');
    const biayaTambahanInput = document.getElementById('biaya_tambahan');
    const totalHargaInput = document.getElementById('total_harga');

    function calculateTotal() {
        const selectedOption = packageSelect.options[packageSelect.selectedIndex];
        // Mengambil atribut data-price dari elemen select option paket
        const packagePrice = parseInt(selectedOption.getAttribute('data-price')) || 0;
        const additionalCost = parseInt(biayaTambahanInput.value) || 0;
        
        if (packagePrice > 0) {
            // Kalkulasi real-time penjumlahan biaya
            totalHargaInput.value = packagePrice + additionalCost;
            
            // Efek transisi visual saat data terisi otomatis
            totalHargaInput.classList.add('bg-slate-300');
            setTimeout(() => {
                totalHargaInput.classList.remove('bg-slate-300');
            }, 300);
        } else {
            totalHargaInput.value = '';
        }
    }

    // Mendengarkan perubahan input dari pengguna
    packageSelect.addEventListener('change', calculateTotal);
    biayaTambahanInput.addEventListener('input', calculateTotal);
    
    if (packageSelect.value) {
        calculateTotal();
    }
});
```

---

#### 3.3 Kode Program Konfigurasi Keamanan (Access Control)

##### 3.3.1 Implementasi Pembatasan Hak Akses Controller Middleware
Berkas: `app/Http/Controllers/PackageController.php`
Menggunakan fitur `HasMiddleware` Laravel 12 untuk membatasi akses edit/tambah/hapus data paket hanya untuk pengguna dengan peran Admin, sedangkan Staff WO hanya diberi hak akses baca (`index` dan `show`):
```php
namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PackageController extends Controller implements HasMiddleware
{
    /**
     * Daftarkan middleware khusus untuk membatasi hak akses.
     */
    public static function middleware(): array
    {
        return [
            // Memproteksi modul manipulasi data paket
            // Hanya memperbolehkan peran Admin. Staff WO dikecualikan dari pemblokiran
            // hanya untuk fungsi melihat daftar (index) dan detail paket (show).
            new Middleware('role:Admin', except: ['index', 'show']),
        ];
    }

    // ... fungsi operasional controller (index, create, store, show, edit, update, destroy)
}
```

---

#### 3.4 Kode Program Skema Basis Data (Database Schema)

##### 3.4.1 Konfigurasi Migration Relasi Fisik Tabel Orders ke Users
Berkas: `database/migrations/2026_06_09_192000_add_user_id_to_orders_table.php`
Mendefinisikan foreign key relasi secara fisik antara tabel `orders` dan tabel `users` untuk memetakan kepemilikan transaksi dengan penanganan `nullOnDelete` guna melindungi integritas data finansial:
```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Deklarasi relasi fisik ke tabel users
            $table->foreignId('user_id')
                  ->nullable()
                  ->after('package_id')
                  ->constrained('users')
                  ->nullOnDelete(); // Jika pengguna dihapus, data transaksi tidak ikut terhapus (diatur NULL)
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
```

---
**Tautan Repositori Kode Program:**
1.  **Repositori Git Lokal:** [EWedding Project Folder](file:///Users/reyvaldoarrizkys/Documents/NURUL%20FIKRI/BISMILLAH%20LULUS/SKRIPSHIT/TA%201/EWedding)
2.  **Tautan GitHub (Referensi Akademik):** `https://github.com/reyvaldoarrizky/ewedding-siwo`
