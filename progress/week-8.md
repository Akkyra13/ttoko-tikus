# Proyek TToko Tikus

Minggu ke 8
---------------------------------
bikin tabel view dari tabel^2^ berikut

- [x] satuan

```sql 

create or replace view satuan_v as
select nama_satuan as Satuan, 
case
  when status = 0 then 'tidak aktif'
  when status = 1 then 'aktif'
end as status
from satuan;

```

- [x] barang

```sql 

create or replace view barang_v as
select b.idbarang as 'ID_Item',
case
  when jenis = 'O' then 'Office'
  when jenis = 'P' then 'Travel'
  when jenis = 'G' then 'Gaming'
  when jenis = 'E' then 'Ergonomic'
end as 'Jenis',
b.nama as 'Nama_Barang',
sat.nama_satuan as 'Satuan',
case 
  when b.status = 0 then 'Stok Tersedia'
  when b.status = 1 then 'Stok Habis'
end as Stok,
harga as 'Harga'
from barang b 
join satuan sat on b.idsatuan = sat.idsatuan

```

- [x] vendor
dml dulu ngubah data dari vendor
```sql
-- update data
update vendor 
set nama_vendor = "Logitik Indonesia Utama", badan_hukum = 'P', status = 'A'
where idvendor = 1;

update vendor 
set nama_vendor = "WinTech Solusindo", badan_hukum = 'P', status = 'A'
where idvendor = 2;

update vendor 
set nama_vendor = "Rival Gear Nusantara", badan_hukum = 'C', status = 'A'
where idvendor = 3;

-- bikin view
create or replace view vendor_v as 
select concat(
(case
  when badan_hukum = 'P' then 'PT.'
  when badan_hukum = 'C' then 'CV.'
end), 
nama_vendor) as Vendor, 
case 
  when status = 'A' then 'Aktif'
  when status = 'N' then 'Nonaktif'
end as Status
from vendor;

```


- [x] role

```sql 

create or replace view role_v as 
select idrole as ID_Role,
nama_role as Role
from role;

```

- [x] margin

```sql 

create or replace view margin_v as 
select concat(persen * 100, '%') as 'Margin',
case 
  when status = 0 then 'tidak aktif'
  when status = 1 then 'aktif'
end as status
from margin_penjualan;

```


- [x] user

```sql

create or replace view user_v as 
select u.username as 'Username',
r.nama_role as 'Role'
from user u
join role r on u.idrole = r.idrole;

```


