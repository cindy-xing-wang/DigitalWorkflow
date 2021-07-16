# Digital Workflow

This is a full-stack web app using Laravel8, MySQL. I used MVC architecture to build this project. The Laravel UI will handle the authentication feature and I used a theme kit for the UI mockup. The main features of this app are role, checklist management, creating a new operation, calendars, health and safety reporting. The demo project is deployed on Heroku. Feel free to log in as admin/sub-admin/staff to have a look at [the app](http://digitalworkflow.herokuapp.com/)(Quick Login provided).

The documentation will demonstrate how I built and deployed this app.

## Background

One use case for this project is a commercial drone company wants to rent their products to different airports and they need to provide a standard procedure for the users flying a drone by filling a form and a pre-flight checklist. The form includes some basic information (the weather, drone model, pilot name, etc.) for each flight. The checklist provides some standard instructions for checking the drone before anyone can operate it. The main purpose of this project is enabling the company to manage the workflow of operating the drone. Those form and checklist will be saved into a database for later when people need to trace back to see what happened during that operation.

## The design process

Before I dive into the details, I will talk about the main logic. I will create a Laravel app skeleton and connect with database (MySQL). I used XAMMP as it is widely used for PHP projects. For each feature, I will create Models and migrations. After migrating the models into database, we will have the tables created. Then, I will create controllers and views. Repeat the same process for the next feature. It is a long way to go, please be patient.
Let’s start now!

### Create a new Laravel Project

Create a new Laravel Project in htdocs folder.

```
# bash
laravel new DigitalWorkflow
```
![Open the project with VS code](/img/12-2.openProjectVScode.PNG)
*Open the project with VS code*

Update configuration and enviroment files

![Initial settings](/img/12-3.initSetting.PNG)
*Initial settings-1*

![Initial settings](/img/12-4.env.PNG)
*Initial settings-2*

![Initial settings](/img/12-5.timezone.PNG)
*Initial settings-3*

Connect with Database
![Connect with Database](/img/12-6.dbSetting.PNG)
*Connect with Database*

Create a Database
![Create with Database](/img/12-7.createDB.PNG)
*Create with Database*

Require laravel/ui, bootstrap auth for authentication function
![Require laravel/ui](/img/12-8-1.instalUI.PNG)
*Require laravel/ui*

![Require bootatrap auth](/img/12-8-2.instalUI.PNG)
*Require bootatrap auth*

Run npm install && npm run dev **TWICE** to get the authentication UI scaffolding built properly.

```
# bash
npm install && npm run dev
```

Go to the browser to check it out!
![localhost](/img/12-9-1.localhost.PNG)  

*The web is working on localhost-1*

![localhost](/img/12-9-2.localhost.PNG)
*The web is working on localhost-2*

### Change home page to login page
Update the web.php file. Change the home page to login page.
![web.php](/img/12-10-1.routelogin.PNG)

*Update web.php*

![web.php](/img/12-10-2.routelogin.PNG)
*Update web.php*

Refresh the browser again and you should see the login page is set as the home page.
![login](/img/12-10-3.routelogin.PNG)
*Login page*

### Migrations
Even though Laravel UI provides the basic authentication function, we still need to change the code a little bit to make it suit our case. I will start from user’s migration file.

Go to the database/migrations folder and update the users table as below
![user](/img/12-11-1.userMigration.PNG)
*Update the users table*

Run migration

```
# bash
php artisan migrate
```

![migration](/img/12-11-2.userMigration.PNG)
*Run migration*

After running migration, we should see the users table being created in the database.
![Users table](/img/12-11-3.userMigration.PNG)

*Users table-1*

![Users table](/img/12-11-4.userMigration.PNG)
*Users table-2*

### Create a Role Model
Now, we can continue on create more models.
Create the Role Model first.

```
# bash
php artisan make:model Role -m
```

![Roles table](/img/12-11-5.userMigration.PNG)
*Create a Role Model-1*

When adding the "-m" tag, the command will create a migration at the same time.

Go to the roles migration file in database/migrations folder to update the file as below.
![Roles table](/img/12-11-6.userMigration.PNG)
*Create a Role Model-2*

Run migration as we did before and the roles table is created in the database.
![Roles table](/img/12-11-7.userMigration.PNG)

*Create a Role Model-3*

### Seeding the data into roles table
Let's seed some data into the roles table. There are 3 roles in the app: admin, sub-admin, and staff role.

We can create the Role.php file first in the database/seeders folder.


```
# bash
php artisan make:seeder Role
```

![Roles table](/img/12-11-8.userMigration.PNG)
*Create a Role.php file-1*

![Roles table](/img/12-11-9.userMigration.PNG)

*Create a Role.php file-2*

Update the Role.php file as below and run seeding command. The data will be seeded into roles table.

```
# bash
php artisan db:seed --class Role
```

![Roles table](/img/12-11-10.userMigration.PNG)
*Create a Role Model-3*


![Roles table](/img/12-11-11.userMigration.PNG)

*Create a Role Model-3*

### Create the relationship between users and roles
We need to update the users migration file to add the relationship between users and roles. Every user is going to have only one role.

```
# bash
php artisan make:migration add_role_to_users_table --table=users
```

![Users table](/img/12-11-12.userMigration.PNG)
*Create the relationship between users and roles*

![Users table](/img/12-11-13.userMigration.PNG)
*Create the relationship between users and roles*

### Create the Airport Model and migration file
The process is the same as we created roles table before. We also need to add the relationship between users and airpots.The user now have a role_id, and an airport_id to define where the user comes from and what permissions the user can have.

![Users table](/img/12-11-14.userMigration.PNG)
*Create the relationship between users and airports*

### Seeding sample users to the users table
We need some sample users to be able to login to the web at the beginning as the registration function is not required by the client.

![Users table](/img/12-11-15.userMigration.PNG)
*Seeding the sample users*
Remember to import Hash to the seeders/User.php file.

Now, we can try to  login the sample users.

![Users table](/img/12-11-16.userMigration.PNG)
*Login as an admin role*

![Users table](/img/12-11-17.userMigration.PNG)
*Login as an admin role*

### Controllers and Views
It is time to work on the controllers and views.

Add the files to resources/views/admin/layouts folder.

The master.blade.php looks like this.
![master.php file](/img/12-12.master.PNG)
*master.php file*

![Add StaffController to the route](/img/12-13-1.staffController.PNG)
*Add StaffController to the route*

![create a middleware](/img/12-14.middleware.PNG)
*Create a middleware*

## License

The Digital Workflow is open-sourced project licensed under the [MIT license](https://opensource.org/licenses/MIT).
