create database salmgmtv2;
use salmgmtv2;
create table owner(pwd varchar(100) , uname varchar(20) primary key, gst varchar(30));
create table products(pid int(5) primary key, pname varchar(100) unique not null, pcost float(10,2) not null, qtyavail int not null,pdesc varchar(1000));
create table supplier(total_payment float(10,2) not null, sgst varchar(20) primary key, sname varchar(100) not null, saddr varchar(100));
create table rawmaterials(rid int(5) primary key, rname varchar(100) not null, rcost float(10,2) not null, rqtyavail int not null,sgst varchar(20) not null, foreign key (sgst) references supplier (sgst) on delete cascade);
create table customer(uname varchar(20) primary key, paymentbal float(10,2), name varchar(100) not null, gst varchar(20) unique not null,pwd varchar(100) not null,email VARCHAR(100) NOT NULL,mob1 int(10) NOT NULL,mob2 int(10),address varchar(50));
create table orders(pono int primary key not null auto_increment, cgst varchar(20),finished int, driverno varchar(10), foreign key (cgst) references customer(gst) on delete cascade);
alter table orders AUTO_INCREMENT = 1;
create table ordered_pdts1(pono int not null, pid int(5) not null, qty int, finstage varchar(20), foreign key (pono) references orders(pono) on delete cascade, foreign key (pid) references products(pid) on delete cascade, primary key(pono,pid));
create table employees(name varchar(100) not null, empid int(20) primary key, uname varchar(20) unique, pwd varchar(100), bsal float(10,2), ot int);

insert into products(pcost,pdesc,pid,pname,qtyavail) values (1200,"clamps",1,"clamps",10), (10000,"silicon carbide heating elements",2,"silicon carbide heating elements",8), (1000,"HFK bricks",3,"HFK bricks",10), (10200,"gold melting graphite crucible",4,"gold melting graphite crucible",2), (10200,"silver melting graphite crucible",5,"silver melting graphite crucible",10), (175000, "Electrically operated gold multiple melting furnace", 6,  "Electrically operated gold multiple melting furnace" ,1 ), (5000,"L - Type thermocouple",7,"L - Type thermocouple",5), (200,"Thermocouple cable (PtPtRh)",8,"Thermocouple cable (PtPtRh)",100), (90000,"Oil fired furnace",9,"Oil fired furnace",0), (240000,"150 kg Aluminium meltilng / holding furnace",10,"150 kg Aluminium meltilng / holding furnace",1);


insert into supplier (saddr,sgst,sname,total_payment) values ("chennai", "01", "Continental thermal", 0), ("Bommasandra","02","Mersen",0), ("chennai","03","Abi Instruments",0), ("Hyderabad","04","Mariton heaters",0), ("Magadi Road","05","Pavantranix",0), ("Mathikere","06","San Process", 0), ("Bangalore","07","Unipower",0), ("Jalahalli","08","Alpha-tech",0);

insert into rawmaterials (rcost,rid,rname,rqtyavail,sgst) values (2400,1,"gear motor",20,"01"), (24000,2,"blower",10,"01"), (48000,3,"pumping elements",7,"02"), (9000,4,"fiberglass heaters",5,"03"), (8000,5,"PID controller",2,"04"), (4500, 6, "temperature controller", 10, "05"), (15000, 7, "graphite mill board",3,"06");

INSERT INTO employees (name, empid, uname, pwd,bsal, ot,image) VALUES 
('Glenda', '1', 'glenda', 'dab84745a9b4752dfd678751ff3c029e', '5000', '10','empimg/01.jpg'), 
('Vivian', '2', 'vivian', '9fb6a5fbc8cd461ff114a1205fb5a56f', '6000', '20','empimg/02.jpg'), 
('Melissa', '3', 'melissa', 'ff5390bde5a4cf0aa2006cf2198efd29', '5000', '1','empimg/03.jpg'), 
('Juan', '4', 'juan', 'a94652aa97c7211ba8954dd15a3cf838', '4000', '0','empimg/04.jpg'), 
('Woodrow', '5', 'woodrow', '2b03845a5aec50185289b7a2f749ee66', '4200', '7','empimg/05.jpg'), 
('Thomas', '6', 'thomas', 'ef6e65efc188e7dffd7335b646a85a21', '7000', '6','empimg/06.jpg'), 
('Michael', '7', 'michael', '0acf4539a14b3aa27deeb4cbdf6e989f', '3800', '5','empimg/07.jpg'), 
('Donald', '8', 'donald', '0d343c0f0ca763f983c8042350059f56', '2000', '10','empimg/08.jpg'), 
('Ryan', '9', 'ryan', '10c7ccc7a4f0aff03c915c485565b9da', '4600', '15','empimg/09.jpg'), 
('Tommie', '10', 'tommie', '0caf065ccd370d79267702267e185084', '4500', '3','empimg/10.jpg');

INSERT INTO owner (pwd, uname, gst) VALUES ('21232f297a57a5a743894a0e4a801fc3', 'admin', '12121212');
alter table orders add COLUMN ocost float(10,2);
alter TABLE employees ADD column image varchar(1000);
