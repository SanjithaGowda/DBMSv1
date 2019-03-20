create database salmgmtv2;
use salmgmtv2;
create table owner(password varchar(20) , uname varchar(20) primary key, gst varchar(30));
create table products(pid int(5) primary key, pname varchar(10) unique not null, pcost float(10,2) not null, qtyavail int not null,pdesc varchar(1000));
create table supplier(total_payment float(10,2) not null, sgst varchar(20) primary key, sname varchar(100) not null, saddr varchar(100));
create table rawmaterials(rid int(5) primary key, rname varchar(100) not null, rcost float(10,2) not null, rqtyavail int not null,sgst varchar(20) not null, foreign key (sgst) references supplier (sgst) on delete cascade);
create table customer(username varchar(20) primary key, paymentbal float(10,2), name varchar(20) not null, gst varchar(20) unique not null,password varchar(20) not null,email VARCHAR(100) NOT NULL,mob1 int(10) NOT NULL,mob2 int(10),address varchar(50));
create table orders(pono int primary key, cgst varchar(20),finished int, driverno varchar(10), foreign key (cgst) references customer(gst) on delete cascade);
create table ordered_pdts1(pono int not null, pid int(5) not null, qty int, finstage varchar(20), foreign key (pono) references orders(pono) on delete cascade, foreign key (pid) references products(pid) on delete cascade, primary key(pono,pid));
create table employees(name varchar(20) not null, empid int(20) primary key, uname varchar(20) unique, pwd varchar(20), bsal float(10,2), ot float(10,2));

insert into products(pcost,pdesc,pid,pname,qtyavail) values (1200,clamps,1,clamps,10), (10000,silicon carbide heating elements,2,silicon carbide heating elements,8), (1000,HFK bricks,3,HFK bricks,10), (10200,gold melting graphite crucible,4,gold melting graphite crucible,2), (10200,silver melting graphite crucible,5,silver melting graphite crucible,10), (175000, Electrically operated gold multiple melting furnace, 6,  Electrically operated gold multiple melting furnace ,1 ), (5000,L - Type thermocouple,7,L - Type thermocouple,5), (200,Thermocouple cable (PtPtRh),8,Thermocouple cable (PtPtRh),100), (90000,Oil fired furnace,9,Oil fired furnace,0), (240000,150 kg Aluminium meltilng / holding furnace,10,150 kg Aluminium meltilng / holding furnace,1);


insert into supplier (saddr,sgst,sname,total_payment) values ("chennai", "01", "Continental thermal", 0), ("Bommasandra","02","Mersen",0), ("chennai","03","Abi Instruments",0), ("Hyderabad","04","Mariton heaters",0), ("Magadi Road","05","Pavantranix",0), ("Mathikere","06","San Process", 0), ("Bangalore","07","Unipower",0), ("Jalahalli","08","Alpha-tech",0);

insert into rawmaterials (rcost,rid,rname,rqtyavail,sgst) values (2400,1,"gear motor",20,"01"), (24000,2,"blower",10,"01"), (48000,3,"pumping elements",7,"02"), (9000,4,"fiberglass heaters",5,"03"), (8000,5,"PID controller",2,"04"), (4500, 6, "temperature controller", 10, "05"), (15000, 7, "graphite mill board",3,"06");

INSERT INTO employees (name, empid, uname, pwd,bsal, ot) VALUES 
('Glenda', '034326696', 'glenda', 'dab84745a9b4752dfd678751ff3c029e', '5000', '500'), 
('Vivian', '215784257', 'vivian', '9fb6a5fbc8cd461ff114a1205fb5a56f', '6000', '200'), 
('Melissa', '066092622', 'melissa', 'ff5390bde5a4cf0aa2006cf2198efd29', '5000', '100'), 
('Juan', '240230662', 'juan', 'a94652aa97c7211ba8954dd15a3cf838', '4000', '0'), 
('Woodrow', '253650916', 'woodrow', '2b03845a5aec50185289b7a2f749ee66', '4200', '100'), 
('Thomas', '047381422', 'thomas', 'ef6e65efc188e7dffd7335b646a85a21', '7000', '200'), 
('Michael', '302688393', 'michael', '0acf4539a14b3aa27deeb4cbdf6e989f', '3800', '120'), 
('Donald', '771269215', 'donald', '0d343c0f0ca763f983c8042350059f56', '2000', '100'), 
('Ryan', '0144184657', 'ryan', '10c7ccc7a4f0aff03c915c485565b9da', '4600', '150'), 
('Tommie', '515251324', 'tommie', '0caf065ccd370d79267702267e185084', '4500', '350');

INSERT INTO owner (password, uname, gst) VALUES ('21232f297a57a5a743894a0e4a801fc3', 'admin', '12121212');
