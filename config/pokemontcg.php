<?php

/*
 * Default configuration to run the pokemontcg.io API
 */
return [
    'url' => env('POKEMONTCG_API_URL', 'https://api.pokemontcg.io/v2/'),
    'secret' => env('POKEMONTCG_SECRET'),
];
