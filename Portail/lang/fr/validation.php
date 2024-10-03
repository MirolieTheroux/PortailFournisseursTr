<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Le champ :attribute doit être accepté.',
    'accepted_if' => 'Le champ :attribute doit être accepté quand :other est :value.',
    'active_url' => 'Le champ :attribute doit être un URL valide.',
    'after' => 'Le champ :attribute doit être une date après :date.',
    'after_or_equal' => 'Le champ :attribute doit être une date après ou égale à :date.',
    'alpha' => 'Le champ :attribute doit contenir uniquement des lettres.',
    'alpha_dash' => 'Le champ :attribute doit contenir uniquement des lettres, nombres, tirets et barres soulignées.',
    'alpha_num' => 'Le champ :attribute contenir uniquement des lettres et des nombres.',
    'array' => 'Le champ :attribute doit être un tableau.',
    'ascii' => 'The :attribute field must only contain single-byte alphanumeric characters and symbols.',
    'before' => 'Le champ :attribute doit être une date avant :date.',
    'before_or_equal' => 'Le champ :attribute doit être une date avant ou égale à :date.',
    'between' => [
        'array' => 'Le tableau :attribute doit contenir entre :min et :max éléments.',
        'file' => 'Le fichier :attribute doit avoir une taille entre :min et :max kilobytes.',
        'numeric' => 'Le nombre :attribute doit être entre :min et :max.',
        'string' => 'La champ :attribute doit contenir entre :min et :max caractères.',
    ],
    'boolean' => 'Le champ :attribute doit être vrai ou faux.',
    'can' => 'The :attribute field contains an unauthorized value.',
    'confirmed' => 'Le champ :attribute ne correspond pas.',
    'contains' => 'Le champ :attribute doit contenir :values.',
    'current_password' => 'Le mot de passe est incorrect.',
    'date' => 'Le champ :attribute doit être une date valide.',
    'date_equals' => 'Le champ :attribute doit être une date égale à :date.',
    'date_format' => 'Le champ :attribute doit correspondre au format :format.',
    'decimal' => 'Le champ :attribute doit avoir :decimal decimales.',
    'declined' => 'The :attribute field must be declined.',
    'declined_if' => 'The :attribute field must be declined when :other is :value.',
    'different' => 'Le champ :attribute et :other doivent être différents.',
    'digits' => 'Le champ :attribute doit contenir :digits chiffres.',
    'digits_between' => 'Le champ :attribute doit contenir entre :min et :max chiffres.',
    'dimensions' => 'The :attribute field has invalid image dimensions.',
    'distinct' => 'Le champ :attribute a un doublon.',
    'doesnt_end_with' => 'Le champ :attribute ne doit pas terminer par l\'une des valeurs suivantes: :values.',
    'doesnt_start_with' => 'Le champ :attribute ne doit pas commencer par :values.',
    'email' => 'Le champ :attribute doit être un adresse courriel valide.',
    'ends_with' => 'Le champ :attribut doit terminer par l\'une des valeurs suivantes: :values.',
    'enum' => 'La valeur de :attribute sélectionnée est invalide.',
    'exists' => 'La valeur de :attribute sélectionnée est invalide.',
    'extensions' => 'Le champ :attribute doit avoir l\'une des extensions suivantes: :values.',
    'file' => 'Le champ :attribute doit être un fichier.',
    'filled' => 'Le champ :attribute doit avoir une valeur.',
    'gt' => [
        'array' => 'Le tableau :attribute doit avoir plus que :value éléments.',
        'file' => 'Le fichier :attribute doit avoir une taille plus grande que :value kilobytes.',
        'numeric' => 'Le nombre :attribute doit être plus grand que :value.',
        'string' => 'La chaîne de caractères :attribute doit contenir plus que :value caracteres.',
    ],
    'gte' => [
        'array' => 'Le tableau :attribute doit avoir :value éléments ou plus.',
        'file' => 'Le fichier :attribute doit avoir une taille de :value kilobytes ou plus.',
        'numeric' => 'Le nombre :attribute doit être plus grand ou égal à :value.',
        'string' => 'La chaîne de caractères :attribute doit contenir :value caractères ou plus.',
    ],
    'hex_color' => 'The :attribute field must be a valid hexadecimal color.',
    'image' => 'Le champ :attribute doit être une image.',
    'in' => 'La valeur de :attribute sélectionnée est invalide.',
    'in_array' => 'The :attribute field must exist in :other.',
    'integer' => 'Le champ :attribute doit être un nombre entier.',
    'ip' => 'The :attribute field must be a valid IP address.',
    'ipv4' => 'The :attribute field must be a valid IPv4 address.',
    'ipv6' => 'The :attribute field must be a valid IPv6 address.',
    'json' => 'The :attribute field must be a valid JSON string.',
    'list' => 'The :attribute field must be a list.',
    'lowercase' => 'Le champ :attribute doit être en minuscule.',
    'lt' => [
        'array' => 'Le tableau :attribute doit avoir moins que :value éléments.',
        'file' => 'Le fichier :attribute doit avoir une taille plus petite que :value kilobytes.',
        'numeric' => 'Le nombre :attribute doit être plus petit que :value.',
        'string' => 'La chaîne de caractères :attribute doit contenir moins que :value caractères.',
    ],
    'lte' => [
        'array' => 'Le tableau :attribute doit avoir :value éléments ou moins.',
        'file' => 'Le fichier :attribute doit avoir une taille de :value kilobytes ou moins.',
        'numeric' => 'Le nombre :attribute doit être plus petit ou égal à :value.',
        'string' => 'La chaîne de caractères :attribute doit contenir :value caractères ou moins.',
    ],
    'mac_address' => 'The :attribute field must be a valid MAC address.',
    'max' => [
        'array' => 'Le tableau :attribute ne doit pas avoir plus de :max éléments.',
        'file' => 'Le fichier :attribute ne doit pas être plus gros que :max kilobytes.',
        'numeric' => 'Le nombre :attribute ne doit pas être plus grand que :max.',
        'string' => 'La chaîne de caractères :attribute ne doit pas contenir plus que :max caractères.',
    ],
    'max_digits' => 'Le nombre :attribute ne doit pas contenir plus que :max chiffres.',
    'mimes' => 'La champ :attribute doit être l\'un des types de fichier suivants: :values.',
    'mimetypes' => 'La champ :attribute doit être l\'un des types de fichier suivants: :values.',
    'min' => [
        'array' => 'Le tableau :attribute doit être d\'au moins :min éléments.',
        'file' => 'Le fichier :attribute doit avoir une taille d\'au moins :min kilobytes.',
        'numeric' => 'Le nombre :attribute doit être d\'au moins :min.',
        'string' => 'La chaîne de caractères :attribute doit contenir au moins :min caractères.',
    ],
    'min_digits' => 'Le nombre :attribute doit contenir au moins :min chiffres.',
    'missing' => 'The :attribute field must be missing.',
    'missing_if' => 'The :attribute field must be missing when :other is :value.',
    'missing_unless' => 'The :attribute field must be missing unless :other is :value.',
    'missing_with' => 'The :attribute field must be missing when :values is present.',
    'missing_with_all' => 'The :attribute field must be missing when :values are present.',
    'multiple_of' => 'The :attribute field must be a multiple of :value.',
    'not_in' => 'La valeur de :attribute sélectionnée est invalide.',
    'not_regex' => 'La valeur de :attribute sélectionnée est invalide.',
    'numeric' => 'Le champ :attribute doit être un nombre.',
    'password' => [
        'letters' => 'Le mot de passe doit contenir au moins une lettre.',
        'mixed' => 'Le mot de passe doit contenir au moins une majuscule et une minuscule.',
        'numbers' => 'Le mot de passe doit contenir au moins un nombre.',
        'symbols' => 'Le mot de passe doit contenir au moins un symbole.',
        'uncompromised' => 'Le mot de passe est déjà apparu dans une fuite de données. Veuiller en choisir un différent.',
    ],
    'present' => 'The :attribute field must be present.',
    'present_if' => 'The :attribute field must be present when :other is :value.',
    'present_unless' => 'The :attribute field must be present unless :other is :value.',
    'present_with' => 'The :attribute field must be present when :values is present.',
    'present_with_all' => 'The :attribute field must be present when :values are present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'Le format du champ :attribute est invalide.',
    'required' => 'Le champ :attribute est requis.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'required_if' => 'Le champ :attribute est requis quand :other est :value.',
    'required_if_accepted' => 'The :attribute field is required when :other is accepted.',
    'required_if_declined' => 'The :attribute field is required when :other is declined.',
    'required_unless' => 'Le champ :attribute est requis sauf si :other est dans :values.',
    'required_with' => 'Le champ :attribute est requis quand :values est présent.',
    'required_with_all' => 'Le champ :attribute est requis quand :values sont présents.',
    'required_without' => 'Le champ :attribute est requis quand :values n\'est pas présent.',
    'required_without_all' => 'Le champ :attribute est requis quand :values ne sont pas présents.',
    'same' => 'Le champ :attribute doit correspondre à :other.',
    'size' => [
        'array' => 'Le tableau :attribute doit contenir :size éléments.',
        'file' => 'Le fichier :attribute doit avoir une taille de :size kilobytes.',
        'numeric' => 'Le nombre :attribute doit être :size.',
        'string' => 'Le champ :attribute doit être de :size caractères.',
    ],
    'starts_with' => 'Le champ :attribute doit débuter par :values.',
    'string' => 'Le champ :attribute doit être une chaîne de caractères.',
    'timezone' => 'The :attribute field must be a valid timezone.',
    'unique' => 'La valeur du champ :attribute est déjà prise.',
    'uploaded' => 'Le téléversement du champ :attribute a échoué.',
    'uppercase' => 'Le champ :attribute doit être en majuscule.',
    'url' => 'Le champ :attribute doit être un URL valide.',
    'ulid' => 'Le champ :attribute doit être un ULID valide.',
    'uuid' => 'Le champ :attribute doit être un UUID valide.',
    'contain_at_position' => 'Le caractère #:index doit être :values.',
    'digits_only' => 'Le champ :attribute doit être composé uniquement de chiffres.',
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
      'name' => 'Nom',
      'email' => 'Adresse courriel',
      'password' => 'Mot de passe',
      'password_confirmation' => 'Confirmer le mot de passe',
      'neq' => 'Numéro d\'entreprise',
      'licenceRbq' => 'Numéro',
      'statusRbq' => 'Statut',
      'typeRbq' => 'Type',
      'rbqSubcategories' => 'Sous-Catégories',
      'contactDetailsCivicNumber' => 'Nᵒ civique',
      'contactDetailsStreetName'=> 'Rue',
      'contactDetailsOfficeNumber' => 'Bureau',
      'contactDetailsInputCity' => 'Ville',
      'contactDetailsPostalCode' => 'Code postal',
      'contactDetailsWebsite' => 'Site internet',
      'contactFirstNames' => 'Prénom',
      'contactFirstNames.*' => 'Prénom',
      'contactLastNames.*' => 'Nom',
      'contactJobs.*' => 'Fonction',
      'contactEmails.*' => 'Adresse courriel',
      'contactTelTypes.*' => 'Type',
      'contactTelNumbers.*' => 'Numéro',
      'contactTelExtensions.*' => 'Poste',
    ],

];
