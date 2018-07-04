<?php
  /**
   *
   * @copyright Copyright 2008 - http://www.innov-concept.com
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @license GPL 2 License & MIT Licencse
   
   */

  namespace ClicShopping\Apps\Shipping\Item\Module\ClicShoppingAdmin\Config\IT\Params;

  class cost extends \ClicShopping\Apps\Shipping\Item\Module\ClicShoppingAdmin\Config\ConfigParamAbstract {
    public $default = '2.50';
    public $sort_order = 40;

    protected function init() {
      $this->title = $this->app->getDef('cfg_item_cost_title');
      $this->description = $this->app->getDef('cfg_item_cost_desc');
    }
  }
