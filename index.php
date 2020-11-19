<?php 
session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;
use \Acontardi\Page;
use \Acontardi\PageAdmin;
use \Acontardi\Model\User;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {
    
    $page = new Page();
    $page->setTpl("index");

});

$app->get('/admin', function() {

    //User::verifyLogin();
    
    $page = new PageAdmin();
    $page->setTpl("index");

});

$app->get('/admin/login', function() {
    
    $page = new PageAdmin([
        "header"=>false,
        "footer"=>false
    ]);
    $page->setTpl("login");

});

$app->post('/admin/login', function() {
    
    User::login($_POST['deslogin'], $_POST['despassword']);

    header("Location: /admin");
    exit;

});

$app->get('/admin/login', function() {
    
    User::logout();

    header("Location: /admin/login");
    exit;

});

$app->run();

 ?>