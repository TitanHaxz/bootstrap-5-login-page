<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";       // Mysql şifreniz varsa doldurun, yoksa boş bırakın.
    $database = "logreg"; // Mysql database isminiz.

    // Bağlantı Oluşturma - Diğer dosyalarda kolay mysql bağlantısı yapma.

    // Diğer dosyalarda `$conn` ile db bağlantısı sağlanabilir.
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Bağlantı sırasında hata oluşursa
    if(!$conn){
        die("Error". mysqli_connect_error());
    }