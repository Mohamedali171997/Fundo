<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CommentCrudController extends AbstractCrudController  implements EventSubscriberInterface
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }


    public function configureFields(string $pageName): iterable
    {
       // $publishedAtField = DateTimeField::new('publishedAt');
//$publishedAtField->setDefault(new \DateTimeImmutable());
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('post')
                ->formatValue(function ($value, $entity) {
                    return $value->getTitle(); // Assuming you have a getTitle() method in your Post entity
                }),
            AssociationField::new('author')
                ->formatValue(function ($value, $entity) {
                    return $entity->getAuthor()->getUsername(); // Adjust this based on your User entity
                })
                ->autocomplete()
                ->setRequired(true),
            TextField::new('content'),
            DateTimeField::new('publishedAt')->setValue(new \DateTimeImmutable()) ->hideOnForm(),

        ];


    }
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setPublishedAt'],
        ];
    }

    public function setPublishedAt(BeforeEntityPersistedEvent $event): void
    {
        $entity = $event->getEntityInstance();
        if ($entity instanceof Comment) {
            $entity->setPublishedAt(new \DateTimeImmutable());
        }
    }

}
