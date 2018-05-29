CREATE TABLE topic (
  id    SERIAL      PRIMARY KEY,
  name  VARCHAR(50) NOT NULL,
  CONSTRAINT uq_topic_1 UNIQUE (name);
);

INSERT INTO topic (name)
VALUES ('Faith'),('Sacrifice'),('Charity');

ALTER TABLE public.scriptures
  ADD CONSTRAINT pk_scriptures_1 PRIMARY KEY (id);

ALTER TABLE public.scriptures
  ADD CONSTRAINT uq_scriptures_1 UNIQUE (book, chapter, verse);

CREATE TABLE topic_scripture (
  topic_id INT NOT NULL,
  scripture_id INT NOT NULL,
  PRIMARY KEY (topic_id, scripture_id),
  CONSTRAINT fk_topic_scripture_topic FOREIGN KEY (topic_id) REFERENCES topic (id),
  CONSTRAINT fk_topic_scripture_scripture FOREIGN KEY (scripture_id) REFERENCES scriptures (id),
  CONSTRAINT uq_scrip_Top_1 UNIQUE (scripture_id, topic_id);
);

CREATE INDEX fk_topic_scripture_scripture_idx ON topic_scripture (scripture_id ASC);

CREATE INDEX fk_topic_scripture_topic_idx ON topic_scripture (topic_id ASC);


INSERT INTO topic_scripture (topic_id, scripture_id)
VALUES (1,1);

conference=# INSERT INTO topic_scripture
VALUES (2,1), (2,2), (3,3), (4,3), (3,4);
