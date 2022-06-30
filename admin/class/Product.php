<?php
    class Product {
        public $name; 
        public $category_id;
        public $price; 
        public $short_desc;
        public $long_desc;
        public $active; 
        public $hot; 
        public $quantity; 
        public $quantity_sold;
        public $thumb;

        function __construct($name, $category_id, $price, $short_desc, $long_desc, $active, $hot, $quantity, $quantity_sold, $thumb) {
            $this->$name = $name;
            $this->$category_id = $category_id;
            $this->$price = $price;
            $this->$short_desc = $short_desc;
            $this->$long_desc = $long_desc;
            $this->$active = $active;
            $this->$hot = $hot;
            $this->$quantity = $quantity;
            $this->$quantity_sold = $quantity_sold;
            $this->$thumb = $thumb;
        }
    }
?>