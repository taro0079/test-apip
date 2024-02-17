<?php

namespace App\ApiResource\Resource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\ApiResource\Processor\CreateBookProcessor;
use App\ApiResource\Provider\BookCollectionProvider;
use App\Entity\Book;

#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: '/books',
            provider: BookCollectionProvider::class
        ),
        new Post(
            uriTemplate: '/books',
            processor: CreateBookProcessor::class
        )
    ]

)]
class BookResponseResource
{

    public static function fromEntity(Book $book): static
    {
        return new self(
            id: $book->getId(),
            title: $book->getTitle(),
            description: $book->getDescription(),
            author: $book->getAuthor()
        );
    }

    public function __construct(
        public ?int $id,
        public string $title,
        public string $description,
        public string $author
    ) {
    }
}
