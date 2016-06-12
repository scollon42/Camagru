# Camagru

PHP project with MVC structure and without any framework or templates.

### Install it :

`$> git clone https://github.com/scollon42/Camagru`

> You need an Apache server with MySQL

You can change your config in config/database.php
and lunch in console
`$> php setup.php`

> You can now access to Camagru.

### "What can I do if... ?" :

* Server Error 500 on the root page or any other page
      * You need to set the `AllowOveride` point to `All` instead of `None` in your Apache conf file
