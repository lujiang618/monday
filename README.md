> 一个laravel的代码库

# 第三方包
## 1.[Xethron/migrations-generator](https://github.com/Xethron/migrations-generator)从数据库生成migrations

```
composer require Xethron/migrations-generator
php artisan migrate:generate db_connections,model_has_permissions,model_has_roles,permissions,project_db,project_projects,project_users,role_has_permissions,roles,sys_sql_order_log
```

## 2.[guzzle](https://www.baidu.com/link?url=QmXISIs5bhAb-jAyQfqv7Owa1M92gy1Q5k7O3phD8TtEf0tCY-ovSx9JTX0lTUSZ&wd=&eqid=9d5bc9020008b0c5000000025b850fde),[github](https://github.com/guzzle/guzzle)

```
composer require guzzlehttp/guzzle
```

## 3.[barryvdh/laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper)
```
Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,  

composer require barryvdh/laravel-ide-helper
php artisan clear-compiled
php artisan optimize
php artisan ide-helper:generate  
```

## 4.[barryvdh/laravel-debugba](https://github.com/barryvdh/laravel-debugbar)
```
Barryvdh\Debugbar\ServiceProvider::class,

composer require barryvdh/laravel-debugbar --dev
php artisan vendor:publish
```

## 5.[reliese/laravel](https://github.com/reliese/laravel) 自动生成model

```
composer require reliese/laravel --dev
php artisan vendor:publish --tag=reliese-models
php artisan config:clear
php artisan code:models

```


## 6. [mews/captcha](https://github.com/mewebstudio/captcha) 图片验证码
```
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
composer --version


composer require mews/captcha
php artisan vendor:publish
```

## 7.[monolog](https://github.com/Seldaek/monolog) 很不错的log扩展
```
composer require monolog/monolog
```

## 8.[predis/predis](https://github.com/nrk/predis)
```
composer require predis/predis
```

## 9.[overtrue/laravel-wechat](https://github.com/overtrue/laravel-wechat)[官网](https://easywechat.com/)
```
composer require overtrue/laravel-wechat
```

## 10.[jormin/laravel-ddoc](https://github.com/jormin/laravel-ddoc)
```
composer require jormin/laravel-ddoc

php artisan vendor:publish
```

## 11.[squizlabs/php_codesniffer](https://github.com/squizlabs/PHP_CodeSniffer)
```
composer require 'squizlabs/php_codesniffer=*'
```

## 12.[ramsey/uuid]()
对于程序的安全性来说，使用uuid作为主键要比自增好很多
```
composer require ramsey/uuid
```
