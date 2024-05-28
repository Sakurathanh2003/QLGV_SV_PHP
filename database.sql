create database qlsv;
use qlsv;

create TABLE if not exists Account(
    id int(11) not null AUTO_INCREMENT primary key,
    name longtext not null,
    email longtext not null,
    password longtext not null,
    role longtext not null
);

-- pass: Admin123@
insert into Account(name, email, password, role) values ("Thanh", "admin@gmail.com", "b39abbe763440b02c231b2653ebd9da3ea78dcb1", "admin");

create table if not exists Teacher(
    id int(11) not null AUTO_INCREMENT primary key,
    name longtext not null,
    email longtext not null,
    gender boolean not null,
    address longtext not null,
    phoneNumber varchar(15) not null,
    birthday date not null
);

create table if not exists Student(
    id int(11) not null AUTO_INCREMENT primary key,
    name longtext not null,
    gender boolean not null,
    email longtext not null,
    address longtext not null,
    phoneNumber varchar(15) not null,
    birthday date not null
);

create table if not exists Class(
    id int(11) not null AUTO_INCREMENT primary key,
    name longtext not null,
    teacherID int(11) not null
);

create table if not exists ClassDetail(
    id int(11) not null AUTO_INCREMENT primary key,
    classID int(11) not null,
    teacherID int(11) not null,
    studentID int(11) not null
);