Тестовое задание на основе Yii2 на позицию PHP-разработчика
-----------------------------------------------------------

### Техническое задание

Требуется создать каталог книг с указанием их авторов (1 книга может быть
написана несколькими авторами и наоборот).    
В каталоге должен присутствовать следующий функционал: 

1. Реализовать необходимые сущности;
2. Реализовать административную часть приложения с авторизацией:
    * `CRUD` операции для авторов и книг;
    * вывести список книг с указанием авторов;
    * вывести список авторов с указанием кол-ва книг.
3. Реализовать публичную часть сайта с отображение авторов и их книг;
4. Реализовать возможность работы с данными через `RESTful API` в формате `JSON`:
    * получение списка со всеми записями;
    * получение по `ID` данных конкретной записи;
    * добавление новых записей;
    * обновление существующих записей;
    * удаление существующих записей;
    * получение списка записей со связанными данными (книг с именами авторов, и авторов с их книгами).
    
Результат предоставить ссылкой на репозиторий.

### Технические требования

Для работы приложения потребуется следующая конфигурация ПО веб-сервера:
1. Apache 2.4.10 + модули:
   * rewrite;
   * php5.
2. PHP 5.4.0 + модули:
   * pdo;
   * pdo_sqlite.
3. SQLite 3.25.3;
   * Расположен локально в директории проекта - `data/`, 
   дополнительных настроек не требует. 
4. Виртуальный хост, настроенный примерно следующим образом (хост должен указывать не на корневую директорию проекта, а на расположенную в ней папку `web/`):
```
<VirtualHost *:80>
    ServerAdmin yudaev.d@gmail.com
    ServerName virtual_host_name

    DocumentRoot /catalog/web
    <Directory /catalog/web>
        Options FollowSymLinks
        AllowOverride All
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/virtual_host_name-error.log
    CustomLog ${APACHE_LOG_DIR}/virtual_host_name-access.log combined
</VirtualHost>
```

### Описание приложения

В рамках тестового задания было реализовано небольшое веб-приложение на базе Yii2 (basic), и размещено на GitHub'е:  
[ссылка на репозиторий](https://github.com/Hardcoder-Beast/catalog),  
[ссылка на скачивание ZIP-архива](https://github.com/Hardcoder-Beast/catalog/archive/master.zip).  

После загрузки проекта из репозитория, например командой git clone:
```
git clone https://github.com/Hardcoder-Beast/catalog.git
```
Необходимо будет предоставить полный доступ на чтение и запись для временных файлов следующими командами:
```
chmod -Rf 0777 catalog/data
chmod -Rf 0777 catalog/web/assets
chmod -Rf 0777 catalog/runtime
```

После чего приложение должно запуститься.

#### Входные точки приложения
**1. Публичная часть**
 - Основная страница: `http://virtual_host_name`

**2. Административная панель**
 - Страница авторизации: `http://virtual_host_name/site/login`
 - Логин: `admin`
 - Пароль: `admin`

#### RESTful API

1. Получение списка данных в формате `JSON`:  
  `GET, HEAD` /api/rest-books  
  `GET, HEAD` /api/author-books  

2. Получение списка записей со связанными данными:  
  `GET` /api/rest-books/catalog  
  `GET` /api/author-books/catalog  
  
3. Получение данных конкретной записи по `ID`:  
  `GET` /api/rest-books/{ID}  
  `GET` /api/author-books/{ID}  

4. Добавление записи (обязательные параметры - author_name/book_name ):  
  `POST` /api/rest-books  
  `POST` /api/author-books  

5. Обновление записи (обязательные параметры - author_name/book_name ):  
  `PATCH` /api/rest-books/{ID}  
  `PATCH` /api/author-books/{ID}  

6. Удаление конкретной записи по `ID`:  
  `DELETE` /api/rest-books/{ID}  
  `DELETE` /api/author-books/{ID}  


<a href="mailto:yudaev.d@gmail.com">Юдаев Денис</a> @ 2018