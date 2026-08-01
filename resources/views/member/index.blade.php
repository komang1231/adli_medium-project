@extends('layouts.app')

@section('template_title')
    Members
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="content-card">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5>Data Member</h5>
            @if(request('expired'))
                <span class="entries-info">Menampilkan member expired</span>
            @endif
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                @if(request('expired'))
                    <a href="{{ route('members.index') }}" class="btn btn-add">
                        Kembali
                    </a>
                @else
                    <button class="btn btn-add me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#formOffcanvas">
                        <img class="icon" src="{{ asset('assets/icons/table/add.svg') }}" alt="">
                        Add
                    </button>

                    <a href="{{ route('members.index', ['expired' => 1]) }}" class="btn btn-add btn-trash-soft me-2">
                        <img class="icon" src="{{ asset('assets/icons/table/trash.svg') }}" alt="">
                        Expired
                    </a>
                @endif
            </div>

            <div class="d-flex align-items-center">
                <form action="{{ route('members.index') }}" method="GET" class="d-flex align-items-center">
                    @if(request('expired'))
                        <input type="hidden" name="expired" value="1">
                    @endif
                    <input type="text" name="search" class="search-box" placeholder="Cari..." value="{{ request('search') }}">
                    <button type="submit" class="search-icon-btn">
                        <img src="{{ asset('assets/icons/table/search.svg') }}" alt="">
                    </button>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="70">No</th>
                        <th width="140">Kode Pelanggan</th>
                        <th>Nama Pelanggan</th>
                        <th>Nomor Telp</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($members as $member)
                        <tr>
                            <td>{{ $members->firstItem() + $loop->index }}</td>
                            <td>{{ $member->kode_pelanggan }}</td>
                            <td>{{ $member->nama_pelanggan }}</td>
                            <td>{{ $member->no_tlp }}</td>
                            <td>{{ $member->expired_status }}</td>
                            <td class="text-center">
                                @if(request('expired'))
                                    {{--
                                    <button type="button" class="btn btn-perpanjang btn-perpanjang-member" data-bs-toggle="offcanvas"
                                        data-bs-target="#editMemberOffcanvas"
                                        data-action="{{ route('members.update', $member->id) }}"
                                        data-nama="{{ $member->nama_pelanggan }}"
                                        data-telp="{{ $member->no_tlp }}"
                                        data-expired="{{ $member->expired_at?->format('Y-m-d H:i:s') ?? '' }}"
                                        data-status="{{ $member->expired_status }}"
                                        data-perpanjang="1">
                                        Perpanjang
                                    </button>
                                    --}}
                                    <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-hapus ms-2">Hapus</button>
                                    </form>
                                @else
                                    <a class="btn btn-detail" href="{{ route('members.show', $member->id) }}">Detail</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                Belum ada data member.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <span class="entries-info">
                Showing {{ $members->firstItem() ?? 0 }}
                to {{ $members->lastItem() ?? 0 }}
                of {{ $members->total() }} entries
            </span>

            {{ $members->withQueryString()->links() }}
        </div>
    </div>
    </section>

    {{-- OFF CANVAS CREATE --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="formOffcanvas" aria-labelledby="formOffcanvasLabel">
        <div class="offcanvas-header">
            <span class="offcanvas-title" id="formOffcanvasLabel">Create Member</span>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form method="POST" action="{{ route('members.store') }}" role="form" enctype="multipart/form-data">
                @csrf

                @include('member.form')

            </form>
        </div>
    </div>

    {{-- OFF CANVAS EDIT --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="editMemberOffcanvas" aria-labelledby="editMemberOffcanvasLabel">
        <div class="offcanvas-header">
            <span class="offcanvas-title" id="editMemberOffcanvasLabel">Edit Member</span>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form id="editMemberForm" method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('member.form')

                <div class="form-group mb-2 mb20">
                    <p><strong>Status saat ini:</strong> <span id="editMemberCurrentStatus">-</span></p>
                    <p><strong>Expired sekarang:</strong> <span id="editMemberCurrentExpired">-</span></p>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const perpanjangButtons = document.querySelectorAll('.btn-perpanjang-member');
            const editForm = document.getElementById('editMemberForm');
            const editTitle = document.getElementById('editMemberOffcanvasLabel');
            const currentStatus = document.getElementById('editMemberCurrentStatus');
            const currentExpired = document.getElementById('editMemberCurrentExpired');
            const nameInput = editForm.querySelector('[name="nama_pelanggan"]');
            const telpInput = editForm.querySelector('[name="no_tlp"]');
            const durationInput = editForm.querySelector('[name="duration"]');

            const createButton = document.querySelector('[data-bs-target="#formOffcanvas"]');
            const createForm = document.querySelector('#formOffcanvas form');

            const resetCreateForm = () => {
                if (!createForm) return;
                createForm.querySelectorAll('input, select').forEach((input) => {
                    if (input.type === 'hidden') return;
                    if (input.tagName === 'SELECT') {
                        input.value = '';
                    } else if (input.type === 'checkbox' || input.type === 'radio') {
                        input.checked = false;
                    } else {
                        input.value = '';
                    }
                    input.disabled = false;
                });
            };

            if (createButton) {
                createButton.addEventListener('click', resetCreateForm);
            }

            perpanjangButtons.forEach((button) => {
                button.addEventListener('click', function () {
                    const action = this.dataset.action;
                    const nama = this.dataset.nama;
                    const telp = this.dataset.telp;
                    const expired = this.dataset.expired;
                    const status = this.dataset.status;

                    editForm.action = action;
                    editTitle.textContent = 'Perpanjang Member';
                    nameInput.value = nama;
                    telpInput.value = telp;
                    durationInput.value = '5s';
                    currentStatus.textContent = status || '-';
                    currentExpired.textContent = expired || '-';

                    nameInput.disabled = true;
                    telpInput.disabled = true;
                    durationInput.disabled = false;
                });
            });
        });
    </script>
@endsection
