<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Brand.php";

    $server = 'mysql:host=localhost:8889;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    $app = new Silex\Application();
    $app->register(
       new Silex\Provider\TwigServiceProvider(),
       array('twig.path' => __DIR__.'/../views')
    );

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();
    $app['debug'] = true;


    //INDEX PAGE GET
    $app->get("/", function() use ($app){
        return $app['twig']->render('index.html.twig', array("stores" => Store::getAll()));
    });

    //Create STORE
    $app->post("/create_store", function() use ($app){
        $new_store = new Store($_POST['store_name']);
        $new_store->save();
        return $app->redirect('/');
    });


    return $app;
