<?php
function connect() {
    $hostname = 'localhost'; //apache_getenv('host');
    $username = 'root';
    $password = 'Ms_0289!';
    $database = 'test-one-gootax';

    try {
        return new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    } catch (PDOException $e) {
        die('Нет подключения к базе данных. Ошибка - ' . $e->getMessage());
    }
}

//функция для запросов поиска (SELECT)
function query($sql, $params = []): array
{
    $sth = connect();
    $sth = $sth->prepare($sql); //Подготавливает запрос к выполнению и возвращает связанный с этим запросом объект
    $sth->execute($params); //Запускает подготовленный запрос на выполнение
    $result = $sth->fetchAll(PDO::FETCH_ASSOC); //Возвращает массив, содержащий все строки результирующего набора

    if (!$result) return [];
    return $result;
}

//метод для добавления, удаления, изменения данных, если успешно то возвратит 1
//INSERT, UPDATE, DELETE
function make($sql, $params = []): bool
{
    $sth = connect();
    $sth = $sth->prepare($sql); //Подготавливает запрос к выполнению и возвращает связанный с этим запросом объект
    return $sth->execute($params); //Запускает подготовленный запрос на выполнение
}