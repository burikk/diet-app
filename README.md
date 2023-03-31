## Symfony Backend Boilerplate
* PHP 8.2.3
* Symfony 5.4
* MySQL 8.0
* Nginx 1.23.3-alpine

1) After cloning repo put environmental variables into **.env** (you need to create this file) as in **.env.example**
2) `docker compose up -d` to build and run up containers
3) There are several packages additionally added to regular skeleton symfony project u can explore in **composer.json**
4) After installation check permissions on **var** folder. They should be as your `UID` user and `GID` usergroup.
If they are not, just enter `sudo chown -R YOURUSER:YOURGROUP var` outside the PHP container