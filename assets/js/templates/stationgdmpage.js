document.addEventListener('DOMContentLoaded', setup);

function setup() {
	function readMoreInteraction(){
		let allReadMoreBlocks = document.querySelectorAll('.readmore-block');

		for ( readMoreBlock of allReadMoreBlocks ) {
			let readMoreButton = readMoreBlock.querySelector('.readmore-button');
			let readMoreText = readMoreBlock.querySelector('.text');
			let readMorePicto = readMoreBlock.querySelector('.picto');
			let isOpen = false;

			readMoreButton.addEventListener('click', displayFullText);

			function displayFullText(){
				readMoreText.classList.toggle('display');

				if( isOpen == false ) {
					readMorePicto.innerHTML = '–';
					isOpen = true;
				} else {
					readMorePicto.innerHTML = '+';
					isOpen = false;
				}
			}
		}
	}

	readMoreInteraction();
}