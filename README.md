# Short Link

## Requirements
Web Server with PHP 7.x

## Install
```
cd /www/wwwroot/example.com
git clone https://github.com/WooMai/ShortLink tmp
mv tmp/.git .
rm -rf tmp
git reset --hard HEAD
composer install
cp config/config.example.php config/config.php
vi config/config.php
```
修改站点配置，将运行目录设置为public<br>
设置伪静态规则如下
```
location / {  
	try_files $uri $uri/ /index.php$is_args$query_string;  
}
```
以上
