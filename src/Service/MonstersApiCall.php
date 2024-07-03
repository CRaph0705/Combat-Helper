<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class MonstersApiCall
{
    public const API_URL = 'https://www.dnd5eapi.co';
    public array $monsters = [];

    public function __construct(private HttpClientInterface $client)
    {
    }

    public function getAllMonsters()
    {
        if (empty($this->monsters)) {
            $response = $this->client->request('GET', self::API_URL . '/api/monsters');
            dump("request all monsters");
            $content = $response->toArray();
            $this->monsters = $content;
        }
        return $this->monsters;
    }

    public function getMonster(array $monster)
    {
        $response = $this->client->request('GET', self::API_URL . $monster['url']);
        $content = $response->toArray();
        dump("request monster " . $monster['name']);
        return $content;
    }
}