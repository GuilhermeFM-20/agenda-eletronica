<?php

namespace Src\Controllers; 

use Src\Models\Themes;
use Src\Services\Page;
use Src\Services\CategoryService;
use Src\Services\ThemeService;
use Src\Services\UsersService;
use Src\Services\BrandService;

class ThemeController extends Controller{
    
    public function __invoke(){

        UsersService::verifyLogin();

        $pages = isset($_GET['page']) ? $_GET['page'] : 1;

        $product = new ThemeService();

        $product->setData($_POST);

        $pagination = $product->getPages($pages,8);

        $result = $this->verifyPages($pagination,$pages);

        $page = new Page();


        $page->setTpl('theme_search',[
            'theme'=>$pagination['data'],
            'pages'=>$result['pages'],
            'more'=>$result['more'],
            'alert' => self::getMessage(),
            'filter' => $_POST,
        ]);

    }

    public function viewCreate(){

        UsersService::verifyLogin();

        $page = new Page();
    
        $page->setTpl('theme',[
            'alert' => self::getMessage(),
            'link' => '/temas/create',
        ]);

    }

    public function viewUpdate($request, $response, array $args){

        UsersService::verifyLogin();
        
        $theme = new ThemeService();

        $page = new Page();

        $values = $theme->load($args['id']);

        $page->setTpl('theme',[
            'alert' => self::getMessage(),
            'product' => $values[0],
            'link' => "/temas/update/$args[id]",
        ]);

    }

    public function update($request, $response, array $args){

        UsersService::verifyLogin();

        $theme = new ThemeService();

        $theme->setData($_POST);

        $result = $theme->update($args['id']);

        if(!$result){
            self::setMessage('Preencha todos os campos.','warning');
            Controller::redirect('/temas/update/'.$args['id']);
        }

        self::setMessage('Registro atualizado com sucesso.','success');
        Controller::redirect('/temas');

    }

    public function create(){

        UsersService::verifyLogin();

        $theme = new ThemeService();

        $theme->setData($_POST);

        $result = $theme->save();

        if(!$result){
            self::setMessage('Preencha todos os campos.','warning');
            Controller::redirect('/temas/create');
        }

        self::setMessage('Registro cadastrado com sucesso.','success');
        Controller::redirect('/temas');

    }

    public function delete($request, $response, array $args){

        UsersService::verifyLogin();

        $theme = new ThemeService();

        $result = $theme->delete($args['id']);

        if(!$result){
            self::setMessage('Não foi possível excluir o registro!','warning');
            Controller::redirect('/temas');
        }

        self::setMessage('Registro excluído com sucesso.','success');
        Controller::redirect('/temas');

    }



}