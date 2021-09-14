document.addEventListener('DOMContentLoaded', setup)

function setup() {

	/// HEADER

	// Logo Hover

	var logo = document.getElementById('logo');
	var logoShape = document.getElementById('logo-shape');
	var logoCircle = document.getElementById('logo-circle');
	var logoType = document.getElementById('logo-type');

	var logoReduced = document.getElementById('logo-reduced');
	var logoShapeReduced = document.getElementById('logo-shape-reduced');
	var logoCircleReduced = document.getElementById('logo-circle-reduced');
	var logoTypeReduced = null;

	function logoMouseover (logo, logoShape, logoCircle, logoType){
		logo.classList.add('hover');
		logoShape.classList.add('hover');
		logoCircle.classList.add('hover');
		if (logoType != null){
			logoType.classList.add('hover');
		}
	}

	function logoMouseout (logo, logoShape, logoCircle, logoType){
		logo.classList.remove('hover');
		logoShape.classList.remove('hover');
		logoCircle.classList.remove('hover');
		if (logoType != null){
			logoType.classList.remove('hover');
		}
	}

	logo.addEventListener('mouseover', function(){
		logoMouseover(logo, logoShape, logoCircle, logoType);
	})

	logo.addEventListener('mouseout', function(){
		logoMouseout(logo, logoShape, logoCircle, logoType);
	})

	logoReduced.addEventListener('mouseover', function(){
		logoMouseover(logoReduced, logoShapeReduced, logoCircleReduced, logoTypeReduced);
	})

	logoReduced.addEventListener('mouseout', function(){
		logoMouseout(logoReduced, logoShapeReduced, logoCircleReduced, logoTypeReduced);
	})

	// Station Station Radio Hover

	var radio = document.getElementById('radio');
	var radioPicto = document.getElementById('picto-radio');

	var radioReduced = document.getElementById('radio-reduced');
	var radioPictoReduced = document.getElementById('picto-radio-reduced');

	radio.addEventListener('mouseover', function(){
		radioPicto.classList.add('hover');
	})

	radio.addEventListener('mouseout', function(){
		radioPicto.classList.remove('hover');
	})

	radioReduced.addEventListener('mouseover', function(){
		radioPictoReduced.classList.add('hover');
	})

	radioReduced.addEventListener('mouseout', function(){
		radioPictoReduced.classList.remove('hover');
	})

	// Submenu

	var buttonProgrammes = document.getElementById('programmes');
	var buttonInformations = document.getElementById('informations');

	var submenuProgrammes = document.getElementById('submenu-programmes');
	var submenuInformations = document.getElementById('submenu-informations');

	var submenuMain = null;
	var submenuReduced = document.getElementById('submenu-reduced');

	var buttonProgrammesReduced = document.getElementById('programmes-reduced');
	var buttonInformationsReduced = document.getElementById('informations-reduced');

	var submenuProgrammesReduced = document.getElementById('submenu-reduced-programmes');
	var submenuInformationsReduced = document.getElementById('submenu-reduced-informations');

	function showSubmenu (button, submenu, submenuList1, submenuList2){
		button.addEventListener('click', function(){
			if(submenu != null){
				submenu.classList.add('show');
			}
			submenuList1.classList.add('show');
			submenuList2.classList.remove('show')
		});
	}

	showSubmenu(buttonProgrammes, submenuMain, submenuProgrammes, submenuInformations);
	showSubmenu(buttonInformations, submenuMain, submenuInformations, submenuProgrammes);

	showSubmenu(buttonProgrammesReduced, submenuReduced, submenuProgrammesReduced, submenuInformationsReduced);
	showSubmenu(buttonInformationsReduced, submenuReduced, submenuInformationsReduced, submenuProgrammesReduced);

	// Search Interaction

	var searchPicto = document.getElementById('picto-search');
	var searchBar = document.getElementById('search-bar');
	var searchInput = document.getElementById('search-input');
	var allMenuButtons = document.getElementsByClassName('menu-button');
	var closeSearch = document.getElementById('close-search')
	var menuSeparator = document.getElementById('menu-separator');
	var radioButton = document.getElementById('button-radio');

	var searchPictoReduced = document.getElementById('picto-search-reduced');
	var searchBarReduced = document.getElementById('search-bar-reduced');
	var searchInputReduced = document.getElementById('search-input-reduced');
	var closeSearchReduced = document.getElementById('close-search-reduced');

	var isSearchBarActived = false;

	searchPicto.addEventListener('click', displaySearchBar);
	closeSearch.addEventListener('click', hideSearchBar);
	
	searchPictoReduced.addEventListener('click', displaySearchBar);
	closeSearchReduced.addEventListener('click', hideSearchBar);

	function displaySearchBar(){
		isSearchBarActived = true;

		for( let i = 0; i < allMenuButtons.length; i++ ) {
			allMenuButtons[i].classList.add('hidden');
		}
		menuSeparator.classList.add('hidden');

		searchPicto.classList.add('active');
		searchBar.classList.add('active');
		searchInput.classList.add('active');
		closeSearch.classList.add('active');

		radioButton.classList.add('active');

		searchPictoReduced.classList.add('active');
		searchBarReduced.classList.add('active');
		searchInputReduced.classList.add('active');
		closeSearchReduced.classList.add('active');
	}

	function hideSearchBar(){
		isSearchBarActived = false;

		for( let i = 0; i < allMenuButtons.length; i++ ) {
			allMenuButtons[i].classList.remove('hidden');
		}
		menuSeparator.classList.remove('hidden');

		searchPicto.classList.remove('active');
		searchBar.classList.remove('active');
		searchInput.classList.remove('active');
		closeSearch.classList.remove('active');

		radioButton.classList.remove('active');

		searchPictoReduced.classList.remove('active');
		searchBarReduced.classList.remove('active');
		searchInputReduced.classList.remove('active');
		closeSearchReduced.classList.remove('active');
	}

	// Show Menu Reduced

	menuReduced = document.getElementById("menu-reduced");

	var showMenuReduced = function() {
		var y = window.scrollY;
		if (y >= 800) {
			menuReduced.classList.add('show');
		} else {
			menuReduced.classList.remove('show');
		}
	};

	window.addEventListener("scroll", showMenuReduced);

	/// FOOTER

	// Mail Interaction

	var mailButton = document.getElementById('mail');
	var mail = 'mail';
	var telButton = document.getElementById('tel');
	var tel = 'tel';

	function copyInteraction(e, element) {
		//console.log(e)
		var textToCopy = e.innerHTML;
		var textElement = element;

		e.addEventListener('mouseover', showCopy);
		e.addEventListener('mouseout', hideCopy);
		e.addEventListener('click', copyText);

		function showCopy(){
			this.innerHTML = 'Copier le ' + textElement;
		}

		function hideCopy(){
			this.innerHTML = textToCopy;
		}

		function copyText() {
			copyToClipboard(textToCopy);
			this.innerHTML = textElement + ' copié !'
		}
	}

	copyInteraction(mailButton, mail);
	copyInteraction(telButton, tel);

	function copyToClipboard(string) {
		let textarea;
		let result;

		try {
		    textarea = document.createElement('textarea');
		    textarea.setAttribute('readonly', true);
		    textarea.setAttribute('contenteditable', true);
		    textarea.style.position = 'fixed'; // prevent scroll from jumping to the bottom when focus is set.
		    textarea.value = string;

		    document.body.appendChild(textarea);

		    textarea.focus();
		    textarea.select();

		    const range = document.createRange();
		    range.selectNodeContents(textarea);

		    const sel = window.getSelection();
		    sel.removeAllRanges();
		    sel.addRange(range);

		    textarea.setSelectionRange(0, textarea.value.length);
		    result = document.execCommand('copy');
		} catch (err) {
		    //console.error(err);
		    result = null;
		} finally {
		    document.body.removeChild(textarea);
		}

		  // manual copy fallback using prompt
		if (!result) {
		    const isMac = navigator.platform.toUpperCase().indexOf('MAC') >= 0;
		    const copyHotkey = isMac ? '⌘C' : 'CTRL+C';
		    result = prompt(`Press ${copyHotkey}`, string); // eslint-disable-line no-alert
		    if (!result) {
		      return false;
		    }
		}

		isClicked = false;

		return true;
	}

	// Social

	var facebookButton = document.getElementById('facebook-button');
	var facebookPicto = document.getElementById('facebook');

	var instagramButton = document.getElementById('instagram-button');
	var instagramPicto = document.getElementById('instagram');

	var youtubeButton = document.getElementById('youtube-button');
	var youtubePicto = document.getElementById('youtube');

	var mixcloudButton = document.getElementById('mixcloud-button');
	var mixcloudPicto = document.getElementById('mixcloud');

	function socialButtonHover(button, picto){
		button.addEventListener('mouseover', toggleHover)
		button.addEventListener('mouseout', toggleHover)
		function toggleHover(){
			picto.classList.toggle('hover');
		}
	}

	socialButtonHover(facebookButton, facebookPicto);
	socialButtonHover(instagramButton, instagramPicto);
	socialButtonHover(youtubeButton, youtubePicto);
	socialButtonHover(mixcloudButton, mixcloudPicto);

	// Bricks 

	var bricksHorizontal = document.getElementsByClassName('brick horizontal');
	var bricksVertical = document.getElementsByClassName('brick vertical');

	function rotateBrick(element){
		for( let i = 0; i < element.length; i ++){
			element[i].addEventListener('mouseover', function(){
				element[i].classList.toggle('hover');
			})
		}
	}
	
	rotateBrick(bricksHorizontal);
	rotateBrick(bricksVertical);

	// Newsletter Form

	var subscribeNewsletterForm = document.getElementById('subscribe-newsletter');
	var newsletterEmailInput = document.getElementById('newsletter-email');
	var subscribeNewsletterButton = document.getElementById('subscribe-button');

	var subscribeNewsletterError = document.getElementById('subscribe-error');
	var subscribeNewsletterConfirmation = document.getElementById('subscribe-confirmed');

	if (newsletterEmailInput != null) {
		newsletterEmailInput.addEventListener('keyup', function onEvent(e) {
		    if (e.keyCode === 13) {
		        subscribeNewsletterConfirm();
		    }
		});
	}

	if (subscribeNewsletterButton != null) {
		subscribeNewsletterButton.addEventListener('click', subscribeNewsletterConfirm);
	}

	function handleNewsletterSubscribe(submitEvent) {
		submitEvent.preventDefault();
		
		var targetForm = submitEvent.target

		var formData = new FormData(targetForm);

		fetch('http://lastation.paris/newsletter-subscribe', {
			method: 'POST',
			body: formData
		}).then(success => {
			//console.log(success);
		})
	}

	function subscribeNewsletterConfirm() {
		var emailValue = newsletterEmailInput.value;
		if (!validEmail(emailValue)){
			subscribeNewsletterError.style.display = 'block';
			return;
		}
		subscribeNewsletterError.style.display = 'none';
		newsletterEmailInput.style.display = 'none';
		subscribeNewsletterButton.style.display = 'none';
		subscribeNewsletterConfirmation.style.display = 'block';
		
		subscribeNewsletterForm.dispatchEvent(new Event('submit'));
	}

	if (subscribeNewsletterForm != null) {
		subscribeNewsletterForm.addEventListener('submit', handleNewsletterSubscribe);
	}

	function validEmail(email) {
	    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    return re.test(String(email).toLowerCase());
	}

	// Slideshow

	function slider() {
		let allSlideshows = document.querySelectorAll('.slideshow');

		for ( slideshow of allSlideshows ) {
			let sliderWrapper = slideshow.querySelector('.slider-wrapper');
			let leftSideOfSlider = slideshow.querySelector('.left');
			let rightSideOfSlider = slideshow.querySelector('.right');

			function handleLeft() {
				let previouslyActiveSlide = sliderWrapper.querySelector('.active')		
	 			let newActiveSlide;
	 			previouslyActiveSlide.classList.remove('active');
	 			if (previouslyActiveSlide.previousElementSibling == null) {
	 				newActiveSlide = sliderWrapper.lastElementChild;
	 			} else {
	 				newActiveSlide = previouslyActiveSlide.previousElementSibling;
	 			}
	 			newActiveSlide.classList.add('active');
	 			previouslyActiveSlide.style.display = 'none';
	 			newActiveSlide.style.display = 'block';
			}

			function handleRight() {
		 		let previouslyActiveSlide = sliderWrapper.querySelector('.active')		
	 			let newActiveSlide;
	 			previouslyActiveSlide.classList.remove('active');
	 			if (previouslyActiveSlide.nextElementSibling == null) {
	 				newActiveSlide = sliderWrapper.firstElementChild;
	 			} else {
	 				newActiveSlide = previouslyActiveSlide.nextElementSibling;
	 			}
	 			newActiveSlide.classList.add('active');
	 			previouslyActiveSlide.style.display = 'none';
	 			newActiveSlide.style.display = 'block';
		 	}

		 	leftSideOfSlider.addEventListener('click', handleLeft);
		 	leftSideOfSlider.addEventListener('swiped-right', handleLeft);

		 	rightSideOfSlider.addEventListener('click', handleRight);
		 	rightSideOfSlider.addEventListener('swiped-left', handleRight);

		};
	}

	slider();

	// Mobile

	var isMobile = window.matchMedia("(max-width: 767px)").matches

	var header = document.getElementById('header')
	var menu = document.getElementById('menu');

	if(isMobile) {

		// Menu 

		var buttonMenuMobile = document.getElementById('button-menu-mobile');
		var buttonCloseMenuMobile = document.getElementById('button-close-menu-mobile');
		buttonMenuMobile.addEventListener('click', toggleMobileMenu);
		buttonCloseMenuMobile.addEventListener('click', toggleMobileMenu);

		// Submenu

		var submenuMobileProgrammes = document.getElementsByClassName('submenu-mobile programmes');
		var submenuMobileInformations = document.getElementsByClassName('submenu-mobile informations'); 

		var isSubmenuMobileProgrammesShowed = false;
		var isSubmenuMobileInformationsShowed = false;

		buttonProgrammes.addEventListener('click', function(){
			for(let i = 0; i < submenuMobileProgrammes.length; i ++) {
				submenuMobileProgrammes[i].classList.toggle('show');
			}
			for(let i = 0; i < submenuMobileInformations.length; i ++) {
				submenuMobileInformations[i].classList.remove('show');
			}
		});

		buttonInformations.addEventListener('click', function(){
			for(let i = 0; i < submenuMobileInformations.length; i ++) {
				submenuMobileInformations[i].classList.toggle('show');
			}
			for(let i = 0; i < submenuMobileProgrammes.length; i ++) {
				submenuMobileProgrammes[i].classList.remove('show');
			}
		});

		var buttonSearchMobile = document.getElementById('button-search-mobile');
		var divSearchMobile = document.getElementById('open-mobile-search');
		var buttonCloseSearchMobile = document.getElementById('button-close-search-mobile');

		buttonSearchMobile.addEventListener('click', openMobileSearch);
		buttonCloseSearchMobile.addEventListener('click', closeMobileSearch);
		
	}

	function toggleMobileMenu(){
		header.classList.toggle('show-menu');
		menu.classList.toggle('show');
		logoType.classList.toggle('show-menu');
		buttonMenuMobile.classList.toggle('show-menu');
		buttonCloseMenuMobile.classList.toggle('show-menu');
	}

	function openMobileSearch(){
		divSearchMobile.classList.add('show-search');
		buttonCloseSearchMobile.classList.add('show-search');

		header.classList.remove('show-menu');
		menu.classList.remove('show');
		logoType.classList.remove('show-menu');
		buttonMenuMobile.classList.remove('show-menu');
		buttonCloseMenuMobile.classList.remove('show-menu');
	}

	function closeMobileSearch(){
		divSearchMobile.classList.remove('show-search');
		buttonCloseSearchMobile.classList.remove('show-search');
	}
}
