<?php
    date_default_timezone_set("America/Los_Angeles");
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Cuisine.php";
    require_once __DIR__."/../src/Restaurant.php";

    $server = 'mysql:host=localhost:8889;dbname=pdx_eats';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get("/", function() use($app){
        $cuisines = Cuisine::getAll();

        return $app['twig']->render('index.html.twig', array('cuisines' => $cuisines));
    });

    $app->post('/add-restaurant', function() use($app) {
        $id = NULL;
        $new_restaurant = new Restaurant($_POST['restaurant_name'], $_POST['rating'], $_POST['cuisine_id'],  "Its ok", 0);
        $new_restaurant->save();
        var_dump($new_restaurant);
        $cuisines = Cuisine::getAll();

        return $app['twig']->render('index.html.twig', array('cuisines' => $cuisines));
    });

    $app->get('/cuisines/{id}', function($id) use($app) {
        $found_restaurants = Restaurant::search($id);

        return $app['twig']->render('cuisines.html.twig', array('restaurants' => $found_restaurants));
    });


    return $app;
 ?>
