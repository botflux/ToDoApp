DROP TABLE if EXISTS t_users;
DROP TABLE if EXISTS t_articles;

create table t_users (
    usr_id integer not null primary key auto_increment,
    usr_name varchar(100) not null,
    usr_password varchar(100) not null,
    usr_salt varchar(100) not null,
    usr_role varchar(100) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

CREATE TABLE t_articles (
    art_id INTEGER NOT NULL PRIMARY KEY auto_increment,
    art_title VARCHAR(200) NOT NULL,
    art_content VARCHAR(3500) NOT NULL,
    art_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    usr_id INTEGER NOT NULL,
    CONSTRAINT fk_art_user FOREIGN KEY t_articles(usr_id) REFERENCES t_users(usr_id)
) engine=innodb CHARACTER SET utf8 COLLATE utf8_unicode_ci;
