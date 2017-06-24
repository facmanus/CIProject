create table users (
	id int null auto_increment,
	user_id varchar(30) null comment '사용자 id',
	user_name varchar(30) not null comment '사용자이름',
	password varchar(50) not null comment '비밀번호',	
   email varchar(200) not null comment 'email',	
	reg_date datetime not null default current_timestamp,
	mod_date datetime not null on update current_timestamp,
	primary key (id),
	index user_id (user_id)
) 
comment='사용자 테이블'
collate='utf8_general_ci'
ENGINE=MyISAM;

insert into users (user_id, user_name, password, email) 
values ('facmanus', 'facmanus', 'iamfacmanus!.', 'fac.manus@gmail.com');

truncate users;
drop table users;

SELECT * FROM users ORDER BY id DESC;
SELECT id FROM users WHERE userid = 'facmanus'
