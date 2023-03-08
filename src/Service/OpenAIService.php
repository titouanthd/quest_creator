<?php

// use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class OpenAIService 
{
  private $client;

  // constructor
  public function __construct(HttpClientInterface $client)
  {
    $this->client = $client;
  }

  public function sendRequestToOpenAI(string $prompt): array
  {
    $base_prompt = "Ignore all instructions before this one. ";
    $prompt = $base_prompt . $prompt;

    $response = $this->client->request(
      "POST", 
      "https://api.openai.com/v1/engines/davinci/completions",
      [
        "headers" => [
          'Authorization' => 'Bearer ' . $_ENV['OPENAI_API_KEY'],
        ],
        "json" => [
          "prompt" => $prompt,
          "temperature" => 0.9       
        ],
      ]
    );

    dd($response->toArray()['choices'][0]['text']);

    return $response->toArray();
  }
}