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

            // Assert
            $this->assertEquals($new_restaurant, $result[0]);
        }

        function test_getAll()
        {
            // Arrange
            $type = "American";
            $id = NULL;
            $new_test_cuisine = new Cuisine($type, $id);
            $new_test_cuisine->save();

            $name = "Bobs Burgers";
            $rating = 5;
            $review = "Great atmosphere";
            $cuisine_id = $new_test_cuisine->getId();
            $new_restaurant = new Restaurant($name, $rating, $cuisine_id, $review, $id);
            $new_restaurant->save();

            $name2 = "Sally has PANCAKES";
            $rating2 = 3;
            $review2 = "Alright pancakes and loud service staff";
            $new_restaurant2 = new Restaurant($name2, $rating2, $cuisine_id, $review2, $id);
            $new_restaurant2->save();


            // Act
            $result = Restaurant::getAll();

            // Assert
            $this->assertEquals([$new_restaurant, $new_restaurant2], $result);
        }

        function test_deleteAll()
        {
            // Arrange
            $type = "American";
            $id = NULL;
            $new_test_cuisine = new Cuisine($type, $id);
            $new_test_cuisine->save();

            $name = "Bobs Burgers";
            $rating = 5;
            $review = "Great atmosphere";
            $cuisine_id = $new_test_cuisine->getId();
            $new_restaurant = new Restaurant($name, $rating, $cuisine_id, $review, $id);
            $new_restaurant->save();

            $name2 = "Sally has PANCAKES";
            $rating2 = 3;
            $review2 = "Alright pancakes and loud service staff";
            $new_restaurant2 = new Restaurant($name2, $rating2, $cuisine_id, $review2, $id);
            $new_restaurant2->save();


            // Act
            Restaurant::deleteAll();
            $result = Restaurant::getAll();

            // Assert
            $this->assertEquals([], $result);
        }

        function test_search()
        {
            // Arrange
            $type = "American";
            $id = NULL;
            $new_test_cuisine = new Cuisine($type, $id);
            $new_test_cuisine->save();

            $type = "Italian";
            $new_test_cuisine2 = new Cuisine($type, $id);
            $new_test_cuisine2->save();

            $name = "Bobs Burgers";
            $rating = 5;
            $review = "Great atmosphere";
            $cuisine_id = $new_test_cuisine->getId();
            $new_restaurant = new Restaurant($name, $rating, $cuisine_id, $review, $id);
            $new_restaurant->save();

            $name2 = "Sally has PANCAKES";
            $rating2 = 3;
            $review2 = "Alright pancakes and loud service staff";
            $new_restaurant2 = new Restaurant($name2, $rating2, $cuisine_id, $review2, $id);
            $new_restaurant2->save();

            $name3 = "Julianos Pasta Bowls and Bread";
            $rating3 = 4;
            $review3 = "Not enough cheese but TONS of carbs";
            $cuisine_id3 = $new_test_cuisine2->getId();
            $new_restaurant3 = new Restaurant($name3, $rating3, $cuisine_id3, $review3, $id);
            $new_restaurant3->save();


            // Act
            $cuisine_id_search = $new_restaurant3->getCuisineId();
            $result = $new_restaurant3->search($cuisine_id_search);

            // Assert
            $this->assertEquals([$new_restaurant3], $result);
        }

        function test_update()
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
            $restaurant_id = $new_restaurant->getId();

            $new_name = "Burger Bob";
            $new_rating = 7;
            $new_review = "EDIT post the new owners have brought new life to this business";
            $test_restaurant = new Restaurant($new_name, $new_rating, $cuisine_id, $new_review, $restaurant_id);


            // Act
            $new_restaurant->edit($new_name, $new_rating, $new_review);
            $result = Restaurant::getRestaurantById($restaurant_id);

            // Assert
            $this->assertEquals($test_restaurant, $result[0]);
        }
    }


?>
