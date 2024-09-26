@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/supplier.css') }}">
<link rel="stylesheet" href="{{ asset('css/progressBar.css') }}">
<script src="{{ asset('js/createValidation.js') }}"></script>
@endsection

@section('content')
<form method="post" action="{{ route('suppliers.store') }}" class="need-validation" novalidate enctype="multipart/form-data">
@csrf
    <!--PROGRESS BAR-->
    <!--TODO::Attention, faire que la ligne blanche n'apparaisse pas dans la pointe-->
    <!--TODO::Attention, fait le ménage dans tes MediaQuery-->
    <div class="container-fluid d-flex justify-content-center">		
        <div class="arrow-steps mt-3">
            <div class="step current">
                <span class="number">1</span>
                <span class="name">{{__('form.identificationTitle')}}</span>
            </div>
            <div class="step">
                <span class="number">2</span>
                <span class="name">Produits et services</span><!--TODO::Fichier de langue-->
            </div>
            <div class="step">
                <span class="number">3</span>
                <span class="name">Licence RBQ</span><!--TODO::Fichier de langue-->
            </div>
            <div class="step">
                <span class="number">4</span>
                <span class="name">Coordonnées</span><!--TODO::Fichier de langue-->
            </div>
            <div class="step">
                <span class="number">5</span>
                <span class="name">Contacts</span><!--TODO::Fichier de langue-->
            </div>
            <div class="step">
                <span class="number">6</span>
                <span class="name">Pièces jointes</span><!--TODO::Fichier de langue-->
            </div>
        </div>
    </div><!-- FIN PROGRESS BAR-->

    <!--IDENTIFICATION-->  
    <!--TODO::Le titre de la section disparaît pour l'écran mobile-->
    <div class="container bg-white rounded my-2">
        <div class="row d-none d-md-block">
            <div class="col-12 rounded-top fond-image fond-identification"></div>
        </div>
        <div class="row">
            <div class="d-none d-md-block col-12 text-center">
                <h1 class="section-title">{{__('form.identificationTitle')}}</h1>
            </div>
        </div>
        <div class="row px-3">
            <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
                <h2 class="text-center section-subtitle">{{__('form.identificationCompanySection')}}</h2>
                <div class="text-start">
                    <div class="form-floating mb-3">
                        <input type="text" oninput="validateIdentificationNeq()" name="neq" id="neq" class="form-control is-valid" placeholder="" maxlength="10">
                        <label for="neq">{{__('form.neqLabel')}}</label>
                        <div class="valid-feedback" id="neqValid1">Le NEQ n'est pas obligatoire.</div>
                        <div class="invalid-feedback" id="neqInvalid1" style="display: none;">Le NEQ doit débuter par 11, 22, 33 ou 88!</div>
                        <div class="invalid-feedback" id="neqInvalid2" style="display: none;">Le troisième caractère doit être 4, 5, 6, 7, 8 ou 9!</div>
                        <div class="invalid-feedback" id="neqInvalid3" style="display: none;">Le NEQ doit être composé uniquement de chiffres!</div>
                        <div class="invalid-feedback" id="neqInvalid4" style="display: none;">Le NEQ doit être composé de 10 chiffres!</div>
                        <div class="invalid-feedback" id="neqInvalid5" style="display: none;">Le NEQ est déjà enregistrer pour un autre compte!</div>
                        <div class="valid-feedback" id="neqValid2" style="display: none;"></br></div>
                    </div>
                </div>
                <div class="text-start">
                    <div class="form-floating mb-3">
                        <input type="text" oninput="validateIdentificationName()" name="name" id="name" class="form-control is-invalid" placeholder="" required maxlength="64">
                        <label for="name">{{__('form.companyNameLabel')}}</label>
                        <div class="valid-feedback" id="nameValid1" style="display: none;"></br></div>
                        <div class="invalid-feedback" id="nameInvalid1">Le nom d'entreprise est obligatoire!</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 d-flex flex-column justify-content-between">
                <h2 class="text-center section-subtitle">{{__('form.identificationAuthentificationSection')}}</h2>
                <div class="text-start">
                    <div class="form-floating mb-3">
                        <input type="email" oninput="validateIdentificationEmail()" name="email" id="email" class="form-control is-invalid" required placeholder="example@gmail.com" maxlength="64">
                        <label for="email">{{__('form.emailLabel')}}</label>
                        <div class="valid-feedback" id="emailValid1" style="display: none;"></br></div>
                        <div class="invalid-feedback" id="emailInvalid1">L'adresse courriel est obligatoire!</div>
                        <div class="invalid-feedback" id="emailInvalid2" style="display: none;">L'adresse courriel ne peut commencer par @!</div>
                        <div class="invalid-feedback" id="emailInvalid3" style="display: none;">L'adresse courriel doit contenir un @!</div>
                        <div class="invalid-feedback" id="emailInvalid4" style="display: none;">L'adresse courriel doit contenir un nom de domaine!</div>
                    </div>
                </div>
                <div class="text-start">
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex flex-column justify-content-between">
                            <div class="form-floating mb-3">
                                <input type="password" oninput="validateIdentificationPassword()" name="password" id="password" required class="form-control is-invalid" placeholder="" maxlength="12">
                                <label for="password">{{__('form.passwordLabel')}}</label>
                                <div class="valid-feedback" id="passwordValid1" style="display: none;"></br></div>
                                <div class="invalid-feedback" id="passwordInvalid1">Le mot de passe est obligatoire!</div>
                                <div class="invalid-feedback" id="passwordInvalid2" style="display: none;">Le mot de passe doit contenir entre 7 et 12 caractères!</div>
                                <div class="invalid-feedback" id="passwordInvalid3" style="display: none;">Le mot de passe doit contenir une minuscule!</div>
                                <div class="invalid-feedback" id="passwordInvalid4" style="display: none;">Le mot de passe doit contenir une majuscule!</div>
                                <div class="invalid-feedback" id="passwordInvalid5" style="display: none;">Le mot de passe doit contenir un chiffre!</div>
                                <div class="invalid-feedback" id="passwordInvalid6" style="display: none;">Le mot de passe doit contenir un caractère spécial!</div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 d-flex flex-column justify-content-between">
                            <div class="form-floating mb-3">
                                <input type="password" oninput="validateIdentificationPasswordConfirmation()" name="password_confirmation" required id="password_confirmation" placeholder="" class="form-control is-invalid" maxlength="12">
                                <label for="password_confirmation">{{__('form.passwordConfirmLabel')}}</label>
                                <div class="valid-feedback" id="password_confirmationValid1" style="display: none;"></br></div>
                                <div class="invalid-feedback" id="password_confirmationInvalid1">Le mot de passe est obligatoire!</div>
                                <div class="invalid-feedback" id="password_confirmationInvalid2" style="display: none;">Le mot de passe n'est pas identique!</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-2">
                <button type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.cancel')}}</button><!--TODO::Mettre un nom significatif au Id-->
                <button id="test" type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.next')}}</button><!--TODO::Mettre un nom significatif au Id-->
            </div>
        </div>
    </div>  <!--FIN IDENTIFICATION-->  

    
    <!--PRODUIT ET SERVICE-->
    <div class="container bg-white rounded my-2">
        <div class="row d-none d-md-block">
            <div class="col-12 rounded-top fond-image fond-products_services"></div>
        </div>
        <div class="row">
            <div class="d-none d-md-block col-12 text-center">
                <h1 class="section-title">{{__('form.productsAndServiceTitle')}}</h1>
            </div>
        </div>
        <div class="row px-3">
            <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
                <h2 class="text-center section-subtitle">{{__('form.productsAndServiceCategories')}}</h2>
                <div class="text-center">
                    <div class="form-floating mb-3">
                        <select name="product-category" id="product-category" class="form-select" aria-label="Default select example">
                            <option selected></option>
                            <optgroup label="Approvissionements">
                                <option value="G1">G1 - Aérospatiale</option>
                                <option value="G2">G2 - Matériel de climatisation et de réfrigération</option>
                                <option value="G3">G3 - Armement</option>
                                <option value="G4">G4 - Produits et spécialités chimiques</option>
                                <option value="G5">G5 - Communication, détection et fibres optiques</option>
                                <option value="G6">G6 - Matériaux de construction</option>
                                <option value="G7">G7 - Cosmétiques et articles de toilette</option>
                                <option value="G8">G8 - Matériel et logiciel informatique</option>
                                <option value="G9">G9 - Entretien d'équipement de bureau et d'informatique</option>
                                <option value="G10">G10 - Produits électriques et électroniques</option>
                                <option value="G11">G11 - Énergie</option>
                                <option value="G12">G12 - Moteurs, turbines, composants et accessoires connexes</option>
                                <option value="G13">G13 - Produits finis</option>
                                <option value="G14">G14 - Équipement de lutte contre l'incendie, de sécurité et de protection</option>
                                <option value="G15">G15 - Alimentation</option>
                                <option value="G16">G16 - Préparation alimentaire et équipement de service</option>
                                <option value="G17">G17 - Ameublement</option>
                                <option value="G18">G18 - Équipement industriel</option>
                                <option value="G19">G19 - Machinerie et outils</option>
                                <option value="G20">G20 - Marine</option>
                                <option value="G21">G21 - Fourniture et équipement médicaux et produits pharmaceutiques</option>
                                <option value="G22">G22 - Produits divers</option>
                                <option value="G23">G23 - Matériel de bureau</option>
                                <option value="G24">G24 - Papeterie et fournitures de bureau</option>
                                <option value="G25">G25 - Constructions préfabriqués</option>
                                <option value="G26">G26 - Publications, formulaires et articles en papier</option>
                                <option value="G27">G27 - Instruments scientifiques</option>
                                <option value="G28">G28 - Véhicules spéciaux</option>
                                <option value="G29">G29 - Intégration de systèmes</option>
                                <option value="G30">G30 - Textiles et vêtements</option>
                                <option value="G31">G31 - Équipement de transport et pièces de rechange</option>
                            </optgroup>
                            <optgroup label="Services">
                                <option value="S1">S1 - Recherche et développement (R et D)</option>
                                <option value="S2">S2 - Études spéciales et analyses - (pas R et D)</option>
                                <option value="S3">S3 - Services d'architecture et d'ingénierie</option>
                                <option value="S4">S4 - Traitement de l'information et services de télécommunications connexes</option>
                                <option value="S5">S5 - Services environnementaux</option>
                                <option value="S6">S6 - Services de ressources naturelles</option>
                                <option value="S7">S7 - Services de santé et services sociaux</option>
                                <option value="S8">S8 - Contrôle de la qualité, essais et inspections et services de représentants techniques</option>
                                <option value="S9">S9 - Entretien, réparation, modification, réfection et installation de biens et d'équipement</option>
                                <option value="S10">S10 - Services de garde et autres services connexes</option>
                                <option value="S11">S11 - Services financiers et autres services connexes</option>
                                <option value="S12">S12 - Exploitation des installations gouvernementales</option>
                                <option value="S13">S13 - Services de soutien professionnel et administratif et services de soutien à la gestion</option>
                                <option value="S14">S14 - Services publics</option>
                                <option value="S15">S15 - Services de communication, de photographie, de cartographie, d'impression et de publication</option>
                                <option value="S16">S16 - Services pédagogiques et formation</option>
                                <option value="S17">S17 - Services de transport, de voyage et de déménagement</option>
                                <option value="S18">S18 - Location à bail / Location d'équipement</option>
                                <option value="S19">S19 - Location à bail ou location d'installations immobilières</option>
                            </optgroup>
                            <optgroup label="Autres natures de contrat">
                                <option value="C01">C01 - Bâtiments</option>
                                <option value="C02">C02 - Ouvrages de génie civil</option>
                                <option value="C03">C03 - Autres travaux de construction</option>
                            </optgroup>
                            <optgroup label="Travaux de construction">

                            </optgroup>
<!--				
IMM - Vente de biens immeubles	
MEU1 - Vente de biens meubles	
C1 - Concession	
O1 - Indéterminée	
-->
                        </select>
                        <label for="product-category">{{__('form.productsAndServiceCategoriesList')}}</label>
                    </div>
                </div>
                <div class="text-center">
                    <div class="form-floating mb-3">
                        <input type="text" name="service-search" id="service-search" class="form-control" placeholder="">
                        <label for="service-search">{{__('form.productsAndServiceCategoriesSearch')}}</label>
                    </div>
                </div>
                <div class="text-center">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="details" id="company-name" style="height: 160px; resize: none;" maxlength="500"></textarea>
                        <label for="company-name">{{__('form.productsAndServiceCategoriesDetails')}}</label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
                <h2 class="text-center section-subtitle">{{__('form.productsAndServiceServices')}}</h2>
                <div>
                    <div class="form-floating mb-3">
                        <div class="form-control" placeholder="details" id="company-name" style="height: 308px; overflow-x: hidden; overflow-y: auto;">
                            <div>
                                <div class="row align-items-start">
                                    <div class="col-1 col-md-1 d-flex flex-column justify-content-start">
                                        <input class="form-check-input" type="checkbox" onclick="checkedbox(this)" id="category1" value="">
                                    </div>
                                    <div class="col-4 col-md-4 d-flex flex-column justify-content-start">
                                        <label class="form-check-label" for="category1">05736535</label>
                                    </div>
                                    <div class="col-7 col-md-7 d-flex flex-column justify-content-start">
                                        <label class="form-check-label" for="category1">Service d'entretien ménager</label>
                                    </div>
                                </div>
                                <div class="row align-items-start">
                                    <div class="col-1 col-md-1 d-flex flex-column justify-content-start">
                                        <input class="form-check-input" type="checkbox" onclick="checkedbox(this)" id="category2" value="">
                                    </div>
                                    <div class="col-4 col-md-4 d-flex flex-column justify-content-start">
                                        <label class="form-check-label" for="category2">09563559</label>
                                    </div>
                                    <div class="col-7 col-md-7 d-flex flex-column justify-content-start">
                                        <label class="form-check-label" for="category2">Service d'entretien de pelouse</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label for="company-name">{{__('form.productsAndServiceServicesCategorySelection')}}</label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
                <h2 class="text-center section-subtitle">{{__('form.productsAndServiceSelectedServicesList')}}</h2>
                <div>
                    <div class="form-floating mb-3">
                        <div class="form-control" id="company-name" style="height: 308px; overflow-x: hidden; overflow-y: auto;">
                            <div class="row px-3">
                                <div class="col-12 col-md-12 d-flex flex-column justify-content-between">
                                    <label class="mb-2" id="selectedcategory1" for="category1" style="display:none;">Service d'entretien ménager</label>
                                    <label class="mb-2" id="selectedcategory2" for="category2" style="display:none;">Service d'entretien de pelouse</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-2">
                <button type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.cancel')}}</button>
                <button type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.next')}}</button>
            </div>
        </div>
    </div> <!--FIN PRODUIT ET SERVICE-->


    <!--LICENCE RBQ-->
    
    <!--COORDONNÉES-->
    
    <!--CONTACT-->
    
    <!--PIÈCES JOINTES-->

</form>
@endsection