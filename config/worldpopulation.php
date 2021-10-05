<?php

return [
    /*
    |--------------------------------------------------------------------------
    | World Population Source of data
    |--------------------------------------------------------------------------
    |
    | This control make you choose from which feed takes data.
    | Database is faster but needs to update data from API via CRON
    | Direct is slower becouse its calling directly api and return you result from Source API
    |
    | Supported: "database", "direct"
    |
    */

    'source' => env('WORLDPOPULATION_SOURCE', 'database'),
];
