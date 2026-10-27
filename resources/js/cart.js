import htmx from 'htmx.org';
// WooCommerce can replace cached fragments after htmx's initial DOM scan.
document.addEventListener('DOMContentLoaded', () => {
	window.jQuery?.(document.body).on('wc_fragments_loaded wc_fragments_refreshed added_to_cart removed_from_cart', () => {
		document.querySelectorAll('.ccafe-mini-cart').forEach((cart) => htmx.process(cart));
		if (refreshingCart) {
			const shouldRestore = document.activeElement === document.body;
			refreshingCart = false;
			cartBusy = false;
			setCartDisabled(false);
			if (shouldRestore) restoreFocus(document.querySelector(`${cartFocus?.header || '.header-shop'} .ccafe-mini-cart`));
		}
	});
	window.jQuery?.(document.body).on('wc_fragments_ajax_error', () => {
		if (!refreshingCart) return;
		refreshingCart = false;
		cartBusy = false;
		setCartDisabled(false);
		try { sessionStorage.removeItem(window.wc_cart_fragments_params.fragment_name); } catch { /* Storage may be unavailable. */ }
	});
});
// Woo owns cart fragments. htmx owns this single HTML form component.
let cartFocus;
let refreshingCart = false;
let cartBusy = false;
function setCartDisabled(disabled) {
	document.querySelectorAll('.ccafe-mini-cart button').forEach((button) => { button.disabled = disabled; });
}
function restoreFocus(cart) {
	if (!cart) return;
	const button = [...cart.querySelectorAll('button')].find((item) => item.closest('[data-cart-item]')?.dataset.cartItem === cartFocus?.key && item.getAttribute('aria-label') === cartFocus?.label);
	(button || cart.querySelector('.ccafe-cart-link'))?.focus({ preventScroll: true });
}
document.addEventListener('htmx:beforeRequest', (event) => {
	if (!event.target.closest('.ccafe-mini-cart')) return;
	if (cartBusy) { event.preventDefault(); return; }
	cartBusy = true;
	const button = event.detail.requestConfig?.triggeringEvent?.submitter || document.activeElement;
	cartFocus = button?.name === 'quantity' ? { key: event.target.elements.cart_item_key.value, label: button.getAttribute('aria-label'), header: event.target.closest('#menuu') ? '#menuu' : '.header-shop' } : null;
});
document.addEventListener('htmx:beforeSwap', (event) => {
	if (event.detail.target?.matches('.ccafe-mini-cart') && [403, 422].includes(event.detail.xhr.status)) {
		event.detail.shouldSwap = true;
		event.detail.isError = false;
	}
});
document.addEventListener('htmx:afterSwap', (event) => {
	if (event.target.matches('.ccafe-mini-cart')) setCartDisabled(true);
});
document.addEventListener('htmx:afterSettle', (event) => {
	if (!event.target.matches('.ccafe-mini-cart')) return;
	if (event.detail.xhr.status < 400 && window.jQuery) {
		// Refresh Woo's sessionStorage cache and the other header instance too.
		refreshingCart = true;
		window.jQuery(document.body).trigger('wc_fragment_refresh');
	} else {
		cartBusy = false;
		setCartDisabled(false);
		restoreFocus(event.target);
	}
});
for (const name of ['htmx:sendError', 'htmx:timeout', 'htmx:sendAbort', 'htmx:responseError']) {
	document.addEventListener(name, (event) => {
		const message = event.target.closest('.ccafe-mini-cart')?.querySelector('.ccafe-cart-message');
		if (message) { cartBusy = false; setCartDisabled(false); }
		if (message) message.textContent = 'Nie udało się zaktualizować koszyka. Sprawdź połączenie i spróbuj ponownie.';
	});
}
