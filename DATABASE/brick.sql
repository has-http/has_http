-- brick table (블록 테이블: 블록코드, 블록교시, 교시1, 교시2, 교시3, 교시4)

--
-- 1. TABLE STRUCTURE
--
DROP TABLE IF EXISTS brick;
CREATE TABLE brick (
    b_code      VARCHAR(30) NOT NULL,
    b_time      VARCHAR(60) NOT NULL,
    b_1         INTEGER     NOT NULL,
    b_2         INTEGER     NOT NULL,
    b_3         INTEGER             ,
    b_4         INTEGER             ,
    CONSTRAINT brick_pk PRIMARY KEY (b_code)
);

--
-- 2. DUMPING DATA
--
INSERT INTO brick VALUES ('4A3', '월12목67', 1, 2, 30, 31);
INSERT INTO brick VALUES ('4B3', '월34수56', 3, 4, 21, 22);
INSERT INTO brick VALUES ('4C3', '월5화7목34', 5, 15, 27, 28);
INSERT INTO brick VALUES ('4D3', '화12목7금7', 9, 10, 29, 39);
INSERT INTO brick VALUES ('4E3', '화56금12', 13, 14, 33, 34);
INSERT INTO brick VALUES ('4F3', '수12금34', 17, 18, 35, 36);
INSERT INTO brick VALUES ('4G3', '월67수34', 6, 7, 19, 20);
INSERT INTO brick VALUES ('4H3', '화34금56', 11, 12, 37, 38);
INSERT INTO brick VALUES ('2A3', '목12', 25, 26, 0, 0);
INSERT INTO brick VALUES ('2B3', '월67', 6, 7, 0, 0);
INSERT INTO brick VALUES ('2C3', '수34', 19, 20, 0, 0);
INSERT INTO brick VALUES ('2D3', '화34', 11, 12, 0, 0);
INSERT INTO brick VALUES ('2E3', '금56', 37, 38, 0, 0);