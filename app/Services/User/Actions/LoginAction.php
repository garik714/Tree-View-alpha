<?php

namespace App\Services\User\Actions;

use App\Exceptions\UserNotFoundException;
use App\Http\Resources\TokensResource;
use App\Repositories\Read\User\UserReadRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Client;

class LoginAction
{
    protected UserReadRepositoryInterface $userReadRepository;

    public function __construct(
        UserReadRepositoryInterface $userReadRepository
    ) {
        $this->userReadRepository = $userReadRepository;
    }

    public function run(string $username, string $password): TokensResource | JsonResponse
    {
            $user = $this->userReadRepository->getByUsername($username);

            $oClientId = config('passport.personal_access_client.id');

            $oClient = Client::where('id', $oClientId)->first();
            $response =  Http::asForm()->post(env('APP_URL') . '/oauth/token', [
                'grant_type' => 'password',
                'client_id' => $oClient->id,
                'client_secret' => $oClient->secret,
                'username' => $username,
                'password' => $password,
                'scope' => '*',
            ]);

            $data = json_decode($response->getBody()->getContents());

            $data->user = $user;

            if (property_exists($data, 'errors')) {
                throw new UserNotFoundException();
            }

        return new TokensResource($data);
    }
}
