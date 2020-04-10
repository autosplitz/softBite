<?php

namespace App\Services;

use App\Models\Menu;

class MenuService
{
  public function getMenuWithCategory($restoId)
  {
    $menus = Menu::where('resto_id', $restoId)->get()->groupBy('category.name');
    return $menus;
  }
}
