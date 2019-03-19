create database salmgmtv1;
use salmgmtv1;
create table owner(password varchar(40) , username varchar(20) primary key, gst varchar(30));
create table products(pid int(5) primary key, pname varchar(10) unique not null, pcost float(10,2) not null, qtyavail int not null,pdesc varchar(1000));
create table supplier(total_payment float(10,2) not null, sgst varchar(20) primary key, sname varchar(20) not null, saddr varchar(100));
create table rawmaterials(rid int(5) primary key, rname varchar(10) not null, rcost float(10,2) not null, rqtyavail int not null,sgst varchar(20) not null, foreign key (sgst) references supplier (sgst) on delete cascade);
create table customer(username varchar(20) primary key, paymentbal float(10,2), name varchar(20) not null, gst varchar(20) unique not null,password varchar(40) not null,email VARCHAR(100) NOT NULL,mob1 int(10) NOT NULL,mob2 int(10),address varchar(50));
create table orders(pono int primary key, cgst varchar(20),finished int, drivermob varchar(10), foreign key (cgst) references customer(gst) on delete cascade);
create table ordered_pdts(pono int not null, pid int(5) not null, qty int, finstage varchar(20), foreign key (pono) references orders(pono) on delete cascade, foreign key (pid) references products(pid) on delete cascade, primary key(pono,pid));
create table employees(name varchar(20) not null, empid int(20) primary key, username varchar(20) unique, password varchar(40), bsal float(10,2), ot float(10,2));



imp info:

md5("HELLO") = eb61eead90e3b899c6bcbe27ac581660 
