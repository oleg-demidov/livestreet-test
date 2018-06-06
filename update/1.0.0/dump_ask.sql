CREATE TABLE `prefix_test_test_ask` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `test_id` INT NOT NULL , 
    `bilet_id` INT NULL , 
    `right_ans` INT NULL ,
    `title` VARCHAR(50) NULL , 
    `text` VARCHAR(1000) NOT NULL , 
    `hint` VARCHAR(2000) NULL , 
     `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP 
    PRIMARY KEY (`id`), 
    INDEX (`test_id`), 
    INDEX (`text`), 
    INDEX (`bilet_id`), 
    INDEX (`test_id`)) 
ENGINE = InnoDB;