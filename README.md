<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Установка

1. Скопировать .env     

```cp .env.example .env```

2. Установить пароль БД в переменную DB_PASSWORD
   
3. Запустить сборку контейнеров     

```make build```

4. Сгенерировать ключи приложения и JWT     

```
php artisan key:generate
php artisan jwt:secret
```

5. Запустить тесты ```make test```

# Комментарии

В качестве метода аутентификации я выбрал JWT, т.к. он безопасен, является stateless, 
и позволяет без проблем реализовывать распределенную аутентификацию.    

Для первичного ключа пользователя был выбран UUID v7 (хоть его спецификация не до конца принята) 
для работы с несколькими репликами.

По любым вопросам можно обращаться ко мне в телеграм (указан в email)
