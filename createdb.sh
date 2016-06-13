SQL=/opt/lampp/bin/mysql

$SQL -u root -e "CREATE DATABASE Boardlist DEFAULT CHARACTER SET utf8;"
$SQL -u root -e "CREATE TABLE Boardlist.board (user TEXT, date DATE, id INT NOT NULL AUTO_INCREMENT, name TEXT ,PRIMARY KEY(id));"
