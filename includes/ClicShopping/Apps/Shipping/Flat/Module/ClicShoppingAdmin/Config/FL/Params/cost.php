<?php
  /**
   *
   * @copyright Copyright 2008 - http://www.innov-concept.com
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @license GPL 2 License & MIT Licencse
   
   */

  namespace ClicShopping\Apps\Shipping\Flat\Module\ClicShoppingAdmin\Config\FL\Params;

  class cost extends \ClicShopping\Apps\Shipping\Flat\Module\ClicShoppingAdmin\Config\ConfigParamAbstract {
    public $default = '5';
    public $sort_order = 40;

    protected function init() {
      $this->title = $this->app->getDef('cfg_flat_cost_title');
      $this->description = $this->app->getDef('cfg_flat_cost_desc');
    }
  }
