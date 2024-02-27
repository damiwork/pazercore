## PazerCore
```
PHP Version [>= PHP7.4]
```

#.htaccess
```
RewriteEngine on
RewriteRule ^(.*)$ demo_route/index.php?q=$1 [L,QSA]
```
