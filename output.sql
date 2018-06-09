--
-- PostgreSQL database dump
--

-- Dumped from database version 10.3 (Ubuntu 10.3-1.pgdg16.04+1)
-- Dumped by pg_dump version 10.4 (Ubuntu 10.4-1.pgdg16.04+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: client; Type: TABLE; Schema: public; Owner: sscocugijlbupy
--

CREATE TABLE public.client (
    id integer NOT NULL,
    username character varying(20) NOT NULL,
    password character varying(255) NOT NULL
);


ALTER TABLE public.client OWNER TO sscocugijlbupy;

--
-- Name: client_id_seq; Type: SEQUENCE; Schema: public; Owner: sscocugijlbupy
--

CREATE SEQUENCE public.client_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.client_id_seq OWNER TO sscocugijlbupy;

--
-- Name: client_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sscocugijlbupy
--

ALTER SEQUENCE public.client_id_seq OWNED BY public.client.id;


--
-- Name: listener; Type: TABLE; Schema: public; Owner: sscocugijlbupy
--

CREATE TABLE public.listener (
    listener_id integer NOT NULL,
    listener_name character varying(50) NOT NULL,
    password character varying(255) NOT NULL
);


ALTER TABLE public.listener OWNER TO sscocugijlbupy;

--
-- Name: listener_listener_id_seq; Type: SEQUENCE; Schema: public; Owner: sscocugijlbupy
--

CREATE SEQUENCE public.listener_listener_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.listener_listener_id_seq OWNER TO sscocugijlbupy;

--
-- Name: listener_listener_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sscocugijlbupy
--

ALTER SEQUENCE public.listener_listener_id_seq OWNED BY public.listener.listener_id;


--
-- Name: note; Type: TABLE; Schema: public; Owner: sscocugijlbupy
--

CREATE TABLE public.note (
    note_id integer NOT NULL,
    listener_id integer NOT NULL,
    session_id integer NOT NULL,
    speaker_id integer NOT NULL,
    talk_id integer NOT NULL,
    note text NOT NULL
);


ALTER TABLE public.note OWNER TO sscocugijlbupy;

--
-- Name: note_note_id_seq; Type: SEQUENCE; Schema: public; Owner: sscocugijlbupy
--

CREATE SEQUENCE public.note_note_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.note_note_id_seq OWNER TO sscocugijlbupy;

--
-- Name: note_note_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sscocugijlbupy
--

ALTER SEQUENCE public.note_note_id_seq OWNED BY public.note.note_id;


--
-- Name: ride; Type: TABLE; Schema: public; Owner: sscocugijlbupy
--

CREATE TABLE public.ride (
    ride_id integer NOT NULL,
    rider_id integer NOT NULL,
    trail_id integer NOT NULL,
    ride_date date NOT NULL,
    duration interval NOT NULL,
    ride_name character varying(255) NOT NULL
);


ALTER TABLE public.ride OWNER TO sscocugijlbupy;

--
-- Name: ride_ride_id_seq; Type: SEQUENCE; Schema: public; Owner: sscocugijlbupy
--

CREATE SEQUENCE public.ride_ride_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ride_ride_id_seq OWNER TO sscocugijlbupy;

--
-- Name: ride_ride_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sscocugijlbupy
--

ALTER SEQUENCE public.ride_ride_id_seq OWNED BY public.ride.ride_id;


--
-- Name: rider; Type: TABLE; Schema: public; Owner: sscocugijlbupy
--

CREATE TABLE public.rider (
    rider_id integer NOT NULL,
    rider_name character varying(40) NOT NULL,
    password character varying(255) NOT NULL
);


ALTER TABLE public.rider OWNER TO sscocugijlbupy;

--
-- Name: rider_rider_id_seq; Type: SEQUENCE; Schema: public; Owner: sscocugijlbupy
--

CREATE SEQUENCE public.rider_rider_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.rider_rider_id_seq OWNER TO sscocugijlbupy;

--
-- Name: rider_rider_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sscocugijlbupy
--

ALTER SEQUENCE public.rider_rider_id_seq OWNED BY public.rider.rider_id;


--
-- Name: scriptures; Type: TABLE; Schema: public; Owner: sscocugijlbupy
--

CREATE TABLE public.scriptures (
    id integer NOT NULL,
    book character varying(255) NOT NULL,
    chapter integer NOT NULL,
    verse integer NOT NULL,
    content text NOT NULL
);


ALTER TABLE public.scriptures OWNER TO sscocugijlbupy;

--
-- Name: scriptures_id_seq; Type: SEQUENCE; Schema: public; Owner: sscocugijlbupy
--

CREATE SEQUENCE public.scriptures_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.scriptures_id_seq OWNER TO sscocugijlbupy;

--
-- Name: scriptures_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sscocugijlbupy
--

ALTER SEQUENCE public.scriptures_id_seq OWNED BY public.scriptures.id;


--
-- Name: session; Type: TABLE; Schema: public; Owner: sscocugijlbupy
--

CREATE TABLE public.session (
    session_id integer NOT NULL,
    year integer NOT NULL,
    month integer NOT NULL,
    session character varying(20) NOT NULL
);


ALTER TABLE public.session OWNER TO sscocugijlbupy;

--
-- Name: session_session_id_seq; Type: SEQUENCE; Schema: public; Owner: sscocugijlbupy
--

CREATE SEQUENCE public.session_session_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.session_session_id_seq OWNER TO sscocugijlbupy;

--
-- Name: session_session_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sscocugijlbupy
--

ALTER SEQUENCE public.session_session_id_seq OWNED BY public.session.session_id;


--
-- Name: speaker; Type: TABLE; Schema: public; Owner: sscocugijlbupy
--

CREATE TABLE public.speaker (
    speaker_id integer NOT NULL,
    speaker_name character varying(30) NOT NULL,
    "position" character varying(50)
);


ALTER TABLE public.speaker OWNER TO sscocugijlbupy;

--
-- Name: speaker_speaker_id_seq; Type: SEQUENCE; Schema: public; Owner: sscocugijlbupy
--

CREATE SEQUENCE public.speaker_speaker_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.speaker_speaker_id_seq OWNER TO sscocugijlbupy;

--
-- Name: speaker_speaker_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sscocugijlbupy
--

ALTER SEQUENCE public.speaker_speaker_id_seq OWNED BY public.speaker.speaker_id;


--
-- Name: talk; Type: TABLE; Schema: public; Owner: sscocugijlbupy
--

CREATE TABLE public.talk (
    talk_id integer NOT NULL,
    talk_name character varying(200) NOT NULL,
    session_id integer NOT NULL,
    speaker_id integer NOT NULL
);


ALTER TABLE public.talk OWNER TO sscocugijlbupy;

--
-- Name: talk_talk_id_seq; Type: SEQUENCE; Schema: public; Owner: sscocugijlbupy
--

CREATE SEQUENCE public.talk_talk_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.talk_talk_id_seq OWNER TO sscocugijlbupy;

--
-- Name: talk_talk_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sscocugijlbupy
--

ALTER SEQUENCE public.talk_talk_id_seq OWNED BY public.talk.talk_id;


--
-- Name: topic; Type: TABLE; Schema: public; Owner: sscocugijlbupy
--

CREATE TABLE public.topic (
    id integer NOT NULL,
    name character varying(50) NOT NULL
);


ALTER TABLE public.topic OWNER TO sscocugijlbupy;

--
-- Name: topic_id_seq; Type: SEQUENCE; Schema: public; Owner: sscocugijlbupy
--

CREATE SEQUENCE public.topic_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.topic_id_seq OWNER TO sscocugijlbupy;

--
-- Name: topic_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sscocugijlbupy
--

ALTER SEQUENCE public.topic_id_seq OWNED BY public.topic.id;


--
-- Name: topic_scripture; Type: TABLE; Schema: public; Owner: sscocugijlbupy
--

CREATE TABLE public.topic_scripture (
    topic_id integer NOT NULL,
    scripture_id integer NOT NULL
);


ALTER TABLE public.topic_scripture OWNER TO sscocugijlbupy;

--
-- Name: trail; Type: TABLE; Schema: public; Owner: sscocugijlbupy
--

CREATE TABLE public.trail (
    trail_id integer NOT NULL,
    trail_name character varying(50) NOT NULL,
    start_location character varying(50) NOT NULL,
    distance integer NOT NULL,
    elevation integer NOT NULL
);


ALTER TABLE public.trail OWNER TO sscocugijlbupy;

--
-- Name: trail_trail_id_seq; Type: SEQUENCE; Schema: public; Owner: sscocugijlbupy
--

CREATE SEQUENCE public.trail_trail_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.trail_trail_id_seq OWNER TO sscocugijlbupy;

--
-- Name: trail_trail_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sscocugijlbupy
--

ALTER SEQUENCE public.trail_trail_id_seq OWNED BY public.trail.trail_id;


--
-- Name: client id; Type: DEFAULT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.client ALTER COLUMN id SET DEFAULT nextval('public.client_id_seq'::regclass);


--
-- Name: listener listener_id; Type: DEFAULT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.listener ALTER COLUMN listener_id SET DEFAULT nextval('public.listener_listener_id_seq'::regclass);


--
-- Name: note note_id; Type: DEFAULT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.note ALTER COLUMN note_id SET DEFAULT nextval('public.note_note_id_seq'::regclass);


--
-- Name: ride ride_id; Type: DEFAULT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.ride ALTER COLUMN ride_id SET DEFAULT nextval('public.ride_ride_id_seq'::regclass);


--
-- Name: rider rider_id; Type: DEFAULT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.rider ALTER COLUMN rider_id SET DEFAULT nextval('public.rider_rider_id_seq'::regclass);


--
-- Name: scriptures id; Type: DEFAULT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.scriptures ALTER COLUMN id SET DEFAULT nextval('public.scriptures_id_seq'::regclass);


--
-- Name: session session_id; Type: DEFAULT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.session ALTER COLUMN session_id SET DEFAULT nextval('public.session_session_id_seq'::regclass);


--
-- Name: speaker speaker_id; Type: DEFAULT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.speaker ALTER COLUMN speaker_id SET DEFAULT nextval('public.speaker_speaker_id_seq'::regclass);


--
-- Name: talk talk_id; Type: DEFAULT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.talk ALTER COLUMN talk_id SET DEFAULT nextval('public.talk_talk_id_seq'::regclass);


--
-- Name: topic id; Type: DEFAULT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.topic ALTER COLUMN id SET DEFAULT nextval('public.topic_id_seq'::regclass);


--
-- Name: trail trail_id; Type: DEFAULT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.trail ALTER COLUMN trail_id SET DEFAULT nextval('public.trail_trail_id_seq'::regclass);


--
-- Data for Name: client; Type: TABLE DATA; Schema: public; Owner: sscocugijlbupy
--

COPY public.client (id, username, password) FROM stdin;
\.


--
-- Data for Name: listener; Type: TABLE DATA; Schema: public; Owner: sscocugijlbupy
--

COPY public.listener (listener_id, listener_name, password) FROM stdin;
1	Tammy	password
\.


--
-- Data for Name: note; Type: TABLE DATA; Schema: public; Owner: sscocugijlbupy
--

COPY public.note (note_id, listener_id, session_id, speaker_id, talk_id, note) FROM stdin;
1	1	1	1	2	God sanctifies the most difficult days of mothers.
2	1	1	1	2	Parents teach their children throughout their life, from first prayer, to parenting advice.
3	1	3	2	1	Give thanks when we receive revelation.
4	1	3	2	1	Stretch beyond your personal ability to receive revelation.
5	1	2	2	3	Include conference talks in FHE over next 6 months.
6	1	2	2	3	Spend time in the temple.
\.


--
-- Data for Name: ride; Type: TABLE DATA; Schema: public; Owner: sscocugijlbupy
--

COPY public.ride (ride_id, rider_id, trail_id, ride_date, duration, ride_name) FROM stdin;
13	4	2	2018-05-22	02:37:00	Orange Blossom Heaven
14	4	1	2018-05-01	01:45:00	Morning Ride
15	4	2	2018-05-21	02:13:00	Fun With David
16	4	4	2018-06-04	03:44:00	The Grind
17	5	3	2018-05-19	01:39:00	I Wanna Ride
18	5	3	2018-05-04	01:32:00	I love cycling
19	5	1	2018-05-22	01:19:00	ride 2
20	5	2	2018-05-22	01:52:00	Hills Training
21	4	1	2018-06-05	01:05:00	Test
23	4	4	2018-06-06	03:29:00	Fun Ride
24	4	3	2018-06-07	06:02:00	Unnamed Ride
\.


--
-- Data for Name: rider; Type: TABLE DATA; Schema: public; Owner: sscocugijlbupy
--

COPY public.rider (rider_id, rider_name, password) FROM stdin;
3	Tammy Dresen	$2y$10$1A3q3MGwf3JUQYbrAFroX.FsR78j4E0/NBfYSYXngk9tB4V34Jl3e
5	david	$2y$10$uPEdL3mYkvSFaQTa.8sG..Yg6YI4kTUB.wGkA15kRogiIW61odMtG
6	Jennifer	$2y$10$MlKTHs4wvoUidV3xwy3XTeBEfNBetH9me1Ol7skUt3yeaIWiYH0pu
4	tammy	$2y$10$CNE67e1phTcqEDxhlpcbe.q6vtU9LddLxWOgjZ4SujKzEtnsrTO0u
\.


--
-- Data for Name: scriptures; Type: TABLE DATA; Schema: public; Owner: sscocugijlbupy
--

COPY public.scriptures (id, book, chapter, verse, content) FROM stdin;
1	John	1	5	And the light shineth in darkness; and the darkness comprehended it not.
2	Doctrine and Covenants	88	49	The light shineth in darkness, and the darkness comprehendeth it not; nevertheless, the day shall come when you shall comprehend even God, being quickened in him and by him.
3	Doctrine and Covenants	93	28	He that keepeth his commandments receiveth truth and light, until he is glorified in truth and knoweth all things.
4	Mosiah	16	9	He is the light and the life of the world; yea, a light that is endless, that can never be darkened; yea, and also a life which is endless, that there can be no more death.
15	Nephi	3	5	Scripture text
16	Joshua	5	13	inspiring text
\.


--
-- Data for Name: session; Type: TABLE DATA; Schema: public; Owner: sscocugijlbupy
--

COPY public.session (session_id, year, month, session) FROM stdin;
1	2018	4	Saturday Morning
2	2018	4	Sunday Afternoon
3	2018	4	Sunday Morning
\.


--
-- Data for Name: speaker; Type: TABLE DATA; Schema: public; Owner: sscocugijlbupy
--

COPY public.speaker (speaker_id, speaker_name, "position") FROM stdin;
1	Brian K. Taylor	Seventy
2	Russel M. Nelson	Prophet
\.


--
-- Data for Name: talk; Type: TABLE DATA; Schema: public; Owner: sscocugijlbupy
--

COPY public.talk (talk_id, talk_name, session_id, speaker_id) FROM stdin;
1	Revelation for the Church, Revelation for Our Lives	3	2
2	Am I A Child Of God?	1	1
3	Let Us All Press On	2	2
\.


--
-- Data for Name: topic; Type: TABLE DATA; Schema: public; Owner: sscocugijlbupy
--

COPY public.topic (id, name) FROM stdin;
1	Faith
2	Sacrifice
3	Charity
10	Hope
11	Christ
\.


--
-- Data for Name: topic_scripture; Type: TABLE DATA; Schema: public; Owner: sscocugijlbupy
--

COPY public.topic_scripture (topic_id, scripture_id) FROM stdin;
2	1
2	2
3	3
3	2
3	4
1	1
1	15
10	15
2	16
11	16
\.


--
-- Data for Name: trail; Type: TABLE DATA; Schema: public; Owner: sscocugijlbupy
--

COPY public.trail (trail_id, trail_name, start_location, distance, elevation) FROM stdin;
1	San Louis Rey River Trail	Vista	18	562
2	Rainbow to Rice to Couser Canyon	Fallbrook	30	2954
3	South on Old Highway	Fallbrook	20	1217
4	Big Mountain	Poway	54	3863
5	College to Torrey Pines	Park on College	70	1260
6	To Pala Casino	76 and Old Highway	20	500
7	Neighborhood	home	10	20
\.


--
-- Name: client_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sscocugijlbupy
--

SELECT pg_catalog.setval('public.client_id_seq', 1, false);


--
-- Name: listener_listener_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sscocugijlbupy
--

SELECT pg_catalog.setval('public.listener_listener_id_seq', 1, true);


--
-- Name: note_note_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sscocugijlbupy
--

SELECT pg_catalog.setval('public.note_note_id_seq', 6, true);


--
-- Name: ride_ride_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sscocugijlbupy
--

SELECT pg_catalog.setval('public.ride_ride_id_seq', 24, true);


--
-- Name: rider_rider_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sscocugijlbupy
--

SELECT pg_catalog.setval('public.rider_rider_id_seq', 6, true);


--
-- Name: scriptures_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sscocugijlbupy
--

SELECT pg_catalog.setval('public.scriptures_id_seq', 16, true);


--
-- Name: session_session_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sscocugijlbupy
--

SELECT pg_catalog.setval('public.session_session_id_seq', 3, true);


--
-- Name: speaker_speaker_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sscocugijlbupy
--

SELECT pg_catalog.setval('public.speaker_speaker_id_seq', 2, true);


--
-- Name: talk_talk_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sscocugijlbupy
--

SELECT pg_catalog.setval('public.talk_talk_id_seq', 3, true);


--
-- Name: topic_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sscocugijlbupy
--

SELECT pg_catalog.setval('public.topic_id_seq', 11, true);


--
-- Name: trail_trail_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sscocugijlbupy
--

SELECT pg_catalog.setval('public.trail_trail_id_seq', 7, true);


--
-- Name: client pk_client_1; Type: CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT pk_client_1 PRIMARY KEY (id);


--
-- Name: listener pk_listener_1; Type: CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.listener
    ADD CONSTRAINT pk_listener_1 PRIMARY KEY (listener_id);


--
-- Name: note pk_note_1; Type: CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.note
    ADD CONSTRAINT pk_note_1 PRIMARY KEY (note_id);


--
-- Name: ride pk_ride_1; Type: CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.ride
    ADD CONSTRAINT pk_ride_1 PRIMARY KEY (ride_id);


--
-- Name: rider pk_rider_1; Type: CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.rider
    ADD CONSTRAINT pk_rider_1 PRIMARY KEY (rider_id);


--
-- Name: scriptures pk_scriptures_1; Type: CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.scriptures
    ADD CONSTRAINT pk_scriptures_1 PRIMARY KEY (id);


--
-- Name: session pk_session_1; Type: CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.session
    ADD CONSTRAINT pk_session_1 PRIMARY KEY (session_id);


--
-- Name: speaker pk_speaker_1; Type: CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.speaker
    ADD CONSTRAINT pk_speaker_1 PRIMARY KEY (speaker_id);


--
-- Name: talk pk_talk_1; Type: CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.talk
    ADD CONSTRAINT pk_talk_1 PRIMARY KEY (talk_id);


--
-- Name: topic pk_topic_2; Type: CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.topic
    ADD CONSTRAINT pk_topic_2 PRIMARY KEY (id);


--
-- Name: trail pk_trail_1; Type: CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.trail
    ADD CONSTRAINT pk_trail_1 PRIMARY KEY (trail_id);


--
-- Name: topic_scripture topic_scripture_pkey; Type: CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.topic_scripture
    ADD CONSTRAINT topic_scripture_pkey PRIMARY KEY (topic_id, scripture_id);


--
-- Name: listener uq_listener_1; Type: CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.listener
    ADD CONSTRAINT uq_listener_1 UNIQUE (listener_name);


--
-- Name: rider uq_rider_1; Type: CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.rider
    ADD CONSTRAINT uq_rider_1 UNIQUE (rider_name);


--
-- Name: scriptures uq_scrip_1; Type: CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.scriptures
    ADD CONSTRAINT uq_scrip_1 UNIQUE (book, chapter, verse);


--
-- Name: topic_scripture uq_scrip_top_1; Type: CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.topic_scripture
    ADD CONSTRAINT uq_scrip_top_1 UNIQUE (scripture_id, topic_id);


--
-- Name: topic uq_topic_1; Type: CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.topic
    ADD CONSTRAINT uq_topic_1 UNIQUE (name);


--
-- Name: trail uq_trail_1; Type: CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.trail
    ADD CONSTRAINT uq_trail_1 UNIQUE (trail_name);


--
-- Name: note fk_note_1; Type: FK CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.note
    ADD CONSTRAINT fk_note_1 FOREIGN KEY (listener_id) REFERENCES public.listener(listener_id);


--
-- Name: note fk_note_2; Type: FK CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.note
    ADD CONSTRAINT fk_note_2 FOREIGN KEY (session_id) REFERENCES public.session(session_id);


--
-- Name: note fk_note_3; Type: FK CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.note
    ADD CONSTRAINT fk_note_3 FOREIGN KEY (speaker_id) REFERENCES public.speaker(speaker_id);


--
-- Name: note fk_note_4; Type: FK CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.note
    ADD CONSTRAINT fk_note_4 FOREIGN KEY (talk_id) REFERENCES public.talk(talk_id);


--
-- Name: ride fk_ride_rider; Type: FK CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.ride
    ADD CONSTRAINT fk_ride_rider FOREIGN KEY (rider_id) REFERENCES public.rider(rider_id);


--
-- Name: ride fk_ride_trail; Type: FK CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.ride
    ADD CONSTRAINT fk_ride_trail FOREIGN KEY (trail_id) REFERENCES public.trail(trail_id);


--
-- Name: talk fk_talk_1; Type: FK CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.talk
    ADD CONSTRAINT fk_talk_1 FOREIGN KEY (session_id) REFERENCES public.session(session_id);


--
-- Name: talk fk_talk_2; Type: FK CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.talk
    ADD CONSTRAINT fk_talk_2 FOREIGN KEY (speaker_id) REFERENCES public.speaker(speaker_id);


--
-- Name: topic_scripture fk_topic_scripture_scripture; Type: FK CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.topic_scripture
    ADD CONSTRAINT fk_topic_scripture_scripture FOREIGN KEY (scripture_id) REFERENCES public.scriptures(id);


--
-- Name: topic_scripture fk_topic_scripture_topic; Type: FK CONSTRAINT; Schema: public; Owner: sscocugijlbupy
--

ALTER TABLE ONLY public.topic_scripture
    ADD CONSTRAINT fk_topic_scripture_topic FOREIGN KEY (topic_id) REFERENCES public.topic(id);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: sscocugijlbupy
--

REVOKE ALL ON SCHEMA public FROM postgres;
REVOKE ALL ON SCHEMA public FROM PUBLIC;
GRANT ALL ON SCHEMA public TO sscocugijlbupy;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- Name: LANGUAGE plpgsql; Type: ACL; Schema: -; Owner: postgres
--

GRANT ALL ON LANGUAGE plpgsql TO sscocugijlbupy;


--
-- PostgreSQL database dump complete
--

