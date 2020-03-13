create DATABASE memopa;

grant all on memopa.* to dbuser@localhost
identified by 'nowak2020';


create table users
(
  user_id int(11) not null
  auto_increment primary key,
  email varchar
  (255) unique,
  pass varchar
  (255),
  login_time datetime,
  name varchar
  (255),
  image varchar
  (255),
  delete_flg boolean not null default 0,
  create_date datetime,
  update_date timestamp
);

