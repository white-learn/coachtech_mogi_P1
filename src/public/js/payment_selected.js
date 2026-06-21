document.getElementById('payment_selected')
	.addEventListener('change', function () {

		const preview = document.getElementById('payment_preview');

		if (this.value === '') {
			preview.textContent = '未選択';
			return;
		}

		preview.textContent = this.options[this.selectedIndex].text;
	});