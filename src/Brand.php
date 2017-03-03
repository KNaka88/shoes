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

        function delete()
        {

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

        function update($new_brand_name)
        {
            $query = $GLOBALS['DB']->exec("UPDATE brands SET brand_name = '{$new_brand_name}' WHERE id = {$this->getId()};");
            $this->brand_name = $new_brand_name;
        }


        function addShop()
        {

        }

        function getShops()
        {
            //Join Table
        }


    }
