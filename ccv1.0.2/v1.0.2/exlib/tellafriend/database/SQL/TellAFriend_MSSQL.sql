-- Copyright (C) 2001 YesSoftware. All rights reserved.
-- TellAFriend_MSSQL.sql

if exists (select * from sysobjects where id = object_id(N'tellafriend_log') and OBJECTPROPERTY(id, N'IsUserTable') = 1) drop table tellafriend_log
GO
create table tellafriend_log
(
  log_id integer identity primary key,
  sending_date datetime,
  from_email varchar(50),
  from_name varchar(50),
  to_email varchar(50),
  to_name varchar(50),
  message_comments text
)
GO