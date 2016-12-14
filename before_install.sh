#!/bin/bash
yum -y install php70
service httpd start
mkdir /var/www/html/bzbackup
cd /var/www/html
chmod 755 -R bzbackup
chown apache:apache -R bzbackup
yum -y install mysql-server
service mysqld start
yum -y install php php-mysql
yum -y install php56-intl
yum -y install php56-curl
yum -y install php56-cli
