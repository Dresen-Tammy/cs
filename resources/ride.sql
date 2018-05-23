-- -----------------------------
-- Program Name: ride.sql
-- Program Author: Tammy Dresen

CREATE TABLE public.rider (
    rider_id     SERIAL       constraint  pk_rider_1 PRIMARY KEY,
    rider_name   VARCHAR(40)  constraint  nn_rider_1 NOT NULL constraint uq_rider_1 UNIQUE,
    password    VARCHAR(255) constraint  nn_rider_2 NOT NULL
);

CREATE TABLE public.trail (
    trail_id        SERIAL      constraint  pk_trail_1  PRIMARY KEY,
    trail_name      varchar(50) constraint  nn_trail_2  NOT NULL constraint uq_trail_1 UNIQUE,
    start_location varchar(50)  constraint  nn_trail_3  NOT NULL,
    distance       integer      constraint  nn_trail_4  NOT NULL,
    elevation      integer      constraint  nn_trail_5  NOT NULL
);

CREATE TABLE public.ride (
    ride_id     SERIAL    constraint  pk_ride_1  PRIMARY KEY,
    ride_name    VARCHAR(255) constraint nn_ride_5 NOT NULL,
    rider_id     INTEGER   constraint  nn_ride_1  NOT NULL,
    trail_id     INTEGER  constraint  nn_ride_2  NOT NULL,
    ride_date   DATE      constraint  nn_ride_3  NOT NULL,
    duration    INTERVAL   constraint  nn_ride_4  NOT NULL,
    constraint fk_ride_rider foreign key (rider_id) REFERENCES public.rider (rider_id),
    constraint fk_ride_trail foreign key (trail_id) REFERENCES public.trail (trail_id)
);
