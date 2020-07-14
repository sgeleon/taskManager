use a0297633_taskmanager;

create table `task` (
    `ID` INT UNSIGNED not null AUTO_INCREMENT PRIMARY KEY,
    `USER_NAME` TEXT not null,
    `EMAIL` TEXT not null,
    `MASSAGE` TEXT not null,
    `STATUS` CHAR(1) DEFAULT 'N',
    `EDITED` CHAR(1) DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create table `user` (
    `ID` INT UNSIGNED not null AUTO_INCREMENT PRIMARY KEY,
    `NAME` TEXT not null,
    `PASSWORD` TEXT not null
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
