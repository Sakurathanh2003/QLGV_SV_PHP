create database qlsv;
use qlsv;

create TABLE if not exists Account {
    id int(11) not null AUTO_INCREMENT primary key,
    name longtext not null,
    email longtext not null,
    password longtext not null,
    role longtext not null
};




