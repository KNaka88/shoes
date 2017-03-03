<?php

    class Store
    {
        private $id;
        private $store_name;


        function __construct ($store_name, $id = null)
        {
            $this->store_name = $store_name;
            $this->id = $id;
        }


        function getBrandName()
        {
            return $this->store_name;
        }


        function getBrandId()
        {
            return $this->store_id;
        }


        function setBrandName($store_name)
        {
            $this->store_name = $store_name;
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

        function update($new_store_name)
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
