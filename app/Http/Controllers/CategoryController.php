<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
            $search = $request->search;
            $sort = $request->sort ?? 'desc';
            $used = $request->used;

            $categories = Category::withCount('menus')
                ->when($search, function ($query) use ($search) {
                    $query->where('kode_category', 'like', "%{$search}%")
                        ->orWhere('nama_category', 'like', "%{$search}%");
                })
                ->when($used == 'yes', function ($query) {
                    $query->has('menus');
                })
                ->when($used == 'no', function ($query) {
                    $query->doesntHave('menus');
                })
                ->orderBy('kode_category', $sort)
                ->paginate(10)
                ->withQueryString();

            return view('category.index', compact(
                'categories',
                'search',
                'sort',
                'used',
            ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $category = new Category();

        return view('category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        return Redirect::route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $category = Category::find($id);

        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $category = Category::find($id);

        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());

        return Redirect::route('categories.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Category::find($id)->delete();

        return Redirect::route('categories.index')
            ->with('success', 'Category deleted successfully');
    }

    public function trash(Request $request): View
    {
        $search = $request->search;
        $sort = $request->sort ?? 'desc';

        $categories = Category::onlyTrashed()
            ->when($search, function ($query) use ($search) {
                $query->where('kode_category', 'like', "%{$search}%")
                    ->orWhere('nama_category', 'like', "%{$search}%");
            })
            ->orderBy('kode_category', $sort)
            ->paginate(20)
            ->withQueryString();

        return view('category.trash', compact(
            'categories',
            'search',
            'sort'
        ));
    }

    public function restore($id): RedirectResponse
    {
        Category::onlyTrashed()
            ->findOrFail($id)
            ->restore();

        return Redirect::route('categories.trash')
            ->with('success', 'Category restored successfully.');
    }

    public function forceDelete($id): RedirectResponse
    {
        Category::onlyTrashed()
            ->findOrFail($id)
            ->forceDelete();

        return Redirect::route('categories.trash')
            ->with('success', 'Category deleted permanently.');
    }
}
