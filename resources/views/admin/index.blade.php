

@php
    $sessionArr = session('pms_midterms');
    $sessionParsed = json_decode($sessionArr);
@endphp




<!DOCTYPE html>
<html lang="en">

<head>
  @include('components.metaData')
  <title>JED AUTO SHOP</title>
  <link rel="icon" href="/logoo.jpg" type="image/x-icon">
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
                  <div class="card shadow">
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
                    <div class="col">
                    <div class="card shadow">
                        <div class="text-end p-2 card-body">
                        <select class="form-select" id="chartTimelineSelect">
                            <option value="day" selected>Day</option>
                            <option value="week">Week</option>
                            <option value="month">Month</option>
                            <option value="year">Year</option>
                        </select>
                        </div>
                        <div class="card-body">
                          <canvas id="totalSales"></canvas>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6 col-md-6 col-12">
                    <div class="card shadow">
                        <div class="card-body">

                            <div>
                                <b>Finished Repairs:</b> <span id="finished-task"></span>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-md-6 col-12">
                    <div class="card shadow">
                        <div class="card-body">

                            <div>
                                <b>Pending Appointments:</b> <span id="appointment-count"></span>
                            </div>
                        </div>
                      </div>
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
<script src="{{ asset('jsActions/admin/dashboard.js') }}"></script>
<script src="{{ asset('jsActions/admin/adminModel.js') }}"></script>




</body>

</html>