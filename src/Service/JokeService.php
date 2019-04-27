<?php


namespace App\Service;


use App\Interfaces\JokeGenerator;

class JokeService
{
    /**
     * @var JokeGenerator
     */
    private $jokeGenerator;

    public function __construct(JokeGenerator $jokeGenerator)
    {
        $this->jokeGenerator = $jokeGenerator;
    }

    public function randomJoke(string $category = null): string
    {
        return $this->jokeGenerator->randomJoke($category);
    }

    public function getCategories(): array
    {
        return $this->jokeGenerator->getCategories();
    }
}