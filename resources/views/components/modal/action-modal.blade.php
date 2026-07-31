@props(['id', 'title', 'buttonText', 'buttonClass' => 'btn-submit'])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content modal-custom">

            <div class="modal-header">

                <h5 class="modal-title">
                    {{ $title }}
                </h5>

                <button type="button" class="btn-modal-close" data-bs-dismiss="modal">

                    <i class="bi bi-x-lg"></i>

                </button>

            </div>

            <div class="modal-body">

                {{ $slot }}

            </div>

            <div class="modal-footer">
                <input type="hidden" id="modalMode" value="submit">

                <form id="modalActionForm" method="POST" data-mode="submit">

                    @csrf

                    <input type="hidden" name="_method" id="modalMethod" value="DELETE">

                    <button type="button" class="btn-cancel" data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button type="button" class="{{ $buttonClass }}" id="modalActionButton">

                        {{ $buttonText }}

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>
