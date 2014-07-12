-- Copyright (C) 2001 YesSoftware. All rights reserved.
-- TellAFriend_MySQL.sql

drop table if exists tellafriend_log;
create table tellafriend_log
(
  log_id integer auto_increment primary key,
  sending_date datetime,
  from_email varchar(50),
  from_name varchar(50),
  to_email varchar(50),
  to_name varchar(50),
  message_comments text
);