CREATE TABLE `prefix_test` ( 
    `id` INT NOT NULL AUTO_INCREMENT ,
    `title` VARCHAR(100) NOT NULL , 
    `code` VARCHAR(50) NOT NULL ,
    `topic_id` INT NULL,
    `state` TINYINT NOT NULL, 
    KEY (`state`),
    PRIMARY KEY (`id`)) 
ENGINE = InnoDB 
CHARSET=utf8 
COLLATE utf8_bin;