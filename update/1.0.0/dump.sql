CREATE TABLE `prefix_test_test` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `title` VARCHAR(100) NOT NULL , 
    `desc` VARCHAR(1000) NULL DEFAULT NULL ,
     `name` VARCHAR(50) NOT NULL , 
    `category_type_id` INT NULL , 
    PRIMARY KEY (`id`),
    KEY (`name`), 
    KEY (`category_type_id`)
) 
ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_bin;