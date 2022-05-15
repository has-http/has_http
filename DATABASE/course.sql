/*course table (과목정보 테이블)*/
CREATE TABLE course (
    c_no	VARCHAR(30)	NOT NULL, 
    c_name	VARCHAR(60)	NOT NULL, 
    c_count	INTEGER		NOT NULL, 
    CONSTRAINT course_pk PRIMARY KEY (c_no)
);