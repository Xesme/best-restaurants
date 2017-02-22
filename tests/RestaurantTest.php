<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";

    $server = 'mysql:host=localhost:8889;dbname=pdx_eats_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {
        protected function teardown()
        {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
        }

        function test_save()
        {
            // Arrange
            $type = "American";
            $id = NULL;
            $new_test_cuisine = new Cuisine($type, $id);
            $new_test_cuisine->save();

            $name = "Bobs Burgers";
            $rating = 5;
            $review = "Great atmosphere";
            $id2 = NULL;
            $cuisine_id = $new_test_cuisine->getId();
            $new_restaurant = new Restaurant($name, $rating, $cuisine_id, $review, $id2);
            $new_restaurant->save();
            

            // Act
            $result = Restaurant::getAll();
            // var_dump($result);

            // Assert
            $this->assertEquals($new_restaurant, $result[0]);
        }
    }


?>
