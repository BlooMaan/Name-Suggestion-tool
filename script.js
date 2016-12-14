(function () {
	var autocomplete_input = document.querySelector('.js-autocomplete_input');
	var last_name = document.querySelector('.js-last_name');
	var results = document.querySelector('.js-results');
	var wrapper_results = document.querySelector('.js-wrapper_results');
	var model = document.querySelector('.js-model-name');
	model.remove();
	wrapper_results.classList.add('js-class-empty');
	var xhr = new XMLHttpRequest();
	xhr.addEventListener('load', function (ev) {
		if (xhr.status != 200) return;
		
		var res;
		results.textContent = '';
		
		res = JSON.parse(xhr.responseText);
		
		var l = res.length;
		for (var i = 0; i < l; i++) {
			var d = res[i];
			var a = model.cloneNode(true);
			a.textContent = d.name + ' ' + last_name.value.trim();
			results.appendChild(a);
		}
		
		wrapper_results.classList[(l ? 'remove' : 'add')]('js-class-empty');
	});
	
	var updateNameCombo = function (ev) {
		xhr.abort();
		xhr.open('post', 'name-api.php', 1);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.send('name='+encodeURIComponent(autocomplete_input.value));
	};
	
	last_name.addEventListener('keyup', updateNameCombo);
	autocomplete_input.addEventListener('keyup', updateNameCombo);
})();