CREATE TABLE IF NOT EXISTS `Cashaccounts` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`resident_id` INT NOT NULL ,
`balance` INT NOT NULL DEFAULT '0' COMMENT 'in cents',
UNIQUE (
`resident_id`
)
) ENGINE = MYISAM ;