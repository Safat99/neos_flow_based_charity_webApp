### PHP installation

```
sudo apt update && apt upgrade -y
sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt install php8.2
php -v
```
* composer install >> go to this link >> https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos


```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php --install-dir=bin --filename=composer
php -r "unlink('composer-setup.php');"
php bin/composer
```

### Create project
php bin/composer create-project --no-dev neos/flow-base-distribution Charity

got error:
fixed by this command >>
```
sudo apt-get update && sudo apt-get install php-xml -y
```

update>> 
* installed apache2
* ```bin/composer create-project --keep-vcs neos/flow-base-distribution Charity```

* error solved finally by >> 
https://discuss.neos.io/t/neos-install-problems-debian-12-php-8-2/6449/6

The following dependecines needed to be installed:
``` 
sudo apt install php8.2 php8.2-{common,mbstring,mysql,xml,imagick,curl,intl,igbinary}
```
*  to speed up needed to install >> 
`sudo apt-get install php8.2-curl`

## After installation
1. setting up Neos Flow:

```
./flow flow:core:setfilepermissions --chmod-web=www-data --chmod-cli=yourusername --chgrp-web=www-data --chgrp-cli=yourusername
```

2.  Run the setup command: 
```./flow flow:setup```

3. Run the Neos Flow Server:
```./flow server:run```,
then going to localhost:8081 in the web browser.

The latter instruction will be found on the browswer like how to create a package or something else.

'

### important 
***created kickstart package by running >
`./flow  kickstart:package SincNovation.Charity`***



important commands >> 
- ```./flow doctrine:update ```>> executed a database schema update
- ```./flow doctrine:migrate```
- ```./flow flow:cache:flush```

The custom CLI created command for the Application: 

- ```./flow organization:importfromsettings``` >> imports all the organization lists from **settngs.yaml** file to DB
- ```./flow donationcode:import /path/to/your/donationcodes.csv``` >> import codes from CSV to DB table
- ```./flow donationevaluation:evaluate``` >> custom commnad for evaluation the donation