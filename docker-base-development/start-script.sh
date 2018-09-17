#!/bin/bash

## Check if network already exists, otherwise create it
[ ! "$(docker network ls | grep simplestreamdev)" ] && docker network create simplestreamdev

## Check if docker nginx is running
[ "$(docker ps | grep nginx-proxy)" ] && docker stop nginx-proxy
## Check if docker nginx exists but it's stopped
[ "$(docker ps -a | grep nginx-proxy)" ] && [ ! "$(docker ps | grep nginx-proxy)" ] && docker rm nginx-proxy
## Launch Nginx proxy
[ ! "$(docker ps -a | grep nginx-proxy)" ] && docker run --name=nginx-proxy -d -p 80:80 -p 443:443 -v $PWD/ssl:/etc/nginx/certs  -v /var/run/docker.sock:/tmp/docker.sock:ro --network=simplestreamdev jwilder/nginx-proxy

## Check if mysql is running
[ "$(docker ps -a | grep mysql-ssdev)" ] && docker stop mysql-ssdev
## Check if docker mysql exists but it's stopped
[ "$(docker ps -a | grep mysql-ssdev)" ] && [ ! "$(docker ps | grep mysql-ssdev)" ] && docker rm mysql-ssdev
## Check if docker mysql exists and if directory mysql/data exists
[ ! "$(docker ps -a | grep mysql-ssdev)" ] && [ -d "./mysql/data/" ] && docker run --name=mysql-ssdev -d -p 3306:3306 -e MYSQL_ROOT_PASSWORD=password -v $PWD/mysql/data:/var/lib/mysql --network=simplestreamdev mysql:5.6
## If directory doesn't exist then seed the db
[ ! "$(docker ps -a | grep mysql-ssdev)" ] && [ ! -d "./mysql/data/" ] && mkdir ./mysql/data && docker run --name=mysql-ssdev -d -p 3306:3306 -e MYSQL_ROOT_PASSWORD=password -v $PWD/mysql/data:/var/lib/mysql -v $PWD/mysql/seed:/docker-entrypoint-initdb.d --network=simplestreamdev mysql:5.6

## Mongo DB Integration
[ "$(docker ps -a | grep mongodbdev)" ] && docker stop mongodbdev
[ "$(docker ps -a | grep mongodbdev)" ] && [ ! "$(docker ps | grep mongodbdev)" ] && docker rm mongodbdev
docker run -d -p 27017:27017 --network=simplestreamdev --name=mongodbdev -v $PWD/mongo/data:/data/db -e MONGO_INITDB_ROOT_USERNAME=root -e MONGO_INITDB_ROOT_PASSWORD=password mongo