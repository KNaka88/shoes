<?php

    class Brand
    {
        private $id;
        private $brand_name;


        function __construct ($brand_name, $id = null)
        {
            $this->brand_name = $brand_name;
            $this->id = $id;
        }


        function getBrandName()
        {
            return $this->brand_name;
        }


        function getBrandId()
        {
            return $this->brand_id;
        }


        function setBrandName($brand_name)
        {
            $this->brand_name = $brand_name;
        }


        function save()
        {

        }


        static function getAll()
        {
        }


        static function deleteAll()
        {
        }

        function delete()
        {

        }

        static function find($search_id)
        {

        }

        function update($new_brand_name)
        {

        }


        function addBrand()
        {

        }

        function getBrands()
        {
            //Join Table
        }


    }
