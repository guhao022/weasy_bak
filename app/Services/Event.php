<?php

namespace app\Services;

use App\Repositories\EventRepository;

/**
 * 事件服务提供.
 *
 * @author guhao <378999587@qq.com>
 */
class Event
{
    /**
     * EventRepository.
     *
     * @var App\Repositories\EventRepository
     */
    private $eventRepository;

    /**
     * construct description.
     *
     * @param App\Repositories\EventRepository $eventRepository
     */
    public function __construct( EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;

    }

    /**
     * 是否属于自己的事件.
     *
     * @param string $name name
     *
     * @return bool
     */
    public function isOwnEvent($name)
    {
        return starts_with($name, 'WEASY_EVENT_');
    }

    /**
     * 创建一个文字类型的事件.
     *
     * @param string $text 返回值
     *
     * @return string 事件key
     */
    public function makeText($text)
    {
        return $this->eventRepository->storeTextEvent($text);
    }

    /**
     * 创建key名称.
     *
     * @return string
     */
    public function makeEventKey()
    {
        return 'WEASY_EVENT_'.strtoupper(uniqid());
    }
}
