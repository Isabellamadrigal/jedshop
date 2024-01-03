

@php
    $sessionArr = session('pms_midterms');
    $sessionParsed = json_decode($sessionArr);
@endphp




<!DOCTYPE html>
<html lang="en">

<head>
  @include('components.metaData')
  <title>Home | Auto Care</title>
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
          
          <div class="card">
            <div class="card-body">
              <h5>Logs</h5>
              <div class="table-responsive">
                <table class="table" id='onServiceLogstTable' style='font-size:10px;'>
                  <thead>
                    <tr>
                    
                      <th>Client</th>
                      <th>Vehicle</th>
                      <th>Services Applied</th>
                      <th>Parts Applied</th>
                      <th>Date/Time Start</th>
                      <th>Date/Time End</th>
                      <th>Total Price</th>
                      <th>Service Status</th>
                      <th>payment status</th>
                    </tr>
                  </thead>
                </table>
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
<script src="{{ asset('jsActions/admin/logs.js') }}"></script>
<script src="{{ asset('jsActions/admin/adminModel.js') }}"></script>


</body>

</html>