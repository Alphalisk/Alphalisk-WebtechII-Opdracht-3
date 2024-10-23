create table blogs (
  image varchar(128),
  datum date,
  titel varchar(128)
);

create table users (
  username varchar(128),
  email varchar(128),
  password varchar(128)
);
  

insert into blogs values 
  ('https://cataas.com/cat', '2024-08-23', 'Interessante blog hier 👋'),
  ('https://cataas.com/cat', '2024-08-25', 'Nog een fijne tekst'),
  ('https://cataas.com/cat', '2024-09-10', 'Hoe gaat het ermee?'),
  ('https://cataas.com/cat', '2024-09-11', 'Lees dit stukje eens...'),
  ('https://cataas.com/cat', '2024-09-14', 'Onderweg naar morgen'),
  ('https://cataas.com/cat', '2024-09-23', 'Onderweg naar gisteren'),
  ('https://cataas.com/cat', '2024-09-30', 'De krant van gisteren 😘')

;

