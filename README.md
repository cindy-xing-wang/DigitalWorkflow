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
![Open the project with VS code](\img\12-2.PNG)
*Open the project with VS code*

Run npm install && npm run dev **TWICE** to get the authentication UI scaffolding built properly.

```
# bash
npm install && npm run dev
```

### Change home page to login page

## License

The Digital Workflow is open-sourced project licensed under the [MIT license](https://opensource.org/licenses/MIT).
