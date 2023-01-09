# Laravel framework implementation

Hi! this is parham . in this repository I tried to make my own laravel that can be used for small and medium projects . this laravel is similar to laravel 6 and laravel 7.
I have my own routing system, policies , containers , events , queues and etc that i will discuss about them later.

> notice : MVC has been used in this project


## get start

like all php applications we start from an index.php file in the root which calls autoload and goes straightly to setup.php file

## config folder

in here we got two files . one is setup.php that contains all of the necessary configs we need throughout the project such as jwt , MySQL and file managing and etc.  just like .env file in laravel  and the second file is appliction.php which calls all of the files in provider folder to start packages and etc. 
for example running session or starting my logging system or my exception handler system , listeners , Gates and other things . **exactly** like laravel .

## routing

I used Bramus package for routing because of it's great features such as route naming and middleware system and divided our routes into api, web and auth files and all of them are called using RouteServiceProvider.php

## event and listeners

you can define every event you want in events folder and define their 
listeners in listeners folder . and relate them to each other through eventServiceProvider.php . just the same as Laravel7
## policy

defining a policy system is a key feature for authorization . in here you can handle it both  from policy folder just like postPolicy.php file which I implemented
or you can define it everywhere with `Gate::define()` and `Gate::allows()` methods .
another benefit that this project has , is **before** and **after** methods in Gate class that gives you a full control for   authorization 
not only this, but also you have **authorize** method in user entity for managing each user access . 

## classes

in this folder every class which cannot be referred to as a model in database tables took place . for example **redis** or **jwt** or maybe **elastic search** configs . for more info check each one you want.

I should mention that I am using **MVC** in my project. just the same as Laravel

### other folders

 - Exceptions : defining all the exceptions you want such as those related to http such as 403|not authorized or 404|page not found   to other coding errors just the  same to Laravel6 . check out for more inffo
 - interfaces : all of the interfaces for controllers, models and entities is placed in here
 - helpers : here we have files that are all static and help us with more clean code by avoiding us from repeating code blocks . for example check Tools. Php to see their abilities
 - libs : my libraries
 - storage (outside src) : for cache and logs
 - database : for defining my database format and it is called in DBServiceprovider.php
 - providers : just the same as Laravel . to have **clean code** I am using it 
 - views : adding rendering pages

### example

in the main  branch I implemented a simple login/signup system with this project and it works totally fine
 also you can check **AZKI** branch that I implemented their entities and models 

## ENTITIES
in here , in each class we used magic getter and setters and also all of the related methods to that class for example in user class , we have **isLogin** method or authorize method and many more methods . for more information . check it please


## MODELS

*ALL*  of the methods like CRUD and implemented here . I did my best to make a clean and easy to read code . for example each method id just doing a certain job . or we do not have a method for more than 10 lines . check UserModel.php class

and do  not forget about our **caching system , redis**, which is generated from **Predis** package from **packagist** 

## CONTROLLERS

as MVC says controllers are a bridge between client and server and in here, I used my own controllers for each class and also we have **dependency injection** for URL parameters . if you do not have no idea what it is please check Laravel9 documentation


# final speech

it is kind of obvious that laravel and other frameworks are much more better than mine but I believe if we have our own frameworks we can be faster and much more comfortable while debugging

