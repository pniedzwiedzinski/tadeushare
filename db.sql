create table "user" (
  id SERIAL,
  mail VARCHAR(60) NOT NULL,
  name VARCHAR(20) NOT NULL,
  surname VARCHAR(30) NOT NULL,
  password VARCHAR(255) NOT NULL
);

create table "quotes" (
  id SERIAL,
  quote TEXT
)

create table "uploads" (
  quote_id INTEGER,
  content TEXT
)
