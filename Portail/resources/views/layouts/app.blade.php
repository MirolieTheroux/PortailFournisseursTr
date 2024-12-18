<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('img/VTR-12080_logo_NOIR.ico') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toast.css') }}">
    @yield('css')
</head>
<body class="d-flex flex-column justify-content-between min-vh-100">
    <!-- #HEADER -->
    <header class="navbar">
        <div class="container-fluid bg-white shadow-sm">
            <div class="row w-100">
                <div class="col-6">
                  <a href="{{route('suppliers.home')}}"><img class="header-logo" src="{{ asset('img/VTR-12080_logo_NOIR.png') }}" alt="VTR Logo"></a>
                </div>
                <div class="col-6 justify-content-end align-items-center">
                    <div class="d-none d-lg-flex justify-content-end align-items-center h-100 w-100">
                      <div class="p-2"><a href="{{route('documentation.index')}}" target="_blank">{{__('navbar.help')}}</a></div>
                      @auth
                        <form action="{{route('suppliers.logout')}}" method="post">
                          @csrf
                          <button class="p-2 border-start border-dark link-button" type="submit">{{__('navbar.disconnect')}}</button>
                        </form>
                      @endauth
                    </div>
                    <div class="d-flex d-lg-none justify-content-end align-items-center h-100 w-100">
                      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                        </svg>
                      </button>
                    </div>
                </div>
                <div class="collapse" id="navbarToggleExternalContent">
                  <div class="d-flex d-lg-none flex-column justify-content-center align-items-center">
                    <div class="text-center w-100 p-2 border-bottom border-dark"><a href="{{route('documentation.index')}}" target="_blank">{{__('navbar.help')}}</a></div>
                    @auth
                      <form class="w-100" action="{{route('suppliers.logout')}}" method="post">
                        @csrf
                        <button class="text-center w-100 p-2 border-top border-dark link-button" type="submit">{{__('navbar.disconnect')}}</button>
                      </form>
                    @endauth
                    @yield('mobile-navbar')
                  </div>
                </div>
            </div>
        </div>
    </header>

    <!-- #MAIN -->
    <main class="container-fluid flex-grow-1 p-0">
        @yield('content')
    </main>

    <!-- #FOOTER -->
    <footer>
        <div class="container-fluid bg-white m-0 footer-shadow">
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

    {{-- TOAST RÉUSSI --}}
    @if(session('message'))
    <div class="toast ">
      <div class="toast-content">
        <ion-icon name="checkmark-circle-outline"></ion-icon>
        <div class="message">
          <span class="text text-1">Réussi</span>
          <span class="text text-2">{{session('message')}}</span>
        </div>
      </div>
      <div class="progress "></div>
    </div> 
    @elseif(session('errorMessage'))
    {{-- TOAST ERREUR --}}
    <div class="toast">
      <div class="toast-content">
        <ion-icon class="text-erreur" name="close-circle-outline"></ion-icon>
        <div class="message">
          <span class="text text-1 text-erreur">Erreur</span>
            <span class="text text-2">{{session('errorMessage')}}</span>
        </div>
      </div>
      <div class="progress progress-erreur"></div>
    </div>
    @endif

    <!-- #SCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="{{ asset('js/toast.js') }}"></script>
    
    @yield('scripts')
</body>
</html>
