@extends('layouts.main')

@section('container')
    <!-- Header-->
    <header class="py-5">
        <div class="container px-lg-5">
            <div class="p-4 p-lg-5 bg-light rounded-3 text-center">
                <div class="m-4 m-lg-5">
                    <h1 class="display-5 fw-bold">Map BTS</h1>
                    <p class="fs-4">Sudah banyak BTS yang terdaftar dalam aplikasi kami. Map ini menunjukkan di mana saja BTS tersebut berada.</p>
                </div>
            </div>
        </div>
    </header>
    <!-- Page Content-->
    <section class="pt-4">
        <div class="container px-lg-5">
            <!-- Page Features-->
            <div id="map" style="width: 100%; height: 520px; display: block;" class="mb-5">
                {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11196.961132529668!2d-43.38581128725845!3d-23.011063013218724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9bdb695cd967b7%3A0x171cdd035a6a9d84!2sAv.%20L%C3%BAcio%20Costa%20-%20Barra%20da%20Tijuca%2C%20Rio%20de%20Janeiro%20-%20RJ%2C%20Brazil!5e0!3m2!1sen!2sth!4v1568649412152!5m2!1sen!2sth" width="100%" height="520px" frameborder="0" style="border:0" allowfullscreen></iframe> --}}
            </div>
        </div>
    </section>

    <script>
        const url = '{{ url('/api/locations') }}';

        $(document).ready(function(){
          var map = new GMaps({
            div: '#map',
            lat: -7,
            lng: 107,
            zoom: 6
          });
          $.get(url, function(response){
            console.log(response);
            response.forEach(function(data){
              map.addMarker({
                lat: data.latitude,
                lng: data.longitude,
                title: data.nama,
                infoWindow: {
                  content: '<h6>' + data.nama + '</h6>' + '<p>' + data.alamat + '</p>'
                }
              });
            })
          })

        })
    </script>
@endsection