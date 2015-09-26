<?php namespace Phphub\Github;

use OAuth;
use GuzzleHttp\Client;

class GithubRepoDataReader
{
    public function getContributorDataWithRepoName($repo)
    {
        $client = new Client([
            'base_url' => 'https://api.github.com/repos/',
        ]);

        $query['client_id'] = getenv('client_id');
        $query['client_secret'] = getenv('client_secret');

        return $client->get($repo.'/contributors?'.http_build_query($query))->json();
    }
}
