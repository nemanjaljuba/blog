## Symfony install

    $ cd /var/www/html
    $ composer create-project symfony/skeleton:4.0.5 blog

    $ composer install
    $ composer require symfony/orm-pack
    $ composer require annotations
    $ composer require validator
    $ composer require template
    $ composer require security-bundle
    $ composer require --dev maker-bundle

## Set onwer and permissions for cache and log:

    $ HTTPDUSER=`ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
    $ sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var
    $ sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var

## Setup database

    root folder .env
    $ bin/console doctrine:database:create

## Push project to gitHub

    $ cd /var/www/html/blog
    $ git init
    $ git add .
    $ git commit -m "first commit"
    $ git remote add origin https://guthub.com/nemanjaljuba/blog.git
    $ git push -u origin master

## Clone project from gitHub

    $ git clone https://guthub.com/nemanjaljuba/blog.git

## git tools

    $ sudo apt-get install git-gui
    $ sudo apt-get install gitk

## Virtual host apache2

    $ apt-get update
    $ apt-get install apache2 -y
    $ cd /etc/apache2/sites-available/
    $ a2dissite 000-default
    $ service apache2 reload
    $ a2enmod rewrite
    $ service apache2 restart
    $ touch crvfakeexample.com.conf
    $ vim crvfakeexample.com.conf

    <VirtualHost *:80>
    ServerName blog.com
    ServerAlias www.blog.com

    DocumentRoot /var/www/html/blog/public
    <Directory /var/www/html/blog/public>
        AllowOverride None
        Require all granted
        Allow from All

        <IfModule mod_rewrite.c>
            Options -MultiViews
            RewriteEngine On
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteRule ^(.*)$ index.php [QSA,L]
        </IfModule>
    </Directory>

    # uncomment the following lines if you install assets as symlinks
    # or run into problems when compiling LESS/Sass/CoffeeScript assets
    # <Directory /var/www/crvfakeexample.com>
    #     Options FollowSymlinks
    # </Directory>

    # optionally disable the RewriteEngine for the asset directories
    # which will allow apache to simply reply with a 404 when files are
    # not found instead of passing the request into the full symfony stack
    <Directory /var/www/html/blog/public/bundles>
        <IfModule mod_rewrite.c>
            RewriteEngine Off
        </IfModule>
    </Directory>
    ErrorLog /var/log/apache2/blog_error.log
    CustomLog /var/log/apache2/blog_access.log combined

    # optionally set the value of the environment variables used in the application
    #SetEnv APP_ENV prod
    #SetEnv APP_SECRET <app-secret-id>
    #SetEnv DATABASE_URL "mysql://db_user:db_pass@host:3306/db_name"
    </VirtualHost>

    $ a2ensite crvfakeexample.com.conf
    $ service apache2 reload
 
##### add following line in your /etc/hosts file
    127.0.0.1    blog.com

## npm and bootstrap

    $ composer require webpack-encore
    $ sudo apt-get install cmdtest
    $ sudo apt-get install npm
    $ sudo npm install --global yarn
    $ sudo yarn add sass-loader node-sass --dev
    $ sudo yarn run encore dev --watch
    $ sudo yarn add jquery --dev
    $ sudo yarn add bootstrap-sass --dev
