DROP TABLE if EXISTS t_users;
DROP TABLE if EXISTS t_tasks;

create table t_users (
    usr_id integer not null primary key auto_increment,
    usr_name varchar(100) not null,
    usr_fname varchar(100) not null,
    usr_lname varchar(100) not null,
    usr_password varchar(100) not null,
    usr_salt varchar(100) not null,
    usr_role varchar(100) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_tasks (
    tsk_id integer not null primary key auto_increment,
    tsk_name varchar(100) not null,
    tsk_content varchar(500) not null,
    tsk_cdate DATETIME not null default CURRENT_TIMESTAMP,
    tsk_odate DATETIME not null default CURRENT_TIMESTAMP,
    usr_id integer not null
) engine=innodb character set utf8 collate utf8_unicode_ci;