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


        function getStoreName()
        {
            return $this->store_name;
        }


        function getStoreId()
        {
            return $this->id;
        }


        function setStoreName($store_name)
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


        function addStore()
        {

        }

        function getStores()
        {
            //Join Table
        }


    }
