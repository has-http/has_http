ALTER TABLE `test_schema2`.`demand` 
ADD COLUMN `d_index` INT(11) NOT NULL AUTO_INCREMENT FIRST,
ADD PRIMARY KEY (`d_index`);
;

ALTER TABLE `test_schema2`.`enroll` 
ADD COLUMN `e_index` INT(11) NOT NULL AUTO_INCREMENT FIRST,
ADD PRIMARY KEY (`e_index`);
;
