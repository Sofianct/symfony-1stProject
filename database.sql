CREATE DATABASE IF NOT EXISTS symfony_master;
USE symfony_master;
 
CREATE TABLE IF NOT EXISTS users(
id          int(255) auto_increment not null,
role        varchar(50),
name        varchar(100),
surname     varchar(200),
email       varchar(255),
pasword     varchar(255),
created_at   datetime,
CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;
 
CREATE TABLE IF NOT EXISTS tasks(
id            int(255) auto_increment not null,
user_id       int(255) not null,
title         varchar(255),
content       text,
priority      varchar(20),
hours         int(100),
created_at     datetime,
CONSTRAINT pk_task PRIMARY KEY(id),
CONSTRAINT fk_tasks_user FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;

INSERT INTO `tasks` (`id`, `user_id`, `title`, `content`, `priority`, `hours`, `created_at`) VALUES
(1, 1, 'Tarea 1', 'Contenido de tarea 1', 'high', 40, CURTIME()),
(2, 1, 'Tarea 2', 'Contenido de tarea 2', 'low', 20, CURTIME()),
(3, 2, 'Tarea 3', 'Contenido de tarea 3', 'high', 10, CURTIME()),
(4, 3, 'Tarea 4', 'Contenido de tarea 4', 'low', 50, CURTIME());

INSERT INTO `users` (`id`, `role`, `name`, `surname`, `email`, `pasword`, `created_at`) VALUES
(1, 'ROLE_USER', 'Sofia', 'Romera', 'sofia@email.com', 'password', CURTIME()),
(2, 'ROLE_USER', 'Alexandra', 'Greenaway', 'alexandra@email.com', 'password', CURTIME()),
(3, 'ROLE_USER', 'Marta', 'Lopez', 'marta@email.com', 'password', CURTIME()),
(4, 'ROLE_USER', 'Manuel', 'Perez', 'manuel@email.com', 'password', CURTIME());


ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tasks_user` (`user_id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tasks`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_tasks_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;
