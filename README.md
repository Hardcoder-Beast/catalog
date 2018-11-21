<p align="center">
    <h1 align="center">Тестовое задание для PHP-разработчика.</h1>
    <br>
</p>

### Входные точки приложения:

**Вход в админку (URL, login, password):**

http://localhost/index.php/site/login

admin

admin

**Публичная часть:**

http://localhost/index.php

### Особенности
Приложение не используеn mod_rewrite и .htacces

**RESTful API:**

Реализовал выдачу данных в формате json по RESTful (GET):
  http://localhost/index.php/rest/author
  http://localhost/index.php/rest/book

a. получение списка книг с именем автора (GET):
  http://localhost/index.php/rest/author/catalog
  http://localhost/index.php/rest/book/catalog

b. получение данных книги по id (GET):
  http://localhost/index.php/rest/author/view?id=1
  http://localhost/index.php/rest/book/view?id=1

c. добавление книги (POST, обязательный параметр - author_name/book_name ):
  http://localhost/index.php/rest/author/create
  http://localhost/index.php/rest/book/create

d. обновление данных книги (POST, обязательный параметр - author_name/book_name ):
  http://localhost/index.php/rest/author/update?id=46
  http://localhost/index.php/rest/book/update?id=46

e. удаление записи книги из БД (DELETE):
  http://localhost/index.php/rest/author/delete?id=5
  http://localhost/index.php/rest/book/delete?id=5
