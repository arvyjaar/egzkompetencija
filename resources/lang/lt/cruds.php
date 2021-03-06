<?php

return [
    'userManagement'   => [
        'title'          => 'Vartotojai',
        'title_singular' => 'Vartotojas',
    ],
    'permission'       => [
        'title'          => 'Leidimai',
        'title_singular' => 'Leidimas',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'title'             => 'Pavadinimas',
            'title_helper'      => '',
            'created_at'        => 'Sukurta',
            'created_at_helper' => '',
            'updated_at'        => 'Atnaujinta',
            'updated_at_helper' => '',
            'deleted_at'        => 'Ištrinta',
            'deleted_at_helper' => '',
        ],
    ],
    'role'             => [
        'title'          => 'Rolės',
        'title_singular' => 'Rolė',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'title'              => 'Pavadinimas',
            'title_helper'       => '',
            'permissions'        => 'Leidimai',
            'permissions_helper' => '',
            'created_at'         => 'Sukurta',
            'created_at_helper'  => '',
            'updated_at'         => 'Atnaujinta',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Ištrinta',
            'deleted_at_helper'  => '',
        ],
    ],
    'user'             => [
        'title'          => 'Vartotojai',
        'title_singular' => 'Vartotojas',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'name'                     => 'Vardas',
            'name_helper'              => '',
            'email'                    => 'El. paštas',
            'username'                 => 'Username',
            'branch'                   => 'Padalinys',
            'email_helper'             => '',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => '',
            'password'                 => 'Password',
            'password_helper'          => '',
            'roles'                    => 'Rolės',
            'roles_helper'             => '',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => '',
            'created_at'               => 'Sukurta',
            'created_at_helper'        => '',
            'updated_at'               => 'Atnaujinta',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Ištrinta',
            'deleted_at_helper'        => '',
        ],
    ],
    'worktype' => [
        'title' => 'Veiklos',
        'title_singular' => 'Veikla',
    ],
    'branch' => [
        'title' => 'Padaliniai',
        'title_singular' => 'Padalinys',
    ],
    'report' => [
        'procedure'      => 'Procedūra',
        'video'          => 'Video',
        'title'          => 'Ataskaitos',
        'title_singular' => 'Ataskaita',
        'new_value'      => 'Naujas įvertinimas',
        'not_reviewed'   => 'Nesusipažino',
        'counter'        => [
            'assessed'     => 'Įvertinkite visus kriterijus: ',
        ],
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'observer'                 => 'Vertintojas',
            'observer_helper'          => 'Vertintojas, užpildęs ataskaitą',
            'employee'                 => 'Darbuotojas',
            'user_helper'              => '',
            'branch'                   => 'Filialas/grupė',
            'branch_helper'            => 'Formatas: VL',
            'procedure_datetime'       => 'Procedūros data ir laikas',
            'procedure_date_helper'    => '',
            'category'                 => 'TP Kategorija',
            'category_helper'          => 'Pildoma egzaminams',
            'observing_date'           => 'Vertinimo data',
            'observing_date_helper'    => '',
            'observing_type'           => 'Stebėta',
            'created_at'               => 'Sukurta',
            'created_at_helper'        => '',
            'updated_at'               => 'Atnaujinta',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Ištrinta',
            'deleted_at_helper'        => '',
            'notes'                    => 'Pastabos',
            'notes_singular'           => 'Pastaba',
            'technical_notes'          => 'Papildomos/bendrosios pastabos',
            'technical_notes_helper'   => 'Pastabos dėl techninių priemonių, trukdančių efektyviam darbui, nesusijusios su šiuo įvertinimu',
            'observer_notes'           => 'Stebėtojo išvados, pasiūlymai',
            'observer_notes_helper'    => '',
            'employee_notes'           => 'Darbuotojo pastabos',
            'employee_notes_helper'    => '',
            'employee_reviewed_at'        => 'Darbuotojas peržiūrėjo',
            'employee_reviewed_helper' => 'Kada darbuotojas peržiūrėjo ataskaitą',
            'manager_notes'              => 'Administracijos pastabos',
            'manager_notes_helper'       => '',
        ],
    ],
    'assessment_type'    => [
        'title'          => 'Vertinimo skalės',
        'title_singular' => 'Vertinimo skalė',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'description'        => 'Aprašymas',
            'description_helper' => '',
            'value'              => 'Reikšmė',
            'value_helper'       => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',
        ],
    ],
    'criterion'        => [
        'title'          => 'Kriterijai',
        'title_singular' => 'Kriterijus',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'title'             => 'Pavadinimas',
            'title_helper'      => '',
            'rating_type'       => 'Vertinimas',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'evaluation'       => [
        'title'          => 'Įvertinimai',
        'title_singular' => 'Įvertinimas',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => '',
            'monitoringreport'        => 'Stebėjimo ataskaita',
            'monitoringreport_helper' => '',
            'criteria'                => 'Stebėjimo aspektas',
            'criteria_helper'         => '',
            'point'                   => 'Įvertinimas',
            'point_helper'            => '',
            'created_at'              => 'Created at',
            'created_at_helper'       => '',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => '',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => '',
        ],
    ],
    'competency'       => [
        'title'          => 'Kompetencijos',
        'title_singular' => 'Kompetencija',
    ],
    'form'       => [
        'title'          => 'Formos',
        'title_singular' => 'Forma',
        'fields'    => [
            'version'   => 'Versija',
            'active'    => 'Aktyvuota',
            'has_reports' => 'Yra ataskaitų',
            'active_helper' => 'Pažymėjus aktyvuota, kitos šios veiklos formos bus deaktyvuotos'
        ]
    ],
    'statistics' => [
        'title' => 'Statistika',
        'date_from' => 'Nuo',
        'date_to' => 'Iki',
    ]
];
