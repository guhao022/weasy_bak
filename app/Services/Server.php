<?php

namespace App\Services;

use EasyWeChat\Foundation\Application;
use Cache;

/**
 * 回复服务.
 *
 * @author rongyouyuan <rongyouyuan@163.com>
 */
class Server
{

    /**
     * constructer.
     *
     * @param MessageService $messageService 消息服务
     */
    public function __construct()
    {

    }

    /**
     * 返回服务器.
     *
     * @param App\Models\Account $account account
     *
     * @return Response
     */
    public function make($account)
    {

        $appId = $account->app_id;

        $appSecret = $account->app_secret;

        $token = $account->token;

        $encodingAESKey = $account->aes_key;

        $options = [
            'debug'  => true,
            'app_id' => $appId,
            'secret' => $appSecret,
            'token'  => $token,
            'aes_key' => $encodingAESKey,
            'log' => [
                'level' => 'debug',
                'file'  => '/tmp/easywechat.log',
            ],
        ];

        // 从项目实例中得到服务端应用实例。

        $app = new Application($options);

        /*$server = $app->server;
        $user = $app->user;

        $server->setMessageHandler(function($message) use ($user, $account) {

            return $this->handleMessage($account, $message);
        });*/

        return $app;
    }
}
