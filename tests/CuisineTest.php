<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";

    $server = "mysql:host=localhost:8889;dbname=pdx_eats_test";
    $username = "root";
    $password = "root";
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
        }

        function test_save()
        {
            // Arrange
            $type = "American";
            $id = NULL;
            $new_test_cuisine = new Cuisine($type, $id);
            $new_test_cuisine->save();

            // Act
            $result = Cuisine::getAll();

            // Assert
            $this->assertEquals([$new_test_cuisine], $result);
        }

        function test_getAll()
        {
            // Arrange
            $type = "American";
            $id = NULL;
            $new_test_cuisine = new Cuisine($type, $id);
            $new_test_cuisine->save();

            $type2 = "Mexican";
            $new_test_cuisine2 = new Cuisine($type2, $id);
            $new_test_cuisine2->save();

            // Act
            $result = Cuisine::getAll();

            // Assert
            $this->assertEquals([$new_test_cuisine, $new_test_cuisine2], $result);
        }

        function test_deletAll()
        {
            // Arrange
            $type = "American";
            $id = NULL;
            $new_test_cuisine = new Cuisine($type, $id);
            $new_test_cuisine->save();

            // Act
            Cuisine::deleteAll();
            $result = Cuisine::getAll();

            // Assert
            $this->assertEquals([], $result);
        }

    }


 ?>
