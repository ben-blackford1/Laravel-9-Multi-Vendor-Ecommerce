<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--favicon-->
    <link rel="icon" href="{{ asset('admin_backend/assets/images/favicon-32x32.png')}}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('admin_backend/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <link
      href="{{ asset('admin_backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}"
      rel="stylesheet"
    />
    <link
      href="{{ asset('admin_backend/assets/plugins/metismenu/css/metisMenu.min.css')}}"
      rel="stylesheet"
    />
    <!-- loader-->
    <link href="{{ asset('admin_backend/assets/css/pace.min.css')}}" rel="stylesheet" />
    <script src="{{ asset('admin_backend/assets/js/pace.min.js')}}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('admin_backend/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('admin_backend/assets/css/app.css')}}" rel="stylesheet" />
    <link href="{{ asset('admin_backend/assets/css/icons.css')}}" rel="stylesheet" />
    <title>Admin Login</title>
  </head>

  <body class="bg-login">
    <!--wrapper-->
    <div class="wrapper">
      <div
        class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0"
      >
        <div class="container-fluid">
          <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
            <div class="col mx-auto">         
              <div class="card">
                <div class="card-body">
                  <div class="p-4 rounded">
                    <div class="text-center">
                      <h3 class="">Admin Sign In</h3>
                    </div>                  
                    <div class="form-body">
                      <form class="row g-3" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="col-12">
                          <label for="inputEmailAddress" class="form-label"
                            >Email Address</label
                          >
                          <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            placeholder="Email Address"
                          />
                        </div>
                        <div class="col-12">
                          <label for="inputChoosePassword" class="form-label"
                            >Enter Password</label
                          >
                          <div class="input-group" id="show_hide_password">
                            <input
                              type="password"
                              class="form-control border-end-0"
                              id="password"
                              name="password"
                              placeholder="Enter Password"
                            />
                            <a
                              href="javascript:;"
                              class="input-group-text bg-transparent"
                              ><i class="bx bx-hide"></i
                            ></a>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-check form-switch">
                            <input
                              class="form-check-input"
                              type="checkbox"
                              id="flexSwitchCheckChecked"
                              checked
                            />
                            <label
                              class="form-check-label"
                              for="flexSwitchCheckChecked"
                              >Remember Me</label
                            >
                          </div>
                        </div>
                        <div class="col-md-6 text-end">
                          <a href="authentication-forgot-password.html"
                            >Forgot Password ?</a
                          >
                        </div>
                        <div class="col-12">
                          <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                              <i class="bx bxs-lock-open"></i>Sign in
                            </button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--end row-->
        </div>
      </div>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="{{ asset('admin_backend/assets/js/bootstrap.bundle.min.js')}}"></script>
    <!--plugins-->
    <script src="{{ asset('admin_backend/assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('admin_backend/assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
    <script src="{{ asset('admin_backend/assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
    <script src="{{ asset('admin_backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
    <!--Password show & hide js -->
    <script>
      $(document).ready(function () {
        $("#show_hide_password a").on("click", function (event) {
          event.preventDefault();
          if ($("#show_hide_password input").attr("type") == "text") {
            $("#show_hide_password input").attr("type", "password");
            $("#show_hide_password i").addClass("bx-hide");
            $("#show_hide_password i").removeClass("bx-show");
          } else if (
            $("#show_hide_password input").attr("type") == "password"
          ) {
            $("#show_hide_password input").attr("type", "text");
            $("#show_hide_password i").removeClass("bx-hide");
            $("#show_hide_password i").addClass("bx-show");
          }
        });
      });
    </script>
    <!--app JS-->
    <script src="{{ asset('admin_backend/assets/js/app.js') }}"></script>
  </body>
</html>