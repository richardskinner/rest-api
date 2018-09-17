#!/bin/bash
[ "$(docker ps | grep nginx-proxy)" ] && docker stop nginx-proxy
[ "$(docker ps -a | grep nginx-proxy)" ] && docker rm nginx-proxy
[ "$(docker ps | grep mysql-ssdev)" ] && docker stop mysql-ssdev
[ "$(docker ps -a | grep mysql-ssdev)" ] && docker rm mysql-ssdev
[ "$(docker ps | grep mongodbdev)" ] && docker stop mongodbdev
[ "$(docker ps -a | grep mongodbdev)" ] && docker rm mongodbdev
[ "$(docker ps | grep mongoclientdev)" ] && docker stop mongoclientdev
[ "$(docker ps -a | grep mongoclientdev)" ] && docker rm mongoclientdev
#[ "$(docker network ls | grep simplestreamdev)" ] && docker network remove simplestreamdev