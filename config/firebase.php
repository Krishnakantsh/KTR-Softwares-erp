<?php

return [

    'api_key' => env('FIREBASE_API_KEY'),

    'auth_domain' => env('FIREBASE_AUTH_DOMAIN'),

    'project_id' => env('FIREBASE_PROJECT_ID'),

    'storage_bucket' => env('FIREBASE_STORAGE_BUCKET'),

    'sender_id' => env('FIREBASE_SENDER_ID'),

    'app_id' => env('FIREBASE_APP_ID'),

    'measurement_id' => env('FIREBASE_MEASUREMENT_ID'),

    'credentials' => base_path(env('FIREBASE_CREDENTIALS')),

];



// we can implement is like this in any blade 

// window.firebaseConfig = @json(config('firebase'));