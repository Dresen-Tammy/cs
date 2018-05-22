BEGIN;
INSERT INTO public.rider
(rider_name
,password)
VALUES
('tammy'
,'password'
);

INSERT INTO public.rider
(rider_name
,password)
VALUES
('david'
,'pass'
);

INSERT INTO public.trail
(trail_name
,start_location
,distance
,elevation)
VALUES
('San Louis Rey River Trail'
,'Vista'
,18.4
,562
);

INSERT INTO public.trail
(trail_name
,start_location
,distance
,elevation)
VALUES
('Rainbow to Rice to Couser Canyon'
,'Fallbrook'
,30.2
,2954
);

INSERT INTO public.trail
(trail_name
,start_location
,distance
,elevation)
VALUES
('South on Old Highway'
,'Fallbrook'
,20
,1217
);

INSERT INTO public.ride
(rider_id
,trail_id
,ride_date
,duration)
VALUES
(1
,1
,current_date
,'1 hours 17 minutes'
);

INSERT INTO public.ride
(rider_id
,trail_id
,ride_date
,duration)
VALUES
(2
,1
,current_date
,'1 hours 19 minutes'
);

INSERT INTO public.ride
(rider_id
,trail_id
,ride_date
,duration)
VALUES
(1
,2
,current_date
,'2 hours 37 minutes'
);

INSERT INTO public.ride
(rider_id
,trail_id
,ride_date
,duration)
VALUES
(2
,3
,current_date
,'1 hours 52 minutes'
);


COMMIT;