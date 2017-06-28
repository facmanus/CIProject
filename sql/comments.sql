drop table comments;

create table comments (
	id int null auto_increment,
	bid int not null default 0 comment '부모게시글번호',
	user_id varchar(30) null comment '작성자 id',
	user_name varchar(30) not null comment '작성자이름',
	contents text not null comment '내용',
	reg_date datetime not null default current_timestamp,
	mod_date datetime not null on update current_timestamp,
	primary key (id),
	index bid (id)
) 
comment='댓글'
collate='utf8_general_ci'
ENGINE=MyISAM;

truncate comments;

insert into comments (bid, user_id, user_name, contents) 
values (17, 'facmanus', 'facmanus', '첫번째글입니다.');
insert into comments (bid, user_id, user_name, contents) 
values (17, 'bahara', 'bahara', '두번째댓글입니다.');

SELECT * FROM comments ORDER BY id DESC;
