#!/bin/bash
echo Имя сайта без домена, например mysite
read sitename
echo Домен сайта, например .ru
read domain

cd /var/www
mkdir $sitename
chmod 775 /var/www/$sitename
chown weblifeon:www-data /var/www/$sitename

cd /etc/apache2/sites-available

echo "<VirtualHost *:80>">$sitename.conf
echo "ServerName $sitename$domain">>$sitename.conf
echo "DocumentRoot /var/www/$sitename">>$sitename.conf
echo "ErrorLog ${APACHE_LOG_DIR}/error.log">>$sitename.conf
echo "CustomLog ${APACHE_LOG_DIR}/access.log combined">>$sitename.conf
echo "<Directory /var/www/$sitename>">>$sitename.conf
echo "Options Indexes FollowSymLinks MultiViews">>$sitename.conf
echo "AllowOverride All">>$sitename.conf
echo "Require all granted">>$sitename.conf
echo "</Directory>">>$sitename.conf
echo "</VirtualHost>">>$sitename.conf

echo "192.168.0.100 $sitename$domain">>/etc/hosts
a2ensite $sitename.conf
service apache2 restart

curl -Is $sitename$domain | head -1