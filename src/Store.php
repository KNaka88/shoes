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
            $query = $GLOBALS['DB']->query("SELECT * FROM stores WHERE store_name = '{$this->getStoreName()}';");

            if(empty($result)){
              $GLOBALS['DB']->exec("INSERT INTO stores (store_name) VALUES ('{$this->getStoreName()}');");
              $this->id = $GLOBALS['DB']->lastInsertId();
            }
        }


        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $stores = [];

            foreach($returned_stores as $store){
                $id = $store['id'];
                $store_name = $store['store_name'];
                $new_store = new Store($store_name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }


        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM stores");
          $GLOBALS['DB']->exec("DELETE FROM stores_brands");
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
