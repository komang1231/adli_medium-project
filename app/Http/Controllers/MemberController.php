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
        $query = Member::query();

        if ($request->boolean('expired')) {
            $query->where(function ($subQuery) {
                $subQuery->where('status', 'Non-Active')
                    ->orWhere('expired_at', '<=', now());
            });
        } else {
            // Default listing: only Active members whose expired_at is in the future (or null)
            $query->where('status', 'Active')
                ->where(function ($q) {
                    $q->whereNull('expired_at')
                        ->orWhere('expired_at', '>', now());
                });
        }

        if ($request->filled('search')) {
            $query->where(function ($subQuery) use ($request) {
                $subQuery->where('nama_pelanggan', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('kode_pelanggan', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('no_tlp', 'like', '%' . $request->input('search') . '%');
            });
        }

        $members = $query->paginate();
        $member = new Member();

        return view('member.index', compact('members', 'member'))
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
        $data = $request->validated();
        $duration = $request->input('duration', '5s');

        $data['status'] = 'Active';
        $data['expired_at'] = $this->resolveExpiredAt($duration)->toDateTimeString();

        Member::create($data);

        return Redirect::route('members.index')
            ->with('success', 'Member created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $member = Member::findOrFail($id);

        return view('member.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $member = Member::findOrFail($id);

        return view('member.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MemberRequest $request, Member $member): RedirectResponse
    {
        $data = $request->validated();
        $duration = $request->input('duration');

        if ($duration) {
            $data['status'] = 'Active';
            $data['expired_at'] = $this->resolveExpiredAt($duration)->toDateTimeString();
        } elseif ($member->expired_at && now()->gte($member->expired_at)) {
            $data['status'] = 'Non-Active';
        }

        $member->update($data);

        return Redirect::route('members.index')
            ->with('success', 'Member updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        $member = Member::findOrFail($id);

        if ($member->expired_status === 'Active') {
            return Redirect::back()->with('error', 'Maaf tidak bisa hapus data pelanggan karena member masih aktif');
        }

        $member->forceDelete();

        return Redirect::route('members.index')
            ->with('success', 'Member deleted successfully');
    }

    private function resolveExpiredAt(string $duration)
    {
        return match ($duration) {
            '5s' => now()->addSeconds(5),
            '1month' => now()->addMonths(1),
            '3month' => now()->addMonths(3),
            '6month' => now()->addMonths(6),
            '1year' => now()->addYears(1),
            default => now()->addSeconds(5),
        };
    }

    public function check(Request $request)
    {
        $member = Member::where('nama_member', $request->keyword)
            ->orWhere('no_tlp', $request->keyword)
            ->first();

        if (!$member) {

            return response()->json([
                'success' => false
            ]);
        }

        return response()->json([
            'success' => true,
            'member' => $member
        ]);
    }
}
