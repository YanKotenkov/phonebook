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

alter table user convert to character set utf8mb4 collate utf8mb4_unicode_ci;

create table if not exists phonebook.contact
(
	id int(32) auto_increment
		primary key,
	name varchar(255) not null,
	user_id int(32) not null,
	second_name varchar(255) null,
	email varchar(255) not null,
	phone varchar(12) not null,
	photo mediumblob null,
	ins_date datetime default CURRENT_TIMESTAMP null,
	constraint contact__user_id_fk foreign key (user_id) references user (id) on delete cascade
)
comment 'Контакты' collate=utf8mb4_unicode_ci;

alter table phonebook.contact convert to character set utf8mb4 collate utf8mb4_unicode_ci;
