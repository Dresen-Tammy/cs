INSERT INTO public.ride
(rider_id
,trail_id
,ride_date
,duration
,ride_name)
VALUES
(4
,1
,'2018-05-01'
,'1 hours 45 minutes'
,'Morning Ride'
);

INSERT INTO public.ride
(rider_id
,trail_id
,ride_date
,duration
,ride_name)
VALUES
(4
,2
,'2018-05-21'
,'2 hours 13 minutes'
,'Fun with David'
);

INSERT INTO public.ride
(rider_id
,trail_id
,ride_date
,duration
,ride_name)
VALUES
(4
,3
,'2018-04-18'
,'2 hours 29 minutes'
,'Weekend Ride'
);

INSERT INTO public.ride
(rider_id
,trail_id
,ride_date
,duration
,ride_name)
VALUES
(4
,2
,'2018-03-08'
,'1 hours 34 minutes'
,'Beautiful Day For A Ride'
);

INSERT INTO public.ride
(rider_id
,trail_id
,ride_date
,duration
,ride_name)
VALUES
(5
,3
,'2018-05-19'
,'1 hours 39 minutes'
,'I Wanna Ride'
);

INSERT INTO public.ride
(rider_id
,trail_id
,ride_date
,duration
,ride_name)
VALUES
(5
,3
,'2018-05-4'
,'1 hours 32 minutes'
,'I love cycling'
);

ALTER TABLE ride
CONSTRAINT uq_ride_1 UNIQUE (ride_name, rider_id, trail_id, ride_date, duration);