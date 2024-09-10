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
<body>
    <!-- #HEADER -->
    <header>
        <div class="container-fluid bg-white shadow-sm">
            <div class="row">
                <div class="col-6">
                    <img class="header-logo" src="{{ asset('img/VTR-12080_logo_NOIR.png') }}" alt="VTR Logo">
                </div>
                <div class="col-6 d-flex justify-content-end align-items-center">
                    <div class="p-2 border-end border-dark">Retour au site de la ville</div>
                    <div class="p-2">Déconnexion</div>
                </div>
            </div>
        </div>
    </header>
    

    @yield('content')

    <!-- #FOOTER -->
    <footer>
        <div class="container-fluid bg-white">
            <div class="row py-2">
                <div class="col-6 d-flex justify-content-start align-items-center">
                    <img class="footer-logo" src="{{ asset('img/VTR-12080_logo_NOIR.png') }}" alt="VTR Logo">
                    <div>
                        <div>Ville de Trois-Rivières</div>
                        <div>1325, place de l'Hotêl-de-Ville, C.P. 368</div>
                        <div>Trois-Rivières, QC G9A 5H3</div>
                        <div>Téléphone : 311 ou 819 374-2002</div>
                        <div>Canada ou États-unis : 1 833 374-2002</div>
                        <div>Courriel : 311@v3r.net</div>
                    </div>
                </div>
                <div class="col-6 d-flex justify-content-center align-items-end flex-column">
                    <img class="header-logo" src="{{ asset('img/Logo_Technique_Informatique.png') }}" alt="VTR Logo">
                    <div>© Ville de Trois-Rivières. Tous droits réservés.</div>
                    <div>Réalisé par : Jérémy Faucher, Nicolas Fleurent et Mirolie Théroux</div>
                </div>
            </div>
        </div>
    </footer>

    <!-- #SCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>