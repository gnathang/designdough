// animations //

// window.onbeforeunload = function () {
// 	window.scrollTo(0, 0);
// };

/* standard fade in - element */
function fadeInElement() {
	const fadeElements = document.querySelectorAll('.fade_in_element');
	fadeElements.forEach((element) => {
		const elementTop = element.getBoundingClientRect().top;
		const windowHeight = window.innerHeight;
		if (elementTop < windowHeight * 0.8) {
			element.classList.add('visible');
		}
	});
}
window.addEventListener('load', fadeInElement);
window.addEventListener('scroll', fadeInElement);

/* standard fade in - container */
function fadeInContainer() {
	const fadeContainer = document.querySelectorAll('.fade_in_container');
	fadeContainer.forEach((container) => {
		const elementTop = container.getBoundingClientRect().top;
		const windowHeight = window.innerHeight;
		if (elementTop < windowHeight * 0.9) {
			container.classList.add('visible');
		}
	});
}
window.addEventListener('load', fadeInContainer);
window.addEventListener('scroll', fadeInContainer);

// ani text/image editorial background fold animation
const aniImages = document.querySelectorAll('.ani_background_reveal');
const handleFoldBackground = (entries, observer) => {
	entries.forEach((entry) => {
		if (entry.isIntersecting) {
			const target = entry.target;
			anime({
				targets: target,
				height: '0%',
				duration: 500,
				easing: 'cubicBezier(.4, .05, .1, .3)',
			});
			observer.unobserve(target); // Stop observing once the element is animated
		}
	});
};

const observer = new IntersectionObserver(handleFoldBackground, {
	threshold: 0.8, // When 80% of the element is in view
});

aniImages.forEach((image) => {
	observer.observe(image); // Start observing each element
});

// line extending animation
function borderExtend() {
	const borders = document.querySelectorAll('.title_bar_border');
	borders.forEach((border) => {
		const elementTop = border.getBoundingClientRect().top;
		const windowHeight = window.innerHeight;

		if (elementTop < windowHeight * 0.7) {
			border.classList.add('extended');
		}
	});
}
window.addEventListener('load', borderExtend);
window.addEventListener('scroll', borderExtend);

// // Function to apply parallax scrolling to elements with the "parallax" class
// function applyParallax() {
// 	const parallaxElements = document.querySelectorAll('.parallax');
// 	const parallaxSlowElements = document.querySelectorAll('.parallax_slow');

// 	parallaxElements.forEach((element) => {
// 		element.style.transform = `translateY(-${
// 			window.scrollY * 0.2 // Speed for .parallax elements (adjust as needed)
// 		}px)`;
// 	});

// 	parallaxSlowElements.forEach((element) => {
// 		element.style.transform = `translateY(-${
// 			window.scrollY * 0.1 // Speed for .parallax_slow elements (adjust as needed)
// 		}px)`;
// 	});
// }

// // Observe the respective parallax elements
// const parallaxElements = document.querySelectorAll('.parallax');
// const parallaxSlowElements = document.querySelectorAll('.parallax_slow');

// parallaxElements.forEach((element) => {
// 	element.style.transform = 'translateY(0)';
// });

// parallaxSlowElements.forEach((element) => {
// 	element.style.transform = 'translateY(0)';
// });

// // Listen to the scroll event to trigger the parallax effect
// window.addEventListener('scroll', applyParallax);

//
// letterwave animation
//
function handleLetterWaveIntersection(entries, observer) {
	entries.forEach((entry) => {
		if (entry.isIntersecting) {
			// Wrap every character in a span while preserving spaces
			const textWrapper = document.querySelector('.ani_letterwave');
			const textContent = textWrapper.textContent;
			const charArray = textContent.split('').map((char) => {
				if (char === ' ') {
					return '<h1 class="letter">&nbsp;</h1>';
				} else {
					return `<h1 class="letter">${char}</h1>`;
				}
			});

			textWrapper.innerHTML = charArray.join('');

			// Element is in the viewport, start the character-based animation
			startLetterWaveAnimation();

			// Remove the observer to trigger the animation only once
			observer.unobserve(entry.target);
		}
	});
}

const letterWaveObserver = new IntersectionObserver(
	handleLetterWaveIntersection,
	{
		root: null,
		rootMargin: '0px',
		threshold: 0,
	}
);

const letterWaveAni = document.querySelector('.ani_letterwave');

if (letterWaveAni) {
	letterWaveObserver.observe(letterWaveAni);
}

function startLetterWaveAnimation() {
	anime.timeline().add({
		targets: '.ani_letterwave .letter',
		scale: [0, 1],
		duration: 1500,
		elasticity: 600,
		delay: (el, i) => 45 * (i + 1),
	});
}

//
// wordwave animation
//
function handleWordWaveIntersection(entries, observer) {
	entries.forEach((entry) => {
		if (entry.isIntersecting) {
			// Wrap every word in a span while preserving spaces
			const textWrapper = document.querySelector('.ani_wordwave');
			const words = textWrapper.textContent.split(' ');

			textWrapper.innerHTML = words
				.map((word) => {
					return `<span class="word">${word}</span>`;
				})
				.join('&nbsp');

			// Element is in the viewport, start the word-based animation
			startWordWaveAnimation();

			// Remove the observer to trigger the animation only once
			observer.unobserve(entry.target);
		}
	});
}

const wordWaveObserver = new IntersectionObserver(handleWordWaveIntersection, {
	root: null,
	rootMargin: '0px',
	threshold: 0,
});

const wordWaveAni = document.querySelector('.ani_wordwave');

if (wordWaveAni) {
	wordWaveObserver.observe(wordWaveAni);
}

function startWordWaveAnimation() {
	anime.timeline().add({
		targets: '.ani_wordwave .word',
		opacity: [0, 1],
		duration: 1500,
		easing: 'easeOutQuad',
		delay: (el, i) => 300 * i,
	});
}

//
// slide from bottom animation
//

function handleSlideAnimation(entries, observer) {
	entries.forEach((entry) => {
		if (entry.isIntersecting) {
			const textWrapper = document.querySelector('.ani_fade_up_letter');
			textWrapper.innerHTML = textWrapper.textContent.replace(/./g, (char) => {
				if (char === ' ') {
					return "<span class='letter'>&nbsp;</span>";
				} else {
					return `<span class='letter'>${char}</span>`;
				}
			});

			anime.timeline({ loop: false }).add({
				targets: '.ani_fade_up_letter .letter',
				translateY: [100, 0],
				translateZ: 0,
				opacity: [0, 1],
				easing: 'easeOutExpo',
				duration: 1400,
				delay: (el, i) => 300 + 30 * i,
			});

			// Stop observing after animation starts
			observer.unobserve(textWrapper);
		}
	});
}

const slideAnimationObserver = new IntersectionObserver(handleSlideAnimation, {
	root: null,
	rootMargin: '0px',
	threshold: 0,
});

const slideAni = document.querySelector('.ani_fade_up_letter');
if (slideAni) {
	slideAnimationObserver.observe(slideAni);
}

//
// fade up animation with fold
//
function handleFadeUpAnimation(entries, observer) {
	entries.forEach((entry) => {
		if (entry.isIntersecting) {
			const fadeUpWrappers = document.querySelectorAll('.ani_fade_up_fold');
			fadeUpWrappers.forEach((fadeUpWrapper) => {
				// Check if the current element is in the viewport
				if (entry.target === fadeUpWrapper) {
					const tagName = entry.target.tagName.toLowerCase();
					const words = fadeUpWrapper.textContent.trim().split(/\s+/);
					let html = '';

					// Wrap each word in an <h2> element
					for (let i = 0; i < words.length; i++) {
						if (words.length > 2) {
							if (i === words.length - 2) {
								// Select the second to last element inside 'words'
								if (words[words.length - 2].length < 9) {
									// Check if the last word has less than 9 characters
									// If it's the second to last word and the last word has more than 9 characters, add a line break
									html += `<span class="break_line">`;
								}
							}
						}
						// Add the current word inside <h2> element to the HTML string
						html += `<${tagName} class="word_wrap"><span class="word">${words[i]}&nbsp;</span></${tagName}>`;
					}

					// Set the HTML content with the wrapped words
					fadeUpWrapper.innerHTML = html;

					// Start animation
					anime.timeline({ loop: false }).add({
						targets: '.word_wrap .word',
						translateY: [100, 0],
						opacity: [0, 1],
						translateZ: 0,
						easing: 'easeOutExpo',
						duration: 700,
						delay: (el, i) => 300 + 30 * i,
					});

					// Stop observing after animation starts
					observer.unobserve(fadeUpWrapper);
					// adding this ensures that the element is hidden upon approach to it,
					// otherwise it kind of flashes at you before the animation starts.
					fadeUpWrapper.classList.add('reveal');
				}
			});
		}
	});
}

// todp: make this better
// OG intersection observer for the animation above -> revert to this!
const fadeUpAnimationObserver = new IntersectionObserver(
	handleFadeUpAnimation,
	{
		root: null,
		rootMargin: '0px',
		threshold: 0,
	}
);

const fadeUpAnis = document.querySelectorAll('.ani_fade_up_fold');

fadeUpAnis.forEach((fadeUpAni) => {
	fadeUpAnimationObserver.observe(fadeUpAni);
});

// new intersection observer
// const myObserver = new IntersectionObserver(callback, options);
// const options = {
// 	root: null,
// 	rootMargin: '0px',
// 	threshold: 0,
// };
// // trigger the animation
// const callback = (entries, observer) => {
// 	entries.forEach((entry) => {
// 	  if (entry.isIntersecting) {
// 		entry.target.classList.add("fadeIn")
// 	  }
// 	})
//   }
// // select elements to observe
// const fadeUpAnis = document.querySelectorAll('.ani_fade_up_fold');
// fadeUpAnis.forEach((fadeUpAni) => {
// 	myObserver.observe(fadeUpAni);
// });
// myObserver.observe('.fade_in_element');

////
////
// fade up (words) animation - used for the main page header animation, but has eben moved to the bottom
// this version used an intersectipon observer

// function handleFadeUpFoldAnimation(entries, observer) {
// 	entries.forEach((entry) => {
// 		if (entry.isIntersecting) {
// 			const fadeUpFoldWrapper = document.querySelector('.ani_fade_up');
// 			fadeUpFoldWrapper.innerHTML = fadeUpFoldWrapper.textContent
// 				.split(/\s+/)
// 				.map((word) => {
// 					return `<span class='word'>${word}&nbsp;</span>`;
// 				})
// 				.join('');
// 			anime.timeline({ loop: false }).add({
// 				targets: '.ani_fade_up .word',
// 				translateY: [250, 0],
// 				translateZ: 0,
// 				opacity: [0, 1],
// 				easing: 'easeOutExpo',
// 				duration: 2400,
// 				delay: (el, i) => 300 + 30 * i,
// 			});

// 			// Stop observing after animation starts
// 			observer.unobserve(fadeUpFoldWrapper);
// 		}
// 	});
// 	setTimeout(function () {
// 		fadeInHeader();
// 		fadeInPageHeader();
// 	}, 1700);
// }

// const fadeUpAniFoldObserver = new IntersectionObserver(
// 	handleFadeUpFoldAnimation,
// 	{
// 		root: null,
// 		rootMargin: '0px',
// 		threshold: 0,
// 	}
// );

// const fadeUpAniFold = document.querySelector('.ani_fade_up');

// if (fadeUpAniFold) {
// 	fadeUpAniFoldObserver.observe(fadeUpAniFold);
// }

//
//
// letterwave animation - svg
//
//
// function handleLetterWaveSvgIntersection(entries, observer) {
// 	entries.forEach((entry) => {
// 		if (entry.isIntersecting) {
// 			// Wrap every character in a span while preserving spaces
// 			anime.timeline().add({
// 				targets: '.logo_wrap img',
// 				scale: [0, 1],
// 				duration: 200,
// 				elasticity: 200,
// 				delay: (el, i) => 45 * (i + 1),
// 			});

// 			// Remove the observer to trigger the animation only once
// 			observer.unobserve(entry.target);
// 		}
// 	});
// }

// const letterWaveSvgObserver = new IntersectionObserver(
// 	handleLetterWaveSvgIntersection,
// 	{
// 		root: null,
// 		rootMargin: '0px',
// 		threshold: 0,
// 	}
// );

// const letterWaveAniSvg = document.querySelector('.logo_wrap img');

// if (letterWaveAniSvg) {
// 	letterWaveObserver.observe(letterWaveAniSvg);
// }

function runFadeUpFoldAnimation() {
	const fadeUpFoldWrapper = document.querySelector('.ani_fade_up');
	if (fadeUpFoldWrapper) {
		fadeUpFoldWrapper.innerHTML = fadeUpFoldWrapper.textContent
			.trim()
			.split(/\s+/)
			.map((word) => {
				return `<h1 class="word_wrap"><span class="word">${word}&nbsp;</span></h1>`;
			})
			.join('');
		anime.timeline({ loop: false }).add({
			targets: '.ani_fade_up .word',
			// this is to re-offset the webfont's offsetted text
			translateY: [250, 0],
			translateZ: 0,
			opacity: [0, 1],
			easing: 'easeOutExpo',
			duration: 2400,
			delay: (el, i) => 300 + 30 * i,
		});
		fadeUpFoldWrapper.classList.add('reveal');
		// Additional actions after animation starts
		setTimeout(function () {
			fadeInHeader();
			fadeInPageHeader();
		}, 1000);
	}
}

function fadeUpFoldTopLevel() {
	const fadeUpFoldWrappers = document.querySelectorAll(
		'.ani_fade_up_fold_top_level'
	);

	fadeUpFoldWrappers.forEach((fadeUpFoldWrapper) => {
		const tagName = fadeUpFoldWrapper.tagName.toLowerCase();
		const words = fadeUpFoldWrapper.textContent.trim().split(/\s+/);
		let html = '';

		// Wrap each word in an <h2> element
		for (let i = 0; i < words.length; i++) {
			if (i === words.length - 2 && words.length >= 3) {
				// If it's the second to last word, add a line break only if there are 3 words or above
				if (words[words.length - 1].length < 4) {
					// Check if the last word has less than 5 characters
					// If it's the second to last word and the last word has more than 5 characters, add a line break
					html += `<span class="break_line">`;
				}
			}
			html += `<${tagName} class="word_wrap"><span class="word">${words[i]}&nbsp;</span></${tagName}>`;
		}

		// Set the HTML content with the wrapped words
		fadeUpFoldWrapper.innerHTML = html;

		// Start animation
		anime.timeline({ loop: false }).add({
			targets: '.ani_fade_up_fold_top_level .word',
			translateY: [250, 0],
			translateZ: 0,
			opacity: [0, 1],
			easing: 'easeOutExpo',
			duration: 2400,
			delay: (el, i) => 300 + 30 * i,
		});
		fadeUpFoldWrapper.classList.add('reveal');

		// Additional actions after animation starts
		setTimeout(function () {
			fadeInHeader();
			fadeInPageHeader();
		}, 1700);
	});
}

window.addEventListener('load', fadeUpFoldTopLevel);

// OG loading screen animation
// document.addEventListener('DOMContentLoaded', function () {
// 	// Add the "loading" class to trigger the animation
// 	document.querySelector('.loader_wrapper').classList.add('loading');

// 	// Simulate loading for 3 seconds (adjust as needed)
// 	setTimeout(function () {
// 		// Remove the "loading" class to trigger the fade-out animation
// 		document.querySelector('.loader_wrapper').classList.remove('loading');

// 		// Set a delay before revealing the homepage content
// 		setTimeout(function () {
// 			// Add the "loaded" class to trigger the final fade-out animation
// 			document.querySelector('.loader_wrapper').classList.add('loaded');

// 			// Remove the loader-wrapper after it has faded out
// 			setTimeout(function () {
// 				document.querySelector('.loader_wrapper').remove();
// 			}, 1000); // Adjust as needed
// 		}, 1000); // Adjust as needed
// 	}, 3000); // Simulated loading time (adjust as needed)
// });

const logoWave = () => {
	const animation = anime.timeline().add({
		targets: '.logo_wrap img',
		translateY: [100, 0],
		opacity: [0, 1],
		easing: 'easeInOutElastic',
		duration: 200,
		delay: (el, i) => 20 * (i + 1),
	});
};

const logoFold = () => {
	const logoAni = anime.timeline().add({
		targets: '.logo_wrap img',
		translateY: [200, 0], // Start from above the screen and move down
		opacity: [0, 1], // Start with opacity 0
		duration: 200, // Fixed duration for smooth animation
		easing: 'easeInOutElastic',
	});
};

const pageHeaderLogoFold = () => {
	const pageHeaderLogo = document.querySelector('.heading_logo_wrap');
	if (pageHeaderLogo) {
		const logoAni = anime.timeline().add({
			targets: '.heading_logo_wrap img',
			translateY: [200, 0], // Start from above the screen and move down
			opacity: [0, 1], // Start with opacity 0
			duration: 2000, // Fixed duration for smooth animation
			easing: 'easeInOutElastic',
		});

		pageHeaderLogo.classList.add('reveal');
	}
	setTimeout(function () {
		fadeInHeader();
		fadeInPageHeader();
	}, 3000);
};

window.addEventListener('load', pageHeaderLogoFold);

// ------------- //
// SPLASH SCREEN //
// ------------- //

const splashScreenStatus = localStorage.getItem('splashScreen');
const homepageTitleWrap = document.querySelector('.homepage_title');
// new loading screen animation
document.addEventListener('DOMContentLoaded', function () {
	// check if there the splash screen is diabled (we want it to only show on first visit)
	if (splashScreenStatus === 'disabled') {
		// add regular header class to homepage's page header
		if (homepageTitleWrap) {
			homepageTitleWrap.classList.add('ani_fade_up_fold_top_level');
		}
		if (document.querySelector('.loader_wrapper')) {
			document.querySelector('.loader_wrapper').classList.add('index');
		}
		// add the loaded class so that we don't see the splash screen's blank space
		if (document.querySelector('.loader_wrapper')) {
			document.querySelector('.loader_wrapper').classList.add('loaded');
		}
	} else {
		homepageTitleWrap.classList.add('ani_fade_up');
		logoFold();
		document.getElementsByTagName('body')[0].classList.add('remove_scroll');
		setTimeout(function () {
			setTimeout(function () {
				// Add the "loaded" class to trigger the final fade-out animation
				if (document.querySelector('.loader_wrapper')) {
					document.querySelector('.loader_wrapper').classList.add('loaded');
				}
				// manually run the landing page title animation after the splash screen clears
				runFadeUpFoldAnimation();
				if (document.querySelector('.loader_wrapper')) {
					document.querySelector('.loader_wrapper').classList.add('index');
				}
				// Remove the loader-wrapper after it has faded out
			}, 1000); // Adjust as needed
		}, 1000); // Simulated loading time (adjust as needed)
		localStorage.setItem('splashScreen', 'disabled');
	}
});

// fade header from top
function fadeInHeader() {
	const header = document.querySelector('header');
	header.classList.add('visible');
	// take the body's scroll lock off
	document.getElementsByTagName('body')[0].classList.remove('remove_scroll');
	const cookieIcon = document.querySelector('.cky-btn-revisit-wrapper');
	cookieIcon.classList.add('visible');
}

function fadeInPageHeader() {
	// Select the first <section> element on the page
	const firstSection = document.querySelector('section');
	const cookieBar = document.querySelector('.cky-consent-container');

	cookieBar.classList.add('landing_page_header_fade');
	// Check if a <section> element was found
	if (firstSection) {
		// Add the class to the first <section> element
		firstSection.classList.add('landing_page_header_fade');
	}

	const fadeTopElements = document.querySelectorAll(
		'.landing_page_header_fade'
	);
	fadeTopElements.forEach((element) => {
		element.classList.add('visible');
	});
}

// spinning wheels
const rotatingSvg = document.querySelectorAll('#brandlabs_wheel');

let rotation = 0;
let rotationIncrement = 0.7; // Adjust this value for slower or faster rotation

window.addEventListener('scroll', (event) => {
	// Increase or decrease rotation based on scroll direction
	rotation += event.deltaY > 0 ? rotationIncrement : -rotationIncrement;

	rotatingSvg.forEach((spinning_wheel) => {
		// Apply the rotation using anime.js
		anime({
			targets: spinning_wheel,
			rotate: rotation,
			easing: 'linear',
			duration: 100,
		});
	});
});

// var wheels = document.querySelectorAll('#brandlabs_wheel');
// window.addEventListener('scroll', function () {
// 	var value = window.scrollY * 0.25;
// 	wheels.forEach((wheel, index) => {
// 		wheel.style.transform = `translateX(-50%) translateY(-50%) rotate(${value}deg)`;
// 		wheel.style.transition = `transform 0.6s ease ${0.1 * index}s`; // Adjust the delay
// 	});
// });

// project page header load animation

const projectPageHeaderAni = () => {
	// var roundLogEl = document.querySelector('.section_project_page_header');
	const projectHeaderImage = document.querySelector(
		'.section_project_page_header'
	);

	if (projectHeaderImage) {
		anime({
			targets: projectHeaderImage,
			opacity: [0, 1],
			easing: 'linear',
			duration: 500,
		});
		setTimeout(function () {
			fadeInHeader();
			fadeInPageHeader();
		}, 700);
		// projectHeaderImage.classList.add('reveal');
	}
};

document.addEventListener('DOMContentLoaded', function () {
	projectPageHeaderAni();
});

// make the icons pink in the process timeline
const timelineIcons = document.querySelectorAll('.stage_icon_second');
const timelineColumns = document.querySelectorAll('.timeline_stage');

function handleIconScroll() {
	timelineColumns.forEach((column) => {
		if (column.classList.contains('stick_at_center')) {
			timelineIcons.forEach((icon) => {
				const iconPosition = icon.getBoundingClientRect().top;

				// add the class 100px from the top of the screen
				if (iconPosition <= 200) {
					icon.classList.add('visible');
				} else {
					icon.classList.remove('visible');
				}
			});
		} else {
			timelineIcons.forEach((icon) => {
				const iconPosition = icon.getBoundingClientRect().top;

				// add the class 100px from the top of the screen
				if (iconPosition <= 100) {
					icon.classList.add('visible');
				} else {
					icon.classList.remove('visible');
				}
			});
		}
	});
}

// Attach the event listener to the scroll event
window.addEventListener('scroll', handleIconScroll);

// Call handleIconScroll initially to set the initial state
handleIconScroll();
