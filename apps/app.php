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
    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));
    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use($app){
        $cuisines = Cuisine::getAll();

        return $app['twig']->render('index.html.twig', array('cuisines' => $cuisines));
    });

    $app->post('/add-restaurant', function() use($app) {
        $id = NULL;
        $new_restaurant = new Restaurant($_POST['restaurant_name'], $_POST['rating'], $_POST['cuisine_id'],  $_POST['review'], $id);
        $new_restaurant->save();
        $cuisines = Cuisine::getAll();

        return $app['twig']->render('index.html.twig', array('cuisines' => $cuisines));
    });

    $app->get('/cuisines/{id}', function($id) use($app) {
        $found_restaurants = Restaurant::search($id);
        $cuisine = Cuisine::getCuisineById($id);
        return $app['twig']->render('cuisines.html.twig', array( 'cuisine' => $cuisine, 'restaurants' => $found_restaurants));
    });

    $app->get('/restaurant/{id}', function($id) use($app){
        $found_restaurant = Restaurant::getRestaurantById($id);
        return $app['twig']->render('restaurant.html.twig', array('restaurant' => $found_restaurant));
    });

    $app->delete('/restaurant/delete/{id}', function($id) use($app){
        $restaurant = Restaurant::getRestaurantById($id);
        $cuisine_id = $restaurant[0]->getCuisineId();
        $restaurant[0]->deleteRestaurant();
        $found_restaurants = Restaurant::search($cuisine_id);
        $cuisine = Cuisine::getCuisineById($cuisine_id);

        return $app['twig']->render('cuisines.html.twig', array('cuisine' => $cuisine, 'restaurants' => $found_restaurants));
    });

    $app->patch('/update/{id}', function($id) use($app) {
        $restaurant = Restaurant::getRestaurantById($id);
        $restaurant[0]->update($_POST['new_name'], $_POST['new_rating'], $_POST['new_review']);

        return $app['twig']->render('restaurant.html.twig', array('restaurant' => $restaurant));
    });

    return $app;
 ?>
