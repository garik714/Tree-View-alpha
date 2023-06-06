<?php

namespace App\Services\User\Actions;

use App\Http\Resources\TokensResource;
use App\Repositories\Read\User\UserReadRepositoryInterface;
use App\Services\User\Dto\RefreshTokenDto;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Client;
use Throwable;

class RefreshTokenAction
{
    protected UserReadRepositoryInterface $userReadRepository;

    public function __construct(
        UserReadRepositoryInterface $userReadRepository
    ) {
        $this->userReadRepository = $userReadRepository;
    }
    public function run(RefreshTokenDto $dto): TokensResource
    {
        try {
            $user = $this->userReadRepository->getById($dto->userId);
            $oClientId = config('passport.personal_access_client.id');
            $oClient = Client::where('id', $oClientId)->first();
            $response = Http::asForm()->post(env('APP_URL') . '/oauth/token',
                [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $dto->refreshToken,
                    'client_id' => $oClient->id,
                    'client_secret' => $oClient->secret,
                    'scope' => '',
                ]);
        } catch (Throwable $exception) {
            throw new $exception;
        }

        $data = json_decode($response->getBody()->getContents());
        $data->user = $user;

        if (property_exists($data, 'errors')) {
            throw new AuthorizationException();
        }

        return new TokensResource($data);
    }
}
