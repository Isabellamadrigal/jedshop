

@php
    $sessionArr = session('pms_midterms');
    $sessionParsed = json_decode($sessionArr);
@endphp




<!DOCTYPE html>
<html lang="en">

<head>
  @include('components.metaData')
  <title>JED AUTO SHOP</title>
  <link rel="icon" href="img/logoo.jpg" type="image/x-icon">
  @include('components.plugins.googleFont')

@include('components.plugins.fontAwesome')

@include('components.plugins.icofont')

@include('components.plugins.themify')

@include('components.plugins.flagIcon')

@include('components.plugins.featherIcon')

@include('components.plugins.css')

@include('components.plugins.bootstrap')

@include('components.plugins.appCss')

@include('components.plugins.responsiveCss')

@include('components.plugins.custom')
 
</head>

<body>

  <!-- page-wrapper Start-->
  <div class="page-wrapper compact-sidebar" id="pageWrapper">

    <!-- Page Header Start-->
    @include('components.header')
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper ">

    @include('components.mainNav')

      <div class="page-body">
        <div class="container-fluid dashboard-default-sec">
            <div class="row">
              <div class="col-5 col-md-5 col-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="text-center">
                      <b>Auto Care Services</b>
                      </div>
                      
                      <hr>
                      <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner" id="carouselInner">

                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="col-7 col-md-7 col-12">
                  <div class="row">
                    <div class="col-4">
                      <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                  <h4><i class="fa-solid fa-car-side"></i></h4>
                            </div>
                            <hr>
                            <div class="text-center">
                              My Vehichle/s:<span id="vehicle-count"></span>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                  <h4><i class="fa-solid fa-screwdriver-wrench"></i></h4>
                            </div>
                            <hr>
                            <div class="text-center">
                              Service Availed:<span id="service-count"></span>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="card">
                        <div class="card-body p-1 text-center bg-info rounded">
                          <h4>Notice</h4>
                        </div>
                      </div>
                      <div class="announcements">
                       
                      </div>
                    </div>
                  </div>
              </div>
            </div>
      </div>
    </div>
    @include('components.footer')
  </div>

  @include('components.scripts')
 
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="{{ asset('jsActions/main.js') }}"></script>
<script src="{{ asset('jsActions/client/dashboard.js') }}"></script>
<script src="{{ asset('jsActions/client/clientModel.js') }}"></script>




</body>

</html>