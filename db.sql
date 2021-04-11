create table if not exists "user" (
  id SERIAL,
  mail VARCHAR(60) NOT NULL,
  name VARCHAR(20) NOT NULL,
  surname VARCHAR(30) NOT NULL,
  password VARCHAR(255) NOT NULL
);

create table if not exists "quotes" (
  id SERIAL,
  quote TEXT
);

create table if not exists "uploads" (
  quote_id INTEGER,
  content TEXT
);
