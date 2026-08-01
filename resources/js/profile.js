/**
 * Generic dropdown controller.
 * Works for the topbar profile menu (and reusable for other topbar
 * dropdowns like Mail later) — same open/close pattern as filter popup.
 */
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-dropdown-widget]').forEach(initDropdown);
});

function initDropdown(widget) {
    const trigger = widget.querySelector('[data-dropdown-trigger]');
    const menu    = widget.querySelector('[data-dropdown-menu]');

    function open() {
        menu.hidden = false;
        requestAnimationFrame(() => menu.classList.add('is-open'));
        trigger.setAttribute('aria-expanded', 'true');
        document.addEventListener('click', onOutsideClick);
        document.addEventListener('keydown', onKeydown);
    }

    function close() {
        menu.classList.remove('is-open');
        trigger.setAttribute('aria-expanded', 'false');
        document.removeEventListener('click', onOutsideClick);
        document.removeEventListener('keydown', onKeydown);
        window.setTimeout(() => { menu.hidden = true; }, 150);
    }

    function onOutsideClick(event) {
        if (!widget.contains(event.target)) close();
    }

    function onKeydown(event) {
        if (event.key === 'Escape') close();
    }

    trigger.addEventListener('click', () => {
        menu.hidden ? open() : close();
    });
}