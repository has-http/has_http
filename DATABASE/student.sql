/*student table (학생 테이블)*/
CREATE TABLE student (
    s_id	VARCHAR(30)	NOT NULL, 
    s_pwd	VARCHAR(30)	NOT NULL, 
    s_name	VARCHAR(30)	NOT NULL, 
    s_year	INTEGER		NOT NULL, 
    CONSTRAINT student_pk PRIMARY KEY (s_id)
);