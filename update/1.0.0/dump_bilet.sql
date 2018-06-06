CREATE TABLE `prefix_test_bilet` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `title` VARCHAR(50) NULL DEFAULT NULL , 
    `test_id` INT NOT NULL , 
    `description` VARCHAR(500) NULL DEFAULT NULL , 
    PRIMARY KEY (`id`), 
    INDEX (`test_id`)
) 
ENGINE = InnoDB 
CHARSET=utf8 
COLLATE utf8_bin;