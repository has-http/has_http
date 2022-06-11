/*cource의 스포츠 생활 수정*/
INSERT INTO course VALUES ('3037', '스포츠 생활(여)', 2, '체육');
UPDATE `course` SET `c_name` = '스포츠 생활(남)' WHERE (`c_no` = '3027');

/*teach의 스포츠 생활 수정*/
INSERT INTO `test_schema2`.`teach` (`t_time`, `t_no`, `t_max`, `c_no`, `c_name`, `c_count`) VALUES ('2B3', '1', '30', '3037', '스포츠 생활(여)', '2');
INSERT INTO `test_schema2`.`teach` (`t_time`, `t_no`, `t_max`, `c_no`, `c_name`, `c_count`) VALUES ('2B3', '2', '30', '3037', '스포츠 생활(여)', '2');
INSERT INTO `test_schema2`.`teach` (`t_time`, `t_no`, `t_max`, `c_no`, `c_name`, `c_count`) VALUES ('2C3', '3', '30', '3037', '스포츠 생활(여)', '2');
INSERT INTO `test_schema2`.`teach` (`t_time`, `t_no`, `t_max`, `c_no`, `c_name`, `c_count`) VALUES ('2C3', '4', '30', '3037', '스포츠 생활(여)', '2');
INSERT INTO `test_schema2`.`teach` (`t_time`, `t_no`, `t_max`, `c_no`, `c_name`, `c_count`) VALUES ('2A3', '5', '30', '3037', '스포츠 생활(여)', '2');
INSERT INTO `test_schema2`.`teach` (`t_time`, `t_no`, `t_max`, `c_no`, `c_name`, `c_count`) VALUES ('2A3', '6', '30', '3037', '스포츠 생활(여)', '2');
INSERT INTO `test_schema2`.`teach` (`t_time`, `t_no`, `t_max`, `c_no`, `c_name`, `c_count`) VALUES ('2E3', '7', '30', '3037', '스포츠 생활(여)', '2');
INSERT INTO `test_schema2`.`teach` (`t_time`, `t_no`, `t_max`, `c_no`, `c_name`, `c_count`) VALUES ('2E3', '8', '30', '3037', '스포츠 생활(여)', '2');

UPDATE `test_schema2`.`teach` SET `c_name` = '스포츠 생활(남)' WHERE (`t_no` = '1') and (`c_no` = '3027');
UPDATE `test_schema2`.`teach` SET `c_name` = '스포츠 생활(남)' WHERE (`t_no` = '2') and (`c_no` = '3027');
UPDATE `test_schema2`.`teach` SET `c_name` = '스포츠 생활(남)' WHERE (`t_no` = '3') and (`c_no` = '3027');
UPDATE `test_schema2`.`teach` SET `c_name` = '스포츠 생활(남)' WHERE (`t_no` = '4') and (`c_no` = '3027');
UPDATE `test_schema2`.`teach` SET `c_name` = '스포츠 생활(남)' WHERE (`t_no` = '5') and (`c_no` = '3027');
UPDATE `test_schema2`.`teach` SET `c_name` = '스포츠 생활(남)' WHERE (`t_no` = '6') and (`c_no` = '3027');
UPDATE `test_schema2`.`teach` SET `c_name` = '스포츠 생활(남)' WHERE (`t_no` = '7') and (`c_no` = '3027');
UPDATE `test_schema2`.`teach` SET `c_name` = '스포츠 생활(남)' WHERE (`t_no` = '8') and (`c_no` = '3027');

