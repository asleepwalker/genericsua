document.addEventListener('DOMContentLoaded', function() {
	NodeList.prototype.forEach = Array.prototype.forEach;

	document.querySelectorAll('.results .item').forEach(function (item) {
		var button = item.querySelector('button.details');
		if (button) {
			var generics = item.querySelector('.generics').cloneNode(true);
			button.onclick = function () {
				var aboutBlock = item.querySelector('.about');
				aboutBlock.appendChild(generics);
				aboutBlock.replaceChild(generics, button);
			};
		}
	});
});
