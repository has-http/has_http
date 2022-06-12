-- course table (과목정보 테이블: 과목코드, 과목명, 단위수)

--
-- 1. TABLE STRUCTURE
--
DROP TABLE IF EXISTS course;
CREATE TABLE course (
    c_no	    VARCHAR(30)	NOT NULL, 
    c_name	    VARCHAR(60)	NOT NULL, 
    c_classify	VARCHAR(60)	NOT NULL, 
    c_count 	INTEGER		NOT NULL, 
    CONSTRAINT course_pk PRIMARY KEY (c_no)
);

--
-- 2. DUMPING DATA
--
INSERT INTO course VALUES ('3001', '심화 국어', '국어', 4);
INSERT INTO course VALUES ('3002', '고전읽기', '국어', 4);
INSERT INTO course VALUES ('3003', 'AP 미적분학', '수학', 4);
INSERT INTO course VALUES ('3004', '수학세미나 I', '수학', 4);
INSERT INTO course VALUES ('3005', '수학 과제연구', '수학', 2);
INSERT INTO course VALUES ('3006', '수학적 사고와 통계', '수학', 2);
INSERT INTO course VALUES ('3007', '통합수학', '수학', 4);
INSERT INTO course VALUES ('3008', '응용수학탐구', '수학', 4);
INSERT INTO course VALUES ('3009', '심화 영어 I', '영어', 4);
INSERT INTO course VALUES ('3010', '심화 영어 작문 I', '영어', 2);
INSERT INTO course VALUES ('3011', '영어 비평적 읽기와 쓰기', '영어', 4);
INSERT INTO course VALUES ('3012', '시사영어', '영어', 4);
INSERT INTO course VALUES ('3013', '사회문화', '사회', 4);
INSERT INTO course VALUES ('3014', '생활과 윤리', '사회', 4);
INSERT INTO course VALUES ('3015', '국제 경제', '사회', 4);
INSERT INTO course VALUES ('3016', '비교 문화', '사회', 4);
INSERT INTO course VALUES ('3017', 'AP 세계사', '사회', 4);
INSERT INTO course VALUES ('3018', '고급 생명과학', '과학', 4);
INSERT INTO course VALUES ('3019', '프로그래밍', '과학', 2);
INSERT INTO course VALUES ('3020', '유기화학', '과학', 4);
INSERT INTO course VALUES ('3021', '고전역학', '과학', 4);
INSERT INTO course VALUES ('3022', '응용물리학탐구', '과학', 4);
INSERT INTO course VALUES ('3023', '응용화학탐구', '과학', 4);
INSERT INTO course VALUES ('3024', '응용생명과학탐구', '과학', 4);
INSERT INTO course VALUES ('3025', '응용지구과학탐구', '과학', 4);
INSERT INTO course VALUES ('3026', '에너지환경과학', '과학', 4);
INSERT INTO course VALUES ('3027', '스포츠 생활(남)', '체육', 2);
INSERT INTO course VALUES ('3028', '스포츠 생활(여)', '체육', 2);
INSERT INTO course VALUES ('3029', '음악사', '예술', 2);
INSERT INTO course VALUES ('3030', '미술사', '예술', 2);
INSERT INTO course VALUES ('3031', '음악 전공 실기', '예술', 4);
INSERT INTO course VALUES ('3032', '매체 미술', '예술', 4);
INSERT INTO course VALUES ('3033', '현대문학감상', '예술', 2);
INSERT INTO course VALUES ('3034', '중국어 독해와 작문 I', '제2외국어', 4);
INSERT INTO course VALUES ('3035', '일본 문화', '제2외국어', 4);
INSERT INTO course VALUES ('3036', '중국 언어와 문화', '제2외국어', 4);
INSERT INTO course VALUES ('3037', '심리학', '교양', 2);