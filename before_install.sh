#!/bin/bash
yum -y install mysql-server
service mysqld start
yum -y install php php-mysql
yum -y install php56-intl
yum -y install php56-curl
yum -y install php56-cli