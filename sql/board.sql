create table board (
	id int null auto_increment,
	pid int null default 0 comment '부모글번호',
	user_id varchar(30) null comment '작성자 id',
	user_name varchar(30) not null comment '작성자이름',
	title varchar(200) not null comment '제목',
	contents text not null comment '내용',
	hits int default 0 not null comment '조회수',
	reg_date datetime not null default current_timestamp,
	mod_date datetime not null on update current_timestamp,
	primary key (id),
	index pid (id)
) 
comment='계층형게시판'
collate='utf8_general_ci'
ENGINE=MyISAM;

insert into board (user_id, user_name, title, contents) 
values ('facmanus', 'facmanus', '첫번째 글입니다.', '첫번째글입니다.');
insert into board (user_id, user_name, title, contents) 
values ('facmanus', 'facmanus', '두번째 글입니다.', '두번째글입니다.');
insert into board (user_id, user_name, title, contents) 
values ('facmanus', 'facmanus', '세번째 글입니다.', '세번째글입니다.');
insert into board (user_id, user_name, title, contents) 
values ('facmanus', 'facmanus', '네번째 글입니다.', '네번째글입니다.');
insert into board (user_id, user_name, title, contents) 
values ('facmanus', 'facmanus', '다섯번째 글입니다.', '다섯번째글입니다.');
insert into board (user_id, user_name, title, contents) 
values ('facmanus', 'facmanus', '여섯번째 글입니다.', '여섯번째글입니다.');
insert into board (user_id, user_name, title, contents) 
values ('facmanus', 'facmanus', '일곱번째 글입니다.', '일곱번째글입니다.');
insert into board (user_id, user_name, title, contents) 
values ('facmanus', 'facmanus', '여덞번째 글입니다.', '여덞번째글입니다.');
insert into board (user_id, user_name, title, contents) 
values ('facmanus', 'facmanus', '아홈번째 글입니다.', '아홉번째글입니다.');
insert into board (user_id, user_name, title, contents) 
values ('facmanus', 'facmanus', '열번째 글입니다.', '열번째글입니다.');
insert into board (user_id, user_name, title, contents) 
values ('facmanus', 'facmanus', '열한번째글입니다.', '열한번째글입니다.');
insert into board (user_id, user_name, title, contents) 
values ('facmanus', 'facmanus', '열두번째글입니다.', '열두번째글입니다.');
insert into board (user_id, user_name, title, contents) 
values ('facmanus', 'facmanus', '열세번째 글입니다.', '열세번째글입니다.');
insert into board (user_id, user_name, title, contents) 
values ('facmanus', 'facmanus', '열네번째 글입니다.', '열네번째글입니다.');
insert into board (user_id, user_name, title, contents) 
values ('facmanus', 'facmanus', '열다섯번째 글입니다.', '열다섯번째글입니다.');
insert into board (pid, user_id, user_name, title, contents) 
values (1, 'bahara', '바하라', '첫번째글의 첫 답글입니다.', '첫번째 답글입니다.');
insert into board (pid, user_id, user_name, title, contents) 
values (1, 'bahara', '바하라', '첫번째글의 두번째답글입니다.', '첫번째글의 두번째답글입니다.');
insert into board (pid, user_id, user_name, title, contents) 
values (3, 'bahara', '바하라', '세번째글의 첫번째답글입니다.', '세번째글의 첫번째답글입니다.');

truncate board;

SELECT * FROM board ORDER BY id DESC;
