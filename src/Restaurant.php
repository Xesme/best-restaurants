<?php
    class Restaurant
    {
        private $name;
        private $rating;
        private $cuisine_id;
        private $review;
        private $id;

        function __construct($name, $rating, $cuisine_id, $review, $id = NULL)
        {
            $this->name = $name;
            $this->rating = $rating;
            $this->cuisine_id = $cuisine_id;
            $this->review = $review;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getReview()
        {
            return $this->review;
        }

        function setReview($new_review)
        {
            $this->review = $new_review;
        }

        function getRating()
        {
            return $this->rating;
        }

        function setRating($new_rating)
        {
            $this->rating = $new_rating;
        }


        function getId()
        {
            return $this->id;
        }

        function getCuisineId()
        {
            return $this->cuisine_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO restaurants (name, rating, cuisine_id, review) VALUES ('{$this->getName()}', {$this->getRating()}, {$this->getCuisineId()}, '{$this->getReview()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function deleteRestaurant()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants WHERE id = '{$this->getId()}';");
        }

        static function search($cuisine_id)
        {
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants WHERE cuisine_id = $cuisine_id ORDER BY rating DESC;");
            $restaurants = array();
            foreach($returned_restaurants as $restaurant)
            {
                $name = $restaurant['name'];
                $id = $restaurant['id'];
                $cuisine_id = $restaurant['cuisine_id'];
                $review = $restaurant['review'];
                $rating = $restaurant['rating'];
                $new_restaurant = new Restaurant($name, $rating, $cuisine_id, $review, $id);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        static function getAll()
        {
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");

            $restaurants = array();
            foreach($returned_restaurants as $restaurant)
            {
                $name = $restaurant['name'];
                $id = $restaurant['id'];
                $cuisine_id = $restaurant['cuisine_id'];
                $review = $restaurant['review'];
                $rating = $restaurant['rating'];
                $new_restaurant = new Restaurant($name, $rating, $cuisine_id, $review, $id);
                array_push($restaurants, $new_restaurant);
            }

            return $restaurants;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants;");
        }

        static function getRestaurantById($restaurant_id)
        {
            $returned_restaurant = $GLOBALS['DB']->query("SELECT * FROM restaurants WHERE id = '{$restaurant_id}';");
            $restaurant = array();
            foreach($returned_restaurant as $found_restaurant)
            {
                $name = $found_restaurant['name'];
                $id = $found_restaurant['id'];
                $cuisine_id = $found_restaurant['cuisine_id'];
                $review = $found_restaurant['review'];
                $rating = $found_restaurant['rating'];
                $new_restaurant = new Restaurant($name, $rating, $cuisine_id, $review, $id);
                array_push($restaurant, $new_restaurant);
            }
            return $restaurant;
        }
    }
 ?>
