@extends('dashboard.layouts.main')

@section('container')
        <div aria-label="breadcrumb" class="container py-2">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="../home/index.html" class=" text-black">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Maps</li>
            </ol>
        </div>

        <!-- Tambahin disini.... -->
        <div class = "col-md-10 bg-light rounded ps-2">
            <div class="d-flex align-items-center">
                <h2>
                    Pemetaan Lokasi BTS
                </h2>
            </div>
            <div>
                <div id="map" style="width: 99%; height: 500px; display: block">
                    {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3832582.65742806!2d107.20947990505394!3d-6.353576885707641!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sBase%20Transceiver%20Station%20(BTS)!5e0!3m2!1sen!2sid!4v1650896172038!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
                </div>
            </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              </div>

            </div>
          </div>
        </div>
        
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