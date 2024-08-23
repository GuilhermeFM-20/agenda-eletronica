<?php 

use Src\Controllers\ServiceController;

$app->group('/api', function ($app){

    $app->post('/load/type', [ServiceController::class,'loadType']);
    $app->post('/load/theme', [ServiceController::class,'loadTheme']);
    $app->post('/load/calendar', [ServiceController::class,'loadCalendar']);
    
});







