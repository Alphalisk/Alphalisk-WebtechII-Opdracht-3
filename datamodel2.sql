create table users (
    id integer PRIMARY KEY AUTOINCREMENT ,
    name varchar(128),
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
  
insert into users (name, email, password,register_date) values 
  ('Richard', 'richard@richard.nl', 'Richard!!',CURRENT_TIMESTAMP)
;

insert into shares (user_id, title, body, link, create_date) values 
  ('1', 'Onderwerp', 'Hallo iedereen','https://d3goj5urzzuh84.cloudfront.net/feed/_1536x864_crop_center-center_82_line/PATCHES-2.jpg',CURRENT_TIMESTAMP),
  ('1', 'Gedoe', 'Huh?','https://d3goj5urzzuh84.cloudfront.net/feed/_1536x864_crop_center-center_82_line/PATCHES-2.jpg',CURRENT_TIMESTAMP),
  ('1', 'Dus...', 'Waar ben ik?','https://d3goj5urzzuh84.cloudfront.net/feed/_1536x864_crop_center-center_82_line/PATCHES-2.jpg',CURRENT_TIMESTAMP)
;


-- insert into shares values 
--   ('https://cataas.com/cat', '2024-08-23', 'Interessante blog hier 👋'),
--   ('https://cataas.com/cat', '2024-08-25', 'Nog een fijne tekst'),
--   ('https://cataas.com/cat', '2024-09-10', 'Hoe gaat het ermee?'),
--   ('https://cataas.com/cat', '2024-09-11', 'Lees dit stukje eens...'),
--   ('https://cataas.com/cat', '2024-09-14', 'Onderweg naar morgen'),
--   ('https://cataas.com/cat', '2024-09-23', 'Onderweg naar gisteren'),
--   ('https://cataas.com/cat', '2024-09-30', 'De krant van gisteren 😘')

-- ;

