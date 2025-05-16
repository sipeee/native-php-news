<?php

namespace App\Model\Crud;

use App\Model\ConnectionProvider;
use App\Model\Crud\Configuration\CrudConfigurationInterface;
use App\Model\RequestStack;

class DeleteManager
{
    private CrudConfigurationInterface $configuration;

    public function __construct(CrudConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;
    }

    public function handle(): void
    {
        $request = RequestStack::getInstance()->getRequest();

        $id = $request->query->get('id');
        if (empty($id) || !is_string($id) || !ctype_digit($id)) {
            return;
        }

        $this->deleteRowById($id);
    }

    private function deleteRowById($id): void
    {
        $connection = ConnectionProvider::getInstance()->getConnection();
        $statement = $connection->prepare(sprintf('DELETE FROM %s WHERE id = :id',
            $this->configuration->getTableName()
        ));

        $statement->bindValue('id', $id);

        $statement->execute();
    }
}