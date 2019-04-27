<?php


namespace App\Tests\Utils;


use App\Utils\ChuckNorrisJoke;
use PHPUnit\Framework\TestCase;

class ChuckNorrisJokeTest extends TestCase
{
    /**
     * @var ChuckNorrisJoke
     */
    protected static $jokeGenerator;

    public static function setUpBeforeClass()
    {
        self::$jokeGenerator = new ChuckNorrisJoke();
    }

    public static function tearDownAfterClass()
    {
        self::$jokeGenerator = null;
    }

    public function testRandomJoke()
    {
        $this->assertInternalType('string', self::$jokeGenerator->randomJoke());
    }

    public function testGetCategories()
    {
        $categories = self::$jokeGenerator->getCategories();

        $this->assertEquals(['explicit', 'nerdy'], $categories);
    }
}