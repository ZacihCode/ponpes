@extends('frontend.layouts.app')

@section('title', 'Visi Misi')

@section('content')

<section class="container py-5 visi-misi-section" style="margin-top: 70px;">

    {{-- Hero Image with Title Overlay --}}
    <div class="visi-misi-hero" data-aos="fade-in">
        <img src="https://cdn.aceimg.com/vjZ5mpjlc.jpg" alt="Visi Misi Pesantren">
        <div class="visi-misi-hero-overlay">
            <span class="visi-misi-eyebrow">Assanadiyah</span>
            <h2 class="visi-misi-title">Visi & Misi Pesantren</h2>
        </div>
    </div>

    {{-- Visi & Misi (lebar sejajar dengan hero) --}}
    <div class="visi-misi-grid">

        {{-- Visi --}}
        <div class="visi-misi-card" data-aos="fade-up" data-aos-delay="100">
            <div class="visi-misi-icon">
                <i class="fas fa-eye"></i>
            </div>
            <h4 class="visi-title">Visi</h4>
            <p class="visi-paragraph">
                GENERASI UNGGUL, BERPRESTASI DAN BERBUDI PEKERTI
                (GAUL, BERPRESTASI DAN BERBAKTI)
                Pon-pes Assanadiyah Al-Islamiyahberupaya untuk dapat dikenal oleh setiap kalangan dan level masyarakat sebagai sekolah Unggul bidang keilmuan, Berprestasi dalam Saint, keagamaan, Seni dan Olahraga, Berbudi pekerti dalam karya, sosial, dan Budaya para siswa didukung oleh tenaga pengajar dan Staf/pegawai yang Amanah Fair and Care. (Jujurdan Peduli)19:52
            </p>
        </div>

        {{-- Misi --}}
        <div class="visi-misi-card misi-card" data-aos="fade-up" data-aos-delay="200">
            <div class="visi-misi-icon">
                <i class="fas fa-flag"></i>
            </div>
            <h4 class="misi-title">Misi</h4>
            <p class="misi-paragraph">
                1. Memiliki Guru, staf/pegawai yang profesional dan menjadi tauladan.
                2. Melengkapi sarana dan prasarana yang menunjang proses kegiatan belajar mengajar.
                3. Selalu meng-upgrade informasi dan komunikasi yang mendukung kegiatan pembelajaran.
                4. Membudayakan suasana Islami, kondusif dalam kegiatan PKBM.
                5. Program Al-quranisasi keilmuan dan tekhnologi.
                6. Meningkatkan program-program strategis berupa program sosialkeagamaan, pengabdian kemasyarakatan, dan pengembangan keilmuan.
            </p>
        </div>

    </div>

</section>

@endsection