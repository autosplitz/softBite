<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Rules\RestoCategoryValidate;
use App\Services\MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index($id)
    {
        $restoId = $id;
        $service = new MenuService;
        $menus = $service->getMenuWithCategory($restoId);
        return view('menu.menu-index', compact('menus', 'restoId'));
    }

    public function addMenuItem(Request $request)
    {
        $postData = $this->validate($request, [
            'restoId' => 'required|numeric',
            'item' => 'required',
            'price' => 'required|numeric',
            'description' => 'required|min:3',
            'category' => ['required', new RestoCategoryValidate(request('restoId'))]
        ]);

        $category = Category::where('resto_id', $postData['restoId'])->where('name', $postData['category'])->first();

        $menu = Menu::create([
            'name' => $postData['item'],
            'price' => $postData['price'],
            'description' => $postData['description'],
            'resto_id' => $postData['restoId'],
            'category_id' => $category->id
        ]);
        return response()->json($menu, 201);
    }

    public function getRestaurantMenu(Request $request)
    {
        $this->validate($request, [
            'restoId' => 'required|exists:restaurants,id'
        ]);
        $menuItems = Menu::where('resto_id', $request->input('restoId'))->orderBy('category_id')->get();
        return response()->json($menuItems, 200);
    }
}
