create table if not exists phonebook.user
(
	id int(32) auto_increment
		primary key,
	login varchar(50) not null,
	password varchar(255) not null,
	email varchar(255) not null,
	ins_date datetime default CURRENT_TIMESTAMP not null,
	constraint user_login_uindex
		unique (login),
    constraint user_email_uindex
		unique (email)
)
comment 'Пользователи' collate=utf8mb4_unicode_ci;

ALTER TABLE user CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

create table if not exists phonebook.contact
(
	id int(32) auto_increment
		primary key,
	name varchar(255) not null,
	second_name varchar(255) null,
	email varchar(255) not null,
	phone varchar(12) not null,
	photo mediumblob null,
	ins_date datetime default CURRENT_TIMESTAMP null
)
comment 'Контакты' collate=utf8mb4_unicode_ci;

ALTER TABLE phonebook.contact CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
