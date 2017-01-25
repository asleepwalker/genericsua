document.addEventListener('DOMContentLoaded', function() {
	var input = document.querySelector('form.search input');
	var awesomplete = new Awesomplete(input, {
		replace: function (selectedItem) {
			input.value = selectedItem.label;
			window.location = '/product/' + selectedItem.value + '/';
		}
	});

	input.onkeyup = function () {
		var ajax = new XMLHttpRequest();
		ajax.open('GET', '/suggest/?q=' + encodeURIComponent(input.value), true);
		ajax.onload = function() {
			awesomplete.list = JSON.parse(ajax.responseText);
		};
		ajax.send();
	};
});
