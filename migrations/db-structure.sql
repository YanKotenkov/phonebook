create table if not exists user
(
	id int(32) auto_increment
		primary key,
	login varchar(50) not null,
	password varchar(255) not null,
	email varchar(255) not null,
	ins_date datetime default CURRENT_TIMESTAMP not null,
	constraint user_login_uindex
		unique (login)
    constraint user_email_uindex
		unique (email)
);

ALTER TABLE user CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
