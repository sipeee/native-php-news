<?php

namespace App\Model;

class Repository
{
    public function queryPublishedNews(): array
    {
        $now = new \DateTime();
        $connection = ConnectionProvider::getInstance()->getConnection();
        $statement = $connection->prepare('SELECT n.id, u.name AS author, n.publish_at, n.title, n.short_content FROM `news` AS n LEFT JOIN `users` AS u ON n.author_id = u.id WHERE n.publish_at <= :now ORDER BY n.publish_at DESC');
        $statement->bindValue('now', $now->format('Y-m-d H:i:s'));
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}