<?php
  /**
   *
   * @copyright 2008 - https://www.clicshopping.org
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @Licence GPL 2 & MIT

   * @Info : https://www.clicshopping.org/forum/trademark/
   *
   */

  namespace ClicShopping\Apps\Shipping\Flat\Module\Shipping;

  use ClicShopping\OM\HTML;
  use ClicShopping\OM\Registry;

  use ClicShopping\Apps\Shipping\Flat\Flat as FlatApp;
  use ClicShopping\Sites\Common\B2BCommon;

  class FL implements \ClicShopping\OM\Modules\ShippingInterface
  {
    public string $code;
    public $title;
    public $description;
    public $public_title;
    public ?int $sort_order = 0;
    public $enabled = false;
    public mixed $app;
    protected $currency;
    public $signature;
    protected $api_version;
    public $group;
    public $icon;
    public $quotes;
    public $tax_class;

    public function __construct()
    {
      $CLICSHOPPING_Customer = Registry::get('Customer');

      if (Registry::exists('Order')) {
        $CLICSHOPPING_Order = Registry::get('Order');
      }

      if (!Registry::exists('Flat')) {
        Registry::set('Flat', new FlatApp());
      }

      $this->app = Registry::get('Flat');
      $this->app->loadDefinitions('Module/Shop/FL/FL');

      $this->signature = 'Flat|' . $this->app->getVersion() . '|1.0';
      $this->api_version = $this->app->getApiVersion();

      $this->code = 'FL';
      $this->title = $this->app->getDef('module_flat_title');
      $this->public_title = $this->app->getDef('module_flat_public_title');
      $this->sort_order = \defined('CLICSHOPPING_APP_FLAT_FL_SORT_ORDER') ? CLICSHOPPING_APP_FLAT_FL_SORT_ORDER : 0;

// Activation module du paiement selon les groupes B2B
      if ($CLICSHOPPING_Customer->getCustomersGroupID() != 0) {
        if (B2BCommon::getShippingUnallowed($this->code)) {
          if (CLICSHOPPING_APP_FLAT_FL_STATUS == 'True') {
            $this->enabled = true;
          } else {
            $this->enabled = false;
          }
        }
      } else {
        if (\defined('CLICSHOPPING_APP_FLAT_FL_NO_AUTHORIZE') && CLICSHOPPING_APP_FLAT_FL_NO_AUTHORIZE == 'True' && $CLICSHOPPING_Customer->getCustomersGroupID() == 0) {
          if ($CLICSHOPPING_Customer->getCustomersGroupID() == 0) {
            if (CLICSHOPPING_APP_FLAT_FL_STATUS == 'True') {
              $this->enabled = true;
            } else {
              $this->enabled = false;
            }
          }
        }
      }

      if (\defined('CLICSHOPPING_APP_FLAT_FL_TAX_CLASS')) {
        if ($CLICSHOPPING_Customer->getCustomersGroupID() != 0) {
          if (B2BCommon::getTaxUnallowed($this->code) || !$CLICSHOPPING_Customer->isLoggedOn()) {
            $this->tax_class = \defined('CLICSHOPPING_APP_FLAT_FL_TAX_CLASS') ? CLICSHOPPING_APP_FLAT_FL_TAX_CLASS : 0;

          }
        } else {
          if (B2BCommon::getTaxUnallowed($this->code)) {
            $this->tax_class = \defined('CLICSHOPPING_APP_FLAT_FL_TAX_CLASS') ? CLICSHOPPING_APP_FLAT_FL_TAX_CLASS : 0;
          }
        }
      }

      if (($this->enabled === true) && ((int)CLICSHOPPING_APP_FLAT_FL_ZONE > 0)) {
        $check_flag = false;

        $Qcheck = $this->app->db->get('zones_to_geo_zones', 'zone_id', [
          'geo_zone_id' => (int)CLICSHOPPING_APP_FLAT_FL_ZONE,
          'zone_country_id' => $CLICSHOPPING_Order->delivery['country']['id']
        ],
          'zone_id'
        );

        while ($Qcheck->fetch()) {
          if (($Qcheck->valueInt('zone_id') < 1) || ($Qcheck->valueInt('zone_id') === $CLICSHOPPING_Order->delivery['zone_id'])) {
            $check_flag = true;
            break;
          }
        }

        if ($check_flag === false) {
          $this->enabled = false;
        }
      }
    }

    public function quote($method = '')
    {
      $CLICSHOPPING_Order = Registry::get('Order');
      $CLICSHOPPING_Tax = Registry::get('Tax');
      $CLICSHOPPING_Template = Registry::get('Template');

      $this->quotes = [
        'id' => $this->app->vendor . '\\' . $this->app->code . '\\' . $this->code,
        'module' => $this->app->getDef('module_flat_text_title'),
        'methods' => [array('id' => $this->code,
                            'title' => $this->app->getDef('module_flat_text_way'),
                            'cost' => (float)CLICSHOPPING_APP_FLAT_FL_COST
                            )
                     ]
      ];

      if ($this->tax_class > 0) {
        $this->quotes['tax'] = $CLICSHOPPING_Tax->getTaxRate($this->tax_class, $CLICSHOPPING_Order->delivery['country']['id'], $CLICSHOPPING_Order->delivery['zone_id']);
      }

      if (!empty(CLICSHOPPING_APP_FLAT_FL_LOGO)) {
        $this->icon = $CLICSHOPPING_Template->getDirectoryTemplateImages() . 'logos/shipping/' . CLICSHOPPING_APP_FLAT_FL_LOGO;
        $this->icon = HTML::image($this->icon, $this->title);
      } else {
        $this->icon = '';
      }

      if (!\is_null($this->icon)) $this->quotes['icon'] = '&nbsp;&nbsp;&nbsp;' . $this->icon;

      return $this->quotes;
    }

    public function check()
    {
      return \defined('CLICSHOPPING_APP_FLAT_FL_STATUS') && (trim(CLICSHOPPING_APP_FLAT_FL_STATUS) != '');
    }

    public function install()
    {
      $this->app->redirect('Configure&Install&module=Flat');
    }

    public function remove()
    {
      $this->app->redirect('Configure&Uninstall&module=Flat');
    }

    public function keys()
    {
      return array('CLICSHOPPING_APP_FLAT_FL_SORT_ORDER');
    }
  }