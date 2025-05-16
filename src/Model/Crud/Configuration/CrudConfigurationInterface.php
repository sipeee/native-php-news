<?php

namespace App\Model\Crud\Configuration;

use App\Model\Crud\Field\FormField;

interface CrudConfigurationInterface
{
    public function getTitle(): string;

    public function getTableName(): string;

    /**
     * @return array<int, FormField>
     */
    public function getCreateFields(): array;

    /**
     * @return array<int, FormField>
     */
    public function getEditFields(): array;

    public function modifySubmittedCreateFormData(array $formData): array;

    public function modifySubmittedUpdateFormData(array $formData): array;

}