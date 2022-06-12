-- enroll table (수강등록 테이블: 아이디, 과목코드, 분반)

--
-- 1. TABLE STRUCTURE
--
DROP TABLE IF EXISTS enroll;
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
    ADD CONSTRAINT fk_teach_pk FOREIGN KEY (c_no, t_no)
        REFERENCES teach (c_no, t_no);

--
-- 2. DUMPING DATA
--