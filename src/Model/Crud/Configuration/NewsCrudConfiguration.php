<?php

namespace App\Model\Crud\Configuration;

use App\Model\Crud\Field\FormField;
use App\Model\Repository;
use App\Utility\ImageMover;
use Symfony\Component\Validator\Constraints as Assert;

class NewsCrudConfiguration extends AbstractCrudConfiguration
{
    public function getTableName(): string
    {
        return 'news';
    }

    public function getTitle(): string
    {
        return 'Article';
    }

    public function getCreateFields(): array
    {
        $repo = new Repository();

        $userChoiceOptions = $repo->queryUserChoiceOptions();

        return [
            new FormField(
                'author_id',
                'User',
                'choice',
                [
                    'required' => true,
                    'options' => $userChoiceOptions,
                ],
                [
                    new Assert\NotBlank(),
                    new Assert\Choice(
                        array_map('strval', array_keys($userChoiceOptions)),
                    ),
                ],
            ),
            new FormField(
                'title',
                'Title',
                'text',
                [
                    'required' => true,
                ],
                [
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 3]),
                ],
            ),
            new FormField(
                'short_content',
                'Short content',
                'text',
                [
                    'required' => true,
                ],
                [
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 3]),
                ],
            ),
            new FormField(
                'content',
                'Content',
                'richtext',
            ),
            new FormField(
                'image',
                'Image',
                'file',
            ),
            new FormField(
                'publish_at',
                'Publish at',
                'datetime',
                [
                    'required' => true,
                ],
                [
                    new Assert\NotBlank(),
                    new Assert\DateTime('Y-m-d\\TH:i'),
                ],
            ),
        ];
    }

    public function modifySubmittedCreateFormData(array $formData): array
    {
        if (null !== $formData['image']) {
            $fileName = ImageMover::moveToDirectory($formData['image'], __DIR__.'/../../../../web/uploads/news');
            $formData['image'] = $fileName;
        }

        return $formData;
    }
}