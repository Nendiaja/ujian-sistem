<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Sistem Ujian Karyawan</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/backsite/app-assets/css/bootstrap.css') }}">
    <style>
        .divider:after,
        .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
        }
        .h-custom {
        height: calc(100% - 73px);
        }
        @media (max-width: 450px) {
        .h-custom {
        height: 100%;
        }
        }
    </style>

    @include('sweetalert::alert')
</head>
<body>
        <div class="container-fluid">
            <section class="vh-100">
                <div class="container-fluid h-custom">
                  <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="text-center col-md-9 col-lg-6 col-xl-5">
                      <img style="width: 350px;"  src="{{ asset('/assets/backsite/app-assets/images/logo/logo2.png') }}"
                        class="img-fluid" alt="Sample image">
                        <p class="mt-3" style="font-family: 'Your Desired Font', monospace; font-size: 24px;">Sistem Ujian Karyawan</p>
                    </div>
                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                      <form action="{{ route('login.create') }}" method="POST">

                        @csrf
                        @method('GET')
              
                        <!-- Email input -->
                        <div class="form-outline mb-1">
                            <label class="form-label" for="form3Example3">SAP</label>
                          <input type="SAP" name="SAP" value="{{ old('SAP') }}" id="form3Example3" class="form-control form-control-lg"
                            placeholder="Enter a valid SAP" />
                        </div>
              
                        <!-- Password input -->
                        <div class="form-outline mb-1">
                            <label class="form-label" for="form3Example4">Password</label>
                          <input type="password" name="password" id="form3Example4" class="form-control form-control-lg"
                            placeholder="Enter password" />
                        </div>
                       
                        <div class="text-center text-lg-start">
                          <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                        </div>
              
                      </form>
                    </div>
                  </div>
                </div>
        
                </div>
              </section>
           
        </div>
        
    </div>
   
    <!-- Script to display SweetAlert -->
    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}',
        });
    </script>
    @endif
</body>


</html>