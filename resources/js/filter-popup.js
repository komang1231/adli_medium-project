/**
 * Filter Popup Controller
 * Reusable across all CRUD pages (Category, Menu, Member, dst).
 * No page-specific logic here — "default" state is simply whatever
 * radio/select value is set when the page loads (usually "Semua").
 */

const POPUP_ANIMATION_DURATION = 150;

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-filter-widget]').forEach(initFilterWidget);
});

function initFilterWidget(widget) {
    const trigger = widget.querySelector('[data-filter-trigger]');
    const popup = widget.querySelector('[data-filter-popup]');
    const dot = widget.querySelector('[data-filter-dot]');
    const body = widget.querySelector('[data-filter-body]');
    const resetBtn = widget.querySelector('[data-filter-reset]');
    const applyBtn = widget.querySelector('[data-filter-apply]');
    const closeBtn = widget.querySelector('[data-filter-close]');

    const defaults = captureState(body);

    function open() {
        popup.hidden = false;

        // setiap buka popup mulai dari atas
        body.scrollTop = 0;

        requestAnimationFrame(() => {
            popup.classList.add('is-open');

            // fokus ke input pertama
            const firstInput = body.querySelector('input, select');
            firstInput?.focus();
        });

        trigger.setAttribute('aria-expanded', 'true');

        clampToViewport(popup);

        document.addEventListener('click', onOutsideClick);
        document.addEventListener('keydown', onKeydown);
    }

    function close() {
        popup.classList.remove('is-open');
        popup.classList.remove('align-left');

        trigger.setAttribute('aria-expanded', 'false');

        document.removeEventListener('click', onOutsideClick);
        document.removeEventListener('keydown', onKeydown);

        window.setTimeout(() => {
            popup.hidden = true;
        }, POPUP_ANIMATION_DURATION);
    }

    function onOutsideClick(event) {
        if (!widget.contains(event.target)) {
            close();
        }
    }

    function onKeydown(event) {
        if (event.key === 'Escape') {
            close();
        }
    }

    trigger.addEventListener('click', () => {
        popup.hidden ? open() : close();
    });
    closeBtn?.addEventListener('click', close);

    resetBtn.addEventListener('click', () => {
        restoreState(body, defaults);
        refreshDirtyState();
        close();
    });

    applyBtn.addEventListener('click', () => {
        widget.dispatchEvent(
            new CustomEvent('filter:apply', {
                bubbles: true,
                detail: {
                    state: captureState(body),
                },
            })
        );

        close();
    });

    body.addEventListener('change', refreshDirtyState);

    function refreshDirtyState() {
        const currentState = captureState(body);
        const dirty = !statesMatch(currentState, defaults);

        resetBtn.disabled = !dirty;
        dot.classList.toggle('is-visible', dirty);
    }

    refreshDirtyState();
}

/**
 * Membaca semua nilai filter.
 */
function captureState(body) {
    const state = {};

    body.querySelectorAll('[data-filter-key]').forEach((section) => {
        const key = section.dataset.filterKey;

        const checkedRadio = section.querySelector(
            'input[type="radio"]:checked'
        );

        const select = section.querySelector('select');

        if (checkedRadio) {
            state[key] = checkedRadio.value;
        } else if (select) {
            state[key] = select.value;
        }
    });

    return state;
}

/**
 * Mengembalikan semua filter ke kondisi awal.
 */
function restoreState(body, state) {
    body.querySelectorAll('[data-filter-key]').forEach((section) => {
        const key = section.dataset.filterKey;
        const value = state[key];

        if (value === undefined) return;

        const radio = section.querySelector(
            `input[type="radio"][value="${CSS.escape(value)}"]`
        );

        const select = section.querySelector('select');

        if (radio) {
            radio.checked = true;
        }

        if (select) {
            select.value = value;
        }
    });
}

function statesMatch(a, b) {
    return Object.keys(b).every((key) => a[key] === b[key]);
}

/**
 * Menjaga popup tetap berada di dalam viewport.
 */
function clampToViewport(popup) {
    popup.classList.remove('align-left');

    const rect = popup.getBoundingClientRect();

    if (rect.left < 0) {
        popup.classList.add('align-left');
    }
}