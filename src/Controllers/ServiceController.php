<?php

namespace Src\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Src\Services\EventService;
use Src\Services\ThemeService;
use Src\Services\TypeService;
use Src\Services\UsersService;
use Src\Services\Page;

class ServiceController extends Controller{

    public function __invoke(){

        UsersService::verifyLogin();

        $events = new EventService();

        $data = $events->quantityEvents(date('Y'),date('m'),date('d'));

        $page = new Page();

        $page->setTpl('dashboard',[
            'month' => $data['eventsMonth'],
            'week' => $data['eventsWeek'],
            'day' => $data['eventsDay']
        ]);

    }

    public function loadTheme(ServerRequestInterface $request, ResponseInterface $response, array $args){

        UsersService::verifyLogin();

        $data = $request->getParsedBody();

        $theme = new ThemeService();

        $results = $theme->listAll($data);
        
        $response = ['status' => true,
                     'data' => $results];

        return json_encode($response);

    }

    public function loadType(ServerRequestInterface $request, ResponseInterface $response, array $args){
    
        UsersService::verifyLogin();


        $data = $request->getParsedBody();

        $type = new TypeService();

        $results = $type->listAll($data);
        
        $response = ['status' => true,
                    'data' => $results];

        return json_encode($response);

    }

     public function loadCalendar(ServerRequestInterface $request, ResponseInterface $response, array $args){

        UsersService::verifyLogin();
 
        $event = new EventService();

        $results = $event->getEvents();
        
        $response = ['status' => true,
                    'data' => $results];

         return json_encode($response);

    }

   

} 