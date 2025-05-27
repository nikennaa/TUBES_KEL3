<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bantuan - E-Wedding Dekorasi</title>
    <link rel="stylesheet" href="{{ asset('css/help.css') }}" />
    <style>
        /* Styling tombol dropdown */
        .dropdown-btn {
            cursor: pointer;
            padding: 15px;
            font-size: 18px;
            border: none;
            text-align: left;
            outline: none;
            background-color: #f2f2f2;
            width: 100%;
            transition: background-color 0.3s ease;
            margin-top: 10px;
            border-radius: 5px;
        }
        .dropdown-btn:hover {
            background-color: #ddd;
        }
        /* Icon tanda panah */
        .dropdown-btn::after {
            content: '\25BC'; /* ▼ */
            float: right;
            margin-left: 5px;
            transition: transform 0.3s ease;
        }
        .dropdown-btn.active::after {
            transform: rotate(180deg); /* panah ke atas */
        }

        /* Container konten dropdown */
        .dropdown-container {
            padding: 0 15px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease;
            background-color: #fafafa;
            border-left: 3px solid #2196F3;
            margin-bottom: 10px;
            border-radius: 0 5px 5px 0;
        }
        .dropdown-container.open {
            max-height: 1000px; /* besar cukup untuk isi */
        }

        /* Styling konten paragraf dan list */
        .dropdown-container p,
        .dropdown-container ul {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <a href="{{ url('/') }}" class="btn-back">← Kembali</a>

    <h1>Bantuan Pemesanan E-Wedding Dekorasi</h1>

    <!-- Pertanyaan 1 -->
    <button class="dropdown-btn">1. Cara Memesan Dekorasi atau Paket</button>
    <div class="dropdown-container">
        <p>Ikuti langkah berikut untuk memesan dekorasi, sound system, atau bunga:</p>
        <ul>
            <li>Pilih paket yang diinginkan pada halaman utama.</li>
            <li>Isi formulir pemesanan dengan detail acara Anda (tanggal, lokasi, tema, dll).</li>
            <li>Kirimkan formulir dan tunggu konfirmasi dari tim kami via email atau telepon.</li>
        </ul>
    </div>

    <!-- Pertanyaan 2 -->
    <button class="dropdown-btn">2. Pemesanan Dekorasi Sesuai Tema</button>
    <div class="dropdown-container">
        <p>Anda bisa request tema dekorasi khusus sesuai keinginan. Tulis detail tema pada kolom catatan di formulir pemesanan, atau hubungi kami langsung untuk konsultasi.</p>
    </div>

    <!-- Pertanyaan 3 -->
    <button class="dropdown-btn">3. Metode Pembayaran</button>
    <div class="dropdown-container">
        <p>Kami menerima pembayaran melalui:</p>
        <ul>
            <li>Transfer bank</li>
            <li>E-wallet (OVO, GoPay, Dana, dll)</li>
            <li>Pembayaran langsung di tempat saat acara</li>
        </ul>
        <p>Detail pembayaran akan kami informasikan setelah pemesanan diterima.</p>
    </div>

    <!-- Pertanyaan 4 -->
    <button class="dropdown-btn">4. Waktu Pemesanan</button>
    <div class="dropdown-container">
        <p>Disarankan memesan minimal <strong>2 minggu sebelum acara</strong> untuk memastikan persiapan berjalan lancar.</p>
    </div>

    <!-- Pertanyaan 5 -->
    <button class="dropdown-btn">5. Pembatalan dan Perubahan Pesanan</button>
    <div class="dropdown-container">
        <p>Pembatalan atau perubahan pesanan bisa dilakukan maksimal <strong>7 hari sebelum tanggal acara</strong>. Silakan hubungi kami untuk proses lebih lanjut.</p>
    </div>

    <!-- Pertanyaan 6 -->
    <button class="dropdown-btn">6. Kontak Bantuan</button>
    <div class="dropdown-container">
        <p>Jika Anda membutuhkan bantuan cepat, gunakan tombol WhatsApp yang tersedia di halaman ini untuk langsung menghubungi tim kami.</p>
        <ul>
            <li>Klik tombol WhatsApp di pojok bawah layar.</li>
            <li>Kirim pesan sesuai kebutuhan Anda, seperti bertanya tentang paket, pemesanan, atau perubahan pesanan.</li>
        </ul>
        <p>Kami siap membantu Anda dengan cepat dan ramah melalui WhatsApp.</p>
    </div>

    <script>
        const dropdowns = document.querySelectorAll('.dropdown-btn');
        dropdowns.forEach(btn => {
            btn.addEventListener('click', () => {
                btn.classList.toggle('active');
                const content = btn.nextElementSibling;
                if (content.classList.contains('open')) {
                    content.classList.remove('open');
                } else {
                    content.classList.add('open');
                }
            });
        });
    </script>
</body>
</html>
