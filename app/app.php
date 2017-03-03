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
    //INDEX PAGE POST
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
    //Delete Store
    $app->get("/delete_store/{id}", function($id) use ($app) {
      $store = Store::find($id);
      $store->delete();
      return $app->redirect("/");
    });
    //Delete Brand
    $app->get("/delete_brand/{id}", function($id) use ($app) {
      $brand = Brand::find($id);
      $brand->delete();
      return $app->redirect("/");
    });
    //DELETE ALL STORES
    $app->get("/delete_all_stores", function() use ($app) {
      Store::deleteAll();
      return $app->redirect("/");
    });
    //DELETE ALL BRANDS
    $app->get("/delete_all_brands", function() use ($app) {
      Brand::deleteAll();
      return $app->redirect("/");
    });




    //Store PAGE
    $app->post("/store/{id}", function($id) use ($app){
      $store = Store::find($id);
      return $app->redirect("/store/".$store.getId());
    });
    $app->get("/store/{id}", function($id) use ($app){
        $store = Store::find($id);
        $brands = $store->getBrands();
        return $app['twig']->render("store.html.twig", array("store"=>$store, "store_brands"=>$brands, "all_brands"=>Brand::getAll()));
    });
    //Add_Brand to Store
    $app->post("/add_brand/{id}", function($id) use ($app){
      $store = Store::find($id);
      $brand = Brand::find($_POST['brand_id']);
      $store->addBrand($brand);
      return $app->redirect("/store/".$store->getId());
    });




    //Brand PAGE
    $app->post("/brand/{id}", function($id) use ($app){
      $brand = Brand::find($id);
      return $app->redirect("/brand/".$brand.getId());
    });
    $app->get("/brand/{id}", function($id) use ($app){

        $brand = Brand::find($id);
        $stores = $brand->getStores();
        return $app['twig']->render("brand.html.twig", array("brand"=>$brand, "brand_stores"=>$stores, "all_stores"=>Store::getAll()));
    });
    //Add_Stores to Brand
    $app->post("/add_store/{id}", function($id) use ($app){
        $brand = Brand::find($id);
        $store = Store::find($_POST['store_id']);
        $brand->addStore($store);
        return $app->redirect("/brand/".$brand->getId());
    });


    return $app;
