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

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">


              <div class="card mb-3">
                <div class="d-flex justify-content-center py-4">
                  <a href="index.html" class="logo d-flex align-items-center w-auto">
                    <img src="" style='width:150px;' alt="">
                    <!-- <span class="d-none d-lg-block">NiceAdmin</span> -->
                  </a>
                </div><!-- End Logo -->

                <div class="card-body">
                <div class="pt-4 ">
                    <h5 class="card-title text-center pb-0 fs-4">Registration Form</h5>
                  </div>
                  <hr>
                
                  <form class="row g-3" method="POST" action="" id="customer-registration-form" enctype="multipart/form-data" >
                    @csrf
                    
                    <div class="col-12" id="imgTag" >
                      <img id="imagePreview" src="#" class="rounded-circle img-thumbnail" alt=" " >
                    </div>
                    <div class="col-12">
                      <input type="file" name="image" id="image" class="form-control">
                      </div>
                    <b>Account Credentials</b>
                    <div class="col-12">
                      <input class="form-control" type="email" id="email" name="email" placeholder="Email Address"
                        required>
                    </div>
                    <div class="col-12">
                      <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                    {{-- <div class="col-12">
                    <input type="file" name="image" id="image" class="form-control">
                    </div> --}}
                  
                    <b>Personal Information</b>
                    <div class="col-12">
                      <input class="form-control" type="text" name="name" placeholder="Name" required>
                    </div>
                    <div class="col-12">
                      <textarea class="form-control" rows="3" name="address" placeholder="Address" required></textarea>
                    </div>
                    <div class="col-12">
                      <input class="form-control" type="text" name="phoneNumber" placeholder="Phone number" required>
                    </div>
                    <hr>
                    <div class="col-12 text-center">
                      <input class="btn btn-primary" type="submit" value="Register">
                    </div>
                  </form>
                  <br>
                  <div class="row">
                    <div class="col">
                      <a href="/undago/home">Back to login</a>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </section>
    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>


@include('components.scripts')
<script src="{{ asset('jsActions/main.js') }}"></script>
<script src="{{ asset('jsActions/client/registration.js') }}"></script>
<script src="{{ asset('jsActions/client/clientModel.js') }}"></script>
</body>

</html>