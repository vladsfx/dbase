let images = document.querySelectorAll('.infinity-slider img');
let current = 0;
slider();
function slider() {
	for (let i = 0; i < images.length; i++) {
		images[i].classList.add('opacity0');
	}

	images[current].classList.remove('opacity0');

	if (current+1 == images.length) {
		current = 0;
	} else {
		current++;
	}
}

document.querySelector('.infinity-slider').onclick = slider;