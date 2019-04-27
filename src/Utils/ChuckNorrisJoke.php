<?php


namespace App\Utils;


use App\Interfaces\JokeGenerator;
use GuzzleHttp\Client as HttpClient;
use Symfony\Component\HttpFoundation\Response;

class ChuckNorrisJoke implements JokeGenerator
{
    private const BASE_URL = 'http://api.icndb.com/';

    public function getCategories(): array
    {
        return $this->apiGet('categories');
    }

    public function randomJoke(string $category = null): string
    {
        $resource = 'jokes/random/1';

        if(!is_null($category)) {
            $resource .= '?limitTo=['.$category.']';
        }

        $joke = $this->apiGet($resource);

        if(!is_array($joke)) {
            throw new \Exception('No jokes currently available');
        }

        return array_shift($joke)->joke;
    }

    /**
     * @param string $resource
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function apiGet(string $resource)
    {
        $client = new HttpClient();
        $response = $client->request('GET', self::BASE_URL . $resource);

        if($response->getStatusCode() !== Response::HTTP_OK) {
            $details = [
                'status' => $response->getStatusCode(),
                'body' => (string) $response->getBody()
            ];
            throw new \Exception('Problems with response from icndb.com: ' . json_encode($details));
        }

        return json_decode($response->getBody())->value;
    }
}