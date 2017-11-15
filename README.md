KOPAJ 2017

Installation:
1. Install xampp: https://www.apachefriends.org/download.html
	-By default on Windows, your webroot is: 'C:\xampp\htdcos'. 

2. Install composer: https://getcomposer.org/download/

4. Navigate to folder 'C:\xampp\htdcos', (if installed with defaults). Clone this project: 
 https://github.com/tamaskelemen/kopajgyakorlas.git
So now your project path is C:\xampp\htdocs\kopajgyakorlas. Document root: 'C:\xampp\htdocs\kopajgyakorlas\web'

5. Open browser. Go to 'localhost/phpmyadmin', create a new empty database with name 'szintadmin'.

6. open a console, navigate into your project folder. run these:
'composer global require "fxp/composer-asset-plugin:^1.3.1"'

'composer update'

'yii migrate'
(when promted, say yes). 

that's it!
For the first user, you can create one at 'localhost/site/register'.
You  will be able to login with that user

When listed all users or pages, you can even search or order them by clicking on the column name, or typing in the box above the column. 
Accesscontrol also implemented, e.g. you cant delete some user or create a user without login by typing the url 'localhost/user/create' etc.

	