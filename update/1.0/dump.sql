ALTER TABLE `prefix_category_target` ADD `object_type` VARCHAR(20) NULL DEFAULT NULL AFTER `target_id`, ADD FULLTEXT (`object_type`) ;
