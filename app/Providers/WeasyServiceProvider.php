<?php

namespace App\Providers;

use App\Services\Account as AccountService;
use Illuminate\Support\ServiceProvider;
use App\Repositories\AccountRepository;
use App\Models\Account as AccountModel;

class WeasyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->registerAccountService();

        $this->registerCurrentAccount();

        //$this->registerMenuService();

        //$this->registerReplyService();
    }

    /**
     * 注册公众号服务单例.
     *
     * @return AccountService
     */
    protected function registerAccountService()
    {
        $this->app->singleton('weasy.account_service', function () {
            return new AccountService();
        });
    }

    /**
     * 注册当前公众号单例.
     *
     * @return Account
     */
    protected function registerCurrentAccount()
    {
        $this->app->singleton('weasy.current_account', function () {
            $repositorie = new AccountRepository(new AccountModel());

            return $repositorie->getById(app('weasy.account_service')->chosedId());
        });
    }

    /**
     * 注册菜单服务单例.
     *
     * @return MenuService
     */
    /*protected function registerMenuService()
    {
        $this->app->singleton('weasy.menu_service', function () {
            return new MenuService();
        });
    }*/

    /**
     * 注册自动回复服务
     *
     * @return ReplyService
     */
    /*protected function registerReplyService()
    {
        $this->app->singleton('weasy.reply_service', function () {
            return new ReplyService();
        });
    }*/
}
