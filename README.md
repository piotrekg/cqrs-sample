CQRS sample
======

#1. Installation

##1.1. Dependencies
`composer install`

##1.2. Database
Create data base `symfony` or another defined in configuration.

##1.3. Create database `product`
	CREATE TABLE `symfony`.`product` (
	  `id` VARCHAR(36) NOT NULL,
	  `name` VARCHAR(255) NOT NULL,
	  `description` TEXT NOT NULL,
	  `price` FLOAT NOT NULL,
	  `created_at` DATETIME NOT NULL,
	  PRIMARY KEY (`id`));
	 
#2. TODO
- Use in memory storage in test `ProductControllerTest::testList`
- Create Notification service to handle send email
- Move bundles to `Sample/Bundle/` namespace
- Consider user brodway instead of command bus
- Write more tests
- Add `Product` prefix to command and handler
- Create database setup command
- In ProductCreateCommand add redis cache and read it at first in repository
- Handle exceptions
- Add logger
