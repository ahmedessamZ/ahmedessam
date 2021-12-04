<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class Newsletter
{
    public function subscribe(string $email , string $list = null){
        $list ??=config('services.mailchimp.lists.subscribers');

        return $response = $this->client()->lists->addListMember($list,
            [
            "email_address" => $email,
            "status" => "subscribed"
        ]);
    }

    public function client(){
        return (new ApiClient())->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us20'
        ]);
    }

}