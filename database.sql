drop table users;

create table users(
id  SERIAL PRIMARY KEY,
name varchar(255),
email varchar(255) UNIQUE,
age INTEGER,
dob date,	
password varchar,
token varchar	
);

select * from users;



CREATE TABLE products(
id SERIAL PRIMARY KEY,
productname varchar,
productimage varchar,
price INTEGER
);

select * from products;