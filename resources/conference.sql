
CREATE TABLE public.user (
  user_id   SERIAL       constraint  pk_user_1 PRIMARY KEY
  ,user_name VARCHAR(50)  constraint nn_user_2 NOT NULL  constraint uq_user_1 UNIQUE
  ,password  VARCHAR(255) constraint nn_user_3 NOT NULL
);

CREATE TABLE public.session (
  session_id SERIAL      constraint  pk_session_1 PRIMARY KEY
  ,year       INTEGER     constraint  nn_session_1 NOT NULL
  ,month      INTEGER     constraint  nn_session_2 NOT NULL
  ,session    VARCHAR(20) constraint  nn_session_3 NOT NULL
);

CREATE TABLE public.speaker (
  speaker_id   SERIAL       constraint  pk_speaker_1  PRIMARY KEY
  ,speaker_name VARCHAR(30)  constraint  nn_speaker_1 NOT NULL
  ,position     VARCHAR(50)
);

CREATE TABLE public.talk (
  talk_id     SERIAL      constraint pk_talk_1  PRIMARY KEY
  ,talk_name  VARCHAR(200) constraint nn_talk_1  NOT NULL
  ,session_id INTEGER     constraint nn_talk_2  NOT NULL
  ,speaker_id INTEGER     constraint nn_talk_3  NOT NULL
  ,constraint fk_talk_1 foreign key (session_id) REFERENCES session(session_id)
  ,constraint fk_talk_2 foreign key (speaker_id) REFERENCES speaker(speaker_id)
);

CREATE TABLE public.note (
  note_id    SERIAL    constraint  pk_note_1 PRIMARY KEY
  ,user_id    INTEGER  constraint  nn_note_1 NOT NULL
  ,session_id INTEGER  constraint  n_note_2 NOT NULL
  ,speaker_id INTEGER  constraint  nn_note_3 NOT NULL
  ,talk_id    INTEGER  constraint  nn_note_4 NOT NULL
  ,note       TEXT     constraint  nn_note_5 NOT NULL
  ,constraint fk_note_1 foreign key (user_id)    REFERENCES public.user(user_id)
  ,constraint fk_note_2 foreign key (session_id) REFERENCES public.session(session_id)
  ,constraint fk_note_3 foreign key (speaker_id) REFERENCES public.speaker(speaker_id)
  ,constraint fk_note_4 foreign key (talk_id)    REFERENCES public.talk(talk_id)
);



INSERT INTO public.user
  (user_name
  ,password)
  VALUES
  ('Tammy'
  ,'password'
 );

INSERT INTO public.session
  (year
  ,month
  ,session)
  VALUES
 (2018
 ,04
 ,'Saturday Morning'
);

INSERT INTO public.session
  (year
  ,month
  ,session)
  VALUES
  (2018
  ,04
  ,'Sunday Afternoon'
  );

  INSERT INTO public.session
    (year
    ,month
    ,session)
    VALUES
    (2018
    ,04
    ,'Sunday Morning'
    );

INSERT INTO public.speaker
  (speaker_name
  ,position)
  VALUES
 ('Brian K. Taylor'
  ,'Seventy'
);

INSERT INTO public.speaker
  (speaker_name
  ,position)
  VALUES
  ('Russel M. Nelson'
  ,'Prophet'
);


INSERT INTO public.talk
  (talk_name
  ,session_id
  ,speaker_id)
  VALUES
  ('Revelation for the Church, Revelation for Our Lives'
  ,(SELECT session_id FROM public.session WHERE session = 'Sunday Morning')
  ,(SELECT speaker_id FROM public.speaker WHERE speaker_name = 'Russel M. Nelson')
);

INSERT INTO public.talk
  (talk_name
  ,session_id
  ,speaker_id)
  VALUES
  ('Am I A Child Of God?'
  ,(SELECT session_id FROM public.session WHERE session = 'Saturday Morning')
  ,(SELECT speaker_id FROM public.speaker WHERE speaker_name = 'Brian K. Taylor')
);

INSERT INTO public.talk
  (talk_name
  ,session_id
  ,speaker_id)
  VALUES
  ('Let Us All Press On'
  ,(SELECT session_id FROM public.session WHERE session = 'Sunday Afternoon')
  ,(SELECT speaker_id FROM public.speaker WHERE speaker_name = 'Russel M. Nelson')
);

INSERT INTO public.note
  (user_id
  ,session_id
  ,speaker_id
  ,talk_id
  ,note)
  VALUES
 ((SELECT user_id FROM public.user WHERE user_name = 'Tammy')
 ,(SELECT session_id FROM public.session WHERE session = 'Saturday Morning')
 ,(SELECT speaker_id FROM public.speaker WHERE speaker_name = 'Brian K. Taylor')
 ,(SELECT talk_id FROM public.talk WHERE talk_name = 'Am I A Child Of God?')
 , 'God sanctifies the most difficult days of mothers.'
);

INSERT INTO public.note
  (user_id
  ,session_id
  ,speaker_id
  ,talk_id
  ,note)
  VALUES
 ((SELECT user_id FROM public.user WHERE user_name = 'Tammy')
 ,(SELECT session_id FROM public.session WHERE session = 'Saturday Morning')
 ,(SELECT speaker_id FROM public.speaker WHERE speaker_name = 'Brian K. Taylor')
 ,(SELECT talk_id FROM public.talk WHERE talk_name = 'Am I A Child Of God?')
 , 'Parents teach their children throughout their life, from first prayer, to parenting advice.'
);

INSERT INTO public.note
  (user_id
  ,session_id
  ,speaker_id
  ,talk_id
  ,note)
  VALUES
 ((SELECT user_id FROM public.user WHERE user_name = 'Tammy')
 ,(SELECT session_id FROM public.session WHERE session = 'Sunday Morning')
 ,(SELECT speaker_id FROM public.speaker WHERE speaker_name = 'Russel M. Nelson')
 ,(SELECT talk_id FROM public.talk WHERE talk_name = 'Revelation for the Church, Revelation for Our Lives')
 , 'Give thanks when we receive revelation.'
);

INSERT INTO public.note
  (user_id
  ,session_id
  ,speaker_id
  ,talk_id
  ,note)
  VALUES
 ((SELECT user_id FROM public.user WHERE user_name = 'Tammy')
 ,(SELECT session_id FROM public.session WHERE session = 'Sunday Morning')
 ,(SELECT speaker_id FROM public.speaker WHERE speaker_name = 'Russel M. Nelson')
 ,(SELECT talk_id FROM public.talk WHERE talk_name = 'Revelation for the Church, Revelation for Our Lives')
 , 'Stretch beyond your personal ability to receive revelation.'
);

INSERT INTO public.note
  (user_id
  ,session_id
  ,speaker_id
  ,talk_id
  ,note)
  VALUES
 ((SELECT user_id FROM public.user WHERE user_name = 'Tammy')
 ,(SELECT session_id FROM public.session WHERE session = 'Sunday Afternoon')
 ,(SELECT speaker_id FROM public.speaker WHERE speaker_name = 'Russel M. Nelson')
 ,(SELECT talk_id FROM public.talk WHERE talk_name = 'Let Us All Press On')
 , 'Include conference talks in FHE over next 6 months.'
);

INSERT INTO public.note
  (user_id
  ,session_id
  ,speaker_id
  ,talk_id
  ,note)
  VALUES
 ((SELECT user_id FROM public.user WHERE user_name = 'Tammy')
 ,(SELECT session_id FROM public.session WHERE session = 'Sunday Afternoon')
 ,(SELECT speaker_id FROM public.speaker WHERE speaker_name = 'Russel M. Nelson')
 ,(SELECT talk_id FROM public.talk WHERE talk_name = 'Let Us All Press On')
 , 'Spend time in the temple.'
);

SELECT s.speaker_name AS Speaker, t.talk_name AS Talk, n.note AS Note
FROM note n, talk t, speaker s
WHERE s.speaker_name = 'Russel M. Nelson'
AND s.speaker_id = n.speaker_id
AND t.talk_id = n.talk_id
ORDER BY t.talk_name
;
