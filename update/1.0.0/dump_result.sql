CREATE TABLE `prefix_test_result` ( 
`id` BIGINT NOT NULL AUTO_INCREMENT , 
`user_id` BIGINT NOT NULL , 
`ask_id` SMALLINT NOT NULL , 
`test_id` SMALLINT NOT NULL,
`bilet_id` SMALLINT NULL,
`category_id` SMALLINT NULL,
`result` TINYINT NOT NULL , 
`type` ENUM('bilet','category') NOT NULL , 
`tmp` TINYINT NOT NULL DEFAULT 0,

PRIMARY KEY (`id`), INDEX (`user_id`), 
INDEX (`ask_id`), INDEX (`test_id`), INDEX (`type`),
UNIQUE `uni` (`user_id`, `ask_id`, `type`) USING BTREE
) 
ENGINE = InnoDB 
CHARSET=utf8 
COLLATE utf8_bin;