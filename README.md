# Vinted Backend Homework Assignment
## Module for calculating shipment discounts based on the provided user transactions data

### Tech stack
* PHP 8.1

### How to run application 
* Note! PHP and composer (application-level dependency manager for the PHP) must be installed on your machine
* Run ``` composer install ``` to install project dependencies (autoload and PHPUnit library for Unit tests)
* From the /vinted/app directory, run the command php run.php
* run.php is the input file of the application, it creates a Main() object

### Input data
* Input data is stored in the root of the application, in the input.txt file

### Design decisions and assumptions 
* Design decisions and assumptions are presented in the code as comments in some places in the application

### Tests 
* Because of the decision to rewrite the main part, there are no tests in the application.
After refactoring the code, it became possible to easily extend the application by adding new functionality
as well as modifying existing ones. Unfortunately, there was no time left for writing unit tests.