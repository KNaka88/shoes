<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Brand.php";
    require_once "src/Store.php";

    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
         {
           Brand::deleteAll();
           Brand::deleteAll();
         }

        ///Test 1: test_getBrandName
        //Desc: check class Brand is made and can call name by getBrandName()
        //Input: "Nike"
        //Output: "Nike"
        function test_getBrandName()
         {
             //Arrange
             $brand_name = "Nike";
             $test_brand = new Brand($brand_name, 1);

             //Act
             $result = $test_brand->getBrandName();

             //Assert
            $this->assertEquals($brand_name, $result);
         }

         ////Test 2: test_getBrandId
         //Desc: check class Brand is made and check getBrandId() is numeric or not
         //Input: "Nike", "1"
         //Output: true
         function test_getId()
         {
             //Arrange
             $brand_name = "Nike";
             $brand_id = 1;
             $test_brand = new Brand($brand_name, $brand_id);

             //Act
             $result = $test_brand->getId();

             //Assert
             $this->assertEquals($brand_id, $result);
         }


         ////Test 3: test_save
         //Desc: check intance of Brand saved on hair_salon_test database
         //Input:  "Nike", "Adidas"
         //Output: "Nike"
         function test_save()
          {
              //Arrange
              $brand_name = "Nike";
              $test_brand = new Brand($brand_name);
              $test_brand->save();

              $brand_name2 = "Adidas";
              $test_brand2 = new Brand($brand_name2);
              $test_brand2->save();

              //Act
              $result = Brand::getAll();

              //Assert
              $this->assertEquals($test_brand, $result[0]);
          }


         ////Test 4: test_getAll
         //Desc: check getAll function work
         //Input:  "Nike", "Adidas"
         //Output: "Nike", "Adidas"
         function test_getAll()
         {
             // Arrange
             $brand_name = "Nike";
             $test_brand = new Brand($brand_name);
             $test_brand->save();


             $brand_name2 = "Adidas";
             $test_brand2 = new Brand($brand_name2);
             $test_brand2->save();

             //Act
             $result = Brand::getAll();

             //Assert
             $this->assertEquals([$test_brand, $test_brand2], $result);
         }


         ///Test 5: test_deleteAll()
          //Desc: delete all records from brand table
          //Input:  "Nike", "Adidas"
          //Output: ""
          function test_deleteAll()
          {
              // Arrange
              $brand_name = "Nike";
              $test_brand = new Brand($brand_name);
              $test_brand->save();


              $brand_name2 = "Adidas";
              $test_brand2 = new Brand($brand_name2);
              $test_brand2->save();

              //Act
              $result = Brand::deleteAll();
              $result = Brand::getAll();

              //Assert
              $this->assertEquals([], $result);
          }


          ///Test 6 test_find()
          //desc: find matched indexes by using id
          //Input:  "Nike", "Adidas"
          //Output: "Nike (object)"
          function test_find()
          {
              // Arrange
              $brand_name = "Nike";
              $test_brand = new Brand($brand_name);
              $test_brand->save();
              $id = $test_brand->getId();

              $brand_name2 = "Adidas";
              $test_brand2 = new Brand($brand_name2);
              $test_brand2->save();

              //Act
              $result = Brand::find($id);

              //Assert
              $this->assertEquals($test_brand, $result);
          }



          ///Test 7 test_update()
          //desc: update the brand_name
          //Input:  "Nike", "Adidas"
          //Output: "Adidas (object)"
          function test_update()
          {
              // Arrange
              $brand_name = "Nike";
              $test_brand = new Brand($brand_name);
              $test_brand->save();


              $brand_id = $test_brand->getId();
              $new_brand_name = "Adidas";

              // Act
              $test_brand->update($new_brand_name);

              // Assert
              $this->assertEquals($new_brand_name, $test_brand->getBrandName());
          }



          ///Test 8 test_delete()
          //desc: delete brand_name from database
          //Input:  "Nike", "Adidas"
          //Output: "Adidas"


          ///Test 9 test_addShop()
          //desc: add shop to database
          //Input:  "Nike" (Brand), "Nordstorm" (Shop)
          //Output: "Nordstorm"


          ///Test 10 test_addShop()
          //desc: add shop to database
              //check it prevents duplication
          //Input:  "Nike" (Brand), "Nordstorm" x 2 (Shop)
          //Output: "Nordstorm"


          ///Test 11 test_getShops()
          //desc: get shops that associated with the brand
          //Input:  "Nike" (brand), "Nordstorm"(Shop), "Macys"(Shop)
          //Output: "Nordstorm, Macys"
}
