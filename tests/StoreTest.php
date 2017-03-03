<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Store.php";
    require_once "src/Brand.php";

    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
         {
           Store::deleteAll();
           Brand::deleteAll();
         }

        ///Test 1: test_getStoreName
        //Desc: check class Store is made and can call name by getStoreName()
        //Input: "Nordstorm"
        //Output: "Nordstorm"
        function test_getStoreName()
         {
             //Arrange
             $store_name = "Nordstorm";
             $test_store = new Store($store_name);

             //Act
             $result = $test_store->getStoreName();

             //Assert
            $this->assertEquals($store_name, $result);
         }

        //  //Test 2: test_getStoreId
        //  Desc: check class Store is made and check getStoreId() is numeric or not
        //  Input: "Nordstorm", "1"
        //  Output: true
        function test_getId()
          {
              //Arrange
              $store_name = "Nordstorm";
              $store_id = 1;
              $test_store = new Store($store_name, $store_id);

              //Act
              $result = $test_store->getId();

              //Assert
              $this->assertEquals($store_id, $result);
          }


         ////Test 3: test_save
         //Desc: check intance of Store saved on hair_salon_test database
         //Input:  "Nordstorm", "Macys"
         //Output: "Nordstorm"
         function test_save()
          {
              //Arrange
              $store_name = "Nordstorm";
              $test_store = new Store($store_name);
              $test_store->save();

              $store_name2 = "Macys";
              $test_store2 = new Store($store_name2);
              $test_store2->save();

              //Act
              $result = Store::getAll();

              //Assert
              $this->assertEquals($test_store, $result[0]);
          }


        ////Test 4: test_getAll
        //Desc: check getAll function work
        //Input:  "Nordstorm", "Macys"
        //Output: "Nordstorm", "Macys"
        function test_getAll()
        {
            // Arrange
            $store_name = "Nordstorm";
            $test_store = new Store($store_name);
            $test_store->save();


            $store_name2 = "Macys";
            $test_store2 = new Store($store_name2);
            $test_store2->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store, $test_store2], $result);
        }


        ///Test 5: test_deleteAll()
        //Desc: delete all records from store table
        //Input:  "Nordstorm", "Macys"
        //Output: ""
        function test_deleteAll()
        {
            // Arrange
            $store_name = "Nordstorm";
            $test_store = new Store($store_name);
            $test_store->save();


            $store_name2 = "Macys";
            $test_store2 = new Store($store_name2);
            $test_store2->save();

            //Act
            $result = Store::deleteAll();
            $result = Store::getAll();


            //Assert
            $this->assertEquals([], $result);
        }



        ///Test 6 test_find()
        //desc: find matched indexes by using id
        //Input:  "Nordstorm", "Macys"
        //Output: "Nordstorm"
        function test_find()
        {
            // Arrange
            $store_name = "Nordstorm";
            $test_store = new Store($store_name);
            $test_store->save();
            $id = $test_store->getId();

            $store_name2 = "Macys";
            $test_store2 = new Store($store_name2);
            $test_store2->save();

            //Act
            $result = Store::find($id);

            //Assert
            $this->assertEquals($test_store, $result);
        }


        ///Test 7 test_update()
        //desc: update the store_name
        //Input:  "Nordstorm", "Macys"
        //Output: "Macys"
        function test_update()
        {
            // Arrange
            $store_name = "Nordstorm";
            $test_store = new Store($store_name);
            $test_store->save();


            $store_id = $test_store->getId();
            $new_store_name = "Macys";

            // Act
            $test_store->update($new_store_name);

            // Assert
            $this->assertEquals($new_store_name, $test_store->getStoreName());
        }


        ///Test 8 test_delete()
        //desc: delete store_name from database
        //Input:  "Nordstorm", "Macys"
        //Output: "Macys"
        function testDelete()
        {

            //Arrange
            $store_name = "Nordstorm";
            $test_store = new Store($store_name);
            $test_store->save();

            $store_name2 = "Macys";
            $test_store2 = new Store($store_name2);
            $test_store2->save();

            //Act
            $test_store->delete();

            //Assert
            $this->assertEquals( [$test_store2], Store::getAll());
        }


        ///Test 9 test_addBrand()
        //desc: create instances of brand from instance of Store
        //Input:  "Nordstorm" (Store), "Nike" (Brand)
        //Output: "Nike"
        function test_addBrand()
        {
            $store_name = "Nordstorm";
            $test_store = new Store($store_name);
            $test_store->save();

            $brand_name = 'Nike';
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            $test_store->addBrand($test_brand);

            $result = $test_store->getBrands();

            $this->assertEquals([$test_brand], $result);
        }

        ///Test 10 test_addBrand()
        //desc: create instances of brand from instance of Store
            //check it prevents duplication
        //Input:  "Nordstorm" (Store), "Nike" x 2 (Brand)
        //Output: "Nike"


        ///Test 11 test_getBrands()
        //desc: get brands that associated with the store
        //Input:  "Nordstorm" (Store), "Nike"(Brand), "Adidas"(Brand)
        //Output: "Nike, Adidas"



}
