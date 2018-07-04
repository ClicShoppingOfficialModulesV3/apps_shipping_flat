<?php
/*
 * Delete.php
 * @copyright Copyright 2008 - http://www.innov-concept.com
 * @Brand : ClicShopping(Tm) at Inpi all right Reserved
 * @license GPL 2 License & MIT Licencse
*/

  namespace  ClicShopping\Apps\Shipping\Flat\Sites\ClicShoppingAdmin\Pages\Home\Actions\Configure;

  use ClicShopping\OM\Registry;
  use ClicShopping\OM\Cache;

  class Delete extends \ClicShopping\OM\PagesActionsAbstract {

    public function execute() {

      $CLICSHOPPING_MessageStack = Registry::get('MessageStack');
      $CLICSHOPPING_Flat = Registry::get('Flat');

      $current_module = $this->page->data['current_module'];
      $m = Registry::get('FlatAdminConfig' . $current_module);
      $m->uninstall();

      static::removeMenu();

      Cache::clear('menu-administrator');

      $CLICSHOPPING_MessageStack->add($CLICSHOPPING_Flat->getDef('alert_module_uninstall_success'), 'success', 'Flat');

      $CLICSHOPPING_Flat->redirect('Configure&module=' . $current_module);
    }

    private static function removeMenu() {
      $CLICSHOPPING_Db = Registry::get('Db');

      $Qcheck = $CLICSHOPPING_Db->get('administrator_menu', 'app_code', ['app_code' => 'app_shipping_flat']);

      if ($Qcheck->fetch()) {

        $QMenuId = $CLICSHOPPING_Db->prepare('select id
                                              from :table_administrator_menu
                                              where app_code = :app_code
                                            ');

        $QMenuId->bindValue(':app_code',  'app_shipping_flat');
        $QMenuId->execute();

        $menu = $QMenuId->fetchAll();

        $menu1 = count($menu);

        for ($i=0, $n=$menu1; $i<$n; $i++) {
          $CLICSHOPPING_Db->delete('administrator_menu_description', ['id' => (int)$menu[$i]['id']]);
        }

        $CLICSHOPPING_Db->delete('administrator_menu', ['app_code' => 'app_shipping_flat']);
      }
    }
  }