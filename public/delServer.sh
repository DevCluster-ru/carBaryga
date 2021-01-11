#!/bin/bash
echo Имя сайта без домена, например mysite
read sitename
echo Домен сайта, например .ru
read domain

a2dissite $sitename.conf
rmdir /var/www/$sitename
rm /etc/apache2/sites-available/$sitename.conf
service apache2 restart