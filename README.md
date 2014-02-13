naked-pages
===========

Default index listing (not only) for NGINX, and some custom error pages ;) This is good choice for
someone who want a beauty yet light responsive web listing page. Or maybe **h5ai alternative**.

#Features
- Using our neat CSS framework - Naked! **(Private repo / Xinixman access only)**
- Responsive page
- Much more lighter than h5ai

#Proof of Concept
![PoC](https://github.com/krisanalfa/naked-pages/raw/master/poc/_nnn.png)

#Installation (Apache)
- Clone this repo to wherever you want
- From command line, go to inside `naked-pages` folder and do `bower install` from there
- Link the `naked-pages` to somewhere accessible by your web server (inside your www root directory).

```sh
ln -s /full/path/to/naked-pages /path/to/www/root/[custom-folder]

# for example
ln -s /home/xinixman/naked-pages /var/www/_nnn
```

- Open your httpd configuration, find something like this:

```
<IfModule dir_module>
    DirectoryIndex index.html index.php
</IfModule>
```

Based on example, you should change them to:

```
<IfModule dir_module>
    DirectoryIndex index.html index.php /_nnn
</IfModule>
```

If you want to enable your own error page, find (and edit) or add this line to your `httpd.conf`

```
# Based on example
ErrorDocument 404 /_nnn/404.php
ErrorDocument 403 /_nnn/403.php
```

#Configuration (Apache)
All config is only an array described in `config/config.php`. You can ignore listing your `naked-pages` directory
by tell the config where you install your `naked-pages`. There you can also ignoring the folder/file based on you
patterns, for example if you want to ignore `.DS_Store‎`, just add `.DS_Store‎` fo `fileExcludePatterns` entry.
Easy heh?

#Installation (NGINX)
To be defined later

#Configuration (NGINGX)
To be defined later
