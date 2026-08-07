/**
 * POS — Tambah Transaksi
 * Semua data di file ini masih DUMMY. Titik-titik yang perlu diganti
 * ke backend beneran ditandai dengan komentar "TODO: backend".
 */
document.addEventListener('DOMContentLoaded', () => {

    /* =========================================================
       DUMMY DATA
       ========================================================= */



    // TODO: backend — ganti dengan data payment method + provider dari database
    const PAYMENT_GROUPS = [];

    window.paymentProviders.forEach(provider => {

        // Support camelCase maupun snake_case
        const method =
            provider.paymentMethod ??
            provider.payment_method;

        if (!method) return;

        let group = PAYMENT_GROUPS.find(
            g => g.label === method.nama_payment_method
        );

        if (!group) {

            group = {
                label: method.nama_payment_method,
                providers: []
            };

            PAYMENT_GROUPS.push(group);

        }

        group.providers.push({
            id: provider.id,
            name: provider.nama_payment_provider
        });

    });

    // TODO: backend — ganti dengan data menu dari database
    const DUMMY_MENU = window.menus.map(menu => ({

        id: menu.id,

        name: menu.nama_menu,

        price: Number(menu.harga),

        category: menu.category.nama_category,

    }));

    const SERVICE_FEE = 0.05;
    const TAX_RATE = 0.11;
    const MEMBER_DISCOUNT_RATE = 0.10;

    /* =========================================================
       STATE
       ========================================================= */

    let isMember = false;
    let selectedCustomerId = null;
    let selectedProviderId = null;
    // order = { menuId: { name, price, category, qty } }
    let order = {};

    /* =========================================================
       1. INFORMASI PELANGGAN — realtime check
       ========================================================= */

    const nameInput = document.getElementById('customer_name');
    const phoneInput = document.getElementById('customer_phone');
    const nameCheck = document.getElementById('customer_name_check');
    const phoneCheck = document.getElementById('customer_phone_check');
    const memberStatus = document.getElementById('memberStatus');
    const isMemberField = document.getElementById('is_member');
    const customerIdField = document.getElementById('customer_id');

    async function checkCustomer() {

        const keyword =
            nameInput.value.trim() ||
            phoneInput.value.trim();

        if (keyword === '') {

            selectedCustomerId = null;
            isMember = false;

            nameCheck.hidden = true;
            phoneCheck.hidden = true;

            memberStatus.innerHTML =
                '<span class="pos-badge pos-badge-neutral">Non Member</span>';

            renderSummary();

            return;
        }

        const response = await fetch(
            `/members/check?keyword=${encodeURIComponent(keyword)}`
        );

        const result = await response.json();

        if (!result.success) {

            selectedCustomerId = null;
            isMember = false;

            nameCheck.hidden = true;
            phoneCheck.hidden = true;

            memberStatus.innerHTML =
                '<span class="pos-badge pos-badge-neutral">Non Member</span>';

            renderSummary();

            return;
        }

        const member = result.member;

        selectedCustomerId = member.id;
        isMember = true;

        nameInput.value = member.nama_pelanggan;
        phoneInput.value = member.no_tlp;

        nameCheck.hidden = false;
        phoneCheck.hidden = false;

        memberStatus.innerHTML =
            '<span class="pos-badge pos-badge-member">Member</span>';

        customerIdField.value = member.id;
        isMemberField.value = 1;

        renderSummary();

    }

    let customerDebounce;
    function debouncedCheckCustomer() {
        clearTimeout(customerDebounce);
        customerDebounce = setTimeout(checkCustomer, 250);
    }

    nameInput.addEventListener('input', debouncedCheckCustomer);
    phoneInput.addEventListener('input', debouncedCheckCustomer);

    /* =========================================================
       2. PAYMENT PROVIDER
       ========================================================= */

    const paymentGroupsContainer = document.getElementById('paymentProviderGroups');
    const paymentProviderField = document.getElementById('payment_provider_id');

    function renderPaymentProviders() {
        paymentGroupsContainer.innerHTML = PAYMENT_GROUPS.map((group) => `
            <div class="pos-payment-group-label">${group.label}</div>
            <div class="pos-payment-group">
                ${group.providers.map((p) => `
                    <button type="button" class="pos-provider-btn" data-provider-id="${p.id}">
                        ${p.name}
                    </button>
                `).join('')}
            </div>
        `).join('');

        paymentGroupsContainer.querySelectorAll('[data-provider-id]').forEach((btn) => {
            btn.addEventListener('click', () => {
                selectedProviderId = btn.dataset.providerId;
                paymentProviderField.value = selectedProviderId;

                paymentGroupsContainer.querySelectorAll('[data-provider-id]').forEach((b) => {
                    b.classList.toggle('is-active', b === btn);
                });
            });
        });
    }

    renderPaymentProviders();

    /* =========================================================
       3. CARI MENU — realtime search + dropdown
       ========================================================= */

    const menuSearchInput = document.getElementById('menuSearch');
    const menuDropdown = document.getElementById('menuDropdown');

    function renderMenuDropdown(query) {
        const q = query.trim().toLowerCase();

        if (q.length === 0) {
            menuDropdown.hidden = true;
            menuDropdown.innerHTML = '';
            return;
        }

        // TODO: backend — ganti filter array ini dengan AJAX pencarian menu
        const results = DUMMY_MENU.filter((m) => m.name.toLowerCase().includes(q));

        menuDropdown.hidden = false;

        if (results.length === 0) {
            menuDropdown.innerHTML = '<div class="pos-menu-empty">Menu tidak ditemukan.</div>';
            return;
        }

        menuDropdown.innerHTML = results.map((m) => `
            <div class="pos-menu-item">
                <div class="pos-menu-thumb"></div>
                <div class="pos-menu-info">
                    <div class="pos-menu-name">${m.name}</div>
                    <div class="pos-menu-price">${formatCurrency(m.price)}</div>
                </div>
                <button type="button" class="pos-menu-add-btn" data-menu-id="${m.id}" aria-label="Tambah ${m.name}">+</button>
            </div>
        `).join('');

        menuDropdown.querySelectorAll('[data-menu-id]').forEach((btn) => {
            btn.addEventListener('click', () => {
                const menuId = Number(btn.dataset.menuId);
                const menu = DUMMY_MENU.find((m) => m.id === menuId);
                addToOrder(menu);
            });
        });
    }

    menuSearchInput.addEventListener('input', (e) => renderMenuDropdown(e.target.value));

    document.addEventListener('click', (e) => {
        if (!menuSearchInput.contains(e.target) && !menuDropdown.contains(e.target)) {
            menuDropdown.hidden = true;
        }
    });

    /* =========================================================
       4. DAFTAR PESANAN
       ========================================================= */

    const orderListEl = document.getElementById('orderList');
    const orderEmptyEl = document.getElementById('orderEmpty');

    function addToOrder(menu) {
        if (order[menu.id]) {
            order[menu.id].qty += 1;
        } else {
            order[menu.id] = {
                name: menu.name,
                price: menu.price,
                category: menu.category,
                qty: 1,
            };
        }
        renderOrder();
    }

    function changeQty(menuId, delta) {
        if (!order[menuId]) return;
        order[menuId].qty += delta;
        if (order[menuId].qty <= 0) {
            delete order[menuId];
        }
        renderOrder();
    }

    function removeItem(menuId) {
        delete order[menuId];
        renderOrder();
    }

    function renderOrder() {
        const entries = Object.entries(order);

        if (entries.length === 0) {
            orderListEl.innerHTML = '';
            orderListEl.appendChild(orderEmptyEl);
            orderEmptyEl.hidden = false;
            renderSummary();
            return;
        }

        orderEmptyEl.hidden = true;

        // Kelompokkan per kategori, urutan kategori mengikuti kemunculan pertama
        const grouped = {};
        entries.forEach(([id, item]) => {
            if (!grouped[item.category]) grouped[item.category] = [];
            grouped[item.category].push([id, item]);
        });

        orderListEl.innerHTML = Object.entries(grouped).map(([category, items]) => `
            <div class="pos-order-category-label">${category}</div>
            ${items.map(([id, item]) => {
            const subtotal = item.price * item.qty;
            return `
                    <div class="pos-order-item">
                        <div class="pos-order-info">
                            <div class="pos-order-name">${item.name}</div>
                            <div class="pos-order-price">${formatCurrency(item.price)}</div>
                        </div>
                        <div class="pos-qty-control">
                            <button type="button" class="pos-qty-btn" data-qty-action="decrease" data-menu-id="${id}">-</button>
                            <span class="pos-qty-value">${item.qty}</span>
                            <button type="button" class="pos-qty-btn" data-qty-action="increase" data-menu-id="${id}">+</button>
                        </div>
                        <div class="pos-order-subtotal">${formatCurrency(subtotal)}</div>
                        <button type="button" class="pos-order-remove" data-remove-id="${id}" aria-label="Hapus ${item.name}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                `;
        }).join('')}
        `).join('');

        orderListEl.querySelectorAll('[data-qty-action="increase"]').forEach((btn) => {
            btn.addEventListener('click', () => changeQty(btn.dataset.menuId, 1));
        });
        orderListEl.querySelectorAll('[data-qty-action="decrease"]').forEach((btn) => {
            btn.addEventListener('click', () => changeQty(btn.dataset.menuId, -1));
        });
        orderListEl.querySelectorAll('[data-remove-id]').forEach((btn) => {
            btn.addEventListener('click', () => removeItem(btn.dataset.removeId));
        });

        renderSummary();
    }

    /* =========================================================
       5. RINGKASAN PEMBAYARAN
       ========================================================= */

    const sumSubtotal = document.getElementById('sumSubtotal');
    const sumDiscount = document.getElementById('sumDiscount');
    const sumService = document.getElementById('sumService');
    const sumTax = document.getElementById('sumTax');
    const sumGrandTotal = document.getElementById('sumGrandTotal');

    function renderSummary() {
        const subtotal = Object.values(order).reduce((acc, item) => acc + item.price * item.qty, 0);
        const discount = isMember ? subtotal * MEMBER_DISCOUNT_RATE : 0;
        const service = subtotal > 0 ? SERVICE_FEE * subtotal : 0;
        const taxBase = subtotal - discount + service;
        const tax = subtotal > 0 ? taxBase * TAX_RATE : 0;
        const grandTotal = taxBase + tax;

        sumSubtotal.textContent = formatCurrency(subtotal);
        sumDiscount.textContent = '- ' + formatCurrency(discount);
        sumService.textContent = formatCurrency(service);
        sumTax.textContent = formatCurrency(tax);
        sumGrandTotal.textContent = formatCurrency(grandTotal);
    }

    /* =========================================================
       6. SUBMIT
       ========================================================= */

    const transactionForm = document.getElementById('transactionForm');

    transactionForm.addEventListener('submit', (e) => {
        // TODO: backend — validasi & kirim payload ke endpoint transaksi (bisa juga diganti AJAX)
        document.getElementById('form_customer_id').value = selectedCustomerId ?? '';
        document.getElementById('form_is_member').value = isMember ? '1' : '0';
        document.getElementById('form_payment_provider_id').value = selectedProviderId ?? '';
        document.getElementById('form_items').value = JSON.stringify(
            Object.entries(order).map(([menuId, item]) => ({
                menu_id: menuId,
                qty: item.qty,
            }))
        );

        if (Object.keys(order).length === 0) {
            e.preventDefault();
            alert('Tambahkan minimal 1 menu sebelum menyimpan transaksi.');
        }
    });

    /* =========================================================
       UTIL
       ========================================================= */

    function formatCurrency(value) {
        return 'Rp ' + Math.round(value).toLocaleString('id-ID');
    }

    // Render awal
    renderOrder();
});