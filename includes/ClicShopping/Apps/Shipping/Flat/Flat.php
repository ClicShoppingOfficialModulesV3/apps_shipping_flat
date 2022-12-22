<?php
  /**
   *
   * @copyright 2008 - https://www.clicshopping.org
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @Licence GPL 2 & MIT

   * @Info : https://www.clicshopping.org/forum/trademark/
   *
   */

  namespace ClicShopping\Apps\Shipping\Flat;

  use ClicShopping\OM\Registry;
  use ClicShopping\OM\CLICSHOPPING;

  class Flat extends \ClicShopping\OM\AppAbstract
  {

    protected $api_version = 1;
    protected string $identifier = 'ClicShopping_Flat_V1';

    protected function init()
    {
    }

    /**
     * @return array|mixed
     */
    public function getConfigModules(): mixed
    {
      static $result;

      if (!isset($result)) {
        $result = [];

        $directory = CLICSHOPPING::BASE_DIR . 'Apps/Shipping/Flat/Module/ClicShoppingAdmin/Config';
        $name_space_config = 'ClicShopping\Apps\Shipping\Flat\Module\ClicShoppingAdmin\Config';
        $trigger_message = 'ClicShopping\Apps\Shipping\Flat\Flat::getConfigModules(): ';

        $this->getConfigApps($result, $directory, $name_space_config, $trigger_message);
      }

      return $result;
    }

    public function getConfigModuleInfo($module, $info)
    {
      if (!Registry::exists('FlatAdminConfig' . $module)) {
        $class = 'ClicShopping\Apps\Shipping\Flat\Module\ClicShoppingAdmin\Config\\' . $module . '\\' . $module;
        Registry::set('FlatAdminConfig' . $module, new $class);
      }

      return Registry::get('FlatAdminConfig' . $module)->$info;
    }


    public function getApiVersion()
    {
      return $this->api_version;
    }

     /**
     * @return string
     */
    public function getIdentifier() :String
    {
      return $this->identifier;
    }
  }
