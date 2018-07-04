<?php
  /**
   *
   * @copyright Copyright 2008 - http://www.innov-concept.com
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @license GPL 2 License & MIT Licencse

   */

  namespace ClicShopping\Apps\Shipping\Flat\Module\ClicShoppingAdmin\Config\FL\Params;

  class logo extends \ClicShopping\Apps\Shipping\Flat\Module\ClicShoppingAdmin\Config\ConfigParamAbstract {
    public $default = '';
    public $sort_order = 30;

    protected function init() {
      $this->title = $this->app->getDef('cfg_flat_logo_title');
      $this->description = $this->app->getDef('cfg_flat_logo_desc');
    }
  }
