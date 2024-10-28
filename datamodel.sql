create table users (
    id integer PRIMARY KEY AUTOINCREMENT ,
    username varchar(128),
    email varchar(128),
    password varchar(128),
    register_date datetime
);

create table shares (
    id integer PRIMARY KEY AUTOINCREMENT ,
    user_id integer,
    title varchar(128),
    body text,
    link varchar(128),
    create_date datetime,
    FOREIGN KEY (user_id)
       REFERENCES users (id) 
);
  
insert into users (username, email, password,register_date) values 
  ('Richard', 'richard@richard.nl', 'Richard!!',CURRENT_TIMESTAMP)
;

insert into shares (user_id, title, body, link, create_date) values 
  ('1', 'Kat', 'Dit is een foto van een mooie kat!','https://d3goj5urzzuh84.cloudfront.net/feed/_1536x864_crop_center-center_82_line/PATCHES-2.jpg',CURRENT_TIMESTAMP),
  ('1', 'Hond', 'Wat fijn dat honden hier ook welkom zijn!','https://123tinki.com/nl-nl/wp-content/uploads/sites/2/2016/10/honden-weetjes.jpg',CURRENT_TIMESTAMP),
  ('1', 'Cavia', 'Mag een cavia ook op ShareBoard?','https://dierpedia.nl/wp-content/uploads/2021/04/cavia-dierpedia.jpg',CURRENT_TIMESTAMP)
;
