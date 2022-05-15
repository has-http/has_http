/*teach table (개설 강좌 테이블)*/
CREATE TABLE teach (
    t_time		VARCHAR(30)	NOT NULL, 
    t_no		INTEGER		NOT NULL, 
    t_max		INTEGER		NOT NULL, 
    c_no		VARCHAR(30)	NOT NULL, 
    c_name		VARCHAR(60)	NOT NULL, 
    c_count		INTEGER		NOT NULL, 
    CONSTRAINT teach_pk PRIMARY KEY (t_no, c_no)
);

ALTER TABLE teach
    ADD CONSTRAINT fk_course_pk FOREIGN KEY (c_no)
        REFERENCES course (c_no);