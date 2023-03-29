<?php

use Http\Client\Common\HttpMethodsClientInterface;
use LemonSqueezy\API\User;
use LemonSqueezy\LemonSqueezy;

it('test create client', function () {
    $client = new LemonSqueezy();
    $client->authenticate('eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5NGQ1OWNlZi1kYmI4LTRlYTUtYjE3OC1kMjU0MGZjZDY5MTkiLCJqdGkiOiJhZDdhNzk5ZjMwNmQ5OTQ4OGNjYzhiYjE1NjQ3NjZlNzUzMDgwZmQzMWI1ZTliYjI1M2NmMzA0ODUxNjU5MWI3OWU2MGY5ZDkxZjY5MTZlNCIsImlhdCI6MTY4MDAwNjcyNC4xNjE0MSwibmJmIjoxNjgwMDA2NzI0LjE2MTQxMywiZXhwIjoxNzExNjI5MTI0LjE1MDM2Mywic3ViIjoiMzU4NTAzIiwic2NvcGVzIjpbXX0.ga-QKTHLQeQfRly6_nKdaXMcOZrzdeDbeoiSGf3qT9gluwGwAH2WdMyma6T7saaExL0a6e_1uUjMbTM-sScQKRQxplOVx9qVn96R--2EGxS2f_7JVscVVL9YADhSXOtF2BBBomVS8QcO43IdfiJu-Sse8htHlHB1ZYVO5xaTpGLiToGhxqXzyjEXn96mjF79CKfs4jakK19fFG2vxU4NbtaYt2w_YXF19QkHOySk_1sr_1C5MzjTT9MpdhPp6MuMuIHBzqOfCm6OV0Exonztmwp0te1KnCY1b0ojyV30rfC896TO5SFos2lD6SxtOJlBc1K0_JATeaz7WyySHCuuij_fa289MtTc1Ji2jWjqwBr9LnKsRVjkgRsByixWsohm1ZEfw2grkatQj8zk160l_uGci1pwz6RJYqkzlJtOmwZgGjfL7cL6qXMTPM6UkoXSoZiiGzp5T-KVV4G4RAaDjx3Y5tPckwuZnkNAxPp-S3NZJDkuU0UC--PTNFbXROCy');

    $account = $client->user();
    $accountDetails = $account->getUserInformation();
    ray($accountDetails);

    $accountId = $account->getUserId();
    ray($accountId);

    expect($client)
        ->toBeInstanceOf(LemonSqueezy::class)
        ->and($client->getHttpClient())
        ->toBeInstanceOf(HttpMethodsClientInterface::class);
});

it('test create api', function () {
    $client = new LemonSqueezy();

    expect($client->user())
        ->toBeInstanceOf(User::class);
});
