<?php
/*
 * Home.php
 * @copyright Copyright 2008 - http://www.innov-concept.com
 * @Brand : ClicShopping(Tm) at Inpi all right Reserved
 * @license GPL 2 License & MIT Licencse
 
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
