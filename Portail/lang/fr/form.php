<?php

// lang/en/messages.php

return [
    'neqLabel' => 'Numéro d\'entreprise du Québec (NEQ)',
    'companyNameLabel' => 'Nom de l\'entreprise',
    'emailLabel' => 'Adresse courriel',
    'passwordLabel' => 'Mot de passe',
    'passwordConfirmLabel' => 'Confirmer le mot de passe',
    'firstNameLabel' => 'Prénom',
    'lastNameLabel' => 'Nom',
    'jobLabel' => 'Fonction',
    'numberLabel' => 'Numéro',
    'statusLabel' => 'Statut',
    'typeLabel' => 'Type',
    'choiceDefaultStatus' => 'Choisir un statut',
    'choiceValid' => 'Valide',
    'choiceRestrictedValid' => 'Valide avec restriction',
    'choiceInvalid' => 'Non valide',
    'choiceDefaultType' => 'Choisir un type',
    'choiceEntrepreneur' => 'Entrepreneur',
    'choiceOwnerBuilder' => 'Constructeur-propriétaire',

    'identificationTitle' => 'Identification',
    'identificationCompanySection' => 'Entreprise',
    'identificationAuthentificationSection' => 'Authentification',
    'identificationNeqExistValidation' => 'Le NEQ est déjà enregistrer pour un autre compte.',

    'productsAndServiceTitle' => 'Produits et Services Offerts',
    'productsAndServiceCategories' => 'Catégorie',
    'productsAndServiceCategoriesList' => 'Liste des catégories',
    'productsAndServiceCategoriesSearch' => 'Recherche d\'un service',
    'productsAndServiceCategoriesDetails' => 'Détails et spécifications',
    'productsAndServiceServices' => 'Services',
    'productsAndServiceServicesCategorySelection' => 'Sélectionnez une catégorie',
    'productsAndServiceSelectedServicesList' => 'Liste des services choisis',
    'productsAndServiceValidationNEQ3rd' => 'Le troisième caractère doit être 4, 5, 6, 7, 8 ou 9.',
    'productsAndServiceValidationNEQOnlyDigits' => 'Le NEQ doit être composé uniquement de chiffres.',
    'productsAndServiceValidationNEQAmount' => 'Le NEQ doit être de 10 caractères.',
    'productsAndServiceValidationEmailStartWithArobase' => 'L\'Adresse courriel ne doit pas commencer par @.',
    'productsAndServiceValidationEmailArobaseRequired' => 'L\'adresse courriel doit contenir @.',
    'productsAndServiceValidationEmailOneArobaseOnly' => 'L\'adresse courriel ne peut contenir plusieurs @.',
    'productsAndServiceValidationEmailDomain' => 'L\'adresse courriel doit contenir un nom de domaine.',
    'productsAndServiceValidationEmailDomainContainDot' => 'Le nom de domaine doit contenir un ".".',
    'productsAndServiceValidationEmailDomainDotWrongPosition' => 'Le nom de domaine ne peut finir ou commencer par ".".',
    'productsAndServiceValidationMDPAmount' => 'Le mot de passe doit contenir entre 7 et 12 caractères.',
    'productsAndServiceValidationMDPLowercase' => 'Le mot de passe doit contenir une minuscule.',
    'productsAndServiceValidationMDPUppercase' => 'Le mot de passe doit contenir une majuscule.',
    'productsAndServiceValidationMDPDigits' => 'Le mot de passe doit contenir un chiffre.',
    'productsAndServiceValidationMDPSpecial' => 'Le mot de passe doit contenir un caractère spécial.',
    'productsAndServiceValidationMDPConfirm' => 'Le mot de passe n\'est pas identique.',
    
    'contactDetailsTitle' => 'Coordonnées',
    'contactDetailsAddressSection' => 'Adresse',
    'contactDetailsPhoneNumbersSection' => 'Téléphones',
    'civicNumberLabel' => 'Nᵒ civique',
    'streetName' => 'Rue',
    'officeNumber' => 'Bureau',
    'city' => 'Ville',
    'province' => 'Province',
    'districtArea' => 'Région administrative',
    'postalCode' => 'Code postal',
    'website' => 'Site internet',
    'fax' => 'Télécopieur',
    'cellphone' => 'Cellulaire',
    'phoneNumber' => 'Numéro de téléphone',
    'phoneExtension' => 'Poste',
    'phoneNumberList' => 'Liste des numéros de téléphone',
    'inputCityValidation' => 'Le champ Ville est requis.',
    'contactDetailsCNValidationRequired' => 'Le Nᵒ civique est requis.',
    'contactDetailsCNValidationAlphanum' => 'Le Nᵒ civique peut seulement contenir des chiffres et des lettres.',
    'contactDetailsCNValidationLength' => 'Le Nᵒ civique ne peut dépasser 8 caractères.',
    'contactDetailsStreetNameValidationRequired' => 'La Rue est requise.',
    'contactDetailsStreetNameValidationLength' => 'La Rue ne peut dépasser 64 caractères.',
    'contactDetailsStreetNameValidationAlphaNumSC' => 'La Rue peut seulement contenir des chiffres, lettres et caractères spéciaux.',
    'contactDetailsONValidationAlphaNum' => 'Le Bureau peut seulement contenir des chiffres et des lettres.',
    'contactDetailsONValidationLenght' => 'Le Bureau ne peut dépasser 8 caractères.',
    'contactDetailsCityRequired' => 'La Ville est requise.',
    'contactDetailsCityLength' => 'La Ville ne peut dépasser 64 caractères.',
    'contactDetailsPostalCodeRequired' => 'Le Code Postal est requis.',
    'contactDetailsPostalCodeFormat' => 'Le Code Postal doit être sous ce format : A1A 1A1.',
    'contactDetailsPostalCodeLength' => 'Le Code Postal doit contenir 6 caractères.',
    'contactDetailsWebsite' => 'Le Site n\'est pas valide.',
    'contactDetailsWebsiteLength' => 'Le Site ne peut pas dépasser 64 caractères.',
    'contactDetailsPhoneNumberRequired' => 'Le Numéro est requis.',
    'contactDetailsPhoneNumberNumeric' => 'Le Numéro doit seulement contenir des chiffres.',
    'contactDetailsPhoneNumberFormat' => 'Le Numéro doit être sous ce format ###-###-####.',
    'contactDetailsPhoneExtension' => 'Le Poste doit seulement contenir des chiffres.',
    'contactDetailsPhoneExtensionLength' => 'Le Poste ne peut pas dépasser 6 caractères.',
    'contactDetailsPhoneNumberAdd' => 'Le Numéro doit être rempli pour ajouter un numéro de téléphone.',

    'rbqTitle' => 'Licence RBQ',
    'rbqLicenceSection' => 'Licence',
    'rbqLicenceValidation' => 'Le champ licence ne doit contenir que des chiffres.',
    'rbqLicenceValidationSize' => 'Le champ licence doit contenir 10 chiffres.',
    'rbqStatusValidationRequired' => 'Le champ status est requis lorsqu\'il y a une licence.',
    'rbqStatusValidationRequiredNot' => 'Le champ status ne doit pas être rempli lorsqu\'il n\'y a pas de licence.',
    'rbqTypeValidationRequired' => 'Le champ type est requis lorsqu\'il y a une licence.',
    'rbqTypeValidationRequiredNot' => 'Le champ type ne doit pas être rempli lorsqu\'il n\'y a pas de licence.',
    'rbqCategoriesSection' => 'Catégories et sous-catégories autorisées',
    'rbqCategoriesUnselectedType' => 'Veuillez selectionner un type de licence pour voir la liste des sous-catégories',
    'rbqCategoriesGeneralEntrepreneur' => 'Catégories entrepreneur général',
    'rbqCategoriesSpecialisedEntrepreneur' => 'Catégories entrepreneur spécialisé',
    'rbqCategoriesGeneralOwnerBuilder' => 'Catégories constructeur-propriétaire général',
    'rbqCategoriesSpecialisedOwnerBuilder' => 'Catégories constructeur-propriétaire spécialisé',
    'rbqCategoriesValidation' => 'Au moins une catégorie doit être sélectionnée lorsque Numéro est présent.',
    'rbqSubcategorieValidationRequired' => 'Au moins une catégorie doit être choisie lorsqu\'il y a une licence.',
    'rbqSubcategorieValidationRequiredNot' => 'Aucune catégorie ne doit être choisie lorsqu\'il n\'y a pas de licence.',

    'contactsTitle' => 'Contacts',
    'contactsSubtitle' => 'Contact',
    'contactsNamesValidationSymbols' => 'Ce champ ne peut contenir que des lettres (y compris accentuées) et les caractères spéciaux \' et -.',
    'contactsFirstNamesValidationRequired' => 'Le prénom du contact est requis.',
    'contactsLastNamesValidationRequired' => 'Le nom du contact est requis.',
    'contactsJobsValidationRequired' => 'La fonction du contact est requise.',
    'contactsEmailsValidationRequired' => 'L\'adresse courriel est requise.',
    'contactsEmailsValidationFormat' => 'Le format de l\'adresse courriel n\'est pas valide (exemple@gmail.com).',
    'contactsTelNumberValidationRequired' => 'Le numéro de téléphone est requis.',
    'contactsTelNumberValidation' => 'Le champ numéro de téléphone ne doit contenir que des chiffres.',
    'contactsTelNumberValidationSize' => 'Le champ numéro de téléphone doit contenir 10 chiffres.',
    'contactsTelExtensionValidation' => 'Le poste ne doit contenir que des chiffres.',
];
