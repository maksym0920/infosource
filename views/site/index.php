<?php

/* @var $this yii\web\View */

$this->title = 'infosource';

function showMenu(&$menu)
{
    foreach ($menu as $item) {
        if (isset($item['child'])) {
        ?>
          <li class="treeview">
          <a href="#">
            <span><?=$item['name']?></span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
          </a>
            <ul class="treeview-menu">
              <?php showMenu($item['child']) ?>
            </ul>
          </li>
        <?php
        } else {
        ?>
          <li class="">
            <a href="#">
              <span><?=$item['name']?></span>
            </a>
          </li>
        <?php
        }
    }
}
?>
<ul class="sidebar-menu">
  <li class="header">Меню</li>
  <?php showMenu($menu); ?>
</ul>