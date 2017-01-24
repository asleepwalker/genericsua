var input = document.querySelector('form.search input');
var example = document.querySelector('form.search .example .pseudo');

example.onclick = function () {
	input.value = this.innerHTML;
	window.location = '/product/' + this.getAttribute('data-product') + '/';
};
