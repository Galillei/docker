<?php
require 'vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as Capsule;
use \Illuminate\Support\Facades\DB as DB;
use Illuminate\Database\Schema\Builder;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Container\Container;
use model\City;
$app = new \Slim\Slim(array(
    'debug' => true,
    'templates.path' => 'templates'
));
$error = ['error'=>[]];
if(!file_exists('enviroment/connect.ini')){
    $error['error'][] = 'Database file is not exit';
}
if(!file_exists('enviroment/install.sql')){
    $error['error'][] = 'Install file is not exit';
}
if(!count($error['error'])){
    $config = parse_ini_file('enviroment/connect.ini');
    $capsule = new Capsule();
    $capsule->addConnection($config);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    try{
//        $capsule::connection($config);
//        $schema = $capsule::schema($capsule->connection('default'));
//        $schema::hasTable('countries');
    }catch(Exception $e){
        $error['error'][] = $e->getMessage();
    }
}
$app->get('/', function() use ($app) {
    $app->render('hello.php');
});
$app->get('/install',function() use ($app,$error,$capsule){

//    $app->response->headers->set('Content-Type','application/json');

    if(count($error['error'])){
//        echo(json_encode($error));
        $app->stop();
    }
    $insallSql = file_get_contents('enviroment/install.sql');
    $message = [];
    $message['can_install'] = true;
    try{
        /**@var PDO **/
        $pdo = $capsule->getDatabaseManager()->getPDO();
        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $pdo->exec($insallSql);
        $message['install'] = true;
        echo (json_encode(['install'=>true,'can_install'=>true]));
        $app->stop();
    }catch (PDOException $e){
        $error['error'][]=$e->getMessage();
        echo(json_encode($error));
        $app->stop();
    }

    echo(json_encode([]));
    $app->stop();

});

$app->get('/install/application',function() use ($app){
//здесь реализовываем логику проверки готовности, считается, если есть таблица country - то с приложение работать можно
    try{
        $countries = \model\Country::findOrFail(1);
    }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
        $error = ['error'=>true];
    }
    if(!isset($error)){
        $error = ['error'=>false];
    }
    $app->response->headers->set('Content-Type','application/json');
    echo(json_encode($error));
});
$app->group('/application',function() use ($app){
    $app->get('/countries',function() use ($app){
    $countries = \model\Country::all();
    $arrayOfCountry = [];
    if(count($countries)){
        foreach($countries as $country){
            $arrayOfCountry[] = ['title'=>$country->country,'id'=>$country->id];
        }
        $app->response->headers->set('Content-Type','application/json');
    }
    echo(json_encode($arrayOfCountry));
    $app->stop();

    });
    $app->get('/regions/:id',function($id) use ($app){
        $regions = \model\Country::find($id)->regions;
        $arrayofRegions = [];
        if(count($regions)){
            foreach($regions as $region){
                $arrayofRegions[] = ['title'=>$region->region,'id'=>$region->id];
            }
        }
        $app->response->headers->set('Content-Type','application/json');
        echo(json_encode($arrayofRegions));
        $app->stop();
    })->conditions(array('id'=>'\d+'));
   $app->get('/cities/:id',function($id) use ($app){
       $cities = \model\Region::find($id)->cities;
       $arrayOfCities = [];
       if(count($cities)){
           foreach($cities as $city){
               $arrayOfCities[] = ['title'=>$city->city,'id'=>$city->id];
           }
       }
       $app->response->headers->set('Content-Type','application/json');
       echo(json_encode($arrayOfCities));
   });


});
$app->run();