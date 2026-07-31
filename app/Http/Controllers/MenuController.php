<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->search;
        $sort = $request->sort ?? 'desc';
        $kategori = $request->kategori;
        $stok = $request->stok;

        $menus = Menu::with('category')
            ->when($search, function ($query) use ($search) {
                $query->where('kode_menu', 'like', "%{$search}%")
                    ->orWhere('nama_menu', 'like', "%{$search}%");
            })
            ->when($kategori, function ($query) use ($kategori) {
                $query->where('category_id', $kategori);
            })
            ->when($stok == 'available', function ($query) {
                $query->where('stok', '>', 0);
            })
            ->when($stok == 'empty', function ($query) {
                $query->where('stok', '<=', 0);
            })
            ->orderBy('kode_menu', $sort)
            ->paginate(10)
            ->withQueryString();

        $categories = Category::orderBy('nama_category')->get();

        return view('menu.index', compact(
            'menus',
            'categories',
            'search',
            'sort'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $menu = new Menu();
        $categories = Category::orderBy('nama_category')->get();

        return view('menu.create', compact(
            'menu',
            'categories'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('foto_menu')) {
            $data['foto_menu'] = $request->file('foto_menu')
                ->store('menus', 'public');
        }

        Menu::create($data);

        return Redirect::route('menus.index')
            ->with('success', 'Menu created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        return response()->json($menu);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuRequest $request, Menu $menu): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('foto_menu')) {

            if ($menu->foto_menu) {
                Storage::disk('public')->delete($menu->foto_menu);
            }

            $data['foto_menu'] = $request->file('foto_menu')
                ->store('menus', 'public');
        }

        $menu->update($data);

        return Redirect::route('menus.index')
            ->with('success', 'Menu updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu): RedirectResponse
    {
        $menu->delete();

        return Redirect::route('menus.index')
            ->with('success', 'Menu deleted successfully.');
    }

    public function trash(Request $request): View
    {
        $search = $request->search;
        $sort = $request->sort ?? 'desc';

        $menus = Menu::onlyTrashed()
            ->with('category')
            ->when($search, function ($query) use ($search) {
                $query->where('kode_menu', 'like', "%{$search}%")
                    ->orWhere('nama_menu', 'like', "%{$search}%");
            })
            ->orderBy('kode_menu', $sort)
            ->paginate(10)
            ->withQueryString();

        return view('menu.trash', compact(
            'menus',
            'search',
            'sort'
        ));
    }

    public function restore($id): RedirectResponse
    {
        Menu::onlyTrashed()
            ->findOrFail($id)
            ->restore();

        return Redirect::route('menus.trash')
            ->with('success', 'Menu restored successfully.');
    }

    public function forceDelete($id): RedirectResponse
    {
        $menu = Menu::onlyTrashed()->findOrFail($id);

        if ($menu->foto_menu) {
            Storage::disk('public')->delete($menu->foto_menu);
        }

        $menu->forceDelete();

        return Redirect::route('menus.trash')
            ->with('success', 'Menu deleted permanently.');
    }
}