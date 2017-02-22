<?php
    class Restaurant
    {
        private $name;
        private $id;
        private $cuisine_id;
        private $review;
        private $rating;

        function __construct($name, $id = NULL, $cuisine_id, $review, $rating)
        {
            $this->name = $name;
            $this->id = $id;
            $this->cuisine_id = $cuisine_id;
            $this->review = $review;
            $this->rating = $rating;
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
            $GLOBALS['DB']->exec("INSERT INTO restaurants (name, review, cuisine_id, rating) VALUES ('{$this->getName()}', '{$this->getReview()}', {$this->getCuisineId()}, {$this->getRating()});");
            $this->id = $GLOBALS['DB']->insertLastId();
        }

        static function getAll()
        {
            $returned_restaurants = $GlOBALS['DB']->query("SELECT * FROM restaurants;");
            $restaurants = array();
            foreach($returned_restaurants as $restaurant)
            {
                $name = $restaurant['name'];
                $id = $restaurant['id'];
                $cuisine_id = $restaurant['cuisine_id'];
                $review = $restaurant['review'];
                $rating = $restaurant['rating'];
                $new_restaurant = new Restaurant($name, $id, $cuisine_id, $review, $rating);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants;");
        }

    }
 ?>
