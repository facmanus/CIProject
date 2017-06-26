drop table users;

/* 사용자 테이블 */
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
) ci_sessions
comment='사용자 테이블'
collate='utf8_general_ci'
ENGINE=MyISAM;

insert into users (user_id, user_name, password, email) 
values ('facmanus', 'facmanus', 'iamfacmanus!.', 'fac.manus@gmail.com');

truncate users;


SELECT * FROM users ORDER BY id DESC;
SELECT id FROM users WHERE userid = 'facmanus'

/* 세션 테이블 */
CREATE TABLE IF NOT EXISTS `ci_sessions` (
        `id` varchar(40) NOT NULL,
        `ip_address` varchar(45) NOT NULL,
        `timestamp` int(10) unsigned default 0 NOT NULL,
        `data` blob NOT NULL,
        PRIMARY KEY (id)
);
