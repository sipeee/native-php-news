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

    public function queryPublishedArticleById(int $id): ?array
    {
        $now = new \DateTime();
        $connection = ConnectionProvider::getInstance()->getConnection();
        $statement = $connection->prepare('SELECT n.id, u.name AS author, n.publish_at, n.title, n.short_content, n.content, n.image FROM `news` AS n LEFT JOIN `users` AS u ON n.author_id = u.id WHERE n.id = :id AND n.publish_at <= :now LIMIT 0, 1');
        $statement->bindValue('id', $id);
        $statement->bindValue('now', $now->format('Y-m-d H:i:s'));
        $statement->execute();

        return $this->getFirstRow($statement->fetchAll(\PDO::FETCH_ASSOC));
    }

    private function getFirstRow(array $rows): ?array
    {
        return !empty($rows)
            ? $rows[0]
            : null;
    }
}