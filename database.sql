
show tables;
desc barang;


-- =================================
--    data master   /
-- ________________/

-- tabel satuan
create table satuan(
idsatuan int auto_increment,
nama_satuan varchar(45),
status tinyint,
primary key (idsatuan)
);

-- tabel barang
create table barang(
idbarang int auto_increment,
jenis char(1),
nama varchar(45),
idsatuan int,
status tinyint,
harga int,
primary key (idbarang),
constraint fk_satuan_barang foreign key (idsatuan) references satuan(idsatuan)
);

-- tabel vendor
create table vendor(
idvendor int auto_increment,
nama_vendor varchar(100),
badan_hukum char(1),
status char(1),
primary key (idvendor)
);

-- tabel role
create table role(
idrole int auto_increment,
nama_role varchar(100),
primary key (idrole)
);

-- tabel user
create table user(
iduser int auto_increment,
username varchar(45),
password varchar(45),
idrole int,
primary key (iduser),
constraint fk_role_user foreign key (idrole) references role(idrole)
);

-- table margin
create table margin_penjualan(
idmargin_penjualan int auto_increment,
created_at timestamp default current_timestamp,
persen double,
status tinyint,
iduser int,
updated_at timestamp,
primary key (idmargin_penjualan),
constraint fk_user_margin foreign key (iduser) references user(iduser)
);

-- =================================
--    tabel sisanya /
-- ________________/

-- table kartu stok
create table kartu_stok(
idkartu_stok bigint auto_increment,
jenis_transaksi char(1),
masuk int,
keluar int,
stock int,
created_at timestamp default current_timestamp,
idtranskasi int,
idbarang int,
primary key (idkartu_stok),
constraint fk_barang_kartu foreign key (idbarang) references barang(idbarang)
);

-- tabel pengadaan
create table pengadaan(
idpengadaan bigint auto_increment,
timestamp timestamp default current_timestamp,
user_iduser int,
status char(1),
vendor_idvendor int,
subtotal_nilai int,
ppn int,
total_nilai int,
primary key (idpengadaan),
constraint fk_user_pengadaan foreign key (user_iduser) references user(iduser),
constraint fk_vendor_pengadaan foreign key (vendor_idvendor) references vendor(idvendor)
);

-- tabel detil pengadaan
create table detil_pengadaan(
iddetil_pengadaan bigint auto_increment,
harga_satuan int,
jumlah int,
sub_total int,
idbarang int,
idpengadaan bigint,
primary key (iddetil_pengadaan),
constraint fk_barang_dpengadaan foreign key (idbarang) references barang(idbarang),
constraint fk_pengadaan_dpengadaan foreign key (idpengadaan) references pengadaan(idpengadaan)
);

-- tabel penerimaan
create table penerimaan(
idpenerimaan bigint auto_increment,
created_at timestamp default current_timestamp,
status char(1),
idpengadaan bigint,
iduser int,
primary key (idpenerimaan),
constraint fk_pengadaan_penerimaan foreign key (idpengadaan) references pengadaan(idpengadaan),
constraint fk_user_penerimaan foreign key (iduser) references user(iduser)
);

-- tabel detil_penerimaan
create table detil_penerimaan(
iddetil_penerimaan bigint auto_increment,
idpenerimaan bigint,
barang_idbarang int,
jumlah_terima int,
harga_satuan_terima int,
sub_total_terima int,
primary key (iddetil_penerimaan),
constraint fk_penerimaan_dpenerimaan foreign key (idpenerimaan) references penerimaan(idpenerimaan),
constraint fk_barang_dpenerimaan foreign key (barang_idbarang) references barang(idbarang)
);

-- tabel penjualan
create table penjualan(
idpenjualan int auto_increment,
created_at timestamp default current_timestamp,
subtotal_nilai int,
ppn int,
total_nilai int,
iduser int,
idmargin_penjualan int,
primary key (idpenjualan),
constraint fk_user_penjualan foreign key (iduser) references user(iduser),
constraint fk_margin_penjualan foreign key (idmargin_penjualan) references margin_penjualan(idmargin_penjualan)
);

-- tabel detil penjualan
create table detil_penjualan(
iddetil_penjualan bigint auto_increment,
harga_satuan int,
jumlah int,
subtotal int,
penjualan_idpenjualan int,
idbarang int,
primary key (iddetil_penjualan),
constraint fk_penjualan_dpenjualan foreign key (penjualan_idpenjualan) references penjualan(idpenjualan),
constraint fk_barang_dpenjualan foreign key (idbarang) references barang(idbarang)
);

-- tabel retur
create table retur(
idretur bigint auto_increment,
created_at timestamp default current_timestamp,
idpenerimaan bigint,
iduser int,
primary key (idretur),
constraint fk_penerimaan_retur foreign key (idpenerimaan) references penerimaan(idpenerimaan),
constraint fk_user_retur foreign key (iduser) references user(iduser)
);

-- tabel detil retur
create table detil_retur(
iddetil_retur int auto_increment,
jumlah int,
alasan varchar(200),
idretur bigint,
iddetil_penerimaan bigint,
primary key (iddetil_retur),
constraint fk_retur_dretur foreign key (idretur) references retur(idretur),
constraint fk_dpenerimaan_dretur foreign key (iddetil_penerimaan) references detil_penerimaan(iddetil_penerimaan)
);

-- =======================================
--  DML YEEEEY  /
--  ___________/

-- insert value ke tabel role
insert into role(nama_role) values 
("Owner"),
("Manajer"),
("Kasir"),
("Inventaris");

-- ini ganti nama kolom password di tabel user jadi password_hash
alter table user rename column password to password_hash; 
--
-- ganti data type table biar muat hash password
alter table user modify password_hash varchar(255) not null;

-- insert value ke tabel user
insert into user(username, password_hash, idrole) values 
('mas_ceo', SHA2('xmasceox', 256), 1),
('mas_manajer', SHA2('adminkuyy', 256), 2),
('kasir_1', SHA2('loginkasir1', 256), 3),
('kasir_2', SHA2('loginkasir2', 256), 3),
('inven_1', SHA2('warehouse1', 256), 4);

-- insert margin ke tabel margin penjualan
-- ps. semua status nya 0, maka blum ada yang akrif
insert into margin_penjualan(persen, status, iduser) VALUES
(0.1, 0, 2),
(0.2, 0, 2),
(0.3, 0, 2),
(0.4, 0, 2),
(0.5, 0, 2);

-- satuan 
insert into satuan(nama_satuan, status) values 
('Miligram', 0),
('Gram', 0),
('Kilogram', 0),
('Liter', 0),
('Unit', 0);

-- vendor
insert into vendor(nama_vendor, badan_hukum, status) values 
('vendor_1', 'a', 'C'),
('vendor_2', 't', 'A'),
('vendor_3', 'b', 'C'),
('vendor_4', 's', 'S'),
('vendor_5', 'o', 'B');

-- ================================
-- SALAH RUN QUERY TRUS MASUK DATABASE ANJIR SIAL
-- oke jd harus hapus constraint dlu baru bisa ngeturncate record di tabel barang
--
--
-- hapus constraint dlu untuk hapus data
alter table detil_pengadaan
drop foreign key fk_barang_dpengadaan;

alter table detil_penjualan
drop foreign key fk_barang_dpenjualan;

alter table detil_penerimaan
drop foreign key fk_barang_dpenerimaan;

alter table kartu_stok
drop foreign key fk_barang_kartu;

TRUNCATE table barang;

alter table kartu_stok
add constraint fk_barang_kartu foreign key (idbarang) references barang(idbarang);

alter table detil_penjualan
add constraint fk_barang_dpenjualan foreign key (idbarang) references barang(idbarang);

alter table detil_penerimaan
add constraint fk_barang_dpenerimaan foreign key (barang_idbarang) references barang(idbarang);

alter table detil_pengadaan
add constraint fk_barang_dpengadaan foreign key (idbarang) references barang(idbarang);

-- masukkin nilai ke tabel barang
insert into barang(jenis, nama, idsatuan, status, harga) values 
('O', 'Logitik Office S', 5, 0, 320000),
('O', 'Logitik Office', 5, 1, 290000),
('P', 'Logitik Go', 5, 0, 200000),
('P', 'Rival Travel', 5, 1, 80000),
('P', 'WinTech Pebble', 5, 1, 150000),
('G', 'Logitik Pro', 5, 1, 350000),
('G', 'WinTech Pro', 5, 0, 300000),
('G', 'WinTech Pro S', 5, 1, 330000),
('E', 'Logitik Stand', 5, 1, 500000);
--
-- O = Office 
-- P = Portable 
-- G = Gaming 
-- E = Ergonomics 



-- =======================================
--    Tabel view   /
-- _______________/ 

