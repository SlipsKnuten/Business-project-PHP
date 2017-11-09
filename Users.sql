DROP DATABASE skidloppet1;
CREATE DATABASE skidloppet1;
USE skidloppet1;

create table lopp(
	ordningsnr		integer,
    namn			varchar(255),
    starttid		datetime,
	typ				varchar(255),
    klubbkrav	 	bool,
    distans			varchar(255),
    primary key (ordningsnr)
    
)engine=innodb;


create table users(
	kundnr 		int	auto_increment,
    usrMail 	varchar(255),
    usrPw 		varchar(255),
    fornamn		varchar(255),
    efternamn	varchar(255),
    mobilnr		integer,
    primary key (kundnr)
)engine = innodb;

create table adress(
	kundnr		integer,
    gata		varchar(255),
    postnr		integer,
    land		varchar(255),
    hemnummer	integer,
    primary key (kundnr),
    
    constraint FK_adress_users
	FOREIGN KEY (kundnr)
    REFERENCES users(kundnr)
    on delete cascade
    )engine=innodb;


create table loppanmalan(
	kundnr		integer,
    ordningsnr 	integer,
    startnr		varchar(10),
    primary key (kundnr, ordningsnr, startnr),
    
    constraint FK_loppanmalan_users
    foreign key	(kundnr)
    references users(kundnr)
    on delete cascade,
		
    constraint FK_loppanmalan_lopp
    foreign key	(ordningsnr)
    references lopp(ordningsnr)
    on delete cascade

)engine=innodb;



create table splitar(
	kundnr			integer,
    ordningsnr		integer,
    hedemora		time,
    norrhyttan		time,
    bondhyttan		time,
    bommansbo		time,
    smedjebacken	time,
    bjorsjo			time,
    grangesberg		time,
    primary key (kundnr, ordningsnr),
    
    constraint FK_splitar_users
    foreign key (kundnr)
    references users(kundnr)
    on delete cascade,
    
    constraint FK_splitar_lopp
    foreign key (ordningsnr)
    references lopp(ordningsnr)
    on delete cascade

)engine=innodb;

create table tillval(
	kundnr		integer,
    ordningsnr	integer,
    startnr		varchar(10) NOT NULL,	#Fattar inte varför vi inte kan lägga till FK på denna
    diplom		bool,
    forsakring	bool,
    bussbiljett	bool,
    V1			bool,
    V2			bool,
    V3			bool,
    V4			bool,
    V5			bool,
    primary key (kundnr, ordningsnr),
    
    constraint FK_tillval_users
    foreign key (kundnr)
	references users(kundnr)
    on delete cascade,
        
    constraint FK_tillval_lopp
    foreign key (ordningsnr)
    references lopp(ordningsnr)
    on delete cascade
)engine=innodb;

create table feedback(
	ordningsnr integer,
    kundnr integer,
    fraga_1 smallint,
	fraga_2 smallint,
	fraga_3 smallint,
	fraga_4 smallint,
	fraga_5 smallint,
    kommentar varchar(255),
    primary key (ordningsnr, kundnr),
    
    
    constraint FK_feedback_users
    foreign key (kundnr)
    references users(kundnr)
    on delete cascade,
    
    constraint FK_feedback_lopp
    foreign key (ordningsnr)
    references lopp(ordningsnr)
    on delete cascade
    
)engine=innodb;

insert into lopp values ('1', 'Dalloppet', '2017-11-07 08:00:00', 'skidlopp', '1', 'fulldistans');

insert into users(usrMail, usrPw) values('mail','password');

select * from lopp;
insert into lopp values ('2', 'Dalloppet', '2017-11-07 08:00:00 AM', 'skidlopp', '0', 'öppet spår');
insert into lopp values ('3', 'Dalloppet halva', '2017-11-07 08:00:00 AM', 'skidlopp', '0', 'halv');
insert into lopp values ('4', 'Dalloppet tjej', '2017-11-07 08:00:00 AM', 'skidlopp', '1', 'halv');
insert into lopp values ('5', 'Dalloppet kort', '2017-11-07 08:00:00 AM', 'skidlopp', '0', 'tredjedel');
insert into lopp values ('6', 'stafetten', '2017-11-07 08:00:00 AM', 'skidlopp', '1', 'full');

insert into users(usrMail, usrPw, fornamn, efternamn, mobilnr) values ('melker@hotmail.com', 'längdskida', 'Melker', 'Schörling', '070-2335899');
insert into users(usrMail, usrPw, fornamn, efternamn, mobilnr) values ('bananen@hotmail.com', 'staven', 'Bo', 'Hedman', '070-2345898');
insert into users(usrMail, usrPw, fornamn, efternamn, mobilnr) values ('snusen@hotmail.com', 'valla', 'Martin', 'Svensson', '070-2325779');
insert into users(usrMail, usrPw, fornamn, efternamn, mobilnr) values ('apan@hotmail.com', 'snöbacken', 'Tommy', 'Larsson', '070-2126777');

insert into adress values ('1', 'stolpvägen 1', '521 31', 'Sverige', '0515-52131');
insert into adress values ('2', 'banvägen 1', '522 58', 'Sverige', '0500-50010');
insert into adress values ('3', 'handelsvägen 1', '517 99', 'Sverige', '0500-60058');
insert into adress values ('4', 'Sun road', 'Zzzzyy', 'USA', 'Xxxxyyy');
insert into adress values ('5', 'Storvägen 1', '525 60', 'Sverige', '08-523 58 99');

insert into loppanmalan values ('1', '1', '10001');
insert into loppanmalan values ('2', '1', '10002');
insert into loppanmalan values ('3', '1', '10003');
insert into loppanmalan values ('4', '1', '10004');
insert into loppanmalan values ('5', '1', '10005');

insert into splitar values ('1', '1', '4:15', '5:30', '6:00', '5:20', '5:40', '6:55', '6:30');
insert into splitar values ('2', '1', '5:15', '5:20', '5:50', '5:17', '5:42', '5:40', '5:30');
insert into splitar values ('3', '1', '4:30', '5:10', '6:10', '5:22', '5:38', '6:20', '4:30');
insert into splitar values ('4', '1', '5:05', '5:40', '4:20', '4:58', '5:30', '4:58', '4:30');
insert into splitar values ('5', '1', '4:50', '5:30', '5:15', '5:03', '5:32', '5:30', '5:30');

insert into tillval values ('1', '1', '10001', '1', '1', '1', '1', '0', '0', '0', '0');
insert into tillval values ('2', '1', '10002', '1', '1', '1', '0', '1', '0', '0', '0');
insert into tillval values ('3', '1', '10003', '1', '1', '1', '0', '0', '1', '0', '0');
insert into tillval values ('4', '1', '10004', '1', '1', '1', '0', '0', '0', '1', '0');
insert into tillval values ('5', '1', '10005', '1', '1', '1', '0', '0', '0', '0', '1');

insert into feedback values ('1', '1', '1', '2', '3', '4', '5', 'test');
insert into feedback values ('1', '2', '2', '3', '3', '4', '4', 'test');
insert into feedback values ('1', '3', '5', '4', '4', '3', '3', 'test');
insert into feedback values ('1', '4', '5', '5', '5', '5', '3', 'test');
insert into feedback values ('1', '5', '3', '3', '4', '2', '3', 'test');

select * from lopp;
select * from users;
select * from adress;
select * from loppanmalan;
select * from splitar;
select * from tillval;
select * from feedback;