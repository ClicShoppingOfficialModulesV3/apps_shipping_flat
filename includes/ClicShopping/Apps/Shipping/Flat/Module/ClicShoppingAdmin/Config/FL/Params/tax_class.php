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

  use ClicShopping\OM\HTML;
  use ClicShopping\OM\Registry;

  class tax_class extends \ClicShopping\Apps\Shipping\Flat\Module\ClicShoppingAdmin\Config\ConfigParamAbstract
  {
    public $default = '';
    public ?int $sort_order = 50;
    public $set_func = 'clic_cfg_set_tax_classes_pull_down_menu';
//    public $use_func = 'clic_cfg_use_get_tax_class_title';
    protected mixed $app;

    protected function init()
    {
      $this->title = $this->app->getDef('cfg_flat_tax_class_title');
      $this->description = $this->app->getDef('cfg_flat_tax_class_desc');

      if (!Registry::exists('Flat')) {
        Registry::set('Flat', new FlatApp());
      }

      $this->app = Registry::get('Flat');
      $this->app->loadDefinitions('Module/Sites/ClicShoppingAdmin/main');
    }

    public function getInputField()
    {

      $tax_class_array = [
        [
          'id' => '0',
          'text' => $this->app->getDef('cfg_flat_zone_none')
        ]
      ];

      $Qclasses = $this->app->db->get('tax_class', [
        'tax_class_id',
        'tax_class_title'
      ], null, 'tax_class_title'
      );

      while ($Qclasses->fetch()) {
        $tax_class_array[] = [
          'id' => $Qclasses->valueInt('tax_class_id'),
          'text' => $Qclasses->value('tax_class_title')
        ];
      }

      $input = HTML::selectField($this->key, $tax_class_array, $this->getInputValue());

      return $input;
    }
  }
