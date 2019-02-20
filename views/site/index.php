<?php

/* @var $this yii\web\View */

$this->title = 'infosource';

function showMenu(&$menu)
{
    foreach ($menu as $item) {
        if (isset($item['child'])) {
        ?>
          <li class="treeview">
          <a class="node" data-number="<?=$item['number']?>" href="#">
            <span><?=$item['name']?></span>
          </a>
            <ul class="treeview-menu">
              <?php showMenu($item['child']) ?>
            </ul>
          </li>
        <?php
        } else {
        ?>
          <li class="">
            <a class="node" data-number="<?=$item['number']?>" href="#">
              <span><?=$item['name']?></span>
            </a>
          </li>
        <?php
        }
    }
}
?>
<h1>Меню</h1>
<ul class="sidebar-menu">
  <?php showMenu($menu); ?>
</ul>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Узел <span></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="image-form">
          <input type="hidden" id="node-number" name="nodeNumber" value="">
          <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
          <div class="form-group required">
            <label class="control-label" for="custom-title">Случайный текст</label>
            <input type="text" id="custom-title" class="form-control" name="custom" value="" maxlength="200">
            <hr/>
            <div class="text-center" id="image-content">
              <img class="" height="100" width="100" src="">
            </div>
            <div class="block" id="captcha-content">
              <div class="g-recaptcha" data-sitekey="6Le1rJIUAAAAAKuABeUn_RzdZSkta-v9GAi8WFTf"></div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="button-send" class="btn btn-primary">Продолжить</button>
      </div>
    </div>
  </div>
</div>
