# Basic setup for docker
Install docker. You can download docker [here](https://www.docker.com/community-edition#/download) and follow the instructions.

## Start mysql and Nginx proxy
This script is going to launch nginx proxy that can be used to proxy access to
other applications on the port 80, and an instance of MySQL. To initiate MySQL with a dump. If you are not interested in seeding MySQL ignore step 1 and 2.
1) Copy MYSQL dump gzip in ./mysql/seed
2) If you want to reset the mysql database, delete the directory ./mysql/data Please note that deleting this directory, the database is going to be populated at startup and it takes long time.
3) run ```./start-script.sh``` to start the nginx proxy and mysql
4) Nginx is running on port 80 and 443 and Mysql on port 3306, be sure the two ports are not already used by some other application.

## Stop mysql and Nginx proxy
- run ```./stop-script.sh``` to stop and delete nginx and mysql. Please note that the database information is not going to be deleted. If you want to reset the database, delete the directory ./mysql/data

## Verify status container
- run ```docker ps``` to see what container is running.
- run ```docker logs [container_name]``` to see the log of the container for possible errors.

## Access to MySQL
You can access to MySQl from your local machine using "localhost" as host, or use mysql-ssdev has hostname when you access from your application.

- username: root
- password: password
- hostname: localhost (if you access directly from your machine) or mysql-ssdev (if you access from your application running in docker)
