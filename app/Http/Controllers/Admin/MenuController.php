<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Menu\CreateRequest;
use App\Repositories\MenuRepository;
use App\Http\Controllers\Controller;

/**
 * 菜单管理.
 *
 * @author rongyouyuan <rongyouyuan@163.com>
 */
class MenuController extends Controller
{
    /**
     * MenuRepository.
     *
     * @var App\Repositories\MenuRepository;
     */
    private $menuRepository;

    /**
     * construct.
     *
     * @param MenuRepository $menu
     */
    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    /**
     * 菜单.
     */
    public function Index()
    {

        return admin_view('menu.index');
    }

    /**
     * 获取菜单列表.
     *
     * @return Response
     */
    public function Lists()
    {
        $menus = $this->menuRepository->lists($this->account()->id)->toArray();

        return $this->menuRepository->withMaterials($menus);
    }

    public function Create() {
        return admin_view('menu.create');
    }

    /**
     * 保存菜单.
     *
     * @param CreateRequest $request request
     */
    public function Store(CreateRequest $request)
    {
        $accountId = $this->account()->id;

        $this->menuRepository->destroyMenu($accountId);

        $menus = $this->menuRepository->parseMenus($accountId, $request->get('menus'));

        $this->menuRepository->storeMulti($accountId, $menus);

        return redirect(admin_url('menu'));
    }
}
