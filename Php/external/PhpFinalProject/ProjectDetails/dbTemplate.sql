create database WhatIsNext_PhpGradProj;
drop table if exists users;
create table users
(
    id int primary key auto_increment,
    name varchar(256),
    email varchar(256),
    password varchar(256),
    active int default 1
);

drop table if exists profileImages;
create table profileImages
(
    id int primary key auto_increment,
    user int,
    image mediumblob
);

-- nextsTypes : text ,image ,video
drop table if exists nextsTypes;
create table nextsTypes(
id int primary key AUTO_INCREMENT,
type varchar(256)
);
insert into nextsTypes (type) values ("text"),("image"),("video");
"""
explaintation
user -> create nexts -> 
id   : nextsId 
user : NextSownerId
type : NextSType

fetchs data by type with id of nexts;
in select query , first gets nextS id and type
then routes query to target class with selected type
"""
drop table if exists nexts;
create table nexts (
id int primary key AUTO_INCREMENT,
user int,
type int not null default 1
);

drop table if exists n_Text;
create table n_Text(
id int primary key AUTO_INCREMENT,
nextId int,
title varchar(128),
content varchar(500)
);

drop table if exists n_Image;
create table n_Image(
id int primary key AUTO_INCREMENT,
nextId int,
image mediumblob,
descr varchar(500)
);

drop table if exists n_Video;
create table n_Video(
id int primary key AUTO_INCREMENT,
nextId int,
video mediumblob,
descr varchar(500)
);

-- TODO:change -> del from src:nexts to del from src:n_text 
-- because it causing to type issues
"""
so : if we delete Next from n_TYPE
trigger runs and gets nextId , then uses for remove NEXT from nexts table
so removing n_TYPE row is enough to remove NEXT
"""
create trigger bNextTextDelete
before delete on n_text
for each row
BEGIN
	delete from nexts where id=old.nextid;
    delete from n_c_text where nextid=old.nextid;
END;

drop table if exists n_categories;
create table n_categories(
id int primary key AUTO_INCREMENT,
nextId int,
category varchar(256)
);

