 CREATE TABLE IF NOT EXISTS `wg_organizer_development`.`Messages` (
  `id` INT( 11 ) NOT NULL ,
  `from` VARCHAR( 100 ) NOT NULL ,
  `resident_id` INT( 11 ) NOT NULL ,
  `message` VARCHAR( 500 ) NOT NULL ,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `title` VARCHAR( 80 ) NOT NULL ,
  PRIMARY KEY ( `id` )
) ENGINE = MYISAM;

 ALTER TABLE `Messages` CHANGE `id` `id` INT( 11 ) NOT NULL AUTO_INCREMENT;