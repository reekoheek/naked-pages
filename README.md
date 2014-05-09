naked-pages
===========

Default page for NGINX index, 404 page

if you use Apache, create .htaccess file at your www directory

```
DirectoryIndex index.php index.html /naked-pages/index.php

```



Assuming you have access, go to your server's enabled site location. I run a Debian server for development, and the default site setup is at /etc/apache2/sites-available/default for Debian / Ubuntu. Not sure what server you run, but just search for "sites-available" and go into the "default" document. In there you will see an entry for Directory. Modify it to look like this:

```
<Directory /var/www/>
    Options Indexes FollowSymLinks MultiViews
    AllowOverride None
    Order allow,deny
    allow from all
</Directory>
```


Then reload and restart your apache server. Again, not sure about your server, but the command on Debian / Ubuntu is:

sudo services apache2 reload && sudo services apache2 restart
Technically you only need to reload, but I restart just because I feel safer with a full refresh like that.
