<?php

namespace App\ApiResource\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\Resource\BookResponseResource;
use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;

class BookCollectionProvider implements ProviderInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array
    {
        $em = $this->entityManager;
        $books = $em->getRepository(Book::class)->findAll();
        $resources = array_map(fn (Book $book) => BookResponseResource::fromEntity($book), $books);
        return $resources;
    }
}
