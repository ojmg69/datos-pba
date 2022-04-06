<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#61-title
    |
    */

    'title' => 'Plataforma Integral',
    'title_prefix' => 'DATOS PBA |',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#62-favicon
    |
    */

    'use_ico_only' => true,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#63-logo
    |
    */

    'logo' => '<b>Datos</b>PBA',
    'logo_img' => '/favicon.ico',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'PBA',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#64-user-menu
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => true,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#71-layout
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#721-authentication-views-classes
    |
    */

    'classes_auth_card' => 'background-color: #015875',
    'classes_auth_header' => 'bg-gradient-info',
    'classes_auth_body' => '',
    'classes_auth_footer' => 'text-center',
    'classes_auth_icon' => 'fa-lg text-info',
    'classes_auth_btn' => 'btn-flat btn-info',
    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#722-admin-panel-classes
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => 'background-color: #015875',
    'classes_content_header' => 'background-color: #015875',
    'classes_content' => 'background-color: #015875',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-dark navbar-light p-0 m-0',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#73-sidebar
    |
    */

    'sidebar_mini' => true,
    'sidebar_collapse' => true,
    'sidebar_collapse_auto_size' => true,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-dark',
    'sidebar_scrollbar_auto_hide' => 'true',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#74-control-sidebar-right-sidebar
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#65-urls
    |
    */

    'use_route_url' => false,

    'dashboard_url' => '/',

    'logout_url' => 'logout',

    'login_url' => 'login',

    'register_url' => 'register',

    'password_reset_url' => 'password/reset',

    'password_email_url' => 'password/email',

    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#92-laravel-mix
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#8-menu-configuration
    |
    */


    /**MENU 2 */
    'menu' => [
        [
            'text' => 'buscar',
            'search' => false,
            'topnav' => false,
        ],

        ['header' => 'EJES /SECCIONES'],
        [
            'text'    => 'Municipios',
            'icon'    => 'fas fa-fw fa-home',
            'submenu' => [
                [
                    'text'    => 'Intendentes',
                    'route' => ['municipios.index', ['tipo' => 'intendente']],
                    'icon' => 'fas fa-regular fa-caret-right' 
                ],
                [
                    'text'    => 'HCD',
                    'route' => ['politico.index', ['tipo' => 'concejo_deliberante']],
                    'icon' => 'fas fa-regular fa-caret-right'
                ],
                [
                    'text'   => 'Información General',
                    'icon'   => 'fas fa-regular fa-caret-right',
                    'route'  => ['politico.index', ['tipo' => 'catastrales']],
                ],


                [
                    'text'    => 'Fiestas populares',
                    'route' => ['municipios.index', ['tipo' => 'fiestas_populares']],
                    'icon' => 'fas fa-regular fa-caret-right'
                ],

                [
                    'text'    => 'Consulados',
                    'route' => ['municipios.index', ['tipo' => 'consulados']],
                    'icon' => 'fas fa-regular fa-caret-right'
                ],
            ],
        ],
        [
            'text'    => 'Institucional',
            'icon'    => 'fas fa-fw  fa-university',
            'submenu' => [
                [
                    'text'    => 'Ejecutivo',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'submenu' => [
                        [
                            'text'    => 'Gobernación',
                            'icon'    => 'fas fa-regular fa-caret-right',
                            'route' => ['politico.index', ['tipo' => 'gobernacion']],
                        ],
                        [
                            'text'    => 'Vicegobernación',
                            'icon'    => 'fas fa-regular fa-caret-right',
                            'route' => ['politico.index', ['tipo' => 'vicegobernacion']],
                        ],
                        [
                            'text'    => 'Ministerios',
                            'icon'    => 'fas fa-regular fa-caret-right',
                            'route' => ['politico.index', ['tipo' => 'ministerios']],
                        ],
                        [
                            'text'    => 'Org. de la Const.',
                            'icon'    => 'fas fa-regular fa-caret-right',
                            'route' => ['politico.index', ['tipo' => 'constitucion']],
                        ],
                        [
                            'text'    => 'Org. Nacionales y Prov',
                            'icon'    => 'fas fa-regular fa-caret-right',
                            'route' => ['politico.index', ['tipo' => 'organismos']],
                        ],
                       /* [
                            'text'    => 'Sedes',
                            'icon'    => 'fas fa-regular fa-caret-right',
                            'route' => ['politico.index', ['tipo' => 'sedes']],
                        ],*/
                    ],
                ],


                [
                    'text'    => 'Legislativo',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'submenu' => [
                        [
                            'text'    => 'Legisladores',
                            'icon'    => 'fas fa-regular fa-caret-right',
                            'route' => ['politico.index', ['tipo' => 'legislador']],
                        ],
                        [
                            'text'    => 'Legislatura',
                            'icon'    => 'fas fa-regular fa-caret-right',
                            'route' => ['politico.index', ['tipo' => 'legislativo']],
                        ],
                    ],
                ],


                [
                    'text'    => 'Judicial',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'submenu' => [
                        [
                            'text'    => 'Suprema Corte',
                            'icon'    => 'fas fa-regular fa-caret-right',
                            'route' => ['politico.index', ['tipo' => 'supr_corte']],
                        ],

                        [
                            'text'    => 'Deptos. Judiciales',
                            'icon'    => 'fas fa-regular fa-caret-right',
                            'route' => ['politico.index', ['tipo' => 'departamentos-judiciales']],
                        ],
                        [
                            'text'    => 'Tribunales y Juzgados',
                            'icon'    => 'fas fa-regular fa-caret-right',
                            'route' => ['politico.index', ['tipo' => 'tribunales-juzgados']],
                        ],
                    ],
                ],

                /*                 [
                    'text'    => 'Arzobispado',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'route' => ['politico.index', ['tipo' => 'arzobispado']],
                ], */
            ],
        ],

        [
            'text'    => 'Electoral',
            'icon'    => 'fas fa-fw fa-envelope-open-text',
            'submenu' => [

                [
                    'text'    => 'Resultados 2017',
                    'icon' => 'fas fa-regular fa-caret-right',
                    'route' => ['electoral17.index', ['tipo' => 'resultados']],
                ],
                
                [
                    'text'    => 'Resultados 2019',
                    'icon' => 'fas fa-regular fa-caret-right',
                    'route' => ['electoral.index', ['tipo' => 'resultados']],
                ],

                [
                    'text'    => 'Electores e Inscriptos',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => ['electoral.index', ['tipo' => 'electores-inscriptos']],
                ],
            ],
        ],
        [
            'text'    => 'Económico',
            'icon'    => 'fas fa-fw fa-dollar-sign',
            'route' => 'economico.index',
        ],
        [
            'text'    => 'Productivo',
            'icon'    => 'fas fa-fw fas fa-industry',
            'submenu' => [
                [
                    'text'    => 'Agrupamientos Industriales',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => ['productivo.index', ['tipo' => 'agrupamientos-industriales']],
                ],
                [
                    'text'    => 'Puertos',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => ['productivo.index', ['tipo' => 'puertos']],
                ],
                [
                    'text'    => 'Empresas',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => ['productivo.index', ['tipo' => 'empresas']],
                ],
                [
                    'text'    => 'Parques Eólicos',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => ['productivo.index', ['tipo' => 'parques-eolicos']],
                ],
            ],
        ],
        [
            'text'    => 'Vivienda',
            'icon'    => 'fas fa-fw fas fa-house-user',
            'submenu' => [
                [
                    'text'    => 'Asentamientos',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => ['vivienda.index', ['tipo' => 'asentamientos']],
                ],
                [
                    'text'    => 'Servicios',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => ['vivienda.index', ['tipo' => 'servicios']],

                ],
            ],
        ],
        [
            'text'    => 'Sanitario',
            'icon'    => 'fas fa-fw fa fas fa-clinic-medical',
            'submenu' => [
                [
                    'text'    => 'Regiones',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => ['sanitario.index', ['tipo' => 'regiones']],

                ],
                [
                    'text'    => 'Establecimientos',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => ['sanitario.index', ['tipo' => 'establecimientos']],
                ],
            ],
        ],
        [
            'text'    => 'Educación',
            'icon'    => 'fas fa-fw fas fa-graduation-cap',
            'submenu' => [
                /* [
                    'text'    => 'Áreas municipales',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'route' => 'construccion',
                ], */
                [
                    'text'    => 'Escuelas',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => ['educacion.index', ['tipo' => 'escuelas']],
                ],
                [
                    'text'    => 'Universidades y Terciarios',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => ['educacion.index', ['tipo' => 'universidades-terciarios']],
                ],
              /* [
                    'text'    => 'Indicadores',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => ['educacion.index', ['tipo' => 'indicadores']],
                ],*/
                 [
                    'text'    => 'Consejeros Escolares',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => ['educacion.index', ['tipo' => 'matricula']],
                ],
            ],
        ],
        
                [
            'text'    => 'Discapacidad',
            'icon'    => 'fas fa-fw fas fa-wheelchair', 
            'submenu' => [
                /* [
                    'text'    => 'Áreas municipales',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'route' => 'construccion',
                ], */
                [
                    'text'    => 'Establecimientos Educativos',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => ['especial.index', ['tipo' => 'especial-escuelas']],               
                    ],
                [
                    'text'    => 'Políticas Locales',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => 'construccion',
                ],
               /* [
                    'text'    => 'Indicadores',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'route' => ['educacion.index', ['tipo' => 'indicadores']],
                ],
                [
                    'text'    => 'Matrícula',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'route' => ['educacion.index', ['tipo' => 'matricula']],
                ],*/
            ],
        ],
        
        [
            'text'    => 'Cultura',
            'icon'    => 'fas fa-fw fas fa-guitar',
            'submenu' => [
                // [
                //     'text'    => 'Áreas municipales',
                //     'icon'    => 'fas fa-fw fa-circle fas-icon',
                //     'route' => 'construccion',
                // ],
                [
                    'text'    => 'Espacios culturales',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => ['cultura.index', ['tipo' => 'espacios-culturales']],
                ],
            ],
        ],
        [
            'text'    => 'Medioambiente',
            'icon'    => 'fas fa-fw fas fas fa-recycle',
            'submenu' => [
                [
                    'text'    => 'Planes OPDS',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => 'construccion',
                ],
                [
                    'text'    => 'Políticas locales',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => ['medioambiente.index', ['tipo' => 'politicas-locales']],
                ],
            ],
        ],
        [
            'text'    => 'Género',
            'icon'    => 'fas fa-fw fas fa-transgender',
            'submenu' => [
                /* [
                    'text'    => 'Áreas municipales',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'route' => ['genero.index', ['tipo' => 'areas-municipales']],
                ], */
                [
                    'text'    => 'Comisarías de la mujer',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => ['genero.index', ['tipo' => 'comisarias-mujer']],
                ],
                /* [
                    'text'    => 'Convenios',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'route' => ['genero.index', ['tipo' => 'convenios']],
                ],
                [
                    'text'    => 'Programas de asistencia',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'route' => ['genero.index', ['tipo' => 'programas-asistencias']],
                ], */
                [
                    'text'    => 'Espacios de contención',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => ['genero.index', ['tipo' => 'espacios-contencion']],
                ],
                [
                    'text'    => 'Representatividad política',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => ['genero.index', ['tipo' => 'representatividad-politica']],
                ],
                /* [
                    'text'    => 'Capacitación',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'route' => ['genero.index', ['tipo' => 'capacitacion']],
                ],
                [
                    'text'    => 'Campañas de prevención',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'route' => ['genero.index', ['tipo' => 'camp.prevencion']],
                ],
                [
                    'text'    => 'Progs. colectivo LGBTTTIQ+',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'route' => ['genero.index', ['tipo' => 'prog-lgbtttiq+']],
                ],
                [
                    'text'    => 'Estadísticas',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'route' => ['genero.index', ['tipo' => 'estadisticas']],
                ], */
            ],
        ],
        [
            'text'    => 'Geografía',
            'icon'    => 'fas fa-fw fa-globe-americas',
            'submenu' => [
                [
                    'text'    => 'Clima',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => ['geografia.index', ['tipo' => 'clima']],
                ],
                [
                    'text'    => 'Suelo',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => ['geografia.index', ['tipo' => 'suelo']],
                ],
                [
                    'text'    => 'Vientos',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => ['geografia.index', ['tipo' => 'vientos']],
                ],
              /*[
                    'text'    => 'Fauna y Cultivos',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => ['geografia.index', ['tipo' => 'fauna-cultivos']],
                ],*/
                [
                    'text'    => 'Cuencas hidrográficas',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => 'construccion',
                ],
                [
                    'text'    => 'Zonas hidráulicas',
                    'icon'    => 'fas fa-regular fa-caret-right',
                    'route' => ['geografia.index', ['tipo' => 'zonas-hidraulicas']],
                ],
            ],

           /*  'submenu' => [
                [
                    'text'    => 'Clima',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'route' => 'construccion',
                ],
                [
                    'text'    => 'Suelo',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'route' =>'construccion',
                ],
                [
                    'text'    => 'Vientos',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'route' => 'construccion',
                ],
                [
                    'text'    => 'Fauna y Cultivos',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'route' => 'construccion',
                ],
                [
                    'text'    => 'Cuencas hidrográficas',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'route' => 'construccion',
                ],
                [
                    'text'    => 'Zonas hidráulicas',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'route' => 'construccion',23
                ],
            ], */
        ],

        ['header' => 'FUENTES DE INFORMACIÓN'],
        [
            'text'    => 'Ver Fuentes de Información',
            'icon'    => 'fas fa-fw fa-pen',
            'url'   => '#'
        ],

        ['header' => 'USUARIOS'],
        [
            'text'    => 'Administrar Usuarios',
            'icon'    => 'fas fa-fw fa-users',
            'url'   => '#'
        ],
        [
            'text'    => 'Nuevo Usuario',
            'icon'    => 'fas fa-fw fa-plus',
            'url'   => '#'         

        ],
    ],


    /** MENU RESPALDO 2 */
    /* 'menu' => [
        [
            'text' => 'buscar',
            'search' => true,
            'topnav' => true,
        ],

        ['header' => 'EJES /SECCIONES'],
        [
            'text'    => 'Municipios',
            'icon'    => 'fas fa-fw fa-home',
            'submenu' => [
                [
                    'text'    => 'Localidades',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
                [
                    'text'    => 'Habitantes',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
                [
                    'text'    => 'Densidad',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
                [
                    'text'    => 'Intendente',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
                [
                    'text'    => 'Historia',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
                [
                    'text'    => 'Concejo Deliberante',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
                [
                    'text'    => 'Fiestas populares',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
                [
                    'text'    => 'Contacto',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
                [
                    'text'    => 'Consulados',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
                [
                    'text'    => 'Hermanamientos',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
            ],
        ],
        [
            'text'    => 'Institucional',
            'icon'    => 'fas fa-fw fa-home',
            'submenu' => [
                [
                    'text'    => 'Ejecutivo',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
                [
                    'text'    => 'Legislativo',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                ],
                [
                    'text'    => 'Legisladores',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
                [
                    'text'    => 'Suprema Corte',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
                [
                    'text'    => 'Deptos. judiciales',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
                [
                    'text'    => 'Tribunales y juzgados',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
                [
                    'text'    => 'Org. de la Const.',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
                [
                    'text'    => 'Organismos',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
                [
                    'text'    => 'Sedes',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
                [
                    'text'    => 'Arzobispado',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
            ],
        ],

        [
            'text'    => 'Electoral',
            'icon'    => 'fas fa-fw fa-chalkboard-teacher',
            'submenu' => [
                [
                    'text'    => 'Resultados 2019',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
                [
                    'text'    => 'Electores',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
                [
                    'text'    => 'Inscriptos',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
            ],
        ],
        [
            'text'    => 'Económico',
            'icon'    => 'fas fa-fw fa-chalkboard-teacher',
            'submenu' => [
                [
                    'text'    => 'Transferencias',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
            ],
        ],
        [
            'text'    => 'Productivo',
            'icon'    => 'fas fa-fw fa-home',
            'submenu' => [
                [
                    'text'    => 'Agrupamientos Industriales',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                ],
                [
                    'text'    => 'Puertos',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                ],
            ],
        ],
        [
            'text'    => 'Vivienda',
            'icon'    => 'fas fa-fw fa-home',
            'submenu' => [
                [
                    'text'    => 'Asentamientos',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                ],
                [
                    'text'    => 'Servicios',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                ],
            ],
        ],
        [
            'text'    => 'Sanitario',
            'icon'    => 'fas fa-fw fa-home',
            'submenu' => [
                [
                    'text'    => 'Regiones',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                ],
                [
                    'text'    => 'Establecimientos',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                ],
            ],
        ],
        [
            'text'    => 'Educación',
            'icon'    => 'fas fa-fw fa-home',
            'submenu' => [
                [
                    'text'    => 'Regiones',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'submenu' => [],
                ],
                [
                    'text'    => 'Áreas municipales',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'submenu' => [],
                ],
                [
                    'text'    => 'Escuelas',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                ],
                [
                    'text'    => 'Universidades y terciarios',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                ],
                [
                    'text'    => 'Indicadores',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                ],
                [
                    'text'    => 'Matrícula',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                ],
            ],
        ],
        [
            'text'    => 'Cultura',
            'icon'    => 'fas fa-fw fa-home',
            'submenu' => [
                [
                    'text'    => 'Áreas municipales',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                ],
                [
                    'text'    => 'Espacios culturales',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                ],
            ],
        ],
        [
            'text'    => 'Medioambiente',
            'icon'    => 'fas fa-fw fa-home',
            'submenu' => [
                [
                    'text'    => 'Planes OPDS',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
                [
                    'text'    => 'Políticas locales',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
            ],
        ],
        [
            'text'    => 'Género',
            'icon'    => 'fas fa-fw fa-home',
            'submenu' => [
                [
                    'text'    => 'Áreas municipales',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
                [
                    'text'    => 'Comisarías de la mujer',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
                [
                    'text'    => 'Convenios',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
                [
                    'text'    => 'Programas de asistencia',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
                [
                    'text'    => 'Espacios de contención',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
                [
                    'text'    => 'Representatividad política',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
                [
                    'text'    => 'Capacitación',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                ],
                [
                    'text'    => 'Campañas de prevención',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
                [
                    'text'    => 'Programas colectivo LGBTTTIQ+',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
                [
                    'text'    => 'Estadísticas',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
            ],
        ],
        [
            'text'    => 'Geografía',
            'icon'    => 'fas fa-fw fa-home',
            'submenu' => [
                [
                    'text'    => 'Clima',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
                [
                    'text'    => 'Suelo',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
                [
                    'text'    => 'Vientos',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
                [
                    'text'    => 'Cultivos',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
                [
                    'text'    => 'Fauna',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
                [
                    'text'    => 'Cuencas hidrográficas',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
                [
                    'text'    => 'Zonas hidráulicas',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',

                ],
            ],
        ],
    ], */


    /** MENU ORIGINAL */
    /*
    'menu' => [
        [
            'text' => 'buscar',
            'search' => true,
            'topnav' => true,
        ],

        ['header' => 'EJES /SECCIONES'],
        [
            'text'    => 'HOME',
            'icon'    => 'fas fa-fw fa-home',
            'submenu' => [
                [
                    'text'    => 'Localidades',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
                [
                    'text'    => 'Datos demográficos',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
                [
                    'text'    => 'Intendente/a',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
                [
                    'text'    => 'Historia del distrito',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
                [
                    'text'    => 'Concejo deliberante',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
                [
                    'text'    => 'Fiestas populares',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
                [
                    'text'    => 'Contactos',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
            ],
        ],
        [
            'text'    => 'POLÍTICO, ADMIN. E INSTITUCIONAL',
            'icon'    => 'fas fa-fw fa-home',
            'submenu' => [
                [
                    'text'    => 'Poder ejecutivo',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'submenu' => [
                        [
                            'text'    => 'Gobernador',
                            'url'     => '#',
                            'icon' => 'fas fa-circle fas-icon'
                        ],
                        [
                            'text'    => 'Ministerios',
                            'url'     => '#',
                            'icon' => 'fas fa-circle fas-icon'
                        ],
                        [
                            'text'    => 'Organismos',
                            'url'     => '#',
                            'icon' => 'fas fa-circle fas-icon'
                        ],
                        [
                            'text'    => 'Agencias',
                            'url'     => '#',
                            'icon' => 'fas fa-circle fas-icon'
                        ],
                        [
                            'text'    => 'Institutos',
                            'url'     => '#',
                            'icon' => 'fas fa-circle fas-icon'
                        ],
                    ],
                ],
                [
                    'text'    => 'Poder legislativo',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'submenu' => [
                        [
                            'text'    => 'Datos',
                            'url'     => '#',
                            'icon' => 'fas fa-circle fas-icon'
                        ],
                        [
                            'text'    => 'Presidenta del Senado',
                            'url'     => '#',
                            'icon' => 'fas fa-circle fas-icon'
                        ],
                        [
                            'text'    => 'Secretario administrativo',
                            'url'     => '#',
                            'icon' => 'fas fa-circle fas-icon'
                        ],
                        [
                            'text'    => 'Vicepresidentes del cuerpo legislativo',
                            'url'     => '#',
                            'icon' => 'fas fa-circle fas-icon'
                        ],
                        [
                            'text'    => 'Senadores y Senadoras',
                            'url'     => '#',
                            'icon' => 'fas fa-circle fas-icon'
                        ],
                    ],
                ],
                [
                    'text'    => 'Poder judicial',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'submenu' => [
                        [
                            'text'    => 'Suprema corte de la provincia',
                            'url'     => '#',
                            'icon' => 'fas fa-circle fas-icon'
                        ],
                        [
                            'text'    => 'Procuración General',
                            'url'     => '#',
                            'icon' => 'fas fa-circle fas-icon'
                        ],
                        [
                            'text'    => 'Concejo de la Magistratura',
                            'url'     => '#',
                            'icon' => 'fas fa-circle fas-icon'
                        ],
                        [
                            'text'    => 'Junta electoral',
                            'url'     => '#',
                            'icon' => 'fas fa-circle fas-icon'
                        ],
                        [
                            'text'    => 'Organigrama',
                            'url'     => '#',
                            'icon' => 'fas fa-circle fas-icon'
                        ],
                    ],
                ],
            ],
        ],

        [
            'text'    => 'ELECTORAL',
            'icon'    => 'fas fa-fw fa-chalkboard-teacher',
            'submenu' => [
                [
                    'text'    => 'Resultados última elección',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
                [
                    'text'    => 'Análisis demográficos de última elección',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
            ],
        ],
        [
            'text'    => 'ECONÓMICO Y FISCAL',
            'icon'    => 'fas fa-fw fa-chalkboard-teacher',
            'submenu' => [
                [
                    'text'    => 'Ingresos',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
                [
                    'text'    => 'Egresos',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
                [
                    'text'    => 'Presupuesto',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
                [
                    'text'    => 'Variación',
                    'url'     => '#',
                    'icon' => 'fas fa-circle fas-icon'
                ],
            ],
        ],

        [
            'text'    => 'HÁBITAT Y VIVIENDA',
            'icon'    => 'fas fa-fw fa-home',
            'submenu' => [
                [
                    'text'    => 'Hábitat',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'submenu' => [
                        [
                            'text'    => 'Obras de agua potable',
                            'url'     => '#',
                            'icon' => 'fas fa-circle fas-icon'
                        ],
                        [
                            'text'    => 'Obras de cloacas',
                            'url'     => '#',
                            'icon' => 'fas fa-circle fas-icon'
                        ],
                        [
                            'text'    => 'Obras pluviales/inundaciones',
                            'url'     => '#',
                            'icon' => 'fas fa-circle fas-icon'
                        ],
                        [
                            'text'    => 'Obras de presupuesto bonaerense 2021',
                            'url'     => '#',
                            'icon' => 'fas fa-circle fas-icon'
                        ],
                    ],
                ],
                [
                    'text'    => 'Vivienda',
                    'icon'    => 'fas fa-fw fa-circle fas-icon',
                    'submenu' => [
                        [
                            'text'    => 'Asentamientos',
                            'url'     => '#',
                            'icon' => 'fas fa-circle fas-icon'
                        ],
                        [
                            'text'    => 'Villas',
                            'url'     => '#',
                            'icon' => 'fas fa-circle fas-icon'
                        ],
                        [
                            'text'    => 'Impacto del procrear en la provincia',
                            'url'     => '#',
                            'icon' => 'fas fa-circle fas-icon'
                        ],
                    ],
                ],
            ],

        ],
        [
            'text'    => 'SANITARIO',
            'icon'    => 'fas fa-fw fa-home',
            'submenu' => [
                [
                    'text'    => 'Centros de salud',
                    'icon' => 'fas fa-circle fas-icon',
                    'submenu' => [

                        [
                            'text'    => 'Públicos',
                            'icon'    => 'fas fa-fw fa-circle fas-icon',
                            'submenu' => [
                                [
                                    'text'    => 'UPA',
                                    'url'     => '#',
                                    'icon' => 'fas fa-circle fas-icon'
                                ],
                                [
                                    'text'    => 'CAPS',
                                    'url'     => '#',
                                    'icon' => 'fas fa-circle fas-icon'
                                ],
                                [
                                    'text'    => 'Laboratorios',
                                    'url'     => '#',
                                    'icon' => 'fas fa-circle fas-icon'
                                ],
                                [
                                    'text'    => 'Centros de rehabilitacion',
                                    'url'     => '#',
                                    'icon' => 'fas fa-circle fas-icon'
                                ],
                            ],
                        ],
                        [
                            'text'    => 'Privados',
                            'icon'    => 'fas fa-fw fa-circle fas-icon',
                            'submenu' => [
                                [
                                    'text'    => 'UPA',
                                    'url'     => '#',
                                    'icon' => 'fas fa-circle fas-icon'
                                ],
                                [
                                    'text'    => 'CAPS',
                                    'url'     => '#',
                                    'icon' => 'fas fa-circle fas-icon'
                                ],
                                [
                                    'text'    => '**************************************',
                                    'url'     => '#',
                                    'icon' => 'fas fa-circle fas-icon'
                                ],
                            ],
                        ],
                    ],
                ],
            ],

        ],
        [
            'text'    => 'EDUCACIÓN Y CULTURA',
            'icon'    => 'fas fa-fw fa-home',
            'url'   => '#'
        ],
        [
            'text'    => 'MEDIO HAMBIENTE Y DESARROLLO SOSTENIBLE',
            'icon'    => 'fas fa-fw fa-home',
            'url'   => '#'
        ],
        [
            'text'    => 'MUJERES Y GÉNEROS / DERECHOS HUMANOS',
            'icon'    => 'fas fa-fw fa-home',
            'url'   => '#'
        ],
        [
            'text'    => 'CLIMA Y GEOGRAFÍA',
            'icon'    => 'fas fa-fw fa-home',
            'url'   => '#'
        ],
        ['header' => 'FUENTES'],
        [
            'text'    => 'FUENTE 1',
            'icon'    => 'fas fa-fw fa-home',
            'url'   => '#'
        ],
        [
            'text'    => 'FUENTE 2',
            'icon'    => 'fas fa-fw fa-home',
            'url'   => '#'
        ],
    ], */

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#83-custom-menu-filters
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#91-plugins
    |
    */

    'plugins' => [
        [
            'name' => 'Datatables',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/chart.js@3.2.1/dist/chart.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#93-livewire
    */

    'livewire' => true,
];
