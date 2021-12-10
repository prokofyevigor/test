<?php

namespace App;

use App\Models\User;
use App\Services\Mail;
use \DB;

class NotificationSender
{
    protected int $userId;
    protected Configuration $configuration;

    public function __construct(int $userId, Configuration $configuration)
    {
        $this->userId = $userId;
        $this->configuration = $configuration;
    }

    public function send(): array
    {
        $user = User::find($this->userId);

        $userMetas = $this->fetchUserInformation($this->userId);

        $this->configuration->setCredentials([
            'name' => $userMetas->name,
            'email' => $userMetas->email,
        ]);

        $client = new GuzzleHttp\Client();
        $response = $client->request('POST', 'https://api.foobar.com/user', [
            'json' => [
                'user_id' => $user->userId,
                'credentials' => $this->configuration->getCredentials(),
            ],
        ]);

        $response = json_decode($response->getBody());

        return $response;
    }

    protected function fetchUserInformation(int $userId)
    {
        return DB::select("SELECT name, email FROM users_meta WHERE user_id = {$userId}");
    }
}
