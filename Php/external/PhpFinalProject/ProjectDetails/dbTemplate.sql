create database WhatIsNext_PhpGradProj;

drop table if exists users;
create table users
(
    id int primary key auto_increment,
    token varchar(256) default UPPER(UUID()),
    name varchar(256),
    email varchar(256),
    password varchar(256),
    active int default 1
);
insert into users (name,email,password) values ("admin","admin@admin.admin","nimda");
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
/*
explaintation
user -> create nexts -> 
id   : nextsId 
user : NextSownerId
type : NextSType

fetchs data by type with id of nexts;
in select query , first gets nextS id and type
then routes query to target class with selected type
*/
drop table if exists nexts;
create table nexts (
id int primary key AUTO_INCREMENT,
user int,
type int not null default 1,
date datetime not null default current_timestamp
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
title varchar(64),
descr varchar(500)
);

-- saving videos to server side by their ID s
drop table if exists n_Video;
create table n_Video(
id int primary key AUTO_INCREMENT,
nextId int,
title varchar(128),
descr varchar(500)
);

/*
------- followers system
*/

drop table if exists follows;
create table follows(
id int primary key AUTO_INCREMENT,
user int,
follow int
);


-- drop table if exists n_categories;
-- create table n_categories(
-- id int primary key AUTO_INCREMENT,
-- nextId int,
-- category varchar(256)
-- );
/*

----------- TRIGGERS

*/
drop trigger if exists bNextTextDelete;
DELIMITER $
create trigger bNextTextDelete
before delete on n_text
for each row
BEGIN
	delete from nexts where id=old.nextid;
END
DELIMITER ;

drop trigger if exists bNextImageDelete;
DELIMITER $
create trigger bNextImageDelete
before delete on n_image
for each row
BEGIN
	delete from nexts where id=old.nextid;
END
DELIMITER ;

drop trigger if exists bNextVideoDelete;
DELIMITER $
create trigger bNextVideoDelete
before delete on n_video
for each row
BEGIN
	delete from nexts where id=old.nextid;
END$

DELIMITER ;
