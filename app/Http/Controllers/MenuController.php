<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MenuRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $menus = Menu::paginate();

        return view('menu.index', compact('menus'))
            ->with('i', ($request->input('page', 1) - 1) * $menus->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $menu = new Menu();

        return view('menu.create', compact('menu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuRequest $request): RedirectResponse
    {
        Menu::create($request->validated());

        return Redirect::route('menus.index')
            ->with('success', 'Menu created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $menu = Menu::find($id);

        return view('menu.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $menu = Menu::find($id);

        return view('menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuRequest $request, Menu $menu): RedirectResponse
    {
        $menu->update($request->validated());

        return Redirect::route('menus.index')
            ->with('success', 'Menu updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Menu::find($id)->delete();

        return Redirect::route('menus.index')
            ->with('success', 'Menu deleted successfully');
    }
}
