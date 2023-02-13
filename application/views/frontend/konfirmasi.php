<main id="main">

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Laporan Hasil Pemeriksaan</h2>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestias laudantium, eligendi veritatis quo voluptatum nisi! Repudiandae cumque fugit harum laboriosam voluptates veniam repellat sequi recusandae, rerum enim, dolores tempora ut!</p>
            </div>

            <div>
                <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3979.485349126062!2d104.16656811474536!3d-4.124463397001102!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e39af6ab6d26c9b%3A0xcd4e7eab46627c9f!2sPT%20Telkom%20Baturaja!5e0!3m2!1sid!2sid!4v1667112811705!5m2!1sid!2sid" frameborder="0" allowfullscreen></iframe>
            </div>

            <div class="row mt-5">
                <div class="col-lg-12 mt-5 mt-lg-0">
                    <form action="<?= base_url('laporan/done/').$laporan[0]->laporan_id ?>" method="post" class="php-email-form" enctype="multipart/form-data">
                    <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="teknisi_id" class="form-control" id="teknisi_id" value="<?= $laporan[0]->teknisi_id ?>"  placeholder="ID Teknisi" readonly>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="text" class="form-control" name="teknisi_nama" id="teknisi_nama" value="<?= $laporan[0]->teknisi_nama ?>"  placeholder="Nama Teknisi " readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="pelanggan_id" class="form-control" id="pelanggan_id" value="<?= $laporan[0]->laporan_pelanggan ?>"  placeholder="ID Pelanggan" readonly>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="text" class="form-control" name="pelanggan_nama" id="pelanggan_nama" value="<?= $laporan[0]->pelanggan_nama ?>"  placeholder="Nama Pelanggan" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="pelanggan_telepon" class="form-control" id="pelanggan_telepon" value="<?= $laporan[0]->pelanggan_telepon ?>"  placeholder="Telepon Pelanggan" readonly>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="text" class="form-control" name="pelanggan_alamat" id="pelanggan_alamat" value="<?= $laporan[0]->pelanggan_alamat ?>"  placeholder="Alamat Pelanggan" readonly>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="laporan_text" rows="5"  placeholder="Isi laporan" readonly><?= $laporan[0]->laporan_text ?></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="hasil_pemeriksaan" rows="5"  placeholder="Hasil Pemeriksaan" required></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label>Foto Hasil Pemeriksaan</label><br>
                            <input type="file" name="foto_hasil_pemeriksaan" required>
                        </div>
                        <div class="text-center"><button type="submit" name="submit">Send Message</button></div>
                    </form>
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->
    <input type="hidden" id="url" value="<?= base_url() ?>">
</main><!-- End #main -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>