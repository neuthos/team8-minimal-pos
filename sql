create table HakAkses
(
    IdAkses    int auto_increment
        primary key,
    NamaAkses  varchar(255) not null,
    Keterangan varchar(255) not null
);

create table Pengguna
(
    IdPengguna   int auto_increment
        primary key,
    NamaPengguna varchar(255) not null,
    Password     varchar(255) null,
    NamaDepan    varchar(255) not null,
    NamaBelakang varchar(255) not null,
    NoHp         varchar(255) not null,
    Alamat       varchar(255) not null,
    IdAkses      int          not null,
    constraint pengguna_ibfk_1
        foreign key (IdAkses) references HakAkses (IdAkses)
            on delete cascade
);

create table Barang
(
    IdBarang   int auto_increment
        primary key,
    NamaBarang varchar(255) not null,
    Keterangan varchar(255) not null,
    Satuan     varchar(255) not null,
    IdPengguna int          not null,
    HargaBeli  int          null,
    HargaJual  int          null,
    constraint barang_ibfk_1
        foreign key (IdPengguna) references Pengguna (IdPengguna)
            on delete cascade
);

create index IdPengguna
    on Barang (IdPengguna);

create index IdAkses
    on Pengguna (IdAkses);

create table supplier
(
    supplier_id      int auto_increment
        primary key,
    supplier_name    varchar(255) not null,
    supplier_address text         not null
);

create table Pelanggan
(
    pelanggan_id      int auto_increment
        primary key,
    pelanggan_name    varchar(255) not null,
    pelanggan_address text         not null,
    supplier_id       int          not null,
    constraint Pelanggan_supplier_null_fk
        foreign key (supplier_id) references supplier (supplier_id)
);

create table Pembelian
(
    IdPembelian     int auto_increment
        primary key,
    JumlahPembelian int not null,
    IdPengguna      int not null,
    IdSupplier      int not null,
    IdBarang        int null,
    constraint Pembelian_Barang_null_fk
        foreign key (IdBarang) references Barang (IdBarang),
    constraint pembelian_ibfk_1
        foreign key (IdPengguna) references Pengguna (IdPengguna)
            on delete cascade,
    constraint pembelian_ibfk_2
        foreign key (IdSupplier) references supplier (supplier_id)
            on delete cascade
);

create index IdPengguna
    on Pembelian (IdPengguna);

create index IdSupplier
    on Pembelian (IdSupplier);

create table Penjualan
(
    IdPenjualan     int auto_increment
        primary key,
    JumlahPenjualan int not null,
    IdPengguna      int not null,
    IdPelanggan     int not null,
    IdBarang        int null,
    constraint Penjualan_Barang_null_fk
        foreign key (IdBarang) references Barang (IdBarang),
    constraint penjualan_ibfk_1
        foreign key (IdPengguna) references Pengguna (IdPengguna)
            on delete cascade,
    constraint penjualan_ibfk_2
        foreign key (IdPelanggan) references Pelanggan (pelanggan_id)
            on delete cascade
);

create index IdPelanggan
    on Penjualan (IdPelanggan);

create index IdPengguna
    on Penjualan (IdPengguna);

INSERT INTO Barang (IdBarang, NamaBarang, Keterangan, Satuan, IdPengguna, HargaBeli, HargaJual) VALUES (9, 'Ac', 'Ac 1/2 pk', 'Unit', 1, 1000000, 2000000);
INSERT INTO Barang (IdBarang, NamaBarang, Keterangan, Satuan, IdPengguna, HargaBeli, HargaJual) VALUES (1, 'UC 1000', 'Minuman sehat', 'Kilogram', 1, 8000, 10000);
INSERT INTO Barang (IdBarang, NamaBarang, Keterangan, Satuan, IdPengguna, HargaBeli, HargaJual) VALUES (8, 'Aqua', 'Aqua Gelas', 'Unit', 1, 1000, 2000);

INSERT INTO HakAkses (IdAkses, NamaAkses, Keterangan) VALUES (1, 'Super Admin', 'Keterangan Super Admin');
INSERT INTO HakAkses (IdAkses, NamaAkses, Keterangan) VALUES (2, 'Finance', 'Keterangan Finance');


INSERT INTO Pelanggan (pelanggan_id, pelanggan_name, pelanggan_address, supplier_id) VALUES (1, 'Galang', 'Jalan Sesetan', 1);
INSERT INTO Pelanggan (pelanggan_id, pelanggan_name, pelanggan_address, supplier_id) VALUES (6, 'John Doe', 'Jalan Jalan', 1);


INSERT INTO Pembelian (IdPembelian, JumlahPembelian, IdPengguna, IdSupplier, IdBarang) VALUES (2, 100, 1, 1, 1);
INSERT INTO Pembelian (IdPembelian, JumlahPembelian, IdPengguna, IdSupplier, IdBarang) VALUES (5, 50, 1, 1, 8);
INSERT INTO Pembelian (IdPembelian, JumlahPembelian, IdPengguna, IdSupplier, IdBarang) VALUES (6, 1, 1, 1, 9);

INSERT INTO Pengguna (IdPengguna, NamaPengguna, Password, NamaDepan, NamaBelakang, NoHp, Alamat, IdAkses) VALUES (1, 'Galang', '123123', 'Galang', 'Ardian', '081231293', 'Jalan Sesetan', 1);
INSERT INTO Pengguna (IdPengguna, NamaPengguna, Password, NamaDepan, NamaBelakang, NoHp, Alamat, IdAkses) VALUES (2, 'Ardian', '123123', 'Ardian', 'Rafly', '0812386123', 'Jalan Jalan ', 1);

INSERT INTO Penjualan (IdPenjualan, JumlahPenjualan, IdPengguna, IdPelanggan, IdBarang) VALUES (5, 100, 1, 1, 1);
INSERT INTO Penjualan (IdPenjualan, JumlahPenjualan, IdPengguna, IdPelanggan, IdBarang) VALUES (7, 40, 1, 1, 8);
INSERT INTO Penjualan (IdPenjualan, JumlahPenjualan, IdPengguna, IdPelanggan, IdBarang) VALUES (9, 1, 1, 1, 9);

INSERT INTO supplier (supplier_id, supplier_name, supplier_address) VALUES (1, 'Supplier 1', 'Jalan Supllier 1');
