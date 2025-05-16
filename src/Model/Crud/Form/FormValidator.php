<?php

namespace App\Model\Crud\Form;

use App\Model\Crud\Configuration\CrudConfigurationInterface;
use App\Model\Crud\Field\FormField;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;

class FormValidator
{
    private CrudConfigurationInterface $configuration;

    private bool $isEditValidation;

    public function __construct(
        CrudConfigurationInterface $configuration,
        bool $isEditValidation
    )
    {
        $this->configuration = $configuration;
        $this->isEditValidation = $isEditValidation;
    }

    public function getFormErrors(array $formData): array
    {
        $constraints = $this->getConfigurationFormConstraint();
        $formData = self::normalizeFormData($formData);

        $validator = Validation::createValidator();
        $violations = $validator->validate($formData, $constraints);

        return $this->hydrateViolations($violations);
    }

    private function getConfigurationFormConstraint(): Constraint
    {
        $constraintFields = [];
        foreach ($this->getFormFields() as $formField) {
            $constraintFields[$formField->getName()] = $formField->getConstraints();
        }

        return new Assert\Collection([
            'fields' => $constraintFields,
            'allowMissingFields' => true,
        ]);
    }

    private function hydrateViolations(ConstraintViolationListInterface $violations): array
    {
        $formErrors = [];
        foreach ($violations as $violation) {
            $formErrors[$violation->getPropertyPath()][] = $violation->getMessage();
        }

        return $formErrors;
    }

    /**
     * @return array<FormField>
     */
    private function getFormFields(): array
    {
        return $this->configuration->getCreateFields();
    }

    private static function normalizeFormData(array $formData): array
    {
        foreach ($formData as $key => &$value) {
            if (is_array($value)) {
                $value = self::normalizeFormData($value);
            } elseif (self::isValueBlank($value)) {
                $value = null;
            }
        }

        return $formData;
    }

    private static function isValueBlank($value): bool
    {
        return false === $value || (!$value && '0' != $value);
    }
}