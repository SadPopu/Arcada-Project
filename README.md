### How do I run this Project ###
* Get it from the [Repository](https://github.com/SadPopu/Arcada-Project)

### How do I get set up? ###

* [Install PHP](https://windows.php.net/index.php)
* [Install Composer](https://getcomposer.org)  
* [Insall MySQL](https://dev.mysql.com/downloads/installer/) or [Install XAMPP](https://sourceforge.net/projects/xampp/) (You will need to create a Database so the application can run without any errors)

### How do I start the application
* - Run the following cmd in the main directory:
* - composer install
* cp .env.example .env
* Before the next step you will have to change lines 11 to 16 in .env file with your database info.
* - php artisan key:generate
* - php artisan migrate --seed
* - php artisan serve

### This Application was created to serve as API to the CRUD application, you can get it [here](https://github.com/SadPopu/Arcada-Project-React-Js-Crud) ###
