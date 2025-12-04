<?php

return [
    'prod' => [
        'base_url' => env('DFE_ACBR_PROD_BASE_URL'),
        'client_id' => env('DFE_ACBR_PROD_CLIENT_ID'),
        'client_secret' => env('DFE_ACBR_PROD_CLIENT_SECRET'),
        'scope' => env('DFE_ACBR_PROD_SCOPE', 'cnpj'),
    ],

    'homolog' => [
        'base_url' => env('DFE_ACBR_HOMOLOG_BASE_URL'),
        'client_id' => env('DFE_ACBR_HOMOLOG_CLIENT_ID'),
        'client_secret' => env('DFE_ACBR_HOMOLOG_CLIENT_SECRET'),
        'scope' => env('DFE_ACBR_HOMOLOG_SCOPE', 'cnpj'),
    ],
];
