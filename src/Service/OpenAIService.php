<?php

use Symfony\Contracts\HttpClient\HttpClientInterface;

class OpenAIService
{
  private $client;

  // constructor
  public function __construct(HttpClientInterface $client)
  {
    $this->client = $client;
  }
  
  /**
   * sendRequestToOpenAI
   *
   * @param  string $prompt
   * @param  string $context
   * @return string
   */
  public function getGPTResponse(string $prompt, string $context): string
  {
    $base_prompt = "";
    $prompt = $base_prompt . $prompt;

    $post_fields = array(
      "model" => "gpt-3.5-turbo",
      "messages" => array(
        array(
          "role" => "system",
          "content" => $context,
        ),
        array(
          "role" => "user",
          "content" => $prompt
        )
      ),
      "temperature" => 0
    );

    $response = $this->client->request(
      "POST",
      "https://api.openai.com/v1/chat/completions",
      [
        "headers" => [
          'Authorization' => 'Bearer ' . $_ENV['OPENAI_API_KEY'],
        ],
        "json" => $post_fields
      ]
    );

    // dd($response->toArray());

    // check if the response is successful
    if ($response->getStatusCode() === 200) {
      return $response->toArray()['choices'][0]['message']['content'];
    } else {
      throw new \Exception("Error Processing Request", 1);
    }
  }
}
