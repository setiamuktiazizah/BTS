@extends('layouts.main')

@section('container')
        <!-- Header-->
        <header class="masthead text-center text-white">
            <div class="masthead-content">
                <div class="container px-5">
                    <h1 class="masthead-heading mb-0">Base Tranceiver Station Management</h1>
                    <h2 class="masthead-subheading mb-0">Kemudahan Manajemen BTS Dalam Genggaman Anda</h2>
                    <a class="btn btn-primary btn-xl rounded-pill mt-5" href="#scroll">Info Lebih Lanjut</a>
                </div>
            </div>
            <div class="bg-circle-1 bg-circle"></div>
            <div class="bg-circle-2 bg-circle"></div>
            <div class="bg-circle-3 bg-circle"></div>
            <div class="bg-circle-4 bg-circle"></div>
        </header>
        <!-- Content section 1-->
        <section id="scroll">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/01.jpg" alt="..." /></div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="p-5">
                            <h2 class="display-4">Admin dan Tenaga Kerja Terbaik</h2>
                            <p>Tim kami telah mendapatkan training serta pelatihan secara rutin sehingga dapat menyelesaikan pekerjaan dengan cepat. Meski waktu pengerjaan terbilang cepat, hasilnya sangat maksimal dan memuaskan. Kami berkomitmen memberikan pelayanan yang terbaik.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content section 2-->
        <section>
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/02.jpg" alt="..." /></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <h2 class="display-4">100% Aman dan Terpercaya</h2>
                            <p>Kami memiliki lisensi resmi dan dalam pengawasan pemerintah. Semua data dan privasi sangat terlindungi dalam sistem kami.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content section 3-->
        <section>
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/03.jpg" alt="..." /></div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="p-5">
                            <h2 class="display-4">Mudah Digunakan dan Simpel</h2>
                            <p>Content Management System yang sederhana dan mudah digunakan. Kami selalu berusaha untuk menghadirkan konten dengan baik dan simpel tanpa mengurangi nilai informasi yang dibutuhkan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
@endsection