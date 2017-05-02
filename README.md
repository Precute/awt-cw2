# awt-cw2 

## Author
Huseyin Arpalikli

## Objective 2 by Huseyin Arpalikli
To implement my solution to the required merchandise store, I had researched the internet and found a suitable tutorial which guided me through created a web store using AngularJS. After using the tutorial, I have used AJAX to retrieve and send JSON data to and from the database to be used in the store. As well as this, I have implemented the checkout processing using Paypal and have have set up a Sandbox paypal account to test payments. I have implemented post variable that send to Paypal so that items are shown in the paypal checkout, which then can be paid for; following payment, the Instant Payment Notification handler will retrieve the paypal transaction data and store them into the local website database, where admin users can view orders and the paypal transactions. I have also created extra elements of the web app, where admin users can view orders and the paypal transaction data as well as including the ability to add new products by using AJAX and PHP.
The following scenario shows how the the store works:
1. User enters store, views products, etc; then adds products to the shopping cart;
2. User views their shopping cart and either completes checkout or clears basket;
3. When checkout via paypal is initiated the product data is sent via HTTP POST to paypal AND simultaneously creates a new order record in the DB;
4. User completes paypal payment and is redirected back to the store; the IPN handler begins pulling paypal transaction data which is then stored in a transaction database table;
5. Order data can be viewed by admin where they can see whether a payment has been successful or not. 

*This is the link to the tutorial I have used and can be looked at to see the vast differences between my work and the original tutorial (https://www.codeproject.com/Articles/576246/A-Shopping-Cart-Application-Built-with-AngularJS)

## Link
http://mudfoot.doc.stu.mmu.ac.uk/students/arpalikh/AWT-CW2/shop.php
Log in Example NON-ADMIN Store User
Username: robin
Password: Robin1

Log in Example ADMIN Store User
Username: huseyin
Password: Huseyin1

Paypal CUSTOMER sandbox user FOR TESTING
Username: harpalikli-buyer@hotmail.com
Password: huseyin1

## Contributions and List of files
Pre-existing File by Robin Nest:
-	style.css
-	index,php
-	header.php - amended to add store link on nav bar as well as adding in restricted Admin areas to nav bar only accessible to specific users
-	function.php
-	javascript.js
-	checkuser.php
-	friends.php
-	login.php
-	logout,php
-	members.php
-	message.php
-	profile.php
-	setup.php
-	signup.php

File Added by Huseyin Arpalikli:
-	backend_addproducts.php - Code to insert a new product into the database and then return the last inserted id
-	backend_getorders.php - Code to return order and transaction data from the database and return the data in JSON format
-	backend_orders.php - Code to add new unprocessed order to the database and return the last inserted id in JSON format
-	backend_products.php - Retrieve all products from the database and return them in JSON format
-	connection.php - Database connection file to set up the PDO database connection (required in each 'backend' file)
-	img/products/*productid*.jpg - the uploaded image files for the corresponding item - the product id is used to link the images to each record
-	ipn.php - Instant Payment Notification handler file to handle payment notification responses from paypal
-	shop.php - View for angular webapp store
-	partials/addproduct.htm - HTML file containing the form to add new products
			/orders.htm - HTML file containing the table displaying orders and transactions
			/product.htm - HTML file containing table displaying a specific product in the store
			/shoppingCart.htm - HTML file containing the front end of the shopping cart in the angular web app
			/store.htm -  HTML file containing the front end of the store where items are displayed and where buttons are to add to basket, etc
			/transaction.htm - Page displaying a table for a selected paypal transaction
-	angular.min.js (on googleapis server) - Front end web application framework
-	js/app.js - Angular modules routing config and data service creation
	  /controller.js - Store controller containing the objects for the store, cart and orders
	  /order.js - JS Object for an order in the store
	  /orders.js - Uses AJAX to return all order data for use in the admin orders view
	  /product.js - JS Object for a product in the store
	  /shoppingCart.js - Contains various functions for the web app including; to set up the shopping cart, add items to cart, place an order using AJAX, get total item count, total item cost, cart clearing, and setting up the checkout so that paypal can be used
	  /store.js - contains AJAX to retireve all products from the database to be displated in the store and AJAX function to add product to the database.

-	README_HUSEYIN.md

## Built with 
-   AngularJS - front end web framework
-	Sublime text – text editor
-	Github 
-	MySQLWorkBench -  connects to the database 
-	MAMP and Mudfoot - web server


## Test Cases
1.	View product data by clicking on a product; View products page, use product search (the search is not strict and can find matching terms from 2 characters)
2.  Add items to basket and edit quantity from basket; clear basket
3. 	Add items to basket and complete checkout using paypal sandbox user stated above; from admin user check order admin for the completed order and transaction (transaction can take a few mins to be added to database due to Paypal IPN delay)
4. Do same as 3 but cancel order before completing transaction, you should be taken back to the store with an empty basket but the orders will display the order as 'No Transaction Processed'.
5. View admin order area and use search to find specific orders and click on transaction id to view transaction data.
6. Add a new product in the admin area and check the product has been added to the database (therefore the store) (unsure, but might be an issue with image upload?)

The web app is currently connected to Ahmar's Mudfoot MySQL database as we felt it was easier to do it all via one database instead of mutiple. 



