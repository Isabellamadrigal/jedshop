

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
        <div class="row">
            <div class="col">
            <div class="card">
            <div class="card-body">
            <div class="row">
                    <div class="col"><h5>Services</h5></div>
                    <div class="col text-end">
                        <button type="button" class="btn btn-primary addServiceBtn">Add Services</button>
                    </div>
                </div>
              <div class="table-responsive">
                <table class="table" id='servicesTable' style='font-size:10px;'>
                  <thead>
                    <tr>
                      <th>Actions</th>
                      <th>Image</th>
                      <th>Service Desc</th>
                      <th>Price</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
            </div>
            <div class="col">
            <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col"><h5>Parts</h5></div>
                    <div class="col text-end">
                        <button type="button" class="btn btn-primary addPartsBtn" >Add Parts</button>
                    </div>
                </div>
             
              <div class="table-responsive">
                <table class="table" id='PartsTable' style='font-size:10px;'>
                  <thead>
                    <tr>
                      <th>Actions</th>
                      <th>Image</th>
                      <th>Part Desc</th>
                      <th>Category</th>
                      <th>Price</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                </table>
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
<script src="{{ asset('jsActions/admin/settings.js') }}"></script>
<script src="{{ asset('jsActions/admin/adminModel.js') }}"></script>

@include('admin.modals.settingsModal')
</body>

</html>