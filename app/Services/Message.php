<?php
/**
 * Created by PhpStorm.
 * User: ASUS-02
 * Date: 2017/11/16
 * Time: 13:36
 */

namespace App\Services;
use App\Repositories\MessageRepository;
use App\Repositories\ReplyRepository;


class Message
{

    private $messageRepository;

    private $replyRepository;

    public function __construct(ReplyRepository $replyRepository, MessageRepository $messageRepository)
    {

        $this->replyRepository = $replyRepository;
        $this->messageRepository = $messageRepository;
    }

    /**
     * 处理订阅时的消息.
     *
     * @return Response
     */
    private function handleSubscribe($account)
    {

        return "欢迎关注！！";

        /*$event = $this->replyRepository->getFollowReply($account->id);

        $eventId = $event['content'][0];

        return $eventId ? $this->eventToMessage($eventId) : $this->emptyMessage();*/
    }

    /**
     * 处理未匹配时的回复.
     *
     * @return Response
     */
    private function handleNoMatch($account)
    {
        $event = $this->replyRepository->getNoMatchReply($account->id);

        $eventId = $event['content'][0];

        return $eventId ? $this->eventToMessage($eventId) : $this->emptyMessage();
    }

    /**
     * 处理消息.
     *
     * @param int                    $account 公众号
     * @param array                  $message 消息
     *
     * @return Response
     */
    public function handleMessage($account, $message)
    {
        //存储消息
        $this->storeMessage($account, $message);

        switch ($message->MsgType) {
            case 'event':
                if ($message->Event == 'subscribe') {
                    return $this->handleSubscribe($account);
                }
                break;
            case 'image':
            case 'voice':
            case 'video':
            case 'location':
            case 'link':
            case 'text':

                /*$replies = (array) Cache::get('replies_'.$account->id);

                if (empty($replies)) {
                    return $this->handleNoMatch($account);
                }

                foreach ($replies as $key => $reply) {
                    //查找字符串
                    if (str_contains($message['Content'], $key)) {

                        //return $message['Content'];

                        return $this->eventToMessage($reply['content']);
                    }
                }

                return $this->handleNoMatch($account);*/
                break;
            default:
                return '我就静静地看着你装逼~~';
                break;
        }
    }

    /**
     * 存储消息.
     *
     * @param array $account 公众号
     * @param array $message 消息
     */
    public function storeMessage($account, $message)
    {
        $accountId = $account->id;

        return $this->messageRepository->storeMessage($accountId, $message);
    }

    /**
     * 返回一条空消息.
     *
     * @return Response
     */
    public function emptyMessage()
    {
        return '';
    }

}