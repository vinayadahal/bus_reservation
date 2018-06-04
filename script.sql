create table destination
(
  id          int auto_increment
    primary key,
  destination text not null
);

create table travel_agency
(
  id      int auto_increment
    primary key,
  name    text         not null,
  address text         not null,
  contact int          not null,
  email   varchar(255) not null
);

create table bus
(
  id               int auto_increment
    primary key,
  type             text not null,
  total_seat       int  not null,
  bus_number       int  not null,
  seat_layout      int  not null,
  travel_agency_id int  not null,
  constraint bus_ibfk_1
  foreign key (travel_agency_id) references travel_agency (id)
);

create index travel_agency_id
  on bus (travel_agency_id);

create table route
(
  id          int auto_increment
    primary key,
  start_point int not null,
  end_point   int not null,
  bus_id      int null,
  constraint route_ibfk_1
  foreign key (start_point) references destination (id),
  constraint route_ibfk_2
  foreign key (end_point) references destination (id),
  constraint route_ibfk_3
  foreign key (bus_id) references bus (id)
);

create index bus_id
  on route (bus_id);

create index end_point
  on route (end_point);

create index start_point
  on route (start_point);


