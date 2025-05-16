<?php

namespace App\Model\Crud\Field;

use Symfony\Component\Validator\Constraint;

class FormField
{
    private string $name;
    private string $label;
    private string $type = 'text';
    private array $parameters = [];
    private array $constraints = [];

    public function __construct(
        string $name,
        string $label,
        string $type = 'text',
        array  $parameters = [],
        array  $constraints = []
    )
    {
        $this->constraints = $constraints;
        $this->parameters = $parameters;
        $this->type = $type;
        $this->label = $label;
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @return array<Constraint>
     */
    public function getConstraints(): array
    {
        return $this->constraints;
    }
}