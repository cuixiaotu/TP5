#生活服务分类表
create table o2o_category(
id int(11) unsigned not null auto_increment,
name varchar(50) not null default "",
parent_id int(10) unsigned not null default 0,
listorder int(8) unsigned not null default 0,
status tinyint(1) not null default 0,
create_time int(11) unsigned not null default 0,
update_time int(11) unsigned not null default 0,
primary key (id),
key parent_id(parent_id)
)ENGINE=InnoDB auto_increment=1 default charset=utf8;

#城市表
create table o2o_city(
id int(11) unsigned not null auto_increment,
name varchar(50) not null default "",
uname varchar(50) not null default "",
parent_id int(10) unsigned not null default 0,
listorder int(8) unsigned not null default 0,
status tinyint(1) not null default 0,
create_time int(11) unsigned not null default 0,
update_time int(11) unsigned not null default 0,
primary key (id),
key parent_id(parent_id),
unique key uname(uname)
)ENGINE=InnoDB auto_increment=1 default charset=utf8;

#商圈表
create table o2o_area(
id int(11) unsigned not null auto_increment,
name varchar(50) not null default "",
city_id int(11) unsigned not null default 0,
parent_id int(10) unsigned not null default 0,
listorder int(8) unsigned not null default 0,
status tinyint(1) not null default 0,
create_time int(11) unsigned not null default 0,
update_time int(11) unsigned not null default 0,
primary key (id),
key parent_id(parent_id),
key city_id(city_id)
)ENGINE=InnoDB auto_increment=1 default charset=utf8;

#商户表
create table o2o_bis(
id int(11) unsigned not null auto_increment,
name varchar(50) not null default "",
email varchar(50) not null default "",
logo varchar(255) not null default "",
licence_logo varchar(255) not null default "",
description  text not null,
city_id int(11) unsigned not null default 0,
city_path varchar (50) not null default '',
bank_info varchar (50) not null default '',
money decimal(20,2) not null default '0.00',
bank_name varchar (50) not null default '',
bank_user varchar (50) not null default '',
faren varchar (20) not null default '',
faren_tel varchar (20) not null default '',
listorder int(8) unsigned not null default 0,
status tinyint(1) not null default 0,
create_time int(11) unsigned not null default 0,
update_time int(11) unsigned not null default 0,
primary key (id),
key city_id(city_id),
key name(name)
)ENGINE=InnoDB auto_increment=1 default charset=utf8;


#商户账号表
create table o2o_bis_account(
id int(11) unsigned not null auto_increment,
username varchar(50) not null default "",
password char(32) not null default "",
code varchar(10) not null default '',
bis_id int(11) unsigned not null default 0,
last_login_ip varchar(20) not null default '',
last_login_time int(11) unsigned not null default 0,
is_main tinyint(1) unsigned not null default 0,
listorder int(8) unsigned not null default 0,
status tinyint(1) not null default 0,
create_time int(11) unsigned not null default 0,
update_time int(11) unsigned not null default 0,
primary key (id),
key bis_id(bis_id),
key username(username)
)ENGINE=InnoDB auto_increment=1 default charset=utf8;

#商户门店表
create table o2o_bis_location(
id int(11) unsigned not null auto_increment,
name varchar(50) not null default "",
logo varchar(255) not null default "",
address varchar(255) not null default "",
tel varchar(20) not null default "",
contact varchar(20) not null default "",
xpoint varchar(20) not null default "",
ypoint varchar(20) not null default "",
bis_id int(11) unsigned not null default 0,
open_time int(11) unsigned not null default 0,
content  text not null,
is_main tinyint(1) unsigned not null default 0,
api_address varchar(255) not null default "",
city_id int(11) unsigned not null default 0,
city_path varchar (50) not null default '',
category_id int(11) unsigned not null default 0,
category_path varchar(50)  not null default '',
bank_info varchar (50) not null default '',
listorder int(8) unsigned not null default 0,
status tinyint(1) not null default 0,
create_time int(11) unsigned not null default 0,
update_time int(11) unsigned not null default 0,
primary key (id),
key city_id(city_id),
key bis_id(bis_id),
key category_id(category_id),
key name(name)
)ENGINE=InnoDB auto_increment=1 default charset=utf8;

#团购商品表
create table o2o_deal(
id int(11) unsigned not null auto_increment,
name varchar(100) not null default '',
category_id int(11) not null default 0,
se_category_id int(11) not null default 0,
bis_id int(11) not null default 0,
location_ids varchar(100) not null default '',
image varchar(200) not null default '',
description text not null ,
start_time int(11) default 0,
end_time int(11) default 0,
origin_price decimal(20,2) not null default '0.00',
current_price decimal(20,2) not null default '0.00',
city_id int(11) not null default 0,
buy_count int(11) not null default 0,
total_count int(11) not null default 0,
coupons_begin_time int(11) not null default 0,
coupons_end_time int(11) not null default 0,
xpoint varchar(20) not null default '',
ypoint varchar(20) not null default '',
bis_account_id int not null default 0,
balance_price decimal(20,2) not null default '0.00',
notes text not null,
listorder int(8) unsigned not null default 0,
status tinyint(1) not null default 0,
create_time int(11) unsigned not null default 0,
update_time int(11) unsigned not null default 0,
primary key (id),
key category_id(category_id),
key se_category_id(se_category_id),
key city_id(city_id),
key start_time(start_time),
key end_time(end_time)
)ENGINE=InnoDB auto_increment=1 default charset=utf8;

#用户表
create table o2o_user(
id int(11) unsigned not null auto_increment,
username varchar(80) not null default '',
password char(32) not null default '',
code varchar(10) not null default '',
last_login_ip varchar(20) not null default '',
last_login_time int(11) unsigned not null default 0,
email varchar(30) not null default '',
mobile varchar(20) not null default '',
listorder int(8) unsigned not null default 0,
status tinyint(1) not null default 0,
create_time int(11) unsigned not null default 0,
update_time int(11) unsigned not null default 0,
primary key (id),
unique key username(username),
unique key email(email)
)ENGINE=InnoDB auto_increment=1 default charset=utf8;


#推荐位表
create table o2o_featured(
id int(11) unsigned not null auto_increment,
type tinyint(1)  not null default 0,
title varchar(30) not null default '',
image varchar(255) not null default '',
url varchar(255) not null default '',
description varchar(255) not null default '',
listorder int(8) unsigned not null default 0,
status tinyint(1) not null default 0,
create_time int(11) unsigned not null default 0,
update_time int(11) unsigned not null default 0,
primary key (id)
)ENGINE=InnoDB auto_increment=1 default charset=utf8;