<?php

namespace App\ApiResource\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\ApiResource\Resource\BookResponseResource;
use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;

class CreateBookProcessor implements ProcessorInterface
{

    /**
     * @param string $string
     * @param string $class
     */
    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }

    /**
     * @param BookResponseResource $data
     * @param Operation $operation
     * @param array $uriVariables
     * @param array $context
     * @return BookResponseResource
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): BookResponseResource
    {
        $em = $this->entityManager;
        $book = new Book(title: $data->title, description: $data->description, author: $data->author);
        $em->persist($book);
        $em->flush();

        return BookResponseResource::fromEntity($book);



    }


}