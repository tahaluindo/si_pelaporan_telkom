<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container-fluid d-flex justify-content-between align-items-center">

            <!-- <h1 class="logo me-auto me-lg-0"><a href="index.html">TELKOM INDONESIA</a></h1> -->
            <!-- Uncomment below if you prefer to use an image logo -->
            <a href="<?= base_url('home') ?>" class="logo"><img src="<?= base_url() ?>assets/frontend/img/telkom.png" alt="" class="img-fluid"></a>

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="active" href="<?= base_url('/') ?>">Beranda</a></li>
                    <li><a href="<?= base_url('about') ?>">Tentang</a></li>
                    <!-- <li><a href="<?= base_url('contact') ?>">Kontak</a></li> -->
                    <li><a href="<?= base_url('report') ?>">Laporan</a></li>
                    <li><a href="<?= base_url('report-history') ?>">History Laporan</a></li>
                    <li><a href="dash">Login</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

            <div class="header-social-links">
                <a href="https://twitter.com/TelkomIndonesia" target="_BLANK" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="https://www.instagram.com/telkomindonesia/" target="_BLANK" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="https://www.linkedin.com/company/telekomunikasi-indonesia/" target="_BLANK" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
            </div>

        </div>

    </header><!-- End Header -->