<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            TextField::new('slug'),
            TextField::new('summary'),
            TextField::new('content'),
            DateTimeField::new('publishedAt')->hideOnForm(),
            AssociationField::new('author')
                ->formatValue(function ($value, $entity) {
                    return $entity->getAuthor()->getUsername(); // Adjust this based on your User entity
                })
                ->autocomplete()
                ->setRequired(true),
            AssociationField::new('comments'),
            AssociationField::new('tags'),
            // Add other fields as needed
        ];
    }

}
