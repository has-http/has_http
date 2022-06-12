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
    CONSTRAINT PRIMARY KEY (b_code)
);

--
-- 2. DUMPING DATA
--
INSERT INTO brick VALUES ('2A3', '목12', 3, 13, null, null);
INSERT INTO brick VALUES ('2B3', '월67', 50, 60, null, null);
INSERT INTO brick VALUES ('2C3', '수34', 22, 32, null, null);
INSERT INTO brick VALUES ('2D3', '화34', 21, 31, null, null);
INSERT INTO brick VALUES ('2E3', '금56', 44, 54, null, null);
INSERT INTO brick VALUES ('4A3', '월12목67', 0, 10, 53, 63);
INSERT INTO brick VALUES ('4B3', '월34수56', 20, 30, 42, 52);
INSERT INTO brick VALUES ('4C3', '월5화7목34', 40, 61, 23, 33);
INSERT INTO brick VALUES ('4D3', '화12목5금7', 1, 11, 43, 64);
INSERT INTO brick VALUES ('4E3', '화56금12', 41, 51, 4, 14);
INSERT INTO brick VALUES ('4F3', '수12금34', 2, 12, 24, 34);
INSERT INTO brick VALUES ('4G3', '월67수34', 50, 60, 22, 32);
INSERT INTO brick VALUES ('4H3', '화34금56', 21, 31, 44, 54);


