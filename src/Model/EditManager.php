<?php

namespace App\Model;

use App\Model\Crud\Configuration\CrudConfigurationInterface;
use App\Model\Crud\Form\FormValidator;
use Symfony\Component\HttpFoundation\Request;

class EditManager
{
    private CrudConfigurationInterface $configuration;

    public function __construct(CrudConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;
    }

    public function handle(): ?array
    {
        $configuration = $this->configuration;
        $request = RequestStack::getInstance()->getRequest();

        $id = $request->query->get('id');
        if (empty($id) || !is_string($id) || !ctype_digit($id)) {
            return null;
        }

        $formData = $this->queryRow($id);

        if (null === $formData) {
            return null;
        }

        $formErrors = [];
        if ($request->isMethod(Request::METHOD_POST) && $request->request->has('form')) {
            $formData = array_merge($request->request->all('form'), $request->files->all('form'));
            $formValidator = new FormValidator($this->configuration, true);
            $formErrors = $formValidator->getFormErrors($formData);

            if (empty($formErrors)) {
                $formData = $configuration->modifySubmittedUpdateFormData($formData);

                $this->saveUpdatableRow($id, $formData);

                return null;
            }
        }

        return[
            'fields' => $this->configuration->getEditFields(),
            'id' => $id,
            'row' => $formData,
            'request' => $request,
            'formErrors' => $formErrors,
        ];
    }

    private function queryRow(int $id): ?array
    {
        $connection = ConnectionProvider::getInstance()->getConnection();
        $statement = $connection->prepare(sprintf('SELECT %s FROM %s WHERE id = :id',
            implode(', ', $this->getEditFieldNames()), $this->configuration->getTableName()
        ));
        $statement->bindValue('id', $id);
        $statement->execute();

        $rows = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return !empty($rows)
            ? reset($rows)
            : null;
    }

    private function saveUpdatableRow($id, array $formData)
    {
        $connection = ConnectionProvider::getInstance()->getConnection();
        $statement = $connection->prepare(sprintf('UPDATE %s SET %s WHERE id = ?',
            $this->configuration->getTableName(), implode(', ', $this->convertToSqlFieldParts($formData))
        ));

        $counter = 1;
        foreach ($formData as $value) {
            $statement->bindValue($counter++, $value);
        }

        $statement->bindValue($counter++, $id);

        $statement->execute();
    }

    private function convertToSqlFieldParts(array $formData): array
    {
        $parts = [];
        foreach ($formData as $field => $value) {
            $parts[] = sprintf('%s = ?', $field);
        }

        return $parts;
    }

    private function getEditFieldNames()
    {
        $names = [];
        foreach ($this->configuration->getEditFields() as $field) {
            $names[] = $field->getName();
        }

        return $names;
    }
}