<?php


namespace App\Tests\Service;

use App\Utils\ChuckNorrisJoke;
use App\Service\JokeService;
use PHPUnit\Framework\TestCase;


class JokeServiceTest extends TestCase
{

    /**
     * @var JokeService
     */
    protected static $jokeService;

    public static function setUpBeforeClass()
    {
        self::$jokeService = new JokeService(new ChuckNorrisJoke());
    }

    public static function tearDownAfterClass()
    {
        self::$jokeService = null;
    }

    public function testGetCategories()
    {
        $categories = self::$jokeService->getCategories();

        $this->assertTrue(is_array($categories));
    }

    public function testRandomJoke()
    {

        $joke = self::$jokeService->randomJoke();

        $this->assertInternalType('string', $joke, "Got a " . gettype($joke) . " instead of a string");
    }
}