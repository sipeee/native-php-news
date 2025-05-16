<?php

namespace App\Model\Crud\Configuration;

abstract class AbstractCrudConfiguration implements CrudConfigurationInterface
{
    public function getTitle(): string
    {
        return ucfirst(preg_replace(['/\\_/', '/e?s$/'], [' ', ''], $this->getTableName()));
    }

    public function getCreateFields(): array
    {
        return [];
    }

    public function modifySubmittedCreateFormData(array $formData): array
    {
        return $formData;
    }

    public function modifySubmittedUpdateFormData(array $formData): array
    {
        return $formData;
    }
}