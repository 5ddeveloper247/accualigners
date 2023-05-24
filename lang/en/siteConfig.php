<?php

use App\Models\Setting;

$setting = Setting::first();

$config = [

    'local' => [

        'domain' => 'accu.local',
        'subDomain' => [
            'web' => [
                'retail' => 'www',
                'wholesale' => 'wholesale',
                'originator' => 'admin',
                'doctor' => 'doctor'
            ],
            'api' => [
                'retail' => 'api',
                'wholesale' => 'wholesaleapi',
                'originator' => 'originatorapi',
                'doctor' => 'doctor'

            ]
        ],
        'path' => [
            'adminPanel' => url('link/files')
        ],
        'setting' => [
            'name' => 'AccuAligners',
            'logo' => 'media/logo/AccuAligner-logo.png',
            'logoDark' => 'media/logo/AccuAligner-logo-Dark.png',
            'logoDarkVertical' => 'media/logo/AccuAligner-logo-Dark.png',
            'favIcon' => 'media/Logo/icon.png',
            'productDefaultApprove' => '2',
            'dynamicFieldExploder' => ' --- ',
        ],
        'user-type' => [
            'originator' => '1',
            'brand' => '2',
            'public' => '3',
        ],
        'source' => [
            'WEB_DESKTOP' => '1',
            'WEB_MOBILE' => '2',
            'APP_ANDROID' => '3',
            'APP_IOS' => '4',
        ],
        'product_approved' => 1,
        'default_currency' => $setting->currency,

    ],

    'development' => [

        'domain' => 'development.accu.com',
        'subDomain' => [
            'web' => [
                'retail' => 'www',
                'wholesale' => 'wholesale',
                'originator' => 'originator',
                'doctor' => 'doctor'

            ],
            'api' => [
                'retail' => 'retailapi',
                'wholesale' => 'wholesaleapi',
                'originator' => 'originatorapi',
                'brand' => 'brandapi'
            ]
        ],
        'path' => [
            'adminPanel' => url('link/files')
        ],
        'setting' => [
            'name' => 'AccuAligner',
            'logo' => 'media/Logo/Loowish-logo.png',
            'favIcon' => 'media/Logo/icon.png',
            'productDefaultApprove' => '2',
            'dynamicFieldExploder' => ' --- ',
        ],

    ],

    'staging' => [

        'domain' => 'staging.accu.com',
        'subDomain' => [
            'web' => [
                'retail' => 'www',
                'wholesale' => 'wholesale',
                'originator' => 'originator',
                'doctor' => 'doctor'

            ],
            'api' => [
                'retail' => 'retailapi',
                'wholesale' => 'wholesaleapi',
                'originator' => 'originatorapi',
                'brand' => 'brandrapi'
            ]
        ],
        'path' => [
            'adminPanel' => url('link/files')
        ],
        'setting' => [
            'name' => 'AccuAligner',
            'logo' => 'media/Logo/Loowish-logo.png',
            'favIcon' => 'media/Logo/icon.png',
            'productDefaultApprove' => '2',
            'dynamicFieldExploder' => ' --- ',
        ],

    ],

    'production' => [

        'domain' => 'accu.com',
        'subDomain' => [
            'web' => [
                'retail' => 'www',
                'wholesale' => 'wholesale',
                'originator' => 'originator',
                'doctor' => 'doctor'

            ],
            'api' => [
                'retail' => 'retailapi',
                'wholesale' => 'wholesaleapi',
                'originator' => 'originatorapi',
                'brand' => 'brandapi'
            ]
        ],
        'path' => [
            'adminPanel' => url('link/files')
        ],
        'setting' => [
            'name' => 'AccuAligner',
            'logo' => 'media/Logo/Loowish-logo.png',
            'favIcon' => 'media/Logo/icon.png',
            'productDefaultApprove' => '2',
            'dynamicFieldExploder' => ' --- ',
        ],

    ]

];

return $config[env('APP_ENV', 'local')];
