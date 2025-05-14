<?php

use Phpmig\Migration\Migration;

class AddUsers extends Migration
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
ALTER TABLE users
ADD COLUMN email VARCHAR(255) NOT NULL;
SQL
        );

        $connection->query(<<<SQL
ALTER TABLE users
ADD COLUMN password VARCHAR(72) NOT NULL;
SQL
        );

        $this->addNewUser(1, 'Sipos Zoltán', 'sipiszoty@gmail.com', 'password1');
        $this->addNewUser(2, 'Teszt Elek', 'tesztelek@hammeragency.eu', 'password2');
        $this->addNewUser(3, 'Nagy István', 'nagyistvan@hammeragency.eu', 'password3');
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $container = $this->getContainer();
        /** @var \PDO $connection */
        $connection = $container['connection'];
        $connection->query(<<<SQL
ALTER TABLE users
DROP COLUMN email;
SQL
        );
        $connection->query(<<<SQL
ALTER TABLE users
DROP COLUMN password;
SQL
        );
        $connection->query(<<<SQL
SET FOREIGN_KEY_CHECKS = 0;

TRUNCATE TABLE news;
TRUNCATE TABLE users;

SET FOREIGN_KEY_CHECKS = 1;
SQL
        );
    }

    private function addNewUser(int $id, string $name, string $email, string $password): void
    {
        $encoder = new \App\Model\BcryptEncoder();
        $password = $encoder->encodePassword($password);

        $container = $this->getContainer();
        /** @var \PDO $connection */
        $connection = $container['connection'];
        $connection
            ->prepare('INSERT INTO users (id, name, email, password) VALUES (?, ?, ?, ?)')
            ->execute([$id, $name, $email, $password]);
    }
}