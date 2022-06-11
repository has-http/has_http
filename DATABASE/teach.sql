-- teach table (수업 테이블: 블록코드, 과목코드, 과목명, 분반, 현재 인원 수, 최대 인원 수)

--
-- 1. TABLE STRUCTURE
--
DROP TABLE IF EXISTS teach;
CREATE TABLE teach (
    b_code      VARCHAR(30) NOT NULL,
    c_no        VARCHAR(30)	NOT NULL,
    c_name      VARCHAR(60) NOT NULL,
    t_no        INTEGER		NOT NULL,
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

--
-- 2. DUMPING DATA
--
INSERT INTO teach VALUES ('4B3', '3001', '심화 국어', 1, 0, 30);
INSERT INTO teach VALUES ('4F3', '3001', '심화 국어', 2, 0, 30);
INSERT INTO teach VALUES ('4A3', '3001', '심화 국어', 3, 0, 30);
INSERT INTO teach VALUES ('4C3', '3001', '심화 국어', 4, 0, 30);
INSERT INTO teach VALUES ('4H3', '3001', '심화 국어', 5, 0, 30);
INSERT INTO teach VALUES ('4E3', '3001', '심화 국어', 6, 0, 30);

INSERT INTO teach VALUES ('4G3', '3002', '고전읽기', 1, 0, 30);

INSERT INTO teach VALUES ('4A3', '3003', 'AP 미적분학', 1, 0, 30);

INSERT INTO teach VALUES ('4B3', '3004', '수학세미나 I', 1, 0, 30);
INSERT INTO teach VALUES ('4C3', '3004', '수학세미나 I', 2, 0, 30);
INSERT INTO teach VALUES ('4F3', '3004', '수학세미나 I', 3, 0, 30);

INSERT INTO teach VALUES ('2A3', '3005', '수학 과제연구', 1, 0, 30);

INSERT INTO teach VALUES ('2A3', '3006', '수학적 사고와 통계', 1, 0, 30);
INSERT INTO teach VALUES ('2C3', '3006', '수학적 사고와 통계', 2, 0, 30);

INSERT INTO teach VALUES ('4G3', '3007', '통합수학 I', 1, 0, 30);
INSERT INTO teach VALUES ('4D3', '3007', '통합수학 I', 2, 0, 30);
INSERT INTO teach VALUES ('4E3', '3007', '통합수학 I', 3, 0, 30);
INSERT INTO teach VALUES ('4C3', '3007', '통합수학 I', 4, 0, 30);
INSERT INTO teach VALUES ('4F3', '3007', '통합수학 I', 5, 0, 30);
INSERT INTO teach VALUES ('4C3', '3007', '통합수학 I', 6, 0, 30);

INSERT INTO teach VALUES ('4D3', '3008', '응용수학탐구', 1, 0, 30);
INSERT INTO teach VALUES ('4H3', '3008', '응용수학탐구', 2, 0, 30);
INSERT INTO teach VALUES ('4B3', '3008', '응용수학탐구', 3, 0, 30);

INSERT INTO teach VALUES ('4G3', '3009', '심화 영어 I', 1, 0, 30);
INSERT INTO teach VALUES ('4E3', '3009', '심화 영어 I', 2, 0, 30);
INSERT INTO teach VALUES ('4F3', '3009', '심화 영어 I', 3, 0, 30);
INSERT INTO teach VALUES ('4A3', '3009', '심화 영어 I', 4, 0, 30);
INSERT INTO teach VALUES ('4C3', '3009', '심화 영어 I', 5, 0, 30);

INSERT INTO teach VALUES ('2A3', '3010', '심화 영어 작문 I', 1, 0, 30);

INSERT INTO teach VALUES ('4E3', '3011', '영어 비평적 읽기와 쓰기', 1, 0, 30);

INSERT INTO teach VALUES ('4D3', '3012', '시사영어', 1, 0, 30);

INSERT INTO teach VALUES ('4E3', '3013', '사회문화', 1, 0, 30);
INSERT INTO teach VALUES ('4C3', '3013', '사회문화', 2, 0, 30);

INSERT INTO teach VALUES ('4A3', '3014', '생활과 윤리', 1, 0, 30);

INSERT INTO teach VALUES ('4F3', '3015', '국제 경제', 1, 0, 30);
INSERT INTO teach VALUES ('4B3', '3015', '국제 경제', 2, 0, 30);

INSERT INTO teach VALUES ('4D3', '3016', '비교문화', 1, 0, 30);
INSERT INTO teach VALUES ('4F3', '3016', '비교문화', 2, 0, 30);

INSERT INTO teach VALUES ('4B3', '3017', 'AP 세계사', 1, 0, 30);

INSERT INTO teach VALUES ('4B3', '3018', '고급 생명과학', 1, 0, 30);
INSERT INTO teach VALUES ('4A3', '3018', '고급 생명과학', 2, 0, 30);

INSERT INTO teach VALUES ('4A3', '3019', '프로그래밍', 1, 0, 30);

INSERT INTO teach VALUES ('4E3', '3020', '유기화학', 1, 0, 30);

INSERT INTO teach VALUES ('4A3', '3021', '고전역학', 1, 0, 30);
INSERT INTO teach VALUES ('4C3', '3021', '고전역학', 2, 0, 30);

INSERT INTO teach VALUES ('4D3', '3022', '응용물리학탐구', 1, 0, 30);
INSERT INTO teach VALUES ('4F3', '3022', '응용물리학탐구', 2, 0, 30);
INSERT INTO teach VALUES ('4E3', '3022', '응용물리학탐구', 3, 0, 30);

INSERT INTO teach VALUES ('4F3', '3023', '응용화학탐구', 1, 0, 30);
INSERT INTO teach VALUES ('4G3', '3023', '응용화학탐구', 2, 0, 30);

INSERT INTO teach VALUES ('4C3', '3024', '응용생명과학탐구', 1, 0, 30);
INSERT INTO teach VALUES ('4D3', '3024', '응용생명과학탐구', 2, 0, 30);
INSERT INTO teach VALUES ('4F3', '3024', '응용생명과학탐구', 3, 0, 30);

INSERT INTO teach VALUES ('4B3', '3025', '응용지구과학탐구', 1, 0, 30);
INSERT INTO teach VALUES ('4C3', '3025', '응용지구과학탐구', 2, 0, 30);

INSERT INTO teach VALUES ('4D3', '3026', '에너지환경과학', 1, 0, 30);
INSERT INTO teach VALUES ('4E3', '3026', '에너지환경과학', 2, 0, 30);

INSERT INTO teach VALUES ('2B3', '3027', '스포츠 생활', 1, 0, 30);
INSERT INTO teach VALUES ('2B3', '3027', '스포츠 생활', 2, 0, 30);
INSERT INTO teach VALUES ('2C3', '3027', '스포츠 생활', 3, 0, 30);
INSERT INTO teach VALUES ('2C3', '3027', '스포츠 생활', 4, 0, 30);
INSERT INTO teach VALUES ('2A3', '3027', '스포츠 생활', 5, 0, 30);
INSERT INTO teach VALUES ('2A3', '3027', '스포츠 생활', 6, 0, 30);
INSERT INTO teach VALUES ('2E3', '3027', '스포츠 생활', 7, 0, 30);
INSERT INTO teach VALUES ('2E3', '3027', '스포츠 생활', 8, 0, 30);

INSERT INTO teach VALUES ('2D3', '3028', '음악사', 1, 0, 30);
INSERT INTO teach VALUES ('2E3', '3028', '음악사', 2, 0, 30);

INSERT INTO teach VALUES ('2D3', '3029', '미술사', 1, 0, 30);
INSERT INTO teach VALUES ('2E3', '3029', '미술사', 2, 0, 30);

INSERT INTO teach VALUES ('4A3', '3030', '음악 전공 실기', 1, 0, 30);
INSERT INTO teach VALUES ('4B3', '3030', '음악 전공 실기', 2, 0, 30);
INSERT INTO teach VALUES ('4D3', '3030', '음악 전공 실기', 3, 0, 30);

INSERT INTO teach VALUES ('4A3', '3031', '매체 미술', 1, 0, 30);
INSERT INTO teach VALUES ('4B3', '3031', '매체 미술', 2, 0, 30);
INSERT INTO teach VALUES ('4H3', '3031', '매체 미술', 3, 0, 30);

INSERT INTO teach VALUES ('2C3', '3032', '현대문학감상', 1, 0, 30);
INSERT INTO teach VALUES ('2A3', '3032', '현대문학감상', 2, 0, 30);

INSERT INTO teach VALUES ('4A3', '3033', '중국어 독해와 작문 I', 1, 0, 30);

INSERT INTO teach VALUES ('4E3', '3034', '일본 문화', 1, 0, 30);
INSERT INTO teach VALUES ('4D3', '3034', '일본 문화', 2, 0, 30);

INSERT INTO teach VALUES ('4C3', '3035', '중국 언어와 문화', 1, 0, 30);

INSERT INTO teach VALUES ('2A3', '3036', '심리학', 1, 0, 30);
INSERT INTO teach VALUES ('2D3', '3036', '심리학', 2, 0, 30);
INSERT INTO teach VALUES ('2C3', '3036', '심리학', 3, 0, 30);
INSERT INTO teach VALUES ('2A3', '3036', '심리학', 4, 0, 30);
INSERT INTO teach VALUES ('2B3', '3036', '심리학', 5, 0, 30);
INSERT INTO teach VALUES ('2D3', '3036', '심리학', 6, 0, 30);
INSERT INTO teach VALUES ('2E3', '3036', '심리학', 7, 0, 30);