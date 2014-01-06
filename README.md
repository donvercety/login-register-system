login-register-system
=====================

A simple yet very powerful login-register system made with php oop.
-------------------------------------------------------------------

An **object oriented authentication system** including the ability to register a user, 
log in and includes features like validation, remember me, user profiles, **CSRF 
protection, secure password salting** and various helper classes to make working 
with sessions, cookies, input and configuration easier.

Basic structure of the application:
![alt tag](http://prikachi.com/images/623/6925623v.png)

You will need a database that looks like this:
![alt tag](http://prikachi.com/images/683/6925683D.png)

* A "groups" table that looks like this:
*It is important to know that the "permissions" row is going to hold JSON Objects.*
![alt tag](http://prikachi.com/images/685/6925685I.png)

* A "users" table that looks like this:
![alt tag](http://prikachi.com/images/687/6925687D.png)

* A "users_session" table that looks like this:
![alt tag](http://prikachi.com/images/688/6925688G.png)

Most of the Classes are made in such a way, that they can be used separately.
-----------------------------------------------------------------------------

Many thanks for **phpacademy** for making the tutorial, from which this app was made.
You can find them [HERE](https://phpacademy.org).
