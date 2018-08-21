<?php
/**
 *
 *  @copyright 2008 - https://www.clicshopping.org
 *  @Brand : ClicShopping(Tm) at Inpi all right Reserved
 *  @Licence GPL 2 & MIT
 *  @licence MIT - Portion of osCommerce 2.4
 *
 *
 */

  namespace ClicShopping\Apps\Shipping\Flat\Sites\ClicShoppingAdmin\Pages\Home;

  use ClicShopping\OM\Registry;

  use ClicShopping\Apps\Shipping\Flat\Flat;

  class Home extends \ClicShopping\OM\PagesAbstract {
    public $app;

    protected function init() {
      $CLICSHOPPING_Flat = new Flat();
      Registry::set('Flat', $CLICSHOPPING_Flat);

      $this->app = $CLICSHOPPING_Flat;

      $this->app->loadDefinitions('Sites/ClicShoppingAdmin/main');
    }
  }
