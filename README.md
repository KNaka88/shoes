#Koji Nakagawa

#### PHP 4th Week Independent Project for Epicodus, 3.3.2017

#### By Koji Nakagawa

## Description
* This website is the fourth independent project for Epicodus "PHP" class.
* This website can add Shop and Brand to Database and can see the results.

## Specifications

|Behavior|Input|Output|
|--------|-----|------|
| When user type store name and select Add Store and click Add button, the store name will be added on Store Lists  | "Macy's"  | "Macy's" (on Store Lists) |
| When user type store name and select Add Brand, and click Add button, the brand name will be added on Brand Lists  | "Nike"  | "Nike" (on Brand Lists) |
| User can delete Store Lists | "Macy's" -> "Delete" | "" |
| User can delete Brand Lists | "Nike" -> "Delete" | "" |
| User can edit Store Name | "Macy's" -> "Nordstorm" | "Nordstorm" (on Store Lists) |
| User can delete all stores or all brand lists | "Macy's", "Nordstorm" | "" |
| User can lookup which brand is available on specific stores and can add brand | Store: "Macy's" and add Brand: "Nike" | "Nike" is added on Macy's page |
| User can lookup can see which stores sells the brand and can add store | Brand: "Nike" and add Store: "Macy's" | "Macy's" is added on Nike's page |

## Setup/Installation Requirements
1. Clone this repository.
2. Install Composer to your computer.
3. Install the Composer at the top level of project directory to add dependencies to this projects.
* if you are not sure how to install composer and add dependency, [see this link](https://www.learnhowtoprogram.com/php/object-oriented-php/composer).

### To create a database, I used MAMP and set below localhost number:
* Apache Port: localhost:8888
* MySQL Port: localhost:8889
you can install MAMP [from this link](https://www.mamp.info/en/).

## MYSQL Command for Creating Database
1. CREATE DATABASE shoes;
2. USE shoes;
3. CREATE TABLE stores (id serial PRIMARY KEY, store_name VARCHAR (255));
4. CREATE TABLE brands (id serial PRIMARY KEY, brand_name VARCHAR (255));
5. CREATE TABLE stores_brands (id serial PRIMARY KEY, store_id INT, brand_id INT);

#### If you would like to see the result of PHPUnit tests, create database _shoes_test_
#### You can create and manage the database more easily through phpMyAdmin (localhost:8888/phpmyadmin/)

#### If you would like to use the sample database that stored on the top level folder, clone the file from clone repository, choose the import tab and choose your database file and click Go


## Known Bugs
* I confirmed this program is successfully running under the PHP 5.6.16, using Mac OS X 10.11.6.
* If you found some errors, please let me know. Any suggestions are highly appreciated.

## Technologies Used
* HTML
* CSS
* PHP
* Silex
* Twig
* Bootstrap
* PHPUnit
* MySQL

## License

_Copyright (c) 2017 **Koji Nakagawa**_

_Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:_

_The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software._

_THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE._
