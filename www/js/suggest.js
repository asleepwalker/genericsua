document.addEventListener('DOMContentLoaded', function() {
	var form = document.querySelector('form.search');
	var input = form.querySelector('input');
	var awesomplete = new Awesomplete(input, {
		replace: function (selectedItem) {
			input.value = selectedItem.label;
			window.location = '/product/' + selectedItem.value + '/';
		}
	});

	input.onkeyup = function () {
		var q = input.value.trim();
		if (q === '') return;

		var ajax = new XMLHttpRequest();
		ajax.open('GET', '/suggest/?q=' + encodeURIComponent(q), true);
		ajax.onload = function() {
			awesomplete.list = JSON.parse(ajax.responseText);
		};
		ajax.send();
	};

	form.onsubmit = function () {
		if (input.value.trim() === '') {
			input.focus();
			return false;
		}
	};
});
