create database WhatIsNext_PhpGradProj;
drop table if exists users;
create table users
(
    id int primary key auto_increment,
    name varchar(256),
    email varchar(256),
    password varchar(256),
);

drop table if exists profileImages;
create table profileImages
(
    id int primary key auto_increment,
    user int,
    image mediumblob
);