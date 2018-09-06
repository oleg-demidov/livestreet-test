CREATE TABLE `prefix_test_ask` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `test_id` INT NOT NULL , 
    `bilet_id` INT NULL , 
    `right_ans` INT NULL ,
    `title` VARCHAR(50) NULL , 
    `text` VARCHAR(1000) NOT NULL , 
    `hint` VARCHAR(2000) NULL , 
    `order` MEDIUMINT NULL DEFAULT NULL,
     `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`), 
    KEY (`test_id`), 
    KEY (`text`), 
    KEY (`bilet_id`), 
    KEY (`test_id`)) 
ENGINE = InnoDB;