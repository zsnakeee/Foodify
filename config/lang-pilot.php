<?php

declare(strict_types=1);

return [

    /*
     * The path to the language files.
     */
    'lang_path' => base_path('lang'),

    /*
     * The default driver to use.
     */
    'default' => \LangPilot\Drivers\GeminiTranslator::class,

    /*
     * The description of your app to asset in the translation process.
     */
    'description' => 'an ecommerce platform',

    /*
     * The driver's configuration.
     */
    'gemini' => [
        'api_key' => env('GEMINI_API_KEY'),
    ],
];
