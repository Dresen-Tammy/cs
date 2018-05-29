CREATE TABLE topic (
  id    SERIAL      NOT NULL,
  name  VARCHAR(50) NOT NULL
);

INSERT INTO topic
VALUES
(1
,'Faith');

INSERT INTO topic
VALUES
(2
,'Sacrifice');

INSERT INTO topic
VALUES
(3
,'Charity');

ALTER TABLE public.scriptures
  ADD CONSTRAINT pk_scriptures_1 PRIMARY KEY (id);

ALTER TABLE public.topic
  ADD CONSTRAINT pk_topic_2 PRIMARY KEY (id);

CREATE TABLE scriptures_topics (
  scripture_id INTEGER NOT NULL,
  topic_id     INTEGER NOT NULL,
  CONSTRAINT fk_scripTop_1 FOREIGN KEY (scripture_id) REFERENCES public.scriptures(id),
  CONSTRAINT fk_scipTop_1  FOREIGN KEY (topic_id) REFERENCES public.topic(id)
);


INSERT INTO