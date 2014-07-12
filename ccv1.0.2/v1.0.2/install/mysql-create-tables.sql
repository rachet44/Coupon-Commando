CREATE TABLE cc_users 
(         
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        user VARCHAR(64),
        pass VARCHAR(64),
        banned char(1) default 'N',
	account_type char(2) default 'U',
	first_name VARCHAR(64),	
	last_name VARCHAR(64),
	company_name VARCHAR(64),
	email VARCHAR(256)
);

CREATE TABLE cc_audit
(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	user_id INT,
	payment DECIMAL(5,2),
	info varchar(512)
);

CREATE TABLE cc_coupons
(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	user_id INT,	
	name VARCHAR(512),
	tagline VARCHAR(512),
	webhtml VARCHAR(512),
	imgname VARCHAR(512),
	inactive char(1) default 'N'
);

CREATE TABLE cc_onetimeoffers
(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	user_id INT,	
	coupon_id INT,	
	starts_on datetime,
	ends_on datetime,
	active char(1) default 'N',
	displaytokens INT,
	global_placement char(1) default 'N',
	webhtml text,	
	name varchar(512)
);

CREATE TABLE cc_tracking
(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,	
	user_id INT,	
	coupon_id int default 0,
	onetimeoffer_id int default 0,
	viewed VARCHAR(1) default 'N',
	printed VARCHAR(1) default 'Y',
	addedon datetime	
);
