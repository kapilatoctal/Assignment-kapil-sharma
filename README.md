1. download zip or clone project from reposetory.

2. after extract/clone install all dependencies through composer by running command "composer update" inside the root directory of the project.

3. after composer dependencies we should have install npm  via running command "npm i" or "npm install";

4. now its time to copy env.example file to .env file and update database details like DB name, App Name (DB name must required);

5. now we need migrate our migration files to create tables into database also we need to fill the database through our seeders so this both command we can run through one command 

   "php artisan migrate --seed" for first time or if you want to resetup project just call "php artisan migrate:refresh --seed"
 
6. our data has been filled in our db tables so now we can intract with our blog application through our Blog-Api-Collection which will be stored in Api-Collection folder in root directory which can be imported in POSTMAN.

7. we have three kind of roles here 
	
	a. Admin (Has All permissions)
	
		email : Admin@admin.com
		pass  : secret@1
	
	b. Author (Can play with Posts, Create,Read,Update,Delete)
		
		email : editor@author.com
		pass  : Author@1
	
	c. User (Can only read posts)
		
		email : normal@user.com
		pass  : Normal@1
		
	For auth used JWT-Auth;
