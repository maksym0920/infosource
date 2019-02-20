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
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form">
          <input type="hidden" name="nodeNumber" value="">
          <div class="form-group required">
            <label class="control-label" for="custom-title">custom text</label>
            <input type="text" id="custom-title" class="form-control" name="node[custom]" value="" maxlength="200">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <?php /*<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>*/ ?>
        <button type="button" class="btn btn-primary">get image</button>
      </div>
    </div>
  </div>
</div>