// Visual box composition and local draft use browser APIs; PHP validates the purchase.
document.addEventListener('DOMContentLoaded', () => {
	const root = document.getElementById('ccafe-pralines');
	if (!root) return;
	const form = root.querySelector('form.cart');
	const cards = [...root.querySelectorAll('[data-candy-id]')];
	const options = [...root.querySelectorAll('.option-card')];
	const counts = new Map(cards.map((card) => [Number(card.dataset.candyId), 0]));
	const status = root.querySelector('#praline-status');
	const summary = root.querySelector('#candy-summary-list');
	const images = root.querySelector('#candy-image-summary');
	const storageKey = `ccafe-pralines-v2-${form.dataset.product_id}`;
	let selected;
	const total = () => [...counts.values()].reduce((sum, count) => sum + count, 0);
	const capacity = () => Number(selected?.dataset.capacity || 0);
	const selection = () => [...counts].filter(([, quantity]) => quantity > 0).map(([id, quantity]) => ({ id, quantity }));
	function render(message = '') {
		const size = capacity();
		const count = total();
		root.querySelectorAll('.global-counter').forEach((el) => { el.textContent = count; });
		root.querySelector('.box-capacity').textContent = size;
		form.querySelector('[name="custom_candies"]').value = JSON.stringify(selection());
		form.querySelector('[name="box_size"]').value = selected?.dataset.value || '';
		root.querySelectorAll('[type="submit"]').forEach((button) => { button.disabled = !size || count !== size; });
		status.textContent = message || (!size ? 'Wybierz rozmiar pudełka, a następnie smaki pralin.' : count === size ? `Zestaw jest gotowy: ${count} z ${size} pralin.` : `Wybrano ${count} z ${size} pralin. Dodaj jeszcze ${size - count}.`);
		summary.replaceChildren();
		images.replaceChildren();
		images.dataset.capacity = size;
		cards.forEach((card) => {
			const id = Number(card.dataset.candyId);
			const quantity = counts.get(id);
			const name = card.querySelector('.AgrestWCzekoladzie').textContent.trim();
			card.querySelector('[data-count]').textContent = quantity;
			card.querySelector('.decrement').disabled = quantity === 0;
			card.querySelector('.increment').disabled = !size || count >= size;
			if (!quantity) return;
			const remove = document.createElement('button');
			remove.type = 'button';
			remove.className = 'ccafe-selected-candy';
			remove.textContent = `${name} × ${quantity} ×`;
			remove.setAttribute('aria-label', `Usuń jedną pralinę: ${name}`);
			remove.addEventListener('click', () => {
				counts.set(id, counts.get(id) - 1);
				render();
				card.querySelector('.increment').focus({ preventScroll: true });
			});
			summary.append(remove);
			for (let index = 0; index < quantity; index++) {
				const image = document.createElement('img');
				image.src = card.querySelector('img').dataset.extraImage || card.querySelector('img').src;
				image.alt = '';
				images.append(image);
			}
		});
		try { localStorage.setItem(storageKey, JSON.stringify({ box: selected?.dataset.value, candies: selection() })); } catch { /* Private browsing may disallow storage. */ }
	}
	function choose(option, redraw = true) {
		selected = option;
		options.forEach((item) => { item.setAttribute('aria-pressed', String(item === option)); });
		const group = option.closest('.attribute-group');
		group.querySelector('input[name^="attribute_"]').value = option.dataset.value;
		form.querySelector('[name="variation_id"]').value = option.dataset.variationId;
		root.querySelector('#main-variation-image').src = option.querySelector('img').src;
		root.querySelector('#variation-price').textContent = new Intl.NumberFormat('pl-PL', { style: 'currency', currency: 'PLN' }).format(Number(option.dataset.variationPrice));
		let remaining = capacity();
		let trimmed = false;
		for (const [id, count] of counts) {
			const next = Math.min(count, remaining);
			trimmed ||= next !== count;
			counts.set(id, next);
			remaining -= next;
		}
		if (redraw) render(trimmed ? `Zmniejszono zestaw do ${capacity()} pralin. Sprawdź wybrane smaki przed dodaniem do koszyka.` : '');
	}
	options.forEach((option) => option.addEventListener('click', () => choose(option)));
	cards.forEach((card) => {
		const id = Number(card.dataset.candyId);
		for (const [selector, delta] of [['.increment', 1], ['.decrement', -1]]) {
			card.querySelector(selector).addEventListener('click', () => {
				const next = counts.get(id) + delta;
				if (next < 0 || !capacity() || total() + delta > capacity()) return;
				counts.set(id, next);
				render();
			});
		}
	});
	root.querySelector('#clear_all').addEventListener('click', () => { counts.forEach((_, id) => counts.set(id, 0)); render(); });
	form.addEventListener('submit', (event) => {
		if (!capacity() || total() !== capacity()) { event.preventDefault(); render(); status.focus(); }
	});
	try {
		const saved = JSON.parse(localStorage.getItem(storageKey));
		const option = options.find((item) => item.dataset.value === saved?.box);
		if (option && Array.isArray(saved.candies)) {
			choose(option, false);
			let remaining = capacity();
			for (const candy of saved.candies) {
				if (!counts.has(candy.id) || !Number.isInteger(candy.quantity) || candy.quantity <= 0) continue;
				const quantity = Math.min(candy.quantity, remaining);
				counts.set(candy.id, quantity);
				remaining -= quantity;
			}
		}
	} catch { /* Invalid or stale drafts never prevent a new selection. */ }
	render();
});
