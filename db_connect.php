<?php

/** Database Bağlantısı */
try {

    $host = 'localhost';
    $dbname = '#DB_NAME#'; // sizin oluşturduğunuz veritabanı adı
    $user = 'root'; // sizin oluşturduğunuz veritabanı kullanıcısı
    $password = ''; // sizin oluşturduğunuz veritabanı kullanıcısı şifresi

    $data = new PDO("mysql:host=$host;dbname=$dbname; charset=utf8mb4;", "$user", "$password");

}catch(PDOException $mesaj){

    echo $mesaj -> getMessage();

}

?>