DROP PROCEDURE IF EXISTS insert_enroll;

DELIMITER //

CREATE PROCEDURE insert_enroll (
  IN sStudentId VARCHAR(4000), 
  IN sCourseId VARCHAR(4000), 
  IN nCourseIdNo DOUBLE,
  OUT result VARCHAR(4000))
BEGIN
  DECLARE nSumCourseUnit DOUBLE;
  DECLARE nCourseUnit DOUBLE;
  DECLARE nCnt DOUBLE;
  DECLARE nTeachMax DOUBLE;
  DECLARE overlap DOUBLE;
DECLARE NOT_FOUND INT DEFAULT 0;
  DECLARE duplicate_time_cursor CURSOR FOR
    SELECT *
    FROM enroll
    WHERE s_id = sStudentId;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET NOT_FOUND = 1;

/* 수강 신청 등록 */
INSERT INTO enroll(s_id, c_no, c_name)
VALUES (sStudentId, sCourseId, nCourseIdNo);

COMMIT;
result := '수강신청 등록이 완료되었습니다.';

END;
//

DELIMITER ;