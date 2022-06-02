/*demand table (수요조사 테이블)*/
CREATE TABLE demand (
    s_id	VARCHAR(30)	NOT NULL, 
    c_no	VARCHAR(30)	NOT NULL, 
    c_name	VARCHAR(60)	NOT NULL, 
    t_no	INTEGER		
);

ALTER TABLE demand
    ADD CONSTRAINT fk_student_pk FOREIGN KEY (s_id)
        REFERENCES student (s_id);

ALTER TABLE demand
    ADD CONSTRAINT FK_enroll_year_teach_t_year FOREIGN KEY (c_no, t_no)
        REFERENCES teach (c_no, t_no);