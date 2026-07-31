@props([
    'id',
    'title',
])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content modal-custom">

            <div class="modal-header">

                <h5 class="modal-title">
                    {{ $title }}
                </h5>

                <button
                    type="button"
                    class="btn-modal-close"
                    data-bs-dismiss="modal">

                    <i class="bi bi-x-lg"></i>

                </button>

            </div>

            <div class="modal-body">

                {{ $slot }}

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn-submit"
                    data-bs-dismiss="modal">

                    Mengerti

                </button>

            </div>

        </div>

    </div>

</div>  