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
        return $app['twig']->render('index.html.twig', array("stores" => Store::getAll(), "brands" => Brand::getAll()));
    });
    $app->post("/", function() use ($app){

        $input_name = filter_var($_POST['name'], FILTER_SANITIZE_MAGIC_QUOTES);
        $input_type = $_POST['type'];

        if($input_type == "store"){
          $new_store = new Store($input_name);
          $new_store->save();

        }elseif($input_type == "brand"){
          $new_brand = new Brand($input_name);
          $new_brand->save();
                  }
        return $app->redirect('/');
    });

    //Store PAGE
    $app->post("/store/{id}", function($id) use ($app){
      $store = Store::find($id);
      return $app->redirect("/store/".$store.getId());
    });
    $app->get("/store/{id}", function($id) use ($app){
        $store = Store::find($id);
        return $app['twig']->render("store.html.twig", array("store"=>$store));
    });



    //Brand PAGE
    $app->post("/brand/{id}", function($id) use ($app){
      $brand = Brand::find($id);
      return $app->redirect("/brand/".$brand.getId());
    });
    $app->get("/brand/{id}", function($id) use ($app){
        $brand = Brand::find($id);
        return $app['twig']->render("brand.html.twig", array("brand"=>$brand));
    });



    return $app;
