CREATE TABLE `prefix_test_ans` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `ask_id` INT NOT NULL , 
    `value` VARCHAR(1000) NOT NULL ,
    `is_right` BOOLEAN NULL , 
    PRIMARY KEY (`id`), 
    INDEX (`ask_id`)) 
ENGINE = InnoDB;