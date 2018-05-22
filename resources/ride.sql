-- -----------------------------
-- Program Name: ride.sql
-- Program Author: Tammy Dresen

CREATE TABLE public.user (
    user_id     SERIAL       constraint  pk_user_1 PRIMARY KEY,
    user_name   VARCHAR(40)  constraint  nn_user_1 NOT NULL,
    password    VARCHAR(255) constraint  nn_user_2 NOT NULL
);

CREATE TABLE public.trail (
    trail_id        SERIAL      constraint  pk_trail_1  PRIMARY KEY,
    user_id         INTEGER     constraint  nn_trail_1  NOT NULL,
    trail_name      varchar(50) constraint  nn_trail_2  NOT NULL constraint uq_trail_1 UNIQUE,
    start_location varchar(50)  constraint  nn_trail_3  NOT NULL,
    distance       integer      constraint  nn_trail_4  NOT NULL,
    elevation      integer      constraint  nn_trail_5  NOT NULL,
    constraint fk_trail_user foreign key (user_id) REFERENCES public.user (user_id)
);

CREATE TABLE public.ride (
    ride_id     SERIAL    constraint  pk_ride_1  PRIMARY KEY,
    user_id     INTEGER   constraint  nn_ride_1  NOT NULL,
    trail_id     INTEGER  constraint  nn_ride_2  NOT NULL,
    ride_date   DATE      constraint  nn_ride_3  NOT NULL,
    duration    INTEGER   constraint  nn_ride_4  NOT NULL,
    constraint fk_ride_user foreign key (user_id) REFERENCES public.user (user_id),
    constraint fk_ride_trail foreign key (trail_id) REFERENCES public.trail (trail_id)
);
