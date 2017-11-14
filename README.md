KOPAJ 2017

Installation:
1. Install xampp: https://www.apachefriends.org/download.html
	-By default on Windows, your webroot is: 'C:\xampp\htdcos'. 

2. Install composer. 

3. Create a folder (if xampp is installed with defaults) at C:\xampp\htdocs\ named 'kopajgyakorlas'

4. Clone into that folder: https://github.com/tamaskelemen/kopajgyakorlas.git
So now your project path is C:\xampp\htdocs\kopajgyakorlas. Web directory: 'C:\xampp\htdocs\kopajgyakorlas\web'

5. go to 'localhost/phpmyadmin', create a new empty database with name 'szintadmin'.

6. open a console, navigate into Cyour project folder. run these:
composer global require "fxp/composer-asset-plugin:^1.3.1"

composer update

yiic migrate
(when promted, say yes). 

that's it!
You can now login with a basic admin email: 'admin@admin.com' password: 'asdasd'. 
He has no pages. 
When listed all users or pages, you can even search or order them by clicking on the column name, or typing in the box above the column.

	