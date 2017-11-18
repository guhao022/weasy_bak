<?php

namespace App\Http\Controllers;

use App\Services\Message;
use Illuminate\Http\Request;
use App\Services\Server;
use App\Repositories\AccountRepository;


/**
 * 微信服务通讯.
 */
class ServerController extends Controller
{
    /**
     * @var Server
     */
    private $server;

    /**
     * @var Message
     */
    private $message;

    /**
     * ServerController constructor.
     * @param Server $server
     */
    public function __construct(Server $server, Message $message)
    {
        $this->server = $server;
        $this->message = $message;
    }

    /**
     * 返回服务端.
     *
     * @return Response
     */
    public function server(Request $request, AccountRepository $repository)
    {
        $account = $repository->getByTag($request->t);

        if (!$account) {
            return;
        }

        $app = $this->server->make($account);
        $server = $app->server;
        $server->setMessageHandler(function($message) use ($account) {

            return $this->message->handleMessage($account, $message);
        });

        return $server->serve()->send();

    }
}
