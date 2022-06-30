<?php
    class ProductFilter {
        public $keyword;
        public $categoryName;
        public $minPrice;
        public $maxPrice;

        function __construct( $keyword, $categoryName, $minPrice, $maxPrice) {
            $this->$keyword = $keyword;
            $this->$categoryName = $categoryName;
            $this->$minPrice = $minPrice;
            $this->$maxPrice = $maxPrice;
        }
    }
?>