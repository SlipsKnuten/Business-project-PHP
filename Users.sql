DROP DATABASE skidloppet_AB1;
CREATE DATABASE skidloppet_AB1;
USE skidloppet_AB1;

create table skidlopp(
	ordningsnr		varchar(255),
    namn			varchar(255),
    starttid		datetime,
	typ				varchar(255),
    klubbkrav	 	varchar(255),
    distans			varchar(255),
    pris			varchar(255),
    grans1			int, #ny kolumn
    grans2			int, #ny kolumn
    primary key (ordningsnr)
    
)engine=innodb;

create table mtblopp(
	ordningsnr		varchar(255),
    namn			varchar(255),
    starttid		datetime,
	typ				varchar(255),
    klubbkrav	 	bool,
    distans			varchar(255),
    pris			varchar(255),
    grans1			int, #ny kolumn
    grans2			int, #ny kolumn
    primary key (ordningsnr)
    
)engine=innodb;

create table loplopp(
	ordningsnr		varchar(255),
    namn			varchar(255),
    starttid		datetime,
	typ				varchar(255),
    klubbkrav	 	bool,
    distans			varchar(255),
    pris			varchar(255),
    grans1			int, #ny kolumn
    grans2			int, #ny kolumn
    primary key (ordningsnr)
    
)engine=innodb;


create table users(
	kundnr 		int	auto_increment,
    usrMail 	varchar(255),
    usrPw 		varchar(255),
    fornamn		varchar(255),
    efternamn	varchar(255),
    mobilnr		varchar(255),
    kon			varchar(255),
    alder		varchar(255),
    adress		varchar(255),
	stad		varchar(255),
    land		varchar(255),
    klubb		varchar(255),
    typperson	smallint default 1, #ny kolumn
    primary key (kundnr)
)engine = innodb;

create table admin(
	adminName	varchar(255),
    adminPW		varchar(255),
    primary key (adminName)
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


create table loppanmalan_lop(
	kundnr		integer,
    ordningsnr 	varchar(255),
    startnr		INT,
    namn1		varchar(255),
    namn2		varchar(255),
    namn3		varchar(255),
    namn4		varchar(255),
    namn5		varchar(255),
    namn6		varchar(255),
    primary key (kundnr, startnr, ordningsnr),
    
    constraint FK_loppanmalan_lop_users
    foreign key (kundnr)
    references users(kundnr)
    on delete cascade
        
)engine=innodb;



create table loppanmalan_mtb(
	kundnr		integer,
    ordningsnr 	varchar(255),
    startnr		INT,
    namn1		varchar(255),
    namn2		varchar(255),
    namn3		varchar(255),
    namn4		varchar(255),
    namn5		varchar(255),
    namn6		varchar(255),
    primary key (kundnr, startnr, ordningsnr),
    
    constraint FK_loppanmalan_mtb_users
    foreign key (kundnr)
    references users(kundnr)
    on delete cascade
    
)engine=innodb;

create table loppanmalan_skidor(
	kundnr		integer,
    ordningsnr 	varchar(255),
    startnr		INT,
    namn1		varchar(255),
    namn2		varchar(255),
    namn3		varchar(255),
    namn4		varchar(255),
    namn5		varchar(255),
    namn6		varchar(255),
    primary key (kundnr, startnr, ordningsnr),
    
    constraint FK_loppanmalan_skidor_users
    foreign key (kundnr)
    references users(kundnr)
    on delete cascade
        
)engine=innodb;

create table splitarInts( 
	kundnr			integer,
    ordningsnr		varchar(255),
    hedemora		int,
    norrhyttan		int,
    bondhyttan		int,
    bommansbo		int,
    smedjebacken	int,
    bjorsjo			int,
    grangesberg		int,
    primary key (kundnr, ordningsnr)
)engine=innodb;

create table seeding(
	kundnr			integer,
    ordningsnr		varchar(255),
	totaltime 		int,
    primary key (kundnr, ordningsnr)
)engine=innodb;

create table splitar(
	kundnr			integer,
    ordningsnr		varchar(255),
    hedemora		float,
    norrhyttan		float,
    bondhyttan		float,
    bommansbo		float,
    smedjebacken	float,
    bjorsjo			float,
    grangesberg		float,
    primary key (kundnr, ordningsnr)
    
    #foreign key (kundnr) references users(kundnr)
    
)engine=innodb;

create table artiklar_valla(
id 					int auto_increment,
namn				varchar(255),
varde				varchar(255),
beskrivning			varchar(255),
primary key(id)
)engine=innodb;

create table artiklar_diplom(
id 					int auto_increment,	
namn				varchar(255),
varde				varchar(255),
beskrivning			varchar(255),
primary key(id)
)engine=innodb;

create table artiklar_biljett(
id 					int auto_increment,
namn				varchar(255),
varde				varchar(255),
beskrivning			varchar(255),
primary key(id)
)engine=innodb;

create table artiklar_forsakring(
id 					int auto_increment,
namn				varchar(255),
varde				varchar(255),
beskrivning			varchar(255),
primary key(id)
)engine=innodb;

create table artiklar_langning(
id 					int auto_increment,
namn				varchar(255),
varde				varchar(255),
beskrivning			varchar(255),
primary key(id)
)engine=innodb;

create table artiklar_tshirt(
id 					int auto_increment,
namn				varchar(255),
varde				varchar(255),
beskrivning			varchar(255),
primary key(id)
)engine=innodb;

create table tillval_lop(
	kundnr		integer,
    ordningsnr	varchar(255),
    startnr		int,	#Fattar inte varför vi inte kan lägga till FK på denna
    diplom		integer,
    forsakring	integer,
    bussbiljett	integer,
    valla 		integer,
    langning	integer,
    
    primary key (startnr, kundnr, ordningsnr),
    
    
    
    constraint FK_loppanmalan_lop_tillval_lop
    foreign key (kundnr, startnr)
    references loppanmalan_lop(kundnr, startnr)
    on delete cascade,
    
    constraint FK_tillval_lop_diplom
    foreign key (diplom) 
    references artiklar_diplom(id),
    
    constraint FK_tillval_lop_forsakring
    foreign key (forsakring)
    references artiklar_forsakring(id),
    
    constraint FK_tillval_lop_biljett
    foreign key (bussbiljett)
    references artiklar_biljett(id),
    
    constraint FK_tillval_lop_valla
    foreign key (valla)
    references artiklar_valla(id),
    
    constraint FK_tillval_lop_langning
    foreign key (langning)
    references artiklar_langning(id)
        
)engine=innodb;

create table tillval_skidor(
	kundnr		integer,
    ordningsnr 	varchar(255),	#Fattar inte varför vi inte kan lägga till FK på denna
    startnr		int,
    diplom		integer,
    forsakring	integer,
    bussbiljett	integer,
    valla 		integer,
    langning	integer,
     
    primary key (startnr, kundnr, ordningsnr),
	
    constraint FK_loppanmalan_skidor_tillval_skidor
    foreign key (kundnr, startnr)
    references loppanmalan_skidor(kundnr, startnr)
    on delete cascade,
    
    constraint FK_tillval_skidor_diplom
    foreign key (diplom) 
    references artiklar_diplom(id),
    
    constraint FK_tillval_skidor_forsakring
    foreign key (forsakring)
    references artiklar_forsakring(id),
    
    constraint FK_tillval_skidor_biljett
    foreign key (bussbiljett)
    references artiklar_biljett(id),
    
    constraint FK_tillval_skidor_valla
    foreign key (valla)
    references artiklar_valla(id),
    
    constraint FK_tillval_skidor_langning
    foreign key (langning)
    references artiklar_langning(id)
               
)engine=innodb;

create table tillval_mtb(
	kundnr		integer,
    ordningsnr	varchar(255),
    startnr		int,	#Fattar inte varför vi inte kan lägga till FK på denna
    diplom		integer,
    forsakring	integer,
    bussbiljett	integer,
    valla 		integer,
    langning	integer,
    
    primary key (kundnr, ordningsnr),
    
    constraint FK_loppanmalan_mtb_tillval_mtb
    foreign key (kundnr, startnr)
    references loppanmalan_mtb(kundnr, startnr)
    on delete cascade,
    
    constraint FK_tillval_mtb_diplom
    foreign key (diplom) 
    references artiklar_diplom(id),
    
    constraint FK_tillval_mtb_forsakring
    foreign key (forsakring)
    references artiklar_forsakring(id),
    
    constraint FK_tillval_mtb_biljett
    foreign key (bussbiljett)
    references artiklar_biljett(id),
    
    constraint FK_tillval_mtb_valla
    foreign key (valla)
    references artiklar_valla(id),
    
    constraint FK_tillval_mtb_langning
    foreign key (langning)
    references artiklar_langning(id)
        
)engine=innodb;

select * from tillval_skidor;

#select * from loppanmalan_lop;

#delete from loppanmalan_mtb where kundnr = '23' and ordningsnr = 'm2';

#delete from tillval_mtb where startnr = '10013';

create table feedback(
	#ordningsnr integer,
    #kundnr integer,
    feedbacknr int auto_increment,
    fraga_1 varchar(255),
	fraga_2 varchar(255),
	fraga_3 varchar(255),
	fraga_4 varchar(255),
	#fraga_5 varchar(255),
    kommentar varchar(255),
    lopp varchar(255),
    primary key (feedbacknr)
       
)engine=innodb;

DELIMITER $$
create trigger addtotaltime after insert on splitarInts 
for each row 
begin
declare t1 int;
set t1 = new.hedemora + new.norrhyttan + new.bondhyttan + new.bommansbo + new.smedjebacken + new.bjorsjo + new.grangesberg;
insert into seeding (kundnr, ordningsnr, totaltime) values (new.kundnr, new.ordningsnr, t1);

end$$
//
DELIMITER ;

 #typperson 1=ny användare, 2=har statistik för minst ett lopp, 3=veteran, är just nu manuellt inlaggt 4=elit, även det manuellt
DELIMITER $$
create trigger changetypperson after insert on seeding 
for each row 
begin
if (select typperson from users where users.typperson<2 and users.kundnr=new.kundnr) then
	update users set users.typperson=2 where users.kundnr=new.kundnr;
end if;
end$$
//
DELIMITER ;

DELIMITER //
CREATE PROCEDURE mbtseedning(INkundnr integer, INordnr varchar(255))
BEGIN
declare t5 integer;

	if (select typperson from users where users.typperson=1 and INkundnr=users.kundnr) then
		set t5 = (SELECT FLOOR(RAND()*(5000-4000+1))+4000);
		insert into loppanmalan_mtb(kundnr, ordningsnr, startnr) values (INkundnr, INordnr, t5);
        
    elseIF (select typperson from users, seeding, mtblopp where users.typperson=2 and INkundnr=users.kundnr and INkundnr=seeding.kundnr 
		and INordnr=mtblopp.ordningsnr and seeding.totaltime < mtblopp.grans1) then
        set t5 = (SELECT FLOOR(RAND()*(1999-1000+1))+1000);
		insert into loppanmalan_mtb(kundnr, ordningsnr, startnr) values (INkundnr, INordnr, t5);
        
	elseif (select typperson from users, seeding, mtblopp where users.typperson=2 and INkundnr=users.kundnr and INkundnr=seeding.kundnr 
		and INordnr=mtblopp.ordningsnr and seeding.totaltime > mtblopp.grans1 and seeding.totaltime < mtblopp.grans2) then
        set t5 = (SELECT FLOOR(RAND()*(2999-2000+1))+2000);
		insert into loppanmalan_mtb(kundnr, ordningsnr, startnr) values (INkundnr, INordnr, t5);
        
	elseif (select typperson from users, seeding, mtblopp where users.typperson=2 and INkundnr=users.kundnr and INkundnr=seeding.kundnr 
		and INordnr=mtblopp.ordningsnr and seeding.totaltime > mtblopp.grans2) then
        set t5 = (SELECT FLOOR(RAND()*(3999-3000+1))+3000);
		insert into loppanmalan_mtb(kundnr, ordningsnr, startnr) values (INkundnr, INordnr, t5);

	elseIF (select typperson from users where users.typperson=3 and INkundnr=users.kundnr) then
		set t5 = (SELECT FLOOR(RAND()*(999-200+1))+200);
		insert into loppanmalan_mtb(kundnr, ordningsnr, startnr) values (INkundnr, INordnr, t5);
        
     elseIF (select typperson from users where users.typperson=4 and INkundnr=users.kundnr) then
		set t5 = (SELECT FLOOR(RAND()*(00200-0+1))+0);
		insert into loppanmalan_mtb(kundnr, ordningsnr, startnr) values (INkundnr, INordnr, t5);
	END IF;
END//

DELIMITER ;

DELIMITER //
CREATE PROCEDURE lopseedning(INkundnr integer, INordnr varchar(255))
BEGIN
declare t5 integer;

	if (select typperson from users where users.typperson=1 and INkundnr=users.kundnr) then
		set t5 = (SELECT FLOOR(RAND()*(5000-4000+1))+4000);
		insert into loppanmalan_lop(kundnr, ordningsnr, startnr) values (INkundnr, INordnr, t5);
        
    elseIF (select typperson from users, seeding, loplopp where users.typperson=2 and INkundnr=users.kundnr and INkundnr=seeding.kundnr 
		and INordnr=loplopp.ordningsnr and seeding.totaltime < loplopp.grans1) then
        set t5 = (SELECT FLOOR(RAND()*(1999-1000+1))+1000);
		insert into loppanmalan_lop(kundnr, ordningsnr, startnr) values (INkundnr, INordnr, t5);
        
	elseif (select typperson from users, seeding, loplopp where users.typperson=2 and INkundnr=users.kundnr and INkundnr=seeding.kundnr 
		and INordnr=loplopp.ordningsnr and seeding.totaltime > loplopp.grans1 and seeding.totaltime < loplopp.grans2) then
        set t5 = (SELECT FLOOR(RAND()*(2999-2000+1))+2000);
		insert into loppanmalan_lop(kundnr, ordningsnr, startnr) values (INkundnr, INordnr, t5);
        
	elseif (select typperson from users, seeding, loplopp where users.typperson=2 and INkundnr=users.kundnr and INkundnr=seeding.kundnr 
		and INordnr=loplopp.ordningsnr and seeding.totaltime > loplopp.grans2) then
        set t5 = (SELECT FLOOR(RAND()*(3999-3000+1))+3000);
		insert into loppanmalan_lop(kundnr, ordningsnr, startnr) values (INkundnr, INordnr, t5);

	elseIF (select typperson from users where users.typperson=3 and INkundnr=users.kundnr) then
		set t5 = (SELECT FLOOR(RAND()*(999-200+1))+200);
		insert into loppanmalan_lop(kundnr, ordningsnr, startnr) values (INkundnr, INordnr, t5);
        
     elseIF (select typperson from users where users.typperson=4 and INkundnr=users.kundnr) then
		set t5 = (SELECT FLOOR(RAND()*(00200-0+1))+0);
		insert into loppanmalan_lop(kundnr, ordningsnr, startnr) values (INkundnr, INordnr, t5);
	END IF;
END//

DELIMITER ;


DELIMITER //
CREATE PROCEDURE skidorseedning(INkundnr integer, INordnr varchar(255))
BEGIN
declare t5 integer;

	if (select typperson from users where users.typperson=1 and INkundnr=users.kundnr) then
		set t5 = (SELECT FLOOR(RAND()*(5000-4000+1))+4000);
		insert into loppanmalan_skidor(kundnr, ordningsnr, startnr) values (INkundnr, INordnr, t5);
        
    elseIF (select typperson from users, seeding, skidlopp where users.typperson=2 and INkundnr=users.kundnr and INkundnr=seeding.kundnr 
		and INordnr=skidlopp.ordningsnr and seeding.totaltime < skidlopp.grans1) then
        set t5 = (SELECT FLOOR(RAND()*(1999-1000+1))+1000);
		insert into loppanmalan_skidor(kundnr, ordningsnr, startnr) values (INkundnr, INordnr, t5);
        
	elseif (select typperson from users, seeding, skidlopp where users.typperson=2 and INkundnr=users.kundnr and INkundnr=seeding.kundnr 
		and INordnr=skidlopp.ordningsnr and seeding.totaltime > skidlopp.grans1 and seeding.totaltime < skidlopp.grans2) then
        set t5 = (SELECT FLOOR(RAND()*(2999-2000+1))+2000);
		insert into loppanmalan_skidor(kundnr, ordningsnr, startnr) values (INkundnr, INordnr, t5);
        
	elseif (select typperson from users, seeding, skidlopp where users.typperson=2 and INkundnr=users.kundnr and INkundnr=seeding.kundnr 
		and INordnr=skidlopp.ordningsnr and seeding.totaltime > skidlopp.grans2) then
        set t5 = (SELECT FLOOR(RAND()*(3999-3000+1))+3000);
		insert into loppanmalan_skidor(kundnr, ordningsnr, startnr) values (INkundnr, INordnr, t5);

	elseIF (select typperson from users where users.typperson=3 and INkundnr=users.kundnr) then
		set t5 = (SELECT FLOOR(RAND()*(999-200+1))+200);
		insert into loppanmalan_skidor(kundnr, ordningsnr, startnr) values (INkundnr, INordnr, t5);
        
     elseIF (select typperson from users where users.typperson=4 and INkundnr=users.kundnr) then
		set t5 = (SELECT FLOOR(RAND()*(00200-0+1))+0);
		insert into loppanmalan_skidor(kundnr, ordningsnr, startnr) values (INkundnr, INordnr, t5);
	END IF;
END//

DELIMITER ;



insert into admin values ('Henke', 'test');
insert into admin values ('Valla-Kalle', 'test');
insert into admin values ('Langar-Mehmet', 'fest');
insert into admin values ('Buss-Masse', 'hest');

insert into artiklar_valla(namn, varde, beskrivning) values ('Inga valla vald', '0', 'Du kör på eget');
insert into artiklar_valla(namn, varde, beskrivning) values ('Endast glidvalnllning, LF', '400', 'Helt OK valla');
insert into artiklar_valla(namn, varde, beskrivning) values ('Endast glidvallning, HF', '500', 'Bra valla');
insert into artiklar_valla(namn, varde, beskrivning) values ('Komplett vallning, LF', '550', 'Väldigt bra valla' );
insert into artiklar_valla(namn, varde, beskrivning) values ('Komplett vallning, HF', '700', 'Löjligt bra valla');
insert into artiklar_valla(namn, varde, beskrivning) values ('Värstingvalla flourpulver', '1000', 'Fantastiskt mäktig valla');

insert into artiklar_langning(namn, varde, beskrivning) values ('Ingen langning vald', '0', 'Kör du med eget material?');
insert into artiklar_langning(namn, varde, beskrivning) values ('Känn dig som en björn', '500', 'Björnar är starkare än människor!');
insert into artiklar_langning(namn, varde, beskrivning) values ('Åk som ett proffs', '900', 'Prestera bättre än en björn!');

#select * from artiklar_langning;

insert into artiklar_diplom(namn, varde, beskrivning) values ('Inget diplom valt', '0', 'Om du anser detta onödigt');
insert into artiklar_diplom(namn, varde, beskrivning) values ('Utan ram', '100', 'Få diplomet utan ram');
insert into artiklar_diplom(namn, varde, beskrivning) values ('Med björkram', '150', 'Vacker björkram runtom');
insert into artiklar_diplom(namn, varde, beskrivning) values ('Med ekram', '200', 'Vacker ekram runtom');

insert into artiklar_biljett(namn, varde, beskrivning) values ('Ingen biljett vald', '0', 'Ta dig själv till loppet');
insert into artiklar_biljett(namn, varde, beskrivning) values ('Biljett', '50', 'Biljett till & från lopp');

insert into artiklar_forsakring(namn, varde, beskrivning) values ('Ingen försäkring', '0', 'Vid sjukdom - Inga pengar tillbaka');
insert into artiklar_forsakring(namn, varde, beskrivning) values ('Försäkring', '100', 'Vid sjukdom - Pengarna tillbaka');

insert into artiklar_tshirt(namn, varde, beskrivning) values ('Ingen tshirt', '0', 'Ingen t-shirt');
insert into artiklar_tshirt(namn, varde, beskrivning) values ('En brun tshirt', '750', 'Brun tshirt i bästa material');
insert into artiklar_tshirt(namn, varde, beskrivning) values ('En blå tshirt', '750', 'Blå tshirt i bästa material');
insert into artiklar_tshirt(namn, varde, beskrivning) values ('En svart tshirt', '750', 'Svart tshirt i bästa material');

select * from artiklar_tshirt; 

insert into skidlopp values ('s1', 'Dalloppet', '2018-01-07 08:00:00 AM', 'skidlopp', 'nej', 'öppet_spår', '500', '', '');
insert into skidlopp values ('s2', 'Dalloppet', '2018-01-07 08:00:00 AM', 'skidlopp', 'nej', 'halv', '250', '', '');
insert into skidlopp values ('s3', 'Dalloppet', '2018-01-08 08:00:00 AM', 'skidlopp', 'ja', 'halv', '250', '', '');
insert into skidlopp values ('s4', 'Dalloppet', '2018-01-08 08:00:00 AM', 'skidlopp', 'nej', 'tredjedel', '125', '', '');
insert into skidlopp values ('s5', 'Stafetten', '2018-01-08 08:00:00 AM', 'skidlopp', 'ja', 'full', '1000', '', '');

insert into mtblopp values ('m1', 'Dalloppet', '2018-07-07 08:00:00 AM', 'mtb', 'ja', 'kvart', '100', '', '');
insert into mtblopp values ('m2', 'Dalloppet', '2018-07-07 08:00:00 AM', 'mtb', 'nej', 'halv', '200', '', '');
insert into mtblopp values ('m3', 'Stafetten', '2018-07-07 08:00:00 AM', 'mtb', 'nej', 'full', '400', '', '');
insert into mtblopp values ('m4', 'Stafetten', '2018-07-07 08:00:00 AM', 'mtb', 'ja', 'full', '400', '', '');

insert into loplopp values ('l1', 'Dalloppet', '2018-05-07 08:00:00 AM', 'löplopp', 'nej', 'full', '400', '', '');
insert into loplopp values ('l2', 'Dalloppet', '2018-05-07 08:00:00 AM', 'löplopp', 'ja', 'halv', '200', '', '');
insert into loplopp values ('l3', 'Stafetten', '2018-05-07 08:00:00 AM', 'löplopp', 'ja', 'kvart', '100', '', '');
insert into loplopp values ('l4', 'Stafetten', '2018-05-07 08:00:00 AM', 'löplopp', 'nej', 'full', '400', '', '');

insert into users(usrMail, usrPw, fornamn, efternamn, mobilnr, kon, alder, adress, stad, land, klubb) values ('melker@hotmail.com', 'längdskida', 'Melker', 'Schörling', '0515-52131', 'man', '20', 'avägen 1 54146','stockholm', 'sverige', 'boden sk');
insert into users(usrMail, usrPw, fornamn, efternamn, mobilnr, kon, alder, adress, stad, land, klubb) values ('bananen@hotmail.com', 'staven', 'Lina', 'Andersson', '0500-50010', 'kvinna','25', 'bvägen 1 54146', 'stockholm', 'sverige', 'boden sk');
insert into users(usrMail, usrPw, fornamn, efternamn, mobilnr, kon, alder, adress, stad, land, klubb) values ('snusen@hotmail.com', 'valla', 'Martin', 'Svensson', '0500-60058', 'man','27', 'cvägen 1 54146', 'stockholm', 'sverige', 'boden sk');
insert into users(usrMail, usrPw, fornamn, efternamn, mobilnr, kon, alder, adress, stad, land, klubb) values ('apan@hotmail.com', 'snöbacken', 'Karin', 'Bengtsson', '070-2126777', 'kvinna','32', 'dvägen 1 54146', 'stockholm', 'sverige', 'boden sk');
insert into users(usrMail, usrPw, fornamn, efternamn, mobilnr, kon, alder, adress, stad, land, klubb) values ('Mats@hotmail.com', 'kanten', 'Mats', 'Johansson', '08-523 58 97', 'man', '20', 'evägen 1 54146','stockholm', 'sverige', 'boden sk');
insert into users(usrMail, usrPw, fornamn, efternamn, mobilnr, kon, alder, adress, stad, land, klubb) values ('Linus@hotmail.com', 'ramen', 'Linus', 'Gustafsson', '08-523 57 89', 'kvinna', '18', 'fvägen 1 54146','abo', 'finland', 'skittu sk');
insert into users(usrMail, usrPw, fornamn, efternamn, mobilnr, kon, alder, adress, stad, land, klubb) values ('Henrik3@hotmail.com', 'eken', 'Henrik', 'Nilsson', '08-523 56 70', 'man','55', 'gvägen 1 54146', 'skagen', 'danmark', 'jylland sk');
insert into users(usrMail, usrPw, fornamn, efternamn, mobilnr, kon, alder, adress, stad, land, klubb) values ('Hans@hotmail.com', 'melon', 'Hans', 'Johansson', '08-522 58 60', 'man', '35', 'hvägen 1 54146','bergen', 'norge', 'halden sk');
insert into users(usrMail, usrPw, fornamn, efternamn, mobilnr, kon, alder, adress, stad, land, klubb) values ('Karin@hotmail.com', 'apelson', 'Karin', 'Nilsson', '08-523 55 65', 'man', '37', 'ivägen 1 54146','oslo', 'norge', 'oslo sk');
insert into users(usrMail, usrPw, fornamn, efternamn, mobilnr, kon, alder, adress, stad, land, klubb) values ('Tina@hotmail.com', 'banan', 'Tina', 'Svensson', '08-523 54 75', 'kvinna', '40', 'jvägen 1 54146','calcutta', 'indien', 'calcutta sk');
insert into users(usrMail, usrPw, fornamn, efternamn, mobilnr, kon, alder, adress, stad, land, klubb) values ('johanpersson@hotmail.com', 'längdskida', 'Johan', 'Persson', '0515-52132', 'man', '20', 'kvägen 1 54146','bergen', 'norge', 'halden sk');
insert into users(usrMail, usrPw, fornamn, efternamn, mobilnr, kon, alder, adress, stad, land, klubb) values ('bollen10@hotmail.com', 'staven', 'Laban', 'Andersson', '0500-50099', 'man','25', 'lvägen 1 54146', 'bergen', 'norge', 'halden sk');
insert into users(usrMail, usrPw, fornamn, efternamn, mobilnr, kon, alder, adress, stad, land, klubb) values ('snusarn@hotmail.com', 'valla', 'Martina', 'Svensson', '0500-60059', 'kvinna','27', 'mvägen 1 54146', 'bergen', 'norge', 'stavanger sk');
insert into users(usrMail, usrPw, fornamn, efternamn, mobilnr, kon, alder, adress, stad, land, klubb) values ('kakan@hotmail.com', 'snöbacken', 'Karin', 'Bengtsson', '070-2126765', 'kvinna','32', 'nvägen 1 54146', 'bergen', 'norge', 'bergen sk');
insert into users(usrMail, usrPw, fornamn, efternamn, mobilnr, kon, alder, adress, stad, land, klubb) values ('Matteus@hotmail.com', 'kanten', 'Matteus', 'Johansson', '08-510 58 97', 'man', '20', 'ovägen 1 54146','oslo', 'norge', 'bergen sk');
insert into users(usrMail, usrPw, fornamn, efternamn, mobilnr, kon, alder, adress, stad, land, klubb) values ('joppe@hotmail.com', 'ramen', 'jesper', 'Gustafsson', '08-523 54 89', 'man', '18', 'pvägen 1 54146','oslo', 'norge', 'molle sk');
insert into users(usrMail, usrPw, fornamn, efternamn, mobilnr, kon, alder, adress, stad, land, klubb) values ('Henrik2@hotmail.com', 'eken', 'Kajsa', 'Nilsson', '08-523 56 71', 'kvinna','55', 'svägen 1 54146', 'oslo', 'norge', 'fredrikstad sk');
insert into users(usrMail, usrPw, fornamn, efternamn, mobilnr, kon, alder, adress, stad, land, klubb) values ('Mattias@hotmail.com', 'melon', 'Mattias', 'Johansson', '08-510 58 69', 'man','35', 'tvägen 1 54146', 'trondheim', 'norge', 'trondheim sk');
insert into users(usrMail, usrPw, fornamn, efternamn, mobilnr, kon, alder, adress, stad, land, klubb) values ('karina@hotmail.com', 'apelson', 'Karina', 'Nilsson', '08-523 55 61', 'kvinna','34', 'zvägen 1 54146', 'halden', 'norge', 'halden sk');
insert into users(usrMail, usrPw, fornamn, efternamn, mobilnr, kon, alder, adress, stad, land, klubb) values ('Tintin@hotmail.com', 'banan', 'Katrina', 'Svensson', '08-523 54 71', 'kvinna','33', 'xvägen 1 54146', 'sarsborg', 'norge', 'sarpsborg sk');
insert into users(usrMail, usrPw, fornamn, efternamn, mobilnr, kon, alder, adress, stad, land, klubb) values ('kent@hotmail.com', 'plast', 'Kent', 'Persson', '08-521333', 'man','60', 'wvägen 1 54146', 'stockholm', 'sverige', 'AIK');
insert into users(usrMail, usrPw, fornamn, efternamn, mobilnr, kon, alder, adress, stad, land, klubb) values ('Jens@hotmail.com', 'blomma', 'Jens', 'Matsson', '08-522131', 'man', '55', 'yvägen 1 54146','stockholm', 'sverige', 'AIK');

SELECT * FROM users WHERE alder >= 15 and alder <= 25;

insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Nöjd', 'Missnöjd', 'hej hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'nej', 'm3');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 'm2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Nöjd', 'Nöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Nöjd', 'Nöjd', 'Nöjd', 'hej hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'Fick ingen langning', 'l2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Nöjd', 'Missnöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'Loppet var för långt.', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Nöjd', 'Nöjd', 'hej hej', 'l2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Mycket missnöjd', 'Mycket Missnöjd', 'Missnöjd', 'Det var för kallt ute.', 'm2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Nöjd', 'Missnöjd', 'Nöjd', 'hej hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Nöjd', 'Nöjd', 'Missnöjd', 'hej hej', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Nöjd', 'Nöjd', 'Missnöjd', 'hej hej', 'm3');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej', 'm2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Nöjd', 'Nöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Nöjd', 'Nöjd', 'Nöjd', 'hej hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'Fick ingen langning', 'l2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Nöjd', 'Vädret var för kallt.', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Nöjd', 'Missnöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Nöjd', 'Nöjd', 'hej hej', 'l2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Mycket missnöjd', 'Mycket missnöjd', 'Missnöjd', 'Det var för kallt ute.', 'm2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Nöjd', 'Missnöjd', 'Nöjd', 'hej hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Mycket nöjd', 'Missnöjd', 'hej hej', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Nöjd', 'Missnöjd', 'hej hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Nöjd', 'nej', 'm3');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 'm2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Nöjd', 'Nöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Nöjd', 'Nöjd', 'Nöjd', 'hej hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'Fick ingen langning', 'l2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Nöjd', 'Nöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'Loppet var för långt.', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Nöjd', 'Nöjd', 'hej hej', 'l2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Mycket missnöjd', 'Mycket missnöjd', 'Missnöjd', 'Det var för kallt ute.', 'm2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Nöjd', 'Missnöjd', 'Nöjd', 'hej hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Nöjd', 'Nöjd', 'Missnöjd', 'hej hej', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Nöjd', 'Nöjd', 'Missnöjd', 'hej hej', 'm3');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej', 'm2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Nöjd', 'Nöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Nöjd', 'Nöjd', 'Nöjd', 'hej hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Nöjd', 'Missnöjd', 'hej hej', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'Fick ingen langning', 'l2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Nöjd', 'Vädret var för kallt.', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Nöjd', 'Nöjd', 'hej hej', 'l2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Mycket missnöjd', 'Mycket missnöjd', 'Nöjd', 'Det var för kallt ute.', 'm2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Nöjd', 'Missnöjd', 'Nöjd', 'hej hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Mycket nöjd', 'Missnöjd', 'hej hej', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Nöjd', 'Missnöjd', 'hej hej', 's3');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'nej', 'm3');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 'm2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Nöjd', 'Nöjd', 'hej hej', 's3');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Nöjd', 'Nöjd', 'Nöjd', 'hej hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'Fick ingen langning', 'l3');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Nöjd', 'Missnöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'Loppet var för långt.', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Nöjd', 'Nöjd', 'hej hej', 'l2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Mycket missnöjd', 'Mycket missnöjd', 'Missnöjd', 'Det var för kallt ute.', 'm2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Nöjd', 'Missnöjd', 'Nöjd', 'hej hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Nöjd', 'Nöjd', 'Missnöjd', 'hej hej', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Nöjd', 'Nöjd', 'Missnöjd', 'hej hej', 'm1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej', 'm2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Nöjd', 'Nöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Nöjd', 'Nöjd', 'Nöjd', 'hej hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'Fick ingen langning', 'l2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Nöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Nöjd', 'Vädret var för kallt.', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Nöjd', 'Missnöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Nöjd', 'Nöjd', 'hej hej', 'l3');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Mycket missnöjd', 'Mycket missnöjd', 'Missnöjd', 'Det var för kallt ute.', 'm2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Nöjd', 'Missnöjd', 'Nöjd', 'hej hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Mycket nöjd', 'Missnöjd', 'hej hej', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Nöjd', 'Missnöjd', 'hej hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Nöjd', 'nej', 'm3');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Missnöjd', 'Nöjd', 'hej hej', 'm2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 's3');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Nöjd', 'Nöjd', 'hej hej', 's3');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Nöjd', 'Nöjd', 'Nöjd', 'hej hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Nöjd', 'hej hej', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'Fick ingen langning', 'l2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Nöjd', 'Nöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'Loppet var för långt.', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Nöjd', 'Missnöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Nöjd', 'Nöjd', 'hej hej', 'l2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Mycket missnöjd', 'Mycket missnöjd', 'Missnöjd', 'Det var för kallt ute.', 'm2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Nöjd', 'Missnöjd', 'Nöjd', 'hej hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Nöjd', 'Nöjd', 'Missnöjd', 'hej hej', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Nöjd', 'Nöjd', 'Missnöjd', 'hej hej', 'm3');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej', 'm2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej', 's3');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Nöjd', 'Nöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Nöjd', 'Nöjd', 'Nöjd', 'hej hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Nöjd', 'Missnöjd', 'hej hej', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Nöjd', 'Missnöjd', 'Fick ingen langning', 'l2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Nöjd', 'Vädret var för kallt.', 'l3');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'hej hej', 's2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Nöjd', 'Nöjd', 'hej hej', 'l2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Mycket missnöjd', 'Mycket missnöjd', 'Nöjd', 'Det var för kallt ute.', 'm2');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Nöjd', 'Missnöjd', 'Nöjd', 'hej hej', 's1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Mycket nöjd', 'Missnöjd', 'hej hej', 'l3');


insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Mycket missnöjd', 'Mycket missnöjd', 'Mycket missnöjd', 'Mycket missnöjd', 'hej hej', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Mycket missnöjd', 'Mycket missnöjd', 'Mycket missnöjd', 'Missnöjd', 'hej hej', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Mycket missnöjd', 'Mycket missnöjd', 'Mycket missnöjd', 'Nöjd', 'hej hej', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Mycket missnöjd', 'Mycket missnöjd', 'Mycket missnöjd', 'Mycket nöjd', 'hej hej', 'l1');





insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'test', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Nöjd', 'Nöjd', 'Nöjd', 'blah blah', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Mycket nöjd', 'Mycket nöjd', 'Mycket nöjd', 'Mycket nöjd', 'test', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Mycket missnöjd', 'Mycket missnöjd', 'Mycket missnöjd', 'Mycket missnöjd', 'hej hej', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'Hoppsan!', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Nöjd', 'Nöjd', 'Nöjd', 'Kallt hela dagen', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Mycket nöjd', 'Mycket nöjd', 'Mycket nöjd', 'Mycket nöjd', 'test', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Mycket missnöjd', 'Mycket missnöjd', 'Mycket missnöjd', 'Mycket missnöjd', 'hej hej', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Missnöjd', 'Missnöjd', 'Missnöjd', 'Missnöjd', 'Hoppsan!', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Nöjd', 'Nöjd', 'Nöjd', 'Nöjd', 'Kallt hela dagen', 'l1');
insert into feedback(fraga_1, fraga_2, fraga_3, fraga_4, kommentar, lopp) values ('Mycket nöjd', 'Mycket nöjd', 'Mycket nöjd', 'Mycket nöjd', 'test', 'l1');











create view feedback_lop as
select *
from feedback, loplopp
where feedback.lopp=loplopp.ordningsnr;

create view feedback_mtb as
select *
from feedback, mtblopp
where feedback.lopp=mtblopp.ordningsnr;

create view feedback_skidor as
select *
from feedback, skidlopp
where feedback.lopp=skidlopp.ordningsnr;

#select * from feedback_skidor;
#select * from feedback_mtb;
#select * from feedback_lop;

#select count(fraga_1) from feedback_skidor where fraga_1 = 'Missnöjd';

insert into adress values ('1', 'stolpvägen 1', '521 31', 'Sverige', '0515-52131');
insert into adress values ('2', 'banvägen 1', '522 58', 'Sverige', '0500-50010');
insert into adress values ('3', 'handelsvägen 1', '517 99', 'Sverige', '0500-60058');
insert into adress values ('4', 'Sun road', 'Zzzzyy', 'USA', 'Xxxxyyy');
insert into adress values ('5', 'Storvägen 1', '535 50', 'Sverige', '08-523 58 97');
insert into adress values ('6', 'måsvägen 1', '545 65', 'Grekland', '08-523 57 89');
insert into adress values ('7', 'trädvägen 1', '555 75', 'Sverige', '08-523 56 70');
insert into adress values ('8', 'Asfaltsvägen 1', '565 40', 'Tyskland', '08-522 58 60');
insert into adress values ('9', 'Skogsvägen 1', '575 30', 'Sverige', '08-523 55 65');
insert into adress values ('10', 'Fiskvägen 1', '585 40', 'Sverige', '08-523 54 75');

insert into loppanmalan_skidor values('1', 's1', '10001', '', '', '', '', '', '');
insert into loppanmalan_skidor values('2', 's1', '10002', '', '', '', '', '', '');
insert into loppanmalan_skidor values('3', 's1', '10003', '', '', '', '', '', '');
insert into loppanmalan_skidor values('4', 's1', '10004', '', '', '', '', '', '');
insert into loppanmalan_skidor values('5', 's1', '10005', '', '', '', '', '', '');
insert into loppanmalan_skidor values('6', 's1', '10006', '', '', '', '', '', '');
insert into loppanmalan_skidor values('7', 's1', '10007', '', '', '', '', '', '');
insert into loppanmalan_skidor values('8', 's1', '10008', '', '', '', '', '', '');
insert into loppanmalan_skidor values('9', 's1', '10009', '', '', '', '', '', '');
insert into loppanmalan_skidor values('10', 's1', '10010', '', '', '', '', '', '');
insert into loppanmalan_skidor values('11', 's1', '10011', '', '', '', '', '', '');
insert into loppanmalan_skidor values('12', 's1', '10012', '', '', '', '', '', '');
insert into loppanmalan_skidor values('13', 's1', '10013', '', '', '', '', '', '');
insert into loppanmalan_skidor values('14', 's1', '10014', '', '', '', '', '', '');
insert into loppanmalan_skidor values('15', 's1', '10015', '', '', '', '', '', '');
insert into loppanmalan_skidor values('16', 's1', '10016', '', '', '', '', '', '');
insert into loppanmalan_skidor values('17', 's1', '10017', '', '', '', '', '', '');
insert into loppanmalan_skidor values('18', 's1', '10018', '', '', '', '', '', '');
insert into loppanmalan_skidor values('19', 's1', '10019', '', '', '', '', '', '');
insert into loppanmalan_skidor values('20', 's1', '10020', '', '', '', '', '', '');

insert into loppanmalan_skidor values('1', 's2', '10001', '', '', '', '', '', '');
insert into loppanmalan_skidor values('2', 's2', '10002', '', '', '', '', '', '');
insert into loppanmalan_skidor values('3', 's2', '10003', '', '', '', '', '', '');
insert into loppanmalan_skidor values('4', 's2', '10004', '', '', '', '', '', '');
insert into loppanmalan_skidor values('5', 's2', '10005', '', '', '', '', '', '');
insert into loppanmalan_skidor values('6', 's2', '10006', '', '', '', '', '', '');
insert into loppanmalan_skidor values('7', 's2', '10007', '', '', '', '', '', '');
insert into loppanmalan_skidor values('8', 's2', '10008', '', '', '', '', '', '');
insert into loppanmalan_skidor values('9', 's2', '10009', '', '', '', '', '', '');
insert into loppanmalan_skidor values('10', 's2', '10010', '', '', '', '', '', '');

insert into loppanmalan_skidor values('1', 's3', '10001', '', '', '', '', '', '');
insert into loppanmalan_skidor values('2', 's3', '10002', '', '', '', '', '', '');
insert into loppanmalan_skidor values('3', 's3', '10003', '', '', '', '', '', '');
insert into loppanmalan_skidor values('4', 's3', '10004', '', '', '', '', '', '');
insert into loppanmalan_skidor values('5', 's3', '10005', '', '', '', '', '', '');
insert into loppanmalan_skidor values('6', 's3', '10006', '', '', '', '', '', '');
insert into loppanmalan_skidor values('7', 's3', '10007', '', '', '', '', '', '');
insert into loppanmalan_skidor values('8', 's3', '10008', '', '', '', '', '', '');
insert into loppanmalan_skidor values('9', 's3', '10009', '', '', '', '', '', '');
insert into loppanmalan_skidor values('10', 's3', '10010', '', '', '', '', '', '');

insert into loppanmalan_skidor values('1', 's4', '10001', '', '', '', '', '', '');
insert into loppanmalan_skidor values('2', 's4', '10002', '', '', '', '', '', '');
insert into loppanmalan_skidor values('3', 's4', '10003', '', '', '', '', '', '');
insert into loppanmalan_skidor values('4', 's4', '10004', '', '', '', '', '', '');
insert into loppanmalan_skidor values('5', 's4', '10005', '', '', '', '', '', '');
insert into loppanmalan_skidor values('6', 's4', '10006', '', '', '', '', '', '');
insert into loppanmalan_skidor values('7', 's4', '10007', '', '', '', '', '', '');
insert into loppanmalan_skidor values('8', 's4', '10008', '', '', '', '', '', '');
insert into loppanmalan_skidor values('9', 's4', '10009', '', '', '', '', '', '');
insert into loppanmalan_skidor values('10', 's4', '10010', '', '', '', '', '', '');

insert into loppanmalan_skidor values('1', 's5', '10001', '', '', '', '', '', '');
insert into loppanmalan_skidor values('2', 's5', '10002', '', '', '', '', '', '');
insert into loppanmalan_skidor values('3', 's5', '10003', '', '', '', '', '', '');
insert into loppanmalan_skidor values('4', 's5', '10004', '', '', '', '', '', '');
insert into loppanmalan_skidor values('5', 's5', '10005', '', '', '', '', '', '');
insert into loppanmalan_skidor values('6', 's5', '10006', '', '', '', '', '', '');
insert into loppanmalan_skidor values('7', 's5', '10007', '', '', '', '', '', '');
insert into loppanmalan_skidor values('8', 's5', '10008', '', '', '', '', '', '');
insert into loppanmalan_skidor values('9', 's5', '10009', '', '', '', '', '', '');
insert into loppanmalan_skidor values('10', 's5', '10010', '', '', '', '', '', '');

insert into tillval_skidor values ('1', 's1', '10001', '1', '1', '2', '1', '2');
insert into tillval_skidor values ('2', 's1', '10002', '2', '1', '2', '2', '2');
insert into tillval_skidor values ('3', 's1', '10003','2', '2', '1', '3', '2');
insert into tillval_skidor values ('4', 's1', '10004','2', '2', '2', '4', '3');
insert into tillval_skidor values ('5', 's1', '10005','4 ', '2', '2', '5', '3');
insert into tillval_skidor values ('6', 's1', '10006','3', '2', '2', '6 ', '3');
insert into tillval_skidor values ('7', 's1', '10007', '3', '2', '1', '1', '2');
insert into tillval_skidor values ('8', 's1', '10008', '3', '1', '1', '3', '1');
insert into tillval_skidor values ('9', 's1', '10009','3', '1', '1', '4', '1');
insert into tillval_skidor values ('10', 's1', '10010','1', '1', '1', '3', '1');
insert into tillval_skidor values ('11', 's1', '10011', '1', '1', '2', '1', '2');
insert into tillval_skidor values ('12', 's1', '10012', '2', '1', '2', '2', '2');
insert into tillval_skidor values ('13', 's1', '10013','2', '2', '1', '3', '2');
insert into tillval_skidor values ('14', 's1', '10014','2', '2', '2', '4', '3');
insert into tillval_skidor values ('15', 's1', '10015','4 ', '2', '2', '5', '3');
insert into tillval_skidor values ('16', 's1', '10016','3', '2', '2', '6 ', '3');
insert into tillval_skidor values ('17', 's1', '10017', '1', '1', '1', '1', '2');
insert into tillval_skidor values ('18', 's1', '10018', '3', '2', '1', '3', '1');
insert into tillval_skidor values ('19', 's1', '10019','3', '2', '1', '4', '1');
insert into tillval_skidor values ('20', 's1', '10020','1', '2', '1', '3', '1');

insert into tillval_skidor values ('1', 's2', '10001', '1', '1', '2', '1', '2');
insert into tillval_skidor values ('2', 's2', '10002', '2', '1', '2', '2', '2');
insert into tillval_skidor values ('3', 's2', '10003','2', '2', '1', '3', '2');
insert into tillval_skidor values ('4', 's2', '10004','2', '2', '2', '4', '3');
insert into tillval_skidor values ('5', 's2', '10005','4 ', '2', '2', '5', '3');
insert into tillval_skidor values ('6', 's2', '10006','3', '2', '2', '6 ', '3');
insert into tillval_skidor values ('7', 's2', '10007', '3', '2', '1', '1', '2');
insert into tillval_skidor values ('8', 's2', '10008', '3', '1', '1', '3', '1');
insert into tillval_skidor values ('9', 's2', '10009','3', '1', '1', '4', '1');
insert into tillval_skidor values ('10', 's2', '10010','1', '1', '1', '3', '1');

insert into tillval_skidor values ('1', 's3', '10001', '1', '1', '2', '1', '2');
insert into tillval_skidor values ('2', 's3', '10002', '2', '1', '2', '2', '2');
insert into tillval_skidor values ('3', 's3', '10003','2', '2', '1', '3', '2');
insert into tillval_skidor values ('4', 's3', '10004','2', '2', '2', '4', '3');
insert into tillval_skidor values ('5', 's3', '10005','4 ', '2', '2', '5', '3');
insert into tillval_skidor values ('6', 's3', '10006','3', '2', '2', '6 ', '3');
insert into tillval_skidor values ('7', 's3', '10007', '3', '2', '1', '1', '2');
insert into tillval_skidor values ('8', 's3', '10008', '3', '1', '1', '3', '1');
insert into tillval_skidor values ('9', 's3', '10009','3', '1', '1', '4', '1');
insert into tillval_skidor values ('10', 's3', '10010','1', '1', '1', '3', '1');

insert into tillval_skidor values ('1', 's4', '10001', '1', '1', '2', '1', '2');
insert into tillval_skidor values ('2', 's4', '10002', '2', '1', '2', '2', '2');
insert into tillval_skidor values ('3', 's4', '10003','2', '2', '1', '3', '2');
insert into tillval_skidor values ('4', 's4', '10004','2', '2', '2', '4', '3');
insert into tillval_skidor values ('5', 's4', '10005','4 ', '2', '2', '5', '3');
insert into tillval_skidor values ('6', 's4', '10006','3', '2', '2', '6 ', '3');
insert into tillval_skidor values ('7', 's4', '10007', '3', '2', '1', '1', '2');
insert into tillval_skidor values ('8', 's4', '10008', '3', '1', '1', '3', '1');
insert into tillval_skidor values ('9', 's4', '10009','3', '1', '1', '4', '1');
insert into tillval_skidor values ('10', 's4', '10010','1', '1', '1', '3', '1');

insert into tillval_skidor values ('1', 's5', '10001', '1', '1', '2', '1', '2');
insert into tillval_skidor values ('2', 's5', '10002', '2', '1', '2', '2', '2');
insert into tillval_skidor values ('3', 's5', '10003','2', '2', '1', '3', '2');
insert into tillval_skidor values ('4', 's5', '10004','2', '2', '2', '4', '3');
insert into tillval_skidor values ('5', 's5', '10005','4 ', '2', '2', '5', '3');
insert into tillval_skidor values ('6', 's5', '10006','3', '2', '2', '6 ', '3');
insert into tillval_skidor values ('7', 's5', '10007', '3', '2', '1', '1', '2');
insert into tillval_skidor values ('8', 's5', '10008', '3', '1', '1', '3', '1');
insert into tillval_skidor values ('9', 's5', '10009','3', '1', '1', '4', '1');
insert into tillval_skidor values ('10', 's5', '10010','1', '1', '1', '3', '1');

insert into loppanmalan_lop values('1', 'l1', '10001', '', '', '', '', '', '');
insert into loppanmalan_lop values('2', 'l1', '10002', '', '', '', '', '', '');
insert into loppanmalan_lop values('3', 'l1', '10003', '', '', '', '', '', '');
insert into loppanmalan_lop values('4', 'l1', '10004', '', '', '', '', '', '');
insert into loppanmalan_lop values('5', 'l1', '10005', '', '', '', '', '', '');
insert into loppanmalan_lop values('6', 'l1', '10006', '', '', '', '', '', '');
insert into loppanmalan_lop values('7', 'l1', '10007', '', '', '', '', '', '');
insert into loppanmalan_lop values('8', 'l1', '10008', '', '', '', '', '', '');
insert into loppanmalan_lop values('9', 'l1', '10009', '', '', '', '', '', '');
insert into loppanmalan_lop values('10', 'l1', '10010', '', '', '', '', '', '');

insert into loppanmalan_lop values('1', 'l2', '10001', '', '', '', '', '', '');
insert into loppanmalan_lop values('2', 'l2', '10002', '', '', '', '', '', '');
insert into loppanmalan_lop values('3', 'l2', '10003', '', '', '', '', '', '');
insert into loppanmalan_lop values('4', 'l2', '10004', '', '', '', '', '', '');
insert into loppanmalan_lop values('5', 'l2', '10005', '', '', '', '', '', '');
insert into loppanmalan_lop values('6', 'l2', '10006', '', '', '', '', '', '');
insert into loppanmalan_lop values('7', 'l2', '10007', '', '', '', '', '', '');
insert into loppanmalan_lop values('8', 'l2', '10008', '', '', '', '', '', '');
insert into loppanmalan_lop values('9', 'l2', '10009', '', '', '', '', '', '');
insert into loppanmalan_lop values('10', 'l2', '10010', '', '', '', '', '', '');

insert into loppanmalan_lop values('1', 'l3', '10001', '', '', '', '', '', '');
insert into loppanmalan_lop values('2', 'l3', '10002', '', '', '', '', '', '');
insert into loppanmalan_lop values('3', 'l3', '10003', '', '', '', '', '', '');
insert into loppanmalan_lop values('4', 'l3', '10004', '', '', '', '', '', '');
insert into loppanmalan_lop values('5', 'l3', '10005', '', '', '', '', '', '');
insert into loppanmalan_lop values('6', 'l3', '10006', '', '', '', '', '', '');
insert into loppanmalan_lop values('7', 'l3', '10007', '', '', '', '', '', '');
insert into loppanmalan_lop values('8', 'l3', '10008', '', '', '', '', '', '');
insert into loppanmalan_lop values('9', 'l3', '10009', '', '', '', '', '', '');
insert into loppanmalan_lop values('10', 'l3', '10010', '', '', '', '', '', '');

insert into loppanmalan_lop values('1', 'l4', '10001', '', '', '', '', '', '');
insert into loppanmalan_lop values('2', 'l4', '10002', '', '', '', '', '', '');
insert into loppanmalan_lop values('3', 'l4', '10003', '', '', '', '', '', '');
insert into loppanmalan_lop values('4', 'l4', '10004', '', '', '', '', '', '');
insert into loppanmalan_lop values('5', 'l4', '10005', '', '', '', '', '', '');
insert into loppanmalan_lop values('6', 'l4', '10006', '', '', '', '', '', '');
insert into loppanmalan_lop values('7', 'l4', '10007', '', '', '', '', '', '');
insert into loppanmalan_lop values('8', 'l4', '10008', '', '', '', '', '', '');
insert into loppanmalan_lop values('9', 'l4', '10009', '', '', '', '', '', '');
insert into loppanmalan_lop values('10', 'l4', '10010', '', '', '', '', '', '');

insert into tillval_lop values ('1', 'l1', '10001', '1', '1', '1', '1', '2');
insert into tillval_lop values ('2', 'l1', '10002', '1', '1', '1', '3', '1');
insert into tillval_lop values ('3', 'l1', '10003','2', '1', '1', '1', '2');
insert into tillval_lop values ('4', 'l1', '10004','2', '1', '1', '2', '1');
insert into tillval_lop values ('5', 'l1', '10005','2', '1', '1', '1', '2');
insert into tillval_lop values ('6', 'l1', '10006', '1', '2', '1', '1', '1');
insert into tillval_lop values ('7', 'l1', '10007', '1', '2', '1', '3', '2');
insert into tillval_lop values ('8', 'l1', '10008','2', '2', '1', '1', '1');
insert into tillval_lop values ('9', 'l1', '10009','1', '2', '1', '2', '2');
insert into tillval_lop values ('10', 'l1', '10010','1', '2', '1', '1', '1');

insert into tillval_lop values ('1', 'l2', '10001', '1', '1', '1', '1', '2');
insert into tillval_lop values ('2', 'l2', '10002', '1', '1', '1', '3', '1');
insert into tillval_lop values ('3', 'l2', '10003','2', '1', '1', '1', '1');
insert into tillval_lop values ('4', 'l2', '10004','2', '1', '1', '2', '1');
insert into tillval_lop values ('5', 'l2', '10005','2', '1', '1', '1', '1');
insert into tillval_lop values ('6', 'l2', '10006', '1', '2', '1', '1', '1');
insert into tillval_lop values ('7', 'l2', '10007', '1', '2', '1', '3', '2');
insert into tillval_lop values ('8', 'l2', '10008','2', '2', '1', '1', '1');
insert into tillval_lop values ('9', 'l2', '10009','2', '2', '1', '2', '2');
insert into tillval_lop values ('10', 'l2', '10010','2', '2', '1', '1', '1');

insert into tillval_lop values ('1', 'l3', '10001', '1', '1', '1', '1', '2');
insert into tillval_lop values ('2', 'l3', '10002', '1', '1', '1', '3', '1');
insert into tillval_lop values ('3', 'l3', '10003','2', '1', '1', '1', '1');
insert into tillval_lop values ('4', 'l3', '10004','2', '1', '1', '2', '1');
insert into tillval_lop values ('5', 'l3', '10005','1', '2', '1', '1', '2');
insert into tillval_lop values ('6', 'l3', '10006', '1', '2', '1', '1', '1');
insert into tillval_lop values ('7', 'l3', '10007', '1', '2', '1', '3', '2');
insert into tillval_lop values ('8', 'l3', '10008','2', '1', '1', '1', '1');
insert into tillval_lop values ('9', 'l3', '10009','1', '2', '1', '2', '2');
insert into tillval_lop values ('10', 'l3', '10010','1', '2', '1', '1', '1');

insert into tillval_lop values ('1', 'l4', '10001', '1', '1', '1', '1', '2');
insert into tillval_lop values ('2', 'l4', '10002', '1', '1', '1', '3', '1');
insert into tillval_lop values ('3', 'l4', '10003','2', '1', '1', '1', '2');
insert into tillval_lop values ('4', 'l4', '10004','2', '1', '1', '2', '1');
insert into tillval_lop values ('5', 'l4', '10005','1', '1', '1', '1', '2');
insert into tillval_lop values ('6', 'l4', '10006', '1', '2', '1', '1', '1');
insert into tillval_lop values ('7', 'l4', '10007', '1', '2', '1', '3', '2');
insert into tillval_lop values ('8', 'l4', '10008','2', '2', '1', '1', '2');
insert into tillval_lop values ('9', 'l4', '10009','1', '2', '1', '2', '2');
insert into tillval_lop values ('10', 'l4', '10010','1', '2', '1', '1', '1');

insert into loppanmalan_mtb values('1', 'm1', '10001', '', '', '', '', '', '');
insert into loppanmalan_mtb values('2', 'm1', '10002', '', '', '', '', '', '');
insert into loppanmalan_mtb values('3', 'm1', '10003', '', '', '', '', '', '');
insert into loppanmalan_mtb values('4', 'm1', '10004', '', '', '', '', '', '');
insert into loppanmalan_mtb values('5', 'm1', '10005', '', '', '', '', '', '');
insert into loppanmalan_mtb values('6', 'm1', '10006', '', '', '', '', '', '');
insert into loppanmalan_mtb values('7', 'm1', '10007', '', '', '', '', '', '');
insert into loppanmalan_mtb values('8', 'm1', '10008', '', '', '', '', '', '');
insert into loppanmalan_mtb values('9', 'm1', '10009', '', '', '', '', '', '');
insert into loppanmalan_mtb values('10', 'm1', '10010', '', '', '', '', '', '');

insert into loppanmalan_mtb values('1', 'm2', '10001', '', '', '', '', '', '');
insert into loppanmalan_mtb values('2', 'm2', '10002', '', '', '', '', '', '');
insert into loppanmalan_mtb values('3', 'm2', '10003', '', '', '', '', '', '');
insert into loppanmalan_mtb values('4', 'm2', '10004', '', '', '', '', '', '');
insert into loppanmalan_mtb values('5', 'm2', '10005', '', '', '', '', '', '');
insert into loppanmalan_mtb values('6', 'm2', '10006', '', '', '', '', '', '');
insert into loppanmalan_mtb values('7', 'm2', '10007', '', '', '', '', '', '');
insert into loppanmalan_mtb values('8', 'm2', '10008', '', '', '', '', '', '');
insert into loppanmalan_mtb values('9', 'm2', '10009', '', '', '', '', '', '');
insert into loppanmalan_mtb values('10', 'm2', '10010', '', '', '', '', '', '');

insert into loppanmalan_mtb values('1', 'm3', '10001', '', '', '', '', '', '');
insert into loppanmalan_mtb values('2', 'm3', '10002', '', '', '', '', '', '');
insert into loppanmalan_mtb values('3', 'm3', '10003', '', '', '', '', '', '');
insert into loppanmalan_mtb values('4', 'm3', '10004', '', '', '', '', '', '');
insert into loppanmalan_mtb values('5', 'm3', '10005', '', '', '', '', '', '');
insert into loppanmalan_mtb values('6', 'm3', '10006', '', '', '', '', '', '');
insert into loppanmalan_mtb values('7', 'm3', '10007', '', '', '', '', '', '');
insert into loppanmalan_mtb values('8', 'm3', '10008', '', '', '', '', '', '');
insert into loppanmalan_mtb values('9', 'm3', '10009', '', '', '', '', '', '');
insert into loppanmalan_mtb values('10', 'm3', '10010', '', '', '', '', '', '');

insert into loppanmalan_mtb values('1', 'm4', '10001', '', '', '', '', '', '');
insert into loppanmalan_mtb values('2', 'm4', '10002', '', '', '', '', '', '');
insert into loppanmalan_mtb values('3', 'm4', '10003', '', '', '', '', '', '');
insert into loppanmalan_mtb values('4', 'm4', '10004', '', '', '', '', '', '');
insert into loppanmalan_mtb values('5', 'm4', '10005', '', '', '', '', '', '');
insert into loppanmalan_mtb values('6', 'm4', '10006', '', '', '', '', '', '');
insert into loppanmalan_mtb values('7', 'm4', '10007', '', '', '', '', '', '');
insert into loppanmalan_mtb values('8', 'm4', '10008', '', '', '', '', '', '');
insert into loppanmalan_mtb values('9', 'm4', '10009', '', '', '', '', '', '');
insert into loppanmalan_mtb values('10', 'm4', '10010', '', '', '', '', '', '');

insert into tillval_mtb values ('1', 'm1', '10001', '1', '1', '1', '1', '1');
insert into tillval_mtb values ('2', 'm1', '10002', '1', '1', '1', '3', '1');
insert into tillval_mtb values ('3', 'm1', '10003','1', '2', '1', '1', '1');
insert into tillval_mtb values ('4', 'm1', '10004','1', '2', '1', '2', '1');
insert into tillval_mtb values ('5', 'm1', '10005','1', '2', '1', '1', '1');
insert into tillval_mtb values ('6', 'm1', '10006', '1', '2', '1', '1', '1');
insert into tillval_mtb values ('7', 'm1', '10007', '1', '2', '1', '3', '1');
insert into tillval_mtb values ('8', 'm1', '10008','1', '2', '1', '1', '1');
insert into tillval_mtb values ('9', 'm1', '10009','1', '2', '1', '2', '2');
insert into tillval_mtb values ('10', 'm1', '10010','2', '2', '2', '1', '2');

insert into tillval_mtb values ('1', 'm2', '10001', '1', '1', '1', '1', '1');
insert into tillval_mtb values ('2', 'm2', '10002', '1', '1', '1', '3', '1');
insert into tillval_mtb values ('3', 'm2', '10003','1', '2', '1', '1', '1');
insert into tillval_mtb values ('4', 'm2', '10004','1', '2', '1', '2', '1');
insert into tillval_mtb values ('5', 'm2', '10005','1', '2', '1', '1', '1');
insert into tillval_mtb values ('6', 'm2', '10006', '1', '2', '1', '1', '1');
insert into tillval_mtb values ('7', 'm2', '10007', '1', '2', '1', '3', '1');
insert into tillval_mtb values ('8', 'm2', '10008','1', '2', '1', '1', '1');
insert into tillval_mtb values ('9', 'm2', '10009','1', '2', '1', '2', '1');
insert into tillval_mtb values ('10', 'm2', '10010','2', '2', '2', '1', '2');

insert into tillval_mtb values ('1', 'm3', '10001', '1', '1', '1', '1', '2');
insert into tillval_mtb values ('2', 'm3', '10002', '1', '1', '1', '3', '2');
insert into tillval_mtb values ('3', 'm3', '10003','1', '2', '1', '1', '1');
insert into tillval_mtb values ('4', 'm3', '10004','1', '2', '1', '2', '1');
insert into tillval_mtb values ('5', 'm3', '10005','1', '2', '1', '1', '1');
insert into tillval_mtb values ('6', 'm3', '10006', '1', '2', '1', '1', '1');
insert into tillval_mtb values ('7', 'm3', '10007', '1', '2', '1', '3', '1');
insert into tillval_mtb values ('8', 'm3', '10008','1', '2', '1', '1', '1');
insert into tillval_mtb values ('9', 'm3', '10009','1', '2', '1', '2', '1');
insert into tillval_mtb values ('10', 'm3', '10010','2', '2', '2', '1', '2');

insert into tillval_mtb values ('1', 'm4', '10001', '1', '1', '1', '1', '1');
insert into tillval_mtb values ('2', 'm4', '10002', '1', '1', '1', '3', '1');
insert into tillval_mtb values ('3', 'm4', '10003','1', '2', '1', '1', '1');
insert into tillval_mtb values ('4', 'm4', '10004','1', '2', '1', '2', '1');
insert into tillval_mtb values ('5', 'm4', '10005','1', '2', '1', '1', '1');
insert into tillval_mtb values ('6', 'm4', '10006', '1', '2', '1', '1', '1');
insert into tillval_mtb values ('7', 'm4', '10007', '1', '2', '1', '3', '1');
insert into tillval_mtb values ('8', 'm4', '10008','1', '2', '1', '1', '1');
insert into tillval_mtb values ('9', 'm4', '10009','1', '2', '1', '2', '1');
insert into tillval_mtb values ('10', 'm4', '10010','2', '2', '2', '1', '2');

/*insert into adress values ('1', 'stolpvägen 1', '521 31', 'Sverige', '0515-52131');
insert into adress values ('2', 'banvägen 1', '522 58', 'Sverige', '0500-50010');
insert into adress values ('3', 'handelsvägen 1', '517 99', 'Sverige', '0500-60058');
insert into adress values ('4', 'Sun road', 'Zzzzyy', 'USA', 'Xxxxyyy');
insert into adress values ('5', 'Storvägen 1', '535 50', 'Sverige', '08-523 58 97');
insert into adress values ('6', 'måsvägen 1', '545 65', 'Grekland', '08-523 57 89');
insert into adress values ('7', 'trädvägen 1', '555 75', 'Sverige', '08-523 56 70');
insert into adress values ('8', 'Asfaltsvägen 1', '565 40', 'Tyskland', '08-522 58 60');
insert into adress values ('9', 'Skogsvägen 1', '575 30', 'Sverige', '08-523 55 65');
insert into adress values ('10', 'Fiskvägen 1', '585 40', 'Sverige', '08-523 54 75');*/

insert into splitar values ('1', 's1', '4.20', '5.10', '6.20', '5.30', '5.40', '7.10', '6.20');
insert into splitar values ('2', 's1', '5.15', '5.20', '5.50', '5.17', '5.42', '5.40', '5.30');
insert into splitar values ('3', 's1', '4.30', '5.10', '6.10', '5.22', '5.38', '6.20', '4.30');
insert into splitar values ('4', 's1', '5.05', '5.40', '4.20', '4.58', '5.30', '4.58', '4.30');
insert into splitar values ('5', 's1', '4.50', '5.30', '5.15', '5.03', '5.32', '5.30', '5.30');
insert into splitar values ('6', 's1', '4.30', '5.20', '5.25', '5.10', '5.35', '5.01', '5.01');
insert into splitar values ('7', 's1', '4.15', '5.50', '5.35', '5.15', '5.45', '4.50', '4.50');
insert into splitar values ('8', 's1', '4.45', '5.40', '5.05', '5.20', '5.30', '5.05', '4.55');
insert into splitar values ('9', 's1', '4.40', '5.35', '5.05', '5.18', '5.25', '5.15', '5.10');
insert into splitar values ('10', 's1', '4.10', '5.10', '5.20', '5.15', '6.10', '7.20', '5.40');
insert into splitar values ('11', 's1', '4.20', '5.10', '6.20', '5.30', '5.40', '7.10', '6.20');
insert into splitar values ('12', 's1', '5.15', '5.20', '5.50', '5.17', '5.42', '5.40', '5.30');
insert into splitar values ('13', 's1', '4.35', '5.15', '6.15', '5.27', '5.38', '6.20', '4.30');
insert into splitar values ('14', 's1', '5.05', '5.40', '4.20', '4.58', '5.30', '4.58', '4.30');
insert into splitar values ('15', 's1', '4.50', '5.30', '5.15', '5.03', '5.32', '5.30', '5.37');
insert into splitar values ('16', 's1', '4.30', '5.20', '5.25', '5.20', '5.35', '5.01', '5.01');
insert into splitar values ('17', 's1', '4.15', '5.55', '5.35', '5.25', '5.45', '4.50', '4.55');
insert into splitar values ('18', 's1', '4.45', '5.40', '5.05', '5.30', '5.30', '5.05', '4.55');
insert into splitar values ('19', 's1', '4.40', '5.35', '5.15', '5.38', '5.25', '5.15', '5.10');
insert into splitar values ('20', 's1', '4.20', '5.10', '5.20', '5.15', '6.10', '7,20', '5.40');

insert into splitar values ('1', 's2', '4.20', '5.10', '6.20', '5.30', '5.40', '7.10', '6.20');
insert into splitar values ('2', 's2', '5.15', '5.20', '5.50', '5.17', '5.42', '5.40', '5.30');
insert into splitar values ('3', 's2', '4.30', '5.10', '6.10', '5.22', '5.38', '6.20', '4.30');
insert into splitar values ('4', 's2', '5.05', '5.40', '4.20', '4.58', '5.30', '4.58', '4.30');
insert into splitar values ('5', 's2', '4.50', '5.30', '5.15', '5.03', '5.32', '5.30', '5.30');
insert into splitar values ('6', 's2', '4.30', '5.20', '5.25', '5.10', '5.35', '5.01', '5.01');
insert into splitar values ('7', 's2', '4.15', '5.50', '5.35', '5.15', '5.45', '4.50', '4.50');
insert into splitar values ('8', 's2', '4.45', '5.40', '5.05', '5.20', '5.30', '5.05', '4.55');
insert into splitar values ('9', 's2', '4.40', '5.35', '5.05', '5.18', '5.25', '5.15', '5.10');
insert into splitar values ('10', 's2', '4.10', '5.10', '5.20', '5.15', '6.10', '7.20', '5.40');
insert into splitar values ('11', 's2', '4.20', '5.10', '6.20', '5.30', '5.40', '7.10', '6.20');
insert into splitar values ('12', 's2', '5.15', '5.20', '5.50', '5.17', '5.42', '5.40', '5.30');
insert into splitar values ('13', 's2', '4.35', '5.15', '6.15', '5.27', '5.38', '6.20', '4.30');
insert into splitar values ('14', 's2', '5.05', '5.40', '4.20', '4.58', '5.30', '4.58', '4.30');
insert into splitar values ('15', 's2', '4.50', '5.30', '5.15', '5.03', '5.32', '5.30', '5.37');
insert into splitar values ('16', 's2', '4.30', '5.20', '5.25', '5.20', '5.35', '5.01', '5.01');
insert into splitar values ('17', 's2', '4.15', '5.55', '5.35', '5.25', '5.45', '4.50', '4.55');
insert into splitar values ('18', 's2', '4.45', '5.40', '5.05', '5.30', '5.30', '5.05', '4.55');
insert into splitar values ('19', 's2', '4.40', '5.35', '5.15', '5.38', '5.25', '5.15', '5.10');
insert into splitar values ('20', 's2', '4.2', '5.1', '5.2', '5.15', '6.1', '7,2', '5.4');

insert into splitar values ('1', 's3', '4.20', '5.10', '6.20', '5.30', '5.40', '7.10', '6.20');
insert into splitar values ('2', 's3', '5.15', '5.20', '5.50', '5.17', '5.42', '5.40', '5.30');
insert into splitar values ('3', 's3', '4.30', '5.10', '6.10', '5.22', '5.38', '6.20', '4.30');
insert into splitar values ('4', 's3', '5.05', '5.40', '4.20', '4.58', '5.30', '4.58', '4.30');
insert into splitar values ('5', 's3', '4.50', '5.30', '5.15', '5.03', '5.32', '5.30', '5.30');
insert into splitar values ('6', 's3', '4.30', '5.20', '5.25', '5.10', '5.35', '5.01', '5.01');
insert into splitar values ('7', 's3', '4.15', '5.50', '5.35', '5.15', '5.45', '4.50', '4.50');
insert into splitar values ('8', 's3', '4.45', '5.40', '5.05', '5.20', '5.30', '5.05', '4.55');
insert into splitar values ('9', 's3', '4.40', '5.35', '5.05', '5.18', '5.25', '5.15', '5.10');
insert into splitar values ('10', 's3', '4.10', '5.10', '5.20', '5.15', '6.10', '7.20', '5.40');
insert into splitar values ('11', 's3', '4.20', '5.10', '6.20', '5.30', '5.40', '7.10', '6.20');
insert into splitar values ('12', 's3', '5.15', '5.20', '5.50', '5.17', '5.42', '5.40', '5.30');
insert into splitar values ('13', 's3', '4.35', '5.15', '6.15', '5.27', '5.38', '6.20', '4.30');
insert into splitar values ('14', 's3', '5.05', '5.40', '4.20', '4.58', '5.30', '4.58', '4.30');
insert into splitar values ('15', 's3', '4.50', '5.30', '5.15', '5.03', '5.32', '5.30', '5.37');
insert into splitar values ('16', 's3', '4.30', '5.20', '5.25', '5.20', '5.35', '5.01', '5.01');
insert into splitar values ('17', 's3', '4.15', '5.55', '5.35', '5.25', '5.45', '4.50', '4.55');
insert into splitar values ('18', 's3', '4.45', '5.40', '5.05', '5.30', '5.30', '5.05', '4.55');
insert into splitar values ('19', 's3', '4.40', '5.35', '5.15', '5.38', '5.25', '5.15', '5.10');
insert into splitar values ('20', 's3', '4.20', '5.10', '5.20', '5.15', '6.10', '7,20', '5.40');

insert into splitar values ('1', 's4', '4.20', '5.10', '6.20', '5.30', '5.40', '7.10', '6.20');
insert into splitar values ('2', 's4', '5.15', '5.20', '5.50', '5.17', '5.42', '5.40', '5.30');
insert into splitar values ('3', 's4', '4.30', '5.10', '6.10', '5.22', '5.38', '6.20', '4.30');
insert into splitar values ('4', 's4', '5.05', '5.40', '4.20', '4.58', '5.30', '4.58', '4.30');
insert into splitar values ('5', 's4', '4.50', '5.30', '5.15', '5.03', '5.32', '5.30', '5.30');
insert into splitar values ('6', 's4', '4.30', '5.20', '5.25', '5.10', '5.35', '5.01', '5.01');
insert into splitar values ('7', 's4', '4.15', '5.50', '5.35', '5.15', '5.45', '4.50', '4.50');
insert into splitar values ('8', 's4', '4.45', '5.40', '5.05', '5.20', '5.30', '5.05', '4.55');
insert into splitar values ('9', 's4', '4.40', '5.35', '5.05', '5.18', '5.25', '5.15', '5.10');
insert into splitar values ('10', 's4', '4.10', '5.10', '5.20', '5.15', '6.10', '7.20', '5.40');
insert into splitar values ('11', 's4', '4.20', '5.10', '6.20', '5.30', '5.40', '7.10', '6.20');
insert into splitar values ('12', 's4', '5.15', '5.20', '5.50', '5.17', '5.42', '5.40', '5.30');
insert into splitar values ('13', 's4', '4.35', '5.15', '6.15', '5.27', '5.38', '6.20', '4.30');
insert into splitar values ('14', 's4', '5.05', '5.40', '4.20', '4.58', '5.30', '4.58', '4.30');
insert into splitar values ('15', 's4', '4.50', '5.30', '5.15', '5.03', '5.32', '5.30', '5.37');
insert into splitar values ('16', 's4', '4.30', '5.20', '5.25', '5.20', '5.35', '5.01', '5.01');
insert into splitar values ('17', 's4', '4.15', '5.55', '5.35', '5.25', '5.45', '4.50', '4.55');
insert into splitar values ('18', 's4', '4.45', '5.40', '5.05', '5.30', '5.30', '5.05', '4.55');
insert into splitar values ('19', 's4', '4.40', '5.35', '5.15', '5.38', '5.25', '5.15', '5.10');
insert into splitar values ('20', 's4', '4.20', '5.10', '5.20', '5.15', '6.10', '7,20', '5.40');

insert into splitar values ('1', 's5', '4.20', '5.10', '6.20', '5.30', '5.40', '7.10', '6.20');
insert into splitar values ('2', 's5', '5.15', '5.20', '5.50', '5.17', '5.42', '5.40', '5.30');
insert into splitar values ('3', 's5', '4.30', '5.10', '6.10', '5.22', '5.38', '6.20', '4.30');
insert into splitar values ('4', 's5', '5.05', '5.40', '4.20', '4.58', '5.30', '4.58', '4.30');
insert into splitar values ('5', 's5', '4.50', '5.30', '5.15', '5.03', '5.32', '5.30', '5.30');
insert into splitar values ('6', 's5', '4.30', '5.20', '5.25', '5.10', '5.35', '5.01', '5.01');
insert into splitar values ('7', 's5', '4.15', '5.50', '5.35', '5.15', '5.45', '4.50', '4.50');
insert into splitar values ('8', 's5', '4.45', '5.40', '5.05', '5.20', '5.30', '5.05', '4.55');
insert into splitar values ('9', 's5', '4.40', '5.35', '5.05', '5.18', '5.25', '5.15', '5.10');
insert into splitar values ('10', 's5', '4.10', '5.10', '5.20', '5.15', '6.10', '7.20', '5.40');
insert into splitar values ('11', 's5', '4.20', '5.10', '6.20', '5.30', '5.40', '7.10', '6.20');
insert into splitar values ('12', 's5', '5.15', '5.20', '5.50', '5.17', '5.42', '5.40', '5.30');
insert into splitar values ('13', 's5', '4.35', '5.15', '6.15', '5.27', '5.38', '6.20', '4.30');
insert into splitar values ('14', 's5', '5.05', '5.40', '4.20', '4.58', '5.30', '4.58', '4.30');
insert into splitar values ('15', 's5', '4.50', '5.30', '5.15', '5.03', '5.32', '5.30', '5.37');
insert into splitar values ('16', 's5', '4.30', '5.20', '5.25', '5.20', '5.35', '5.01', '5.01');
insert into splitar values ('17', 's5', '4.15', '5.55', '5.35', '5.25', '5.45', '4.50', '4.55');
insert into splitar values ('18', 's5', '4.45', '5.40', '5.05', '5.30', '5.30', '5.05', '4.55');
insert into splitar values ('19', 's5', '4.40', '5.35', '5.15', '5.38', '5.25', '5.15', '5.10');
insert into splitar values ('20', 's5', '4.2', '5.1', '5.2', '5.15', '6.1', '7,2', '5.4');

insert into splitar values ('1', 'm1', '4.20', '5.10', '6.20', '5.30', '5.40', '7.10', '6.20');
insert into splitar values ('2', 'm1', '5.15', '5.20', '5.50', '5.17', '5.42', '5.40', '5.30');
insert into splitar values ('3', 'm1', '4.30', '5.10', '6.10', '5.22', '5.38', '6.20', '4.30');
insert into splitar values ('4', 'm1', '5.05', '5.40', '4.20', '4.58', '5.30', '4.58', '4.30');
insert into splitar values ('5', 'm1', '4.50', '5.30', '5.15', '5.03', '5.32', '5.30', '5.30');
insert into splitar values ('6', 'm1', '4.30', '5.20', '5.25', '5.10', '5.35', '5.01', '5.01');
insert into splitar values ('7', 'm1', '4.15', '5.50', '5.35', '5.15', '5.45', '4.50', '4.50');
insert into splitar values ('8', 'm1', '4.45', '5.40', '5.05', '5.20', '5.30', '5.05', '4.55');
insert into splitar values ('9', 'm1', '4.40', '5.35', '5.05', '5.18', '5.25', '5.15', '5.10');
insert into splitar values ('10', 'm1', '4.10', '5.10', '5.20', '5.15', '6.10', '7.20', '5.40');
insert into splitar values ('11', 'm1', '4.20', '5.10', '6.20', '5.30', '5.40', '7.10', '6.20');
insert into splitar values ('12', 'm1', '5.15', '5.20', '5.50', '5.17', '5.42', '5.40', '5.30');
insert into splitar values ('13', 'm1', '4.35', '5.15', '6.15', '5.27', '5.38', '6.20', '4.30');
insert into splitar values ('14', 'm1', '5.05', '5.40', '4.20', '4.58', '5.30', '4.58', '4.30');
insert into splitar values ('15', 'm1', '4.50', '5.30', '5.15', '5.03', '5.32', '5.30', '5.37');
insert into splitar values ('16', 'm1', '4.30', '5.20', '5.25', '5.20', '5.35', '5.01', '5.01');
insert into splitar values ('17', 'm1', '4.15', '5.55', '5.35', '5.25', '5.45', '4.50', '4.55');
insert into splitar values ('18', 'm1', '4.45', '5.40', '5.05', '5.30', '5.30', '5.05', '4.55');
insert into splitar values ('19', 'm1', '4.40', '5.35', '5.15', '5.38', '5.25', '5.15', '5.10');
insert into splitar values ('20', 'm1', '4.20', '5.10', '5.20', '5.15', '6.10', '7,20', '5.40');

insert into splitar values ('1', 'm2', '4.20', '5.10', '6.20', '5.30', '5.40', '7.10', '6.20');
insert into splitar values ('2', 'm2', '5.15', '5.20', '5.50', '5.17', '5.42', '5.40', '5.30');
insert into splitar values ('3', 'm2', '4.30', '5.10', '6.10', '5.22', '5.38', '6.20', '4.30');
insert into splitar values ('4', 'm2', '5.05', '5.40', '4.20', '4.58', '5.30', '4.58', '4.30');
insert into splitar values ('5', 'm2', '4.50', '5.30', '5.15', '5.03', '5.32', '5.30', '5.30');
insert into splitar values ('6', 'm2', '4.30', '5.20', '5.25', '5.10', '5.35', '5.01', '5.01');
insert into splitar values ('7', 'm2', '4.15', '5.50', '5.35', '5.15', '5.45', '4.50', '4.50');
insert into splitar values ('8', 'm2', '4.45', '5.40', '5.05', '5.20', '5.30', '5.05', '4.55');
insert into splitar values ('9', 'm2', '4.40', '5.35', '5.05', '5.18', '5.25', '5.15', '5.10');
insert into splitar values ('10', 'm2', '4.10', '5.10', '5.20', '5.15', '6.10', '7.20', '5.40');
insert into splitar values ('11', 'm2', '4.20', '5.10', '6.20', '5.30', '5.40', '7.10', '6.20');
insert into splitar values ('12', 'm2', '5.15', '5.20', '5.50', '5.17', '5.42', '5.40', '5.30');
insert into splitar values ('13', 'm2', '4.35', '5.15', '6.15', '5.27', '5.38', '6.20', '4.30');
insert into splitar values ('14', 'm2', '5.05', '5.40', '4.20', '4.58', '5.30', '4.58', '4.30');
insert into splitar values ('15', 'm2', '4.50', '5.30', '5.15', '5.03', '5.32', '5.30', '5.37');
insert into splitar values ('16', 'm2', '4.30', '5.20', '5.25', '5.20', '5.35', '5.01', '5.01');
insert into splitar values ('17', 'm2', '4.15', '5.55', '5.35', '5.25', '5.45', '4.50', '4.55');
insert into splitar values ('18', 'm2', '4.45', '5.40', '5.05', '5.30', '5.30', '5.05', '4.55');
insert into splitar values ('19', 'm2', '4.40', '5.35', '5.15', '5.38', '5.25', '5.15', '5.10');
insert into splitar values ('20', 'm2', '4.20', '5.10', '5.20', '5.15', '6.10', '7,20', '5.40');

insert into splitar values ('1', 'm3', '4.20', '5.10', '6.20', '5.30', '5.40', '7.10', '6.20');
insert into splitar values ('2', 'm3', '5.15', '5.20', '5.50', '5.17', '5.42', '5.40', '5.30');
insert into splitar values ('3', 'm3', '4.30', '5.10', '6.10', '5.22', '5.38', '6.20', '4.30');
insert into splitar values ('4', 'm3', '5.05', '5.40', '4.20', '4.58', '5.30', '4.58', '4.30');
insert into splitar values ('5', 'm3', '4.50', '5.30', '5.15', '5.03', '5.32', '5.30', '5.30');
insert into splitar values ('6', 'm3', '4.30', '5.20', '5.25', '5.10', '5.35', '5.01', '5.01');
insert into splitar values ('7', 'm3', '4.15', '5.50', '5.35', '5.15', '5.45', '4.50', '4.50');
insert into splitar values ('8', 'm3', '4.45', '5.40', '5.05', '5.20', '5.30', '5.05', '4.55');
insert into splitar values ('9', 'm3', '4.40', '5.35', '5.05', '5.18', '5.25', '5.15', '5.10');
insert into splitar values ('10', 'm3', '4.10', '5.10', '5.20', '5.15', '6.10', '7.20', '5.40');
insert into splitar values ('11', 'm3', '4.20', '5.10', '6.20', '5.30', '5.40', '7.10', '6.20');
insert into splitar values ('12', 'm3', '5.15', '5.20', '5.50', '5.17', '5.42', '5.40', '5.30');
insert into splitar values ('13', 'm3', '4.35', '5.15', '6.15', '5.27', '5.38', '6.20', '4.30');
insert into splitar values ('14', 'm3', '5.05', '5.40', '4.20', '4.58', '5.30', '4.58', '4.30');
insert into splitar values ('15', 'm3', '4.50', '5.30', '5.15', '5.03', '5.32', '5.30', '5.37');
insert into splitar values ('16', 'm3', '4.30', '5.20', '5.25', '5.20', '5.35', '5.01', '5.01');
insert into splitar values ('17', 'm3', '4.15', '5.55', '5.35', '5.25', '5.45', '4.50', '4.55');
insert into splitar values ('18', 'm3', '4.45', '5.40', '5.05', '5.30', '5.30', '5.05', '4.55');
insert into splitar values ('19', 'm3', '4.40', '5.35', '5.15', '5.38', '5.25', '5.15', '5.10');
insert into splitar values ('20', 'm3', '4.20', '5.10', '5.20', '5.15', '6.10', '7,20', '5.40');

insert into splitar values ('1', 'm4', '4.20', '5.10', '6.20', '5.30', '5.40', '7.10', '6.20');
insert into splitar values ('2', 'm4', '5.15', '5.20', '5.50', '5.17', '5.42', '5.40', '5.30');
insert into splitar values ('3', 'm4', '4.30', '5.10', '6.10', '5.22', '5.38', '6.20', '4.30');
insert into splitar values ('4', 'm4', '5.05', '5.40', '4.20', '4.58', '5.30', '4.58', '4.30');
insert into splitar values ('5', 'm4', '4.50', '5.30', '5.15', '5.03', '5.32', '5.30', '5.30');
insert into splitar values ('6', 'm4', '4.30', '5.20', '5.25', '5.10', '5.35', '5.01', '5.01');
insert into splitar values ('7', 'm4', '4.15', '5.50', '5.35', '5.15', '5.45', '4.50', '4.50');
insert into splitar values ('8', 'm4', '4.45', '5.40', '5.05', '5.20', '5.30', '5.05', '4.55');
insert into splitar values ('9', 'm4', '4.40', '5.35', '5.05', '5.18', '5.25', '5.15', '5.10');
insert into splitar values ('10', 'm4', '4.10', '5.10', '5.20', '5.15', '6.10', '7.20', '5.40');
insert into splitar values ('11', 'm4', '4.20', '5.10', '6.20', '5.30', '5.40', '7.10', '6.20');
insert into splitar values ('12', 'm4', '5.15', '5.20', '5.50', '5.17', '5.42', '5.40', '5.30');
insert into splitar values ('13', 'm4', '4.35', '5.15', '6.15', '5.27', '5.38', '6.20', '4.30');
insert into splitar values ('14', 'm4', '5.05', '5.40', '4.20', '4.58', '5.30', '4.58', '4.30');
insert into splitar values ('15', 'm4', '4.50', '5.30', '5.15', '5.03', '5.32', '5.30', '5.37');
insert into splitar values ('16', 'm4', '4.30', '5.20', '5.25', '5.20', '5.35', '5.01', '5.01');
insert into splitar values ('17', 'm4', '4.15', '5.55', '5.35', '5.25', '5.45', '4.50', '4.55');
insert into splitar values ('18', 'm4', '4.45', '5.40', '5.05', '5.30', '5.30', '5.05', '4.55');
insert into splitar values ('19', 'm4', '4.40', '5.35', '5.15', '5.38', '5.25', '5.15', '5.10');
insert into splitar values ('20', 'm4', '4.20', '5.10', '5.20', '5.15', '6.10', '7,20', '5.40');

insert into splitar values ('1', 'l1', '4.20', '5.10', '6.20', '5.30', '5.40', '7.10', '6.20');
insert into splitar values ('2', 'l1', '5.15', '5.20', '5.50', '5.17', '5.42', '5.40', '5.30');
insert into splitar values ('3', 'l1', '4.30', '5.10', '6.10', '5.22', '5.38', '6.20', '4.30');
insert into splitar values ('4', 'l1', '5.05', '5.40', '4.20', '4.58', '5.30', '4.58', '4.30');
insert into splitar values ('5', 'l1', '4.50', '5.30', '5.15', '5.03', '5.32', '5.30', '5.30');
insert into splitar values ('6', 'l1', '4.30', '5.20', '5.25', '5.10', '5.35', '5.01', '5.01');
insert into splitar values ('7', 'l1', '4.15', '5.50', '5.35', '5.15', '5.45', '4.50', '4.50');
insert into splitar values ('8', 'l1', '4.45', '5.40', '5.05', '5.20', '5.30', '5.05', '4.55');
insert into splitar values ('9', 'l1', '4.40', '5.35', '5.05', '5.18', '5.25', '5.15', '5.10');
insert into splitar values ('10', 'l1', '4.10', '5.10', '5.20', '5.15', '6.10', '7.20', '5.40');
insert into splitar values ('11', 'l1', '4.20', '5.10', '6.20', '5.30', '5.40', '7.10', '6.20');
insert into splitar values ('12', 'l1', '5.15', '5.20', '5.50', '5.17', '5.42', '5.40', '5.30');
insert into splitar values ('13', 'l1', '4.35', '5.15', '6.15', '5.27', '5.38', '6.20', '4.30');
insert into splitar values ('14', 'l1', '5.05', '5.40', '4.20', '4.58', '5.30', '4.58', '4.30');
insert into splitar values ('15', 'l1', '4.50', '5.30', '5.15', '5.03', '5.32', '5.30', '5.37');
insert into splitar values ('16', 'l1', '4.30', '5.20', '5.25', '5.20', '5.35', '5.01', '5.01');
insert into splitar values ('17', 'l1', '4.15', '5.55', '5.35', '5.25', '5.45', '4.50', '4.55');
insert into splitar values ('18', 'l1', '4.45', '5.40', '5.05', '5.30', '5.30', '5.05', '4.55');
insert into splitar values ('19', 'l1', '4.40', '5.35', '5.15', '5.38', '5.25', '5.15', '5.10');
insert into splitar values ('20', 'l1', '4.20', '5.10', '5.20', '5.15', '6.10', '7,20', '5.40');

insert into splitar values ('1', 'l2', '4.20', '5.10', '6.20', '5.30', '5.40', '7.10', '6.20');
insert into splitar values ('2', 'l2', '5.15', '5.20', '5.50', '5.17', '5.42', '5.40', '5.30');
insert into splitar values ('3', 'l2', '4.30', '5.10', '6.10', '5.22', '5.38', '6.20', '4.30');
insert into splitar values ('4', 'l2', '5.05', '5.40', '4.20', '4.58', '5.30', '4.58', '4.30');
insert into splitar values ('5', 'l2', '4.50', '5.30', '5.15', '5.03', '5.32', '5.30', '5.30');
insert into splitar values ('6', 'l2', '4.30', '5.20', '5.25', '5.10', '5.35', '5.01', '5.01');
insert into splitar values ('7', 'l2', '4.15', '5.50', '5.35', '5.15', '5.45', '4.50', '4.50');
insert into splitar values ('8', 'l2', '4.45', '5.40', '5.05', '5.20', '5.30', '5.05', '4.55');
insert into splitar values ('9', 'l2', '4.40', '5.35', '5.05', '5.18', '5.25', '5.15', '5.10');
insert into splitar values ('10', 'l2', '4.10', '5.10', '5.20', '5.15', '6.10', '7.20', '5.40');
insert into splitar values ('11', 'l2', '4.20', '5.10', '6.20', '5.30', '5.40', '7.10', '6.20');
insert into splitar values ('12', 'l2', '5.15', '5.20', '5.50', '5.17', '5.42', '5.40', '5.30');
insert into splitar values ('13', 'l2', '4.35', '5.15', '6.15', '5.27', '5.38', '6.20', '4.30');
insert into splitar values ('14', 'l2', '5.05', '5.40', '4.20', '4.58', '5.30', '4.58', '4.30');
insert into splitar values ('15', 'l2', '4.50', '5.30', '5.15', '5.03', '5.32', '5.30', '5.37');
insert into splitar values ('16', 'l2', '4.30', '5.20', '5.25', '5.20', '5.35', '5.01', '5.01');
insert into splitar values ('17', 'l2', '4.15', '5.55', '5.35', '5.25', '5.45', '4.50', '4.55');
insert into splitar values ('18', 'l2', '4.45', '5.40', '5.05', '5.30', '5.30', '5.05', '4.55');
insert into splitar values ('19', 'l2', '4.40', '5.35', '5.15', '5.38', '5.25', '5.15', '5.10');
insert into splitar values ('20', 'l2', '4.20', '5.10', '5.20', '5.15', '6.10', '7,20', '5.40');

insert into splitar values ('1', 'l3', '4.20', '5.10', '6.20', '5.30', '5.40', '7.10', '6.20');
insert into splitar values ('2', 'l3', '5.15', '5.20', '5.50', '5.17', '5.42', '5.40', '5.30');
insert into splitar values ('3', 'l3', '4.30', '5.10', '6.10', '5.22', '5.38', '6.20', '4.30');
insert into splitar values ('4', 'l3', '5.05', '5.40', '4.20', '4.58', '5.30', '4.58', '4.30');
insert into splitar values ('5', 'l3', '4.50', '5.30', '5.15', '5.03', '5.32', '5.30', '5.30');
insert into splitar values ('6', 'l3', '4.30', '5.20', '5.25', '5.10', '5.35', '5.01', '5.01');
insert into splitar values ('7', 'l3', '4.15', '5.50', '5.35', '5.15', '5.45', '4.50', '4.50');
insert into splitar values ('8', 'l3', '4.45', '5.40', '5.05', '5.20', '5.30', '5.05', '4.55');
insert into splitar values ('9', 'l3', '4.40', '5.35', '5.05', '5.18', '5.25', '5.15', '5.10');
insert into splitar values ('10', 'l3', '4.10', '5.10', '5.20', '5.15', '6.10', '7.20', '5.40');
insert into splitar values ('11', 'l3', '4.20', '5.10', '6.20', '5.30', '5.40', '7.10', '6.20');
insert into splitar values ('12', 'l3', '5.15', '5.20', '5.50', '5.17', '5.42', '5.40', '5.30');
insert into splitar values ('13', 'l3', '4.35', '5.15', '6.15', '5.27', '5.38', '6.20', '4.30');
insert into splitar values ('14', 'l3', '5.05', '5.40', '4.20', '4.58', '5.30', '4.58', '4.30');
insert into splitar values ('15', 'l3', '4.50', '5.30', '5.15', '5.03', '5.32', '5.30', '5.37');
insert into splitar values ('16', 'l3', '4.30', '5.20', '5.25', '5.20', '5.35', '5.01', '5.01');
insert into splitar values ('17', 'l3', '4.15', '5.55', '5.35', '5.25', '5.45', '4.50', '4.55');
insert into splitar values ('18', 'l3', '4.45', '5.40', '5.05', '5.30', '5.30', '5.05', '4.55');
insert into splitar values ('19', 'l3', '4.40', '5.35', '5.15', '5.38', '5.25', '5.15', '5.10');
insert into splitar values ('20', 'l3', '4.20', '5.10', '5.20', '5.15', '6.10', '7,20', '5.40');

insert into splitar values ('1', 'l4', '4.20', '5.10', '6.20', '5.30', '5.40', '7.10', '6.20');
insert into splitar values ('2', 'l4', '5.15', '5.20', '5.50', '5.17', '5.42', '5.40', '5.30');
insert into splitar values ('3', 'l4', '4.30', '5.10', '6.10', '5.22', '5.38', '6.20', '4.30');
insert into splitar values ('4', 'l4', '5.05', '5.40', '4.20', '4.58', '5.30', '4.58', '4.30');
insert into splitar values ('5', 'l4', '4.50', '5.30', '5.15', '5.03', '5.32', '5.30', '5.30');
insert into splitar values ('6', 'l4', '4.30', '5.20', '5.25', '5.10', '5.35', '5.01', '5.01');
insert into splitar values ('7', 'l4', '4.15', '5.50', '5.35', '5.15', '5.45', '4.50', '4.50');
insert into splitar values ('8', 'l4', '4.45', '5.40', '5.05', '5.20', '5.30', '5.05', '4.55');
insert into splitar values ('9', 'l4', '4.40', '5.35', '5.05', '5.18', '5.25', '5.15', '5.10');
insert into splitar values ('10', 'l4', '4.10', '5.10', '5.20', '5.15', '6.10', '7.20', '5.40');
insert into splitar values ('11', 'l4', '4.20', '5.10', '6.20', '5.30', '5.40', '7.10', '6.20');
insert into splitar values ('12', 'l4', '5.15', '5.20', '5.50', '5.17', '5.42', '5.40', '5.30');
insert into splitar values ('13', 'l4', '4.35', '5.15', '6.15', '5.27', '5.38', '6.20', '4.30');
insert into splitar values ('14', 'l4', '5.05', '5.40', '4.20', '4.58', '5.30', '4.58', '4.30');
insert into splitar values ('15', 'l4', '4.50', '5.30', '5.15', '5.03', '5.32', '5.30', '5.37');
insert into splitar values ('16', 'l4', '4.30', '5.20', '5.25', '5.20', '5.35', '5.01', '5.01');
insert into splitar values ('17', 'l4', '4.15', '5.55', '5.35', '5.25', '5.45', '4.50', '4.55');
insert into splitar values ('18', 'l4', '4.45', '5.40', '5.05', '5.30', '5.30', '5.05', '4.55');
insert into splitar values ('19', 'l4', '4.40', '5.35', '5.15', '5.38', '5.25', '5.15', '5.10');
insert into splitar values ('20', 'l4', '4.20', '5.10', '5.20', '5.15', '6.10', '7,20', '5.40');

insert into splitar values ('23', 's1', '4.15', '6.20', '6.40', '3.10', '5.20', '7.10', '4.20');
insert into splitar values ('23', 's2', '4.15', '4.25', '4.25', '4.45', '5.30', '5.25', '5.45');
insert into splitar values ('23', 's3', '4.15', '4.25', '4.25', '4.45', '5.30', '5.25', '5.45');
insert into splitar values ('23', 's4', '4.15', '4.25', '4.25', '4.45', '5.30', '5.25', '5.45');
insert into splitar values ('23', 's5', '4.15', '4.25', '4.25', '4.45', '5.30', '5.25', '5.45');

insert into splitar values ('23', 'm1', '4.15', '4.25', '4.25', '4.45', '5.30', '5.25', '5.45');
insert into splitar values ('23', 'm2', '4.15', '4.25', '4.25', '4.45', '5.30', '5.25', '5.45');
insert into splitar values ('23', 'm3', '4.15', '4.25', '4.25', '4.45', '5.30', '5.25', '5.45');
insert into splitar values ('23', 'm4', '4.15', '4.25', '4.25', '4.45', '5.30', '5.25', '5.45');

insert into splitar values ('23', 'l1', '4.15', '4.25', '4.25', '4.45', '5.30', '5.25', '5.45');
insert into splitar values ('23', 'l2', '4.15', '4.25', '4.25', '4.45', '5.30', '5.25', '5.45');
insert into splitar values ('23', 'l3', '4.15', '4.25', '4.25', '4.45', '5.30', '5.25', '5.45');
insert into splitar values ('23', 'l4', '4.15', '4.25', '4.25', '4.45', '5.30', '5.25', '5.45');

insert into splitarInts(kundnr, ordningsnr, hedemora, norrhyttan, bondhyttan, bommansbo, smedjebacken, bjorsjo, grangesberg) values 
('1', 's1', '420', '510', '620', '530', '540', '710', '620'),
('2', 's1', '515', '520', '550', '517', '542', '540', '530'),
('3', 's1', '430', '510', '610', '522', '538', '620', '430'),
('4', 's1', '505', '540', '420', '458', '530', '458', '430'),
('5', 's1', '450', '530', '515', '503', '532', '530', '530'),
('6', 's1', '430', '520', '525', '510', '535', '501', '501'),
('7', 's1', '415', '550', '535', '515', '545', '450', '450'),
('8', 's1', '445', '540', '505', '520', '530', '505', '455'),
('9', 's1', '440', '535', '505', '518', '525', '515', '510'),
('10', 's1', '410', '510', '520', '515', '610', '720', '540'),
('11', 'm1', '420', '510', '620', '530', '540', '710', '620'),
('12', 'm1', '515', '520', '550', '517', '542', '540', '530'),
('13', 'm1', '435', '515', '615', '527', '538', '620', '430'),
('14', 'm1', '505', '540', '420', '458', '530', '458', '430'),
('15', 'm1', '450', '530', '515', '503', '532', '530', '537'),
('16', 'm1', '430', '520', '525', '520', '535', '501', '501'),
('17', 'm1', '415', '555', '535', '525', '545', '450', '455'),
('18', 'm1', '445', '540', '505', '530', '530', '505', '455'),
('19', 'm1', '440', '535', '515', '538', '525', '515', '510'),
('20', 'm1', '420', '510', '520', '515', '610', '720', '540'),
('1', 's2', '420', '510', '620', '530', '540', '710', '620'),
('2', 's2', '515', '520', '550', '517', '542', '540', '530'),
('3', 's2', '430', '510', '610', '522', '538', '620', '430'),
('4', 's2', '505', '540', '420', '458', '530', '458', '430'),
('5', 's2', '450', '530', '515', '503', '532', '530', '530'),
('6', 's2', '430', '520', '525', '510', '535', '501', '501'),
('7', 's2', '415', '550', '535', '515', '545', '450', '450');

create view users_splitar_man as
select users.alder, users.kon, splitar.hedemora, splitar.norrhyttan, splitar.bjorsjo, splitar.bondhyttan, splitar.bommansbo, splitar.smedjebacken, splitar.grangesberg, splitar.ordningsnr
from users, splitar
where users.kundnr=splitar.kundnr and kon = 'man';

create view users_splitar_kvinna as
select users.alder, users.kon, splitar.hedemora, splitar.norrhyttan, splitar.bjorsjo, splitar.bondhyttan, splitar.bommansbo, splitar.smedjebacken, splitar.grangesberg, splitar.ordningsnr
from users, splitar
where users.kundnr=splitar.kundnr and kon = 'kvinna';

create view users_splitar_alla as
select users.alder, users.kon, splitar.hedemora, splitar.norrhyttan, splitar.bjorsjo, splitar.bondhyttan, splitar.bommansbo, splitar.smedjebacken, splitar.grangesberg, splitar.ordningsnr
from users, splitar
where users.kundnr=splitar.kundnr and kon = 'kvinna';

#select ROUND(AVG(hedemora),2) from users_splitar_alla where ordningsnr = 's1';

#select * from users_splitar_man;

#select * from feedback;

#select count(fraga_1) from feedback where fraga_1='Missnöjd' and lopp = 's1';
#select count(fraga_1) from feedback where fraga_1='nöjd' and lopp = 's1';

select * from users;
#select * from adress;
select * from loppanmalan_mtb;
select * from loppanmalan_lop;
select * from loppanmalan_skidor;
#select * from splitar;
select * from tillval_mtb;
#select * from feedback;

create view joint_lopp as
select *
from skidlopp 
union  
select *
from loplopp
union
select *
from mtblopp;

select * from joint_lopp;

create view splits_alla_lopp as 
select joint_lopp.namn, joint_lopp.ordningsnr, splitar.kundnr, joint_lopp.distans, joint_lopp.typ
from joint_lopp, splitar
where joint_lopp.ordningsnr = splitar.ordningsnr;

#select * from splits_alla_lopp;

create view joint_anmalan as
select *
from loppanmalan_mtb 
union  
select *
from loppanmalan_skidor
union
select *
from loppanmalan_lop;

select * from joint_anmalan;

#drop view joint_tillval;

create view joint_tillval as
select *
from tillval_skidor 
union  
select *
from tillval_lop
union
select *
from tillval_mtb;

select * from joint_tillval;

create view tillval as
select *
from artiklar_valla
union
select *
from artiklar_langning
union 
select * 
from artiklar_biljett
union 
select *
from artiklar_diplom
union 
select *
from artiklar_forsakring;

select * from tillval;

create view opponent as
select users.fornamn, users.kundnr, users.efternamn, splitar.ordningsnr, users.klubb, users.stad
from splitar, users
where splitar.kundnr = users.kundnr;

#select * from opponent where ordningsnr = 's1';

select * from opponent 
where ordningsnr = 's1' 
order by efternamn asc;

select * from loppanmalan_lop;
select * from loppanmalan_mtb;
select * from loppanmalan_skidor;

select * from users;