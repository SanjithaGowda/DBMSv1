create database salmgmtv1;
use salmgmtv1;
create table owner(password varchar(20), username varchar(20), gst varchar(30));
ALTER TABLE owner add primary key(username);
create table products(pid int(5) primary key, pname varchar(10) unique not null, pcost float(10,2) not null, qtyavail int not null);
alter table products add column (pdesc varchar(1000));
create table supplier(total_payment float(10,2) not null, sgst varchar(20) primary key, sname varchar(20) not null, saddr varchar(100));
create table rawmaterials(rid int(5) primary key, rname varchar(10) unique not null, rcost float(10,2) not null, rqtyavail int not null,sgst varchar(20) not null, foreign key (sgst) references supplier (sgst) on delete cascade);
create table customer(username varchar(20) primary key, paymentbal float(10,2), name varchar(20) not null, gst varchar(20) unique not null,password varchar(20) not null,email VARCHAR(100) NOT NULL,mob1 int(10) NOT NULL,mob2 int(10));
create table orders(pono int primary key, cgst varchar(20), foreign key (cgst) references customer(gst) on delete cascade);
create table ordered_pdts(pono int primary key, pname varchar(20) not null, qty int, foreign key (pono) references orders(pono) on delete cascade, foreign key (pname) references products(pname) on delete cascade);
create table designation(dname varchar(20) primary key, salary float(10,2) not null);
create table employees(name varchar(20) not null, empid int(20) primary key, username varchar(20) unique, password varchar(20), hourpernth float(10,2)  not null, salary float(10,2) not null, design varchar(20) not null,foreign key (design) references designation(dname));
alter TABLE customer add column address varchar(50);

