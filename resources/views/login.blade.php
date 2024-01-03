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

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form class="row g-3 needs-validation" method="POST" action="" id="login-form">
                  @csrf
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="user" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="pass" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <label for="userType" class="form-label">Log In As</label>
                      <select name="userType" class='form-select' id="userType">
                        <option value="client" selected>Client</option>
                        <option value="admin">Admin</option>
                      </select>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                  
                  </form>
                  <div id="registrationHyperLink">
                      
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

<script src="{{ asset('jsAssets/jquery-3.5.1.min.js') }}"></script>
@include('components.scripts')
<script src="{{ asset('jsActions/main.js') }}"></script>
<script src="{{ asset('jsActions/login.js') }}"></script>

</body>

</html>