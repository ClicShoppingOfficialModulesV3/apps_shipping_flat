<?php
  use ClicShopping\OM\HTML;
  use ClicShopping\OM\CLICSHOPPING;
  use ClicShopping\OM\Registry;

  $CLICSHOPPING_Flat = Registry::get('Flat');

  if ($CLICSHOPPING_MessageStack->exists('Flat')) {
    echo $CLICSHOPPING_MessageStack->get('Flat');
  }
?>
  <div class="contentBody">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-block headerCard">
          <div class="row">
            <span class="col-md-1 logoHeading"><?php echo HTML::image($CLICSHOPPING_Template->getImageDirectory() . '/categories/modules_modules_checkout_shipping.gif', $CLICSHOPPING_Flat->getDef('Flat'), '40', '40'); ?></span>
            <span class="col-md-4 pageHeading"><?php echo '&nbsp;' . $CLICSHOPPING_Flat->getDef('heading_title'); ?></span>
          </div>
        </div>
      </div>
    </div>
    <div class="separator"></div>
    <div class="col-md-12 mainTitle"><strong><?php echo $CLICSHOPPING_Flat->getDef('text_flat') ; ?></strong></div>
    <div class="adminformTitle">
      <div class="row">
        <div class="separator"></div>

        <div class="col-md-12">
          <div class="form-group">
            <div class="col-md-12">
              <?php echo $CLICSHOPPING_Flat->getDef('text_intro');  ?>
            </div>
          </div>
        </div>

        <div class="col-md-12 text-md-center">
          <div class="form-group">
            <div class="col-md-12">
<?php
  echo HTML::form('configure', CLICSHOPPING::link('index.php', 'A&Shipping\Flat&Configure'));
  echo HTML::button($CLICSHOPPING_Flat->getDef('button_configure'), null, null, 'primary');
  echo '</form>';
?>
            </div>
          </div>
        </div>
      </div>
      <div class="separator"></div>
    </div>
  </div>
