create table User
(
    id int not null primary key auto_increment,
    username varchar(255) not null,
    mail varchar(255) not null,
    password varchar(255) not null,
    role varchar(255) default 'user',
    token varchar(255),
    collocationId int 
);

create table Collocation
(
    id int not null primary key auto_increment,
    nom varchar(255) not null,
    adresse varchar(255) not null,
    datetime datetime not null
);

create table Depense
(
    id int not null primary key auto_increment,
    montant int not null,
    description varchar(255) not null,
    preuve text not null,
    userId int not null,
    collocationId int not null,
    datetime datetime not null
);

alter table Depense add constraint foreign key (userId) references User(id);

alter table Depense add constraint foreign key (collocationId) references Collocation(id);

alter table User add constraint foreign key (collocationId) references Collocation(id);