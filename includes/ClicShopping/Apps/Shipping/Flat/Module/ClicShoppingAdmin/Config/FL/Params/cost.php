<?php
  /**
   *
   * @copyright 2008 - https://www.clicshopping.org
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @Licence GPL 2 & MIT
   * @licence MIT - Portion of osCommerce 2.4
   * @Info : https://www.clicshopping.org/forum/trademark/
   *
   */

  namespace ClicShopping\Apps\Shipping\Flat\Module\ClicShoppingAdmin\Config\FL\Params;

  class cost extends \ClicShopping\Apps\Shipping\Flat\Module\ClicShoppingAdmin\Config\ConfigParamAbstract
  {
    public $default = '5';
    public ?int $sort_order = 40;

    protected function init()
    {
      $this->title = $this->app->getDef('cfg_flat_cost_title');
      $this->description = $this->app->getDef('cfg_flat_cost_desc');
    }
  }
