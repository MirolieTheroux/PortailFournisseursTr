<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    @yield('css')
</head>
<body class="d-flex flex-column justify-content-between vh-100">
    <!-- #HEADER -->
    <header class="navbar">
        <div class="container-fluid bg-white shadow-sm mb-2">
            <div class="row w-100">
                <div class="col-6">
                    <img class="header-logo" src="{{ asset('img/VTR-12080_logo_NOIR.png') }}" alt="VTR Logo">
                </div>
                <div class="col-6 justify-content-end align-items-center">
                    <div class="d-none d-md-flex justify-content-end align-items-center h-100 w-100">
                      <div class="p-2 border-end border-dark">{{__('navbar.returnHomeWebSite')}}</div>
                      <div class="p-2">{{__('navbar.disconnect')}}</div>
                    </div>
                    
                    
                    <div class="d-flex d-md-none justify-content-end align-items-center h-100 w-100">
                      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                        </svg>
                      </button>
                    </div>
                </div>
                <div class="collapse" id="navbarToggleExternalContent">
                  <div class="d-flex d-md-none flex-column justify-content-center align-items-center">
                    <div class="p-2 border-bottom border-dark">{{__('navbar.returnHomeWebSite')}}</div>
                    <div class="p-2">{{__('navbar.disconnect')}}</div>
                  </div>
                </div>
            </div>
        </div>
    </header>
    
    <main>
        @yield('progressBar')
        @yield('content')
    </main>

    <!-- #FOOTER -->
    <footer>
        <div class="container-fluid bg-white">
            <div class="row py-2">
                <div class="col-12 col-md-6 d-flex flex-column flex-md-row justify-content-start align-items-center">
                    <img class="footer-logo" src="{{ asset('img/VTR-12080_logo_NOIR.png') }}" alt="VTR Logo">
                    <div>
                        <div>{{__('footer.organisationName')}}</div>
                        <div>{{__('footer.addressLine1')}}</div>
                        <div>{{__('footer.addressLine2')}}</div>
                        <div>{{__('footer.phoneLine1')}}</div>
                        <div>{{__('footer.phoneLine2')}}</div>
                        <div>{{__('footer.email')}}</div>
                    </div>
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-center align-items-center align-items-md-end flex-column">
                    <img class="header-logo" src="{{ asset('img/Logo_Technique_Informatique.png') }}" alt="VTR Logo">
                    <div class="text-center text-md-end">{{__('footer.copyrights')}}</div>
                    <div class="text-center text-md-end">{{__('footer.madeBy')}}</div>
                </div>
            </div>
        </div>
    </footer>

    <!-- #SCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{ asset('js/progressBar.js') }} "></script>
</body>
</html>