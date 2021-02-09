# Planets
Add new planets and calculate dates based on terran time. This time using Nginx and PHP-FPM.

1. Problems and Goal
* Goal with this exercise was to learn more about Docker, enviroment variables and Dockerfile.
* My goal was to create this small CRUD app, where you can Add new planets giving Months and Day of the year and finally calculate the estimated day, month and year on the selected planet. However, I've only managed to calculate the estimated year based on the amount of days per year.
* I wanted to add my Symfony app as an git submodule, however it is not ready.

2. Docker
* Just pull and 'docker-compose up'
* It should create 3 containers: -MariaDB database -PHP-FPM with and Symfony 5 app -NGINX webserver
* It should run a doctrine migration automatically and create a 'symfony' database with 'planets' table, having 2 planets with some properties.