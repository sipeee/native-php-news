<?php

use Phpmig\Migration\Migration;

class CreateBaseDb extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $container = $this->getContainer();
        /** @var \PDO $connection */
        $connection = $container['connection'];
        $connection->query(<<<SQL
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);
SQL
        );

        $connection->query(<<<SQL
CREATE TABLE news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    author_id INT NOT NULL,
    publish_at DATETIME NOT NULL,
    title VARCHAR(255) NOT NULL,
    short_content TEXT NOT NULL,
    content TEXT NOT NULL,
    image VARCHAR(255) NOT NULL,
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE CASCADE
);            
SQL
        );
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $container = $this->getContainer();
        /** @var \PDO $connection */
        $connection = $container['connection'];
        $connection->query('DROP TABLE news');
        $connection->query('DROP TABLE users');
    }
}