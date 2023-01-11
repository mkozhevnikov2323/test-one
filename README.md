# Тестовый проект PHP
* Для работы с проектом нужно его развернуть локально.
* Далее импортировать дамп в свою БД, дамп в ./sql.
* Также необходимо создать файл 'config.php' в корне проекта, где прописать:

`<?php
const HOSTNAME = 'your_host';
const DB_USERNAME = 'your_db_username';
const DB_NAME = 'gootax_test';
const DB_PASSWORD = 'your_db_password';`

Стартовая страница: http://localhost/test-one/pages/login.php