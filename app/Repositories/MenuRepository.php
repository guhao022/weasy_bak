<?php

namespace App\Repositories;

use App\Models\Menu;

/**
 * Menu Repository.
 */
class MenuRepository
{
    use BaseRepository;

    /**
     * @var Menu
     */
    protected $model;

    /**
     * @var EventRepository
     */
    protected $eventRepository;

    /**
     * @var MaterialRepository
     */
    protected $materialRepository;

    public function __construct(Menu $menu, EventRepository $eventRepository, MaterialRepository $materialRepository)
    {
        $this->model = $menu;

        $this->eventRepository = $eventRepository;

        $this->materialRepository = $materialRepository;
    }

    /**
     * 菜单列表.
     *
     * @return array
     */
    public function lists($accountId)
    {
        return $this->model->with('subButtons')->where('account_id', $accountId)->where('parent_id', 0)->orderBy('id', 'asc')->get();
    }

    /**
     * 取得所有菜单 不带有层级.
     *
     * @return array
     */
    public function all($accountId)
    {
        return $this->model->where('account_id', $accountId)->get()->toArray();
    }

    /**
     * 一次存储所有菜单.
     *
     * @param int   $$accountId id
     * @param array $menus      菜单
     */
    public function storeMulti($accountId, $menus)
    {
        foreach ($menus as $key => $menu) {
            $menu['sort'] = $key;
            $menu['account_id'] = $accountId;

            $parentId = $this->store($menu)->id;

            if (!empty($menu['sub_button'])) {
                foreach ($menu['sub_button'] as $subKey => $subMenu) {
                    $subMenu['parent_id'] = $parentId;

                    $subMenu['sort'] = $subKey;

                    $subMenu['account_id'] = $accountId;

                    $this->store($subMenu);
                }
            }
        }
    }

    /**
     * 解析菜单数据.
     *
     * @param int   $accountId 公众号ID
     * @param array $menus     menus
     *
     * @return array
     */
    public function parseMenus($accountId, $menus)
    {
        $menus = array_map(function ($menu) use ($accountId) {
            if (isset($menu['sub_button'])) {
                $menu['sub_button'] = $this->parseMenus($accountId, $menu['sub_button']);
            } else {
                $menu = $this->makeMenuEvent($accountId, $menu);
            }

            return $menu;

        }, $menus);

        return $menus;
    }

    /**
     * 生成菜单中的事件.
     *
     * @param int   $accountId 公众号Id
     * @param array $menu      menu
     *
     * @return array
     */
    private function makeMenuEvent($accountId, $menu)
    {
        if ($menu['type'] == 'text') {
            $menu['type'] = 'click';
            $menu['key'] = $this->eventRepository->storeTextEvent($accountId, $menu['value']);
        } elseif ($menu['type'] == 'media') {
            $menu['type'] = 'click';
            $menu['key'] = $this->eventRepository->storeMaterialEvent($accountId, $menu['value']);
        } elseif ($menu['type'] == 'view') {
            $menu['key'] = $menu['value'];
        } else {
            $menu['key'] = $menu['value'];
        }

        unset($menu['value']);

        return $menu;
    }

    /**
     * 获取菜单中的素材具体信息.
     *
     * @param array $menus 菜单列表
     *
     * @return array
     */
    public function withMaterials($menus)
    {
        return array_map(function ($menu) {

            $mediaId = $this->eventRepository->getEventByKey($menu['key'])->value;

            $menu['material'] = $this->materialRepository->getMaterialByMediaId($mediaId);

            return $menu;
        }, $menus);
    }

    /**
     * 删除旧菜单.
     *
     * @param int $accountId 公众号id
     */
    public function destroyMenu($accountId)
    {
        $menus = $this->all($accountId);

        array_map(function ($menu) {

            if ($menu['type'] == 'click') {
                $this->eventRepository->distoryByEventKey($menu['key']);
            }

        }, $menus);

        $this->model->where('account_id', $accountId)->delete();
    }


    /**
     * 保存菜单.
     *
     * @param array $input input
     */
    public function store($input)
    {
        return $this->savePost(new $this->model(), $input);
    }

    /**
     * savePost.
     *
     * @param App\Models\Menu $menu  菜单
     * @param array           $input input
     *
     * @return App\Models\Menu
     */
    public function savePost($menu, $input)
    {
        $menu->fill($input);
        $menu->save();

        return $menu;
    }
}
