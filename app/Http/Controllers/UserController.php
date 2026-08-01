<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->search;
        $sort = $request->sort ?? 'asc';

        $users = User::when($search, function ($query) use ($search) {

            $query->where('kode_user', 'like', "%{$search}%")
                ->orWhere('nama_user', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('no_tlp', 'like', "%{$search}%");
        })
            ->orderBy('nama_user', $sort)
            ->paginate(10)
            ->withQueryString();

        return view('user.index', compact(
            'users',
            'search',
            'sort'
        ));
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if (auth()->user()->role === 'Manager') {

            $validated['role'] = 'Staff';
        }

        if ($request->hasFile('foto_profile')) {

            $validated['foto_profile'] = $request
                ->file('foto_profile')
                ->store('users', 'public');
        }


        $validated['password'] = Hash::make($validated['password']);

        $validated['status'] = 'Active';

        User::create($validated);

        return Redirect::route('users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function show(User $user): View
    {
        return view('user.show', compact('user'));
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();

        unset($validated['password']);

        if ($request->hasFile('foto_profile')) {

            if ($user->foto_profile) {

                Storage::disk('public')
                    ->delete($user->foto_profile);
            }

            $validated['foto_profile'] = $request
                ->file('foto_profile')
                ->store('users', 'public');
        }

        $user->update($validated);

        return Redirect::route('users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return Redirect::route('users.index')
            ->with('success', 'User berhasil dihapus.');
    }

    public function trash(Request $request): View
    {
        $search = $request->search;
        $sort = $request->sort ?? 'asc';

        $users = User::onlyTrashed()
            ->when($search, function ($query) use ($search) {

                $query->where('kode_user', 'like', "%{$search}%")
                    ->orWhere('nama_user', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('no_tlp', 'like', "%{$search}%");
            })
            ->orderBy('nama_user', $sort)
            ->paginate(10)
            ->withQueryString();

        return view('user.trash', compact(
            'users',
            'search',
            'sort'
        ));
    }

    public function restore($id): RedirectResponse
    {
        User::onlyTrashed()
            ->findOrFail($id)
            ->restore();

        return Redirect::route('users.trash')
            ->with('success', 'User berhasil dipulihkan.');
    }

    public function forceDelete($id): RedirectResponse
    {
        $user = User::onlyTrashed()->findOrFail($id);

        if ($user->foto_profile) {

            Storage::disk('public')
                ->delete($user->foto_profile);
        }

        $user->forceDelete();

        return Redirect::route('users.trash')
            ->with('success', 'User berhasil dihapus permanen.');
    }

    public function toggleStatus(User $user): RedirectResponse
    {
        $user->status = $user->status === 'Active'
            ? 'Non-Active'
            : 'Active';

        $user->save();

        return back()->with(
            'success',
            'Status user berhasil diperbarui.'
        );
    }
}
