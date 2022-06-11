-- student table (학생 테이블: 아이디, 비밀번호, 이름, 기수)

--
-- 1. TABLE STRUCTURE
--
DROP TABLE IF EXISTS student;
CREATE TABLE student (
    s_id        VARCHAR(30)	NOT NULL, 
    s_pw        VARCHAR(60)	NOT NULL, 
    s_name      VARCHAR(60)	NOT NULL, 
    s_year      INTEGER		NOT NULL, 
    CONSTRAINT student_pk PRIMARY KEY (s_id)
);

--
-- 2. DUMPING DATA
--