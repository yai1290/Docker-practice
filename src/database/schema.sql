
create database if not exists `docker_practice`;

create table if not exists `docker_practice`.`clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

insert into `docker_practice`.`clientes` (`name`, `email`) values
('John Doe', '