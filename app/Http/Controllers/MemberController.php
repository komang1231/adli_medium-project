<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MemberRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $members = Member::paginate();

        return view('member.index', compact('members'))
            ->with('i', ($request->input('page', 1) - 1) * $members->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $member = new Member();

        return view('member.create', compact('member'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MemberRequest $request): RedirectResponse
    {
        Member::create($request->validated());

        return Redirect::route('members.index')
            ->with('success', 'Member created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $member = Member::find($id);

        return view('member.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $member = Member::find($id);

        return view('member.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MemberRequest $request, Member $member): RedirectResponse
    {
        $member->update($request->validated());

        return Redirect::route('members.index')
            ->with('success', 'Member updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Member::find($id)->delete();

        return Redirect::route('members.index')
            ->with('success', 'Member deleted successfully');
    }
}
