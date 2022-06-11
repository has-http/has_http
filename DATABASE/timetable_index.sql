/*timetable_index table (timetable의 index 저장해두는 테이블)*/
CREATE TABLE timetable_index (
    s_id 			VARCHAR(30)	NOT NULL,
    table_index 	INTEGER	NOT NULL,
    CONSTRAINT PRIMARY KEY (s_id)
);

ALTER TABLE timetable_index
    ADD CONSTRAINT fk_timetable_index_pk FOREIGN KEY (s_id)
        REFERENCES student (s_id);