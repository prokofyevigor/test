<?php

namespace App;

class UsersController
{
    public function store(Request $request)
    {
        $configuration = new EmailConfiguration();
        $configuration->setCredentials([
            'foo' => 'bar',
        ]);

        $sender = new NotificationSender(
            $request->input('user_id'),
            $configuration
        );

        $response = $sender->send();

        return response()->json($response);
    }
}
