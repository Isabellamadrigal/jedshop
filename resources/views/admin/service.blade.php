

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
                
            <div class="container mt-4">
                    <!-- Show/Hide Data button -->
                    <div class="mb-3">
                        <button class="btn btn-primary" type="button" id="toggleBtn" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Show Approve Appointment
                        </button>
                    </div>
                    <div class="collapse" id="collapseExample">
                    <div>
                        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search Client Name">
                    </div>
                    <!-- Display data with horizontal scroll and vertical scroll -->
                    <div id="dataContainer" class="d-flex flex-nowrap overflow-auto" style="max-height: 400px; overflow-y: auto; display: none;">
                        <!-- Data will be loaded here -->
                    </div>

                    <!-- Search bar -->
                

                    <!-- Pagination -->
                    <div id="pagination" class="d-flex justify-content-center mt-4">
                        <!-- Pagination links will be loaded here -->
                    </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h5>On Service</h5>
              <div class="table-responsive">
                <table class="table" id='onServicetTable' style='font-size:10px;'>
                  <thead>
                    <tr>
                      <th>Actions</th>
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
<script src="{{ asset('jsActions/admin/service.js') }}"></script>
<script src="{{ asset('jsActions/admin/adminModel.js') }}"></script>

@include('admin.modals.appointmentModal')
</body>

</html>