SET  NAMES  UTF8;

DROP DATABASE IF EXISTS kaoqin;

CREATE DATABASE kaoqin  CHARSET=UTF8;

USE kaoqin;


CREATE TABLE emp(
  uid INT primary key auto_increment,
  uname varchar(100) not null,
  upwd varchar(100) not null default '123456',
  u_join_time DATETIME default now(),
  is_leader int default 0
);


INSERT INTO emp (uname,is_leader) VALUES("alibaba",1);



select * from emp;


create table kaoqin(
	kid int primary key auto_increment,
	uid int not null,
	kcreate_time DATETIME default now()
);


insert into kaoqin (uid) values(1);


select * from kaoqin;


