<?php

namespace App\Model;

class Repository
{
    public function queryNewsByKeyword(?string $keyword, bool $onlyPublished): array
    {
        $connection = ConnectionProvider::getInstance()->getConnection();

        $whereCondition = self::createKeywordConditionInfo($keyword);
        if ($onlyPublished) {
            $now = new \DateTime();
            $whereCondition['sqlParts'][] = 'n.publish_at <= :now';
            $whereCondition['params']['now'] = $now->format('Y-m-d H:i:s');
        }

        $whereSql = implode(' AND ', $whereCondition['sqlParts']);
        if ('' !== $whereSql) {
            $whereSql = 'WHERE ' . $whereSql;
        }

        $statement = $connection->prepare('SELECT n.id, u.name AS author, n.publish_at, n.title, n.short_content FROM `news` AS n LEFT JOIN `users` AS u ON n.author_id = u.id '.$whereSql.' ORDER BY n.publish_at DESC');
        foreach ($whereCondition['params'] as $key => $value) {
            $statement->bindValue($key, $value);
        }
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function queryArticleById(int $id, bool $onlyPublished): ?array
    {
        $whereCondition = [
            'sqlParts' => ['n.id = :id'],
            'params' => ['id' => $id],
        ];

        if ($onlyPublished) {
            $now = new \DateTime();
            $whereCondition['sqlParts'][] = 'n.publish_at <= :now';
            $whereCondition['params']['now'] = $now->format('Y-m-d H:i:s');
        }

        $whereSql = implode(' AND ', $whereCondition['sqlParts']);

        $connection = ConnectionProvider::getInstance()->getConnection();
        $statement = $connection->prepare('SELECT n.id, u.name AS author, n.publish_at, n.title, n.short_content, n.content, n.image FROM `news` AS n LEFT JOIN `users` AS u ON n.author_id = u.id WHERE '.$whereSql.' LIMIT 0, 1');
        foreach ($whereCondition['params'] as $key => $value) {
            $statement->bindValue($key, $value);
        }
        $statement->execute();

        return $this->getFirstRow($statement->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function queryUserByEmail(string $email): ?array
    {
        $connection = ConnectionProvider::getInstance()->getConnection();
        $statement = $connection->prepare('SELECT * FROM `users` WHERE `email` = :email LIMIT 0, 1');
        $statement->bindValue('email', $email);
        $statement->execute();
        $rows = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $this->getFirstRow($rows);
    }

    public function queryUserById(int $id): ?array
    {
        $connection = ConnectionProvider::getInstance()->getConnection();
        $statement = $connection->prepare("SELECT * FROM `users` WHERE `id` = :id");
        $statement->bindValue('id', $id);

        $statement->execute();

        return $this->getFirstRow($statement->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function queryUserChoiceOptions(): ?array
    {
        $connection = ConnectionProvider::getInstance()->getConnection();
        $statement = $connection->prepare("SELECT id, email FROM `users`");

        $statement->execute();
        $rows = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return array_column($rows, 'email', 'id');
    }

    private function getFirstRow(array $rows): ?array
    {
        return !empty($rows)
            ? $rows[0]
            : null;
    }

    private static function createKeywordConditionInfo(?string $keyword)
    {
        if ($keyword === null || '' === $keyword) {
            return ['sqlParts' => [], 'params' => []];
        }

        return [
            'sqlParts' => [
                '(LOWER(n.title) LIKE LOWER(:keyword) OR LOWER(n.short_content) LIKE LOWER(:keyword) OR LOWER(n.content) LIKE LOWER(:keyword) OR LOWER(u.name) LIKE LOWER(:keyword))',
            ],
            'params' => [
                'keyword' => '%'.$keyword.'%',
            ],
        ];
    }
}