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


        function getId()
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


        static function find($search_id)
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM stores WHERE id = {$search_id};");
            $result = $query->fetch(PDO::FETCH_ASSOC);
            $id = $result['id'];
            $store_name = $result['store_name'];
            $store = new Store($store_name, $id);

            return $store;
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->id};");
            $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE stores_id = {$this->id};");
        }

        function update($new_store_name)
        {
            $query = $GLOBALS['DB']->exec("UPDATE stores SET store_name = '{$new_store_name}' WHERE id = {$this->getId()};");
            $this->store_name = $new_store_name;
        }


        function addBrand($brand)
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM stores_brands WHERE store_id = {$this->id} AND brand_id = {$brand->getId()}");

            $retrieved = $query->fetchAll(PDO::FETCH_ASSOC);
            if(!$retrieved){ //if empty
                $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$this->getId()}, {$brand->getId()});");
            }
        }

        function getBrands()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT brands.* FROM stores JOIN stores_brands ON (stores.id = stores_brands.store_id) JOIN brands ON (stores_brands.brand_id = brands.id) WHERE stores.id = {$this->getId()};");

            $brands = [];
            foreach($returned_brands as $brand){
                $brand_name = $brand['brand_name'];
                $id = $brand['id'];
                $new_brand = new Brand($brand_name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }
    }
