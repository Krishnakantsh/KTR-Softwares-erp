<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('academic:auto-session')
    ->timezone('Asia/Kolkata')
    ->yearlyOn(4, 1, '01:00');


    // linux command

    // * * * * * php /path-to-project/artisan schedule:run >> /dev/null 2>&1

    //  Example

    // * * * * * php /home/ktrsofttech/public_html/artisan schedule:run >> /dev/null 2>&1