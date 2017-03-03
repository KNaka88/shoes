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


        function getId()
        {
            return $this->id;
        }


        function setBrandName($brand_name)
        {
            $this->brand_name = $brand_name;
        }


        function save()
        {
          $query = $GLOBALS['DB']->query("SELECT * FROM brands WHERE brand_name = '{$this->getBrandName()}';");

          if(empty($result)){
            $GLOBALS['DB']->exec("INSERT INTO brands (brand_name) VALUES ('{$this->getBrandName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
          }
        }


        static function getAll()
        {
          $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
          $brands = [];

          foreach($returned_brands as $brand){
              $id = $brand['id'];
              $brand_name = $brand['brand_name'];
              $new_brand = new Brand($brand_name, $id);
              array_push($brands, $new_brand);
          }
          return $brands;
        }


        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM brands");
          $GLOBALS['DB']->exec("DELETE FROM stores_brands");
        }



        static function find($search_id)
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM brands WHERE id = {$search_id};");
            $result = $query->fetch(PDO::FETCH_ASSOC);
            $id = $result['id'];
            $brand_name = $result['brand_name'];
            $brand = new Brand($brand_name, $id);

            return $brand;
        }

        function delete()
        {
          $GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->id};");
          $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE brand_id = {$this->id};");
        }

        function update($new_brand_name)
        {
            $query = $GLOBALS['DB']->exec("UPDATE brands SET brand_name = '{$new_brand_name}' WHERE id = {$this->getId()};");
            $this->brand_name = $new_brand_name;
        }


        function addStore($store)
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM stores_brands WHERE brand_id = {$this->id} AND store_id = {$store->getId()}");

            $retrieved = $query->fetchAll(PDO::FETCH_ASSOC);
            if(!$retrieved){ //if empty
                $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$store->getId()}, {$this->getId()});");
            }
        }

        function getStores()
        {
            $query = $GLOBALS['DB']->query("SELECT stores.* FROM brands JOIN stores_brands ON (brands.id = stores_brands.brand_id) JOIN stores ON (stores_brands.store_id = stores.id) WHERE brands.id = {$this->getId()};");

            $returned_stores = $query->fetchAll(PDO::FETCH_ASSOC);
            $stores = [];
            foreach($returned_stores as $store){
                $store_name = $store['store_name'];
                $id = $store['id'];
                $new_store = new Store($store_name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }


    }
