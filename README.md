# Intergaz-assignment
 
## Table of contents
* [General info](#general-info)
* [Technologies](#technologies)
* [Setup](#setup)
* [Demonstration](#demonstration)

## General info

In this project you are able to see the movements of deliveries for a company. Deliveries contain addresses, routes, what product is beeing delivered for what price and in what stage the delivery is currently. You can see which clients had both deliveries (liquid and solid) to one address, overall delivery history, and inactive clients (those who haven't had a single liquid product delivery to an address).

## Technologies

* PHP version: 8.0
* Laravel version: v9.48.0
* MySQL version: 8.0.31-0ubuntu0.20.04.2 for Linux on x86_64 ((Ubuntu))
* Composer version: 2.4.4

## Setup
1. Clone this repository `git clone https://github.com/dauchinjs/intergaz-assignment.git`
2. Install all dependencies: `composer install`
3. Rename the `.env.example` file to `.env` and add your credentials
4. To get the databases, use command `php artisan migrate` in the terminal
5. Run the frontend `npm run dev`
6. To run the project use `php artisan serve` in terminal.
7. If you want to get random database instances, you can use command `php artisan db:seed`, this will fill the database with 100 random examples

## Demonstration
