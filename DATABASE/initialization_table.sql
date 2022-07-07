DROP TABLE IF EXISTS enroll;
DROP TABLE IF EXISTS demand;
DROP TABLE IF EXISTS teach;
DROP TABLE IF EXISTS course;

CREATE TABLE course (
    c_no	    VARCHAR(30)	NOT NULL, 
    c_name	    VARCHAR(60)	NOT NULL, 
    c_classify	VARCHAR(60)	NOT NULL, 
    c_count 	INTEGER		NOT NULL, 
    CONSTRAINT course_pk PRIMARY KEY (c_no)
);

CREATE TABLE teach (
    b_code      VARCHAR(30) NOT NULL,
    c_no        VARCHAR(30)	NOT NULL,
    c_name      VARCHAR(60) NOT NULL,
    t_no        INTEGER		NOT NULL,
    t_dem       INTEGER     NOT NULL,
    t_now       INTEGER		NOT NULL,
    t_max       INTEGER		NOT NULL,
    CONSTRAINT teach_pk PRIMARY KEY (c_no, t_no)
);

ALTER TABLE teach
    ADD CONSTRAINT fk_brick_pk FOREIGN KEY (b_code)
        REFERENCES brick (b_code);
ALTER TABLE teach
    ADD CONSTRAINT fk_course_pk FOREIGN KEY (c_no)
        REFERENCES course (c_no);
        
CREATE TABLE demand (
    s_id    VARCHAR(30) NOT NULL,
    c_no    VARCHAR(30) NOT NULL,
    t_no    INTEGER             ,    
    CONSTRAINT  PRIMARY KEY (s_id, c_no)
);

ALTER TABLE demand
    ADD CONSTRAINT fk_demand_student_pk FOREIGN KEY (s_id)
        REFERENCES student (s_id);
ALTER TABLE demand
    ADD CONSTRAINT fk_demand_teach_pk FOREIGN KEY (c_no)
        REFERENCES teach (c_no);


CREATE TABLE enroll (
    s_id        VARCHAR(30) NOT NULL,
    c_no        VARCHAR(30) NOT NULL,
    t_no        INTEGER     ,
    CONSTRAINT  PRIMARY KEY (s_id, c_no)
);

ALTER TABLE enroll
    ADD CONSTRAINT fk_student_pk FOREIGN KEY (s_id)
        REFERENCES student (s_id);
ALTER TABLE enroll
    ADD CONSTRAINT fk_teach_pk FOREIGN KEY (c_no)
        REFERENCES teach (c_no);