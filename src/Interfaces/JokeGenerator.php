<?php


namespace App\Interfaces;


interface JokeGenerator
{
    public function randomJoke(string $category = null): string;

    public function getCategories(): array;
}