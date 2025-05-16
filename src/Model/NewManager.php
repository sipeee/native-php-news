<?php

namespace App\Model;

use App\Model\Crud\Configuration\CrudConfigurationInterface;
use App\Model\Crud\Form\FormValidator;
use Symfony\Component\HttpFoundation\Request;

class NewManager
{
    private CrudConfigurationInterface $configuration;

    public function __construct(CrudConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;
    }

    public function handle(): ?array
    {
        $formData = $this->createNewRow();

        $request = RequestStack::getInstance()->getRequest();
        $formErrors = [];
        if ($request->isMethod(Request::METHOD_POST) && $request->request->has('form')) {
            $formData = array_merge($request->request->all('form'), $request->files->all('form'));
            $formValidator = new FormValidator($this->configuration, false);
            $formErrors = $formValidator->getFormErrors($formData);

            if (empty($formErrors)) {
                $formData = $this->configuration->modifySubmittedCreateFormData($formData);

                $this->saveCreatableRow($formData);

                return null;
            }
        }

        return [
            'fields' => $this->configuration->getCreateFields(),
            'row' => $formData,
            'request' => $request,
            'formErrors' => $formErrors,
        ];
    }

    private function createNewRow(): array
    {
        $row = [];
        foreach ($this->configuration->getCreateFields() as $field) {
            $row[$field->getName()] = null;
        }

        return $row;
    }

    private function saveCreatableRow(array $formData)
    {
        $columns = array_keys($formData);

        $connection = ConnectionProvider::getInstance()->getConnection();
        $statement = $connection->prepare(sprintf('INSERT %s (%s) VALUES (%s)',
            $this->configuration->getTableName(), implode(', ', $columns), implode(', ', array_fill(0, count($columns), '?'))
        ));

        $counter = 1;
        foreach ($formData as $value) {
            $statement->bindValue($counter++, $value);
        }

        $statement->execute();
    }
}