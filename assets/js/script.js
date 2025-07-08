/**
 * Main JS
 *
 * @summary   The Main JS for WP Theme, refer to
 *            the webpack config for other files
 */

// reCaptcha tokens & metrics
function onClick(e) {
	e.preventDefault();
	grecaptcha.enterprise.ready(async () => {
		const token = await grecaptcha.enterprise.execute(
			'6LciNbspAAAAAICTzVXvGjkLEKp7pcEUj4RG2444',
			{ action: 'LOGIN' }
		);
	});
}

$(document).on('ready', function () {
	$('.vertical-center-4').slick({
		dots: true,
		vertical: true,
		centerMode: true,
		slidesToShow: 4,
		slidesToScroll: 2,
	});
	$('.vertical-center-3').slick({
		dots: true,
		vertical: true,
		centerMode: true,
		slidesToShow: 3,
		slidesToScroll: 3,
	});
	$('.vertical-center-2').slick({
		dots: true,
		vertical: true,
		centerMode: true,
		slidesToShow: 2,
		slidesToScroll: 2,
	});
	$('.vertical-center').slick({
		dots: true,
		vertical: true,
		centerMode: true,
		arrows: false,
		//    loop: true,
		//    infinite: true,
		dots: true,
		//    autoplay: true,
		//    autoplaySpeed: 3500,
		dotsClass: 'custom_paging',
		customPaging: function (slider, i) {
			console.log(slider);
			return i + 1 + '/' + slider.slideCount;
		},
	});
	$('.vertical').slick({
		dots: true,
		vertical: true,
		slidesToShow: 3,
		slidesToScroll: 3,
	});
	$('.regular').slick({
		dots: false,
		infinite: true,
		arrows: false,
		slidesToShow: 3,
		slidesToScroll: 1,
		responsive: [
			{
				breakpoint: 1200,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 1,
				},
			},
			{
				breakpoint: 1008,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
				},
			},
			{
				breakpoint: 800,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
				},
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
				},
			},
		],
	});
	$('.center').slick({
		dots: true,
		infinite: true,
		centerMode: true,
		slidesToShow: 5,
		slidesToScroll: 3,
	});
	$('.variable').slick({
		dots: true,
		infinite: true,
		variableWidth: true,
	});
	$('.lazy').slick({
		lazyLoad: 'ondemand', // ondemand progressive anticipated
		infinite: true,
		arrows: true,
		dots: true,
	});
	$('.continuous').slick({
		speed: 4000,
		autoplay: true,
		autoplaySpeed: 0,
		cssEase: 'linear',
		slidesToShow: 1,
		slidesToScroll: 1,
		variableWidth: true,
		arrows: false,
	});
});

// scroll to top on load
const scrollToTop = () => {
	const checkboxes = document.querySelectorAll('.category_checkbox');

	// if the filter is being used on an archive page, scroll to the top of the posts
	// if not, just scroll right to the top of the page.
	if (Array.from(checkboxes).some((checkbox) => checkbox.checked)) {
		scrollToTopOfPosts();
	} else {
		setTimeout(() => {
			window.scrollTo(0, 0);
		}, 100);
	}
};
window.addEventListener('load', scrollToTop);

// remove first rows fade on the big images.
// this ir s
const removeRowOneFades = () => {
	const rowOnes = document.querySelectorAll('.big_image .image.row-1');
	rowOnes.forEach((rowOne) => {
		rowOne.classList.remove('fade_in_element', 'fade-delay-1');
	});
};
// only run this function when not on wrok inner pages
window.addEventListener('load', function () {
	if (!window.location.href.includes('/our-work/')) {
		removeRowOneFades();
	}
});

// old scripts
$(document).ready(function () {
	$('.one-time').slick({
		dots: true,
		infinite: true,
		speed: 300,
		slidesToShow: 1,
		adaptiveHeight: true,
	});

	function fadeBottom() {
		const fadeElements = document.querySelectorAll('.post_wrapper_bottom');

		fadeElements.forEach((element) => {
			const elementTop = element.getBoundingClientRect().top;
			const windowHeight = window.innerHeight;

			if (elementTop < windowHeight * 0.7) {
				element.classList.add('fade_bottom');
			}
		});
	}

	// Call the inViewport function when the page loads and when scrolling
	window.addEventListener('load', fadeBottom);
	window.addEventListener('scroll', fadeBottom);

	function fadeTop() {
		const fadeElements = document.querySelectorAll('.post_wrapper_top');

		fadeElements.forEach((element) => {
			const elementTop = element.getBoundingClientRect().top;
			const windowHeight = window.innerHeight;

			if (elementTop < windowHeight * 0.7) {
				element.classList.add('fade_top');
			}
		});
	}
	// Call the inViewport function when the page loads and when scrolling
	window.addEventListener('load', fadeTop);
	window.addEventListener('scroll', fadeTop);

	// toodo: remove this?
	$('a[href*="#"]:not([href="#"])').click(function () {
		var target = $(this.hash);
		$('html,body')
			.stop()
			.animate(
				{
					scrollTop: target.offset().top - 120,
				},
				'linear'
			);
	});
	if (location.hash) {
		var id = $(location.hash);
	}
	// $(window).on('load', function () {
	// 	if (location.hash) {
	// 		$('html,body').animate({ scrollTop: id.offset().top - 120 }, 'linear');
	// 	}
	// });

	$('#play-button').click(function () {
		$('.video-container').addClass('active');
		$('#play-button').hide();
		$('#pause-button').show();
	});

	$('#pause-button').click(function () {
		$('.video-container').removeClass('active');
		$('#pause-button').hide();
		$('#play-button').show();
	});

	function waitForElement(id, callback) {
		var poops = setInterval(function () {
			if (document.getElementById(id)) {
				clearInterval(poops);
				callback();
			}
		}, 100);
	}

	waitForElement('projectplayer', function () {
		var iframe = document.getElementById('projectplayer');

		// $f == Froogaloop
		var player = $f(iframe);

		// bind events
		var playButton = document.getElementById('play-button');
		if (playButton) {
			playButton.addEventListener('click', function () {
				player.api('play');
			});
		}
		var pauseButton = document.getElementById('pause-button');
		if (pauseButton) {
			pauseButton.addEventListener('click', function () {
				player.api('pause');
			});
		}
	});

	$(window).scroll(function () {
		var scrollTop = 200;
		if ($(window).scrollTop() >= scrollTop) {
			$('.top_arrow').addClass('fadein');
		}
		if ($(window).scrollTop() < scrollTop) {
			$('.top_arrow ').removeClass('fadein');
		}
	});

	$(window).scroll(function () {
		var scrollTop = 300;
		if ($(window).scrollTop() >= scrollTop) {
			$('.main_nav').addClass('scroll');
		}
		if ($(window).scrollTop() < scrollTop) {
			$('.main_nav').removeClass('scroll');
		}
	});
});

//
// light/dark mode
//

const pageArchiveFilter = document.querySelector('.page_archive_filter');
let isPastPageArchiveFilter = false;

// Function to check if the user has scrolled past the page_archive_filter section
if (pageArchiveFilter && pageArchiveFilter.classList.contains('archive_work')) {
	function checkScroll() {
		const body = document.body;
		isPastPageArchiveFilter =
			window.scrollY >
			pageArchiveFilter.offsetTop + pageArchiveFilter.offsetHeight / 1.1;
		body.dataset.theme = isPastPageArchiveFilter ? 'light' : 'dark';
	}
	// Attach the scroll event listener
	window.addEventListener('scroll', checkScroll);

	// Initial check on page load
	checkScroll();
}

//
// open submenus within modal nav
//

document.querySelectorAll('.li_level_one').forEach((button) => {
	button.addEventListener('click', () => {
		// First, hide all submenus
		document.querySelectorAll('.dropdown_area_modal').forEach((item) => {
			item.classList.remove('active');
		});

		// Then, find and open the submenu for the clicked top-level item
		const submenu = button.querySelector('.dropdown_area_modal');
		// const icon = button.querySelector('.p_level_one');
		if (submenu) {
			submenu.classList.add('active');
			// icon.classList.toggle('active');
		}
	});
});
//
// accordion // todo: make this smoother!
//
const accordions = document.getElementsByClassName('accord_wrap');
for (let i = 0; i < accordions.length; i++) {
	accordions[i].addEventListener('click', function () {
		this.classList.toggle('active');
		// Find the accordion_down_arrow within the clicked accord_wrap
		this.querySelector('.accordion_down_arrow').classList.toggle('active');

		// Close all other acc heads and arrows
		for (let j = 0; j < accordions.length; j++) {
			if (i !== j) {
				accordions[j].classList.remove('active');
				const otherArrow = accordions[j].querySelector('.accordion_down_arrow');
				if (otherArrow) {
					otherArrow.classList.remove('active');
				}
			}
		}
	});
}

//
// team modals
//

const openTeamModals = document.querySelectorAll('.team_member_overlay');
const teamModals = document.querySelectorAll('.team_member_modal');

// todo: make into a toggle - sams class name for open and close modal?
openTeamModals.forEach(function (modal, index) {
	modal.addEventListener('click', function () {
		teamModals[index].classList.add('active');
		$('body').addClass('remove_scroll');
	});
});

$('.member_modal_close').click(function () {
	$('.team_member_modal').removeClass('active');
	$('body').removeClass('remove_scroll');
});

//
// text & grid modals
//

const modalOpens = document.querySelectorAll('.open_grid_modal');
const modalCloses = document.querySelectorAll('.modal_close');
const gridModals = document.querySelectorAll('.grid_modal');
const body = document.querySelector('body');
// if using content cards
const stickyHeader = document.querySelectorAll('.sticky_header');

modalOpens.forEach((modal, index) => {
	modal.addEventListener('click', () => {
		gridModals[index].classList.add('active');
		body.classList.toggle('remove_scroll');
		document.body.classList.add('remove_scroll');
		stickyHeader.forEach((header) => {
			header.classList.add('remove_sticky');
		});
	});
});
modalCloses.forEach((modalClose) => {
	modalClose.addEventListener('click', () => {
		const gridModal = modalClose.closest('.grid_modal');
		gridModal.classList.remove('active');
		body.classList.remove('remove_scroll');
		document.body.classList.remove('remove_scroll');
		stickyHeader.forEach((header) => {
			header.classList.remove('remove_sticky');
		});
	});
});

//
// menu open & close
//

const hamburgerWrap = document.querySelectorAll('.hamburger_wrap');
const hamburgerIcon = document.querySelector('.hamburger');
const modalNav = document.querySelector('.modal_nav');
const sections = document.querySelectorAll('section');
const menuIconWrap = document.querySelector('.menu_icon_wrap');
const bulletinBar = document.querySelector('.bulletin_bar');
const footer = document.querySelector('footer');

hamburgerWrap.forEach((wrap) => {
	wrap.addEventListener('click', () => {
		wrap.classList.toggle('is-active');
		hamburgerIcon.classList.toggle('is-active');
		modalNav.classList.toggle('active');
		menuIconWrap.classList.toggle('active');
		sections.forEach((section) => {
			section.classList.toggle('blur');
		});
		footer.classList.toggle('blur');
		body.classList.toggle('remove_scroll');
		if (bulletinBar) {
			bulletinBar.classList.toggle('blur');
		}
	});
});

document.querySelector('.main').addEventListener('click', () => {
	hamburgerWrap.forEach((wrap) => {
		wrap.classList.remove('is-active');
	});
	hamburgerIcon.classList.remove('is-active');
	modalNav.classList.remove('active');
	menuIconWrap.classList.remove('active');
	sections.forEach((section) => {
		section.classList.remove('blur');
	});
	footer.classList.remove('blur');
	body.classList.remove('remove_scroll');
	if (bulletinBar) {
		bulletinBar.classList.remove('blur');
	}
});

//
// splide carousels
//

document.addEventListener('DOMContentLoaded', function () {
	// Select all elements with the class 'testimonials_carousel'
	if (document.querySelector('#bulletin_scroll')) {
		new Splide('#bulletin_scroll', {
			focus: 0,
			// omitEnd: true,
			easing: 'linear',
			type: 'loop',
			autoplay: true,
			autoWidth: true,
			arrows: false,
			pagination: false,
			interval: 9999999999,
			speed: 3000,
			// padding: 10,
		}).mount(window.splide.Extensions);
	}

	// testimonials carousel

	const vwToPx = (vw) => {
		const screenWidth = window.innerWidth;
		return (vw * screenWidth) / 100;
	};

	const fixedWidth = vwToPx(75);

	// Select all elements with the class 'testimonials_carousel'
	const testimonialCarousels = document.querySelectorAll(
		'#testimonials_carousel'
	);
	if (testimonialCarousels) {
		testimonialCarousels.forEach(function (testCarousel) {
			new Splide(testCarousel, {
				type: 'loop',
				arrows: false,
				perPage: 4,
				perMove: 1,
				gap: 20,
				pagination: false,
				breakpoints: {
					640: {
						perPage: 1,
						fixedWidth: fixedWidth,
						gap: 10,
						padding: '20%',
					},
				},
			}).mount();
		});
	}

	// Splide('#testimonials_carousel').on('moved', function () {
	// 	console.log('moved');
	// });

	// team carousel
	const teamCarousels = document.querySelectorAll('#team_carousel');
	if (teamCarousels) {
		teamCarousels.forEach(function (carousel) {
			new Splide(carousel, {
				type: 'loop',
				arrows: false,
				perPage: 3,
				gap: 30,
				padding: '10%',
				pagination: false,
				breakpoints: {
					850: {
						perPage: 2,
						padding: '10%',
						gap: 10,
					},
					640: {
						perPage: 1,
						padding: '10%',
						gap: 10,
					},
				},
			}).mount();
		});
	}

	// filter_carousel
	const filterCarousels = document.querySelectorAll('#filter_carousel');
	if (filterCarousels) {
		filterCarousels.forEach((carousel) => {
			new Splide('#filter_carousel', {
				arrows: false,
				perMove: 1,
				autoWidth: true,
				drag: true,
				snap: true,
				gap: 5,
				pagination: false,
				breakpoints: {
					1200: {
						perPage: 3,
						arrows: true,
					},
					756: {
						perPage: 3,
					},
				},
			}).mount();
		});
	}

	// images carousel -> 3 slides
	const threeSlideCarousels = document.querySelectorAll(
		'#images_carousel_3_slides'
	);

	if (threeSlideCarousels) {
		threeSlideCarousels.forEach((carousel) => {
			new Splide(carousel, {
				type: 'loop',
				arrows: false,
				perPage: 3,
				variableWidth: true,
				gap: 30,
				padding: '10%',
				pagination: false,
				breakpoints: {
					640: {
						perPage: 1,
						padding: '10%',
					},
				},
			}).mount();
		});
	}

	// images carousel -> 1 slide + padding
	const oneSlideCarousels = document.querySelectorAll(
		'#images_carousel_1_slide'
	);
	if (oneSlideCarousels) {
		oneSlideCarousels.forEach((carousel) => {
			new Splide(carousel, {
				type: 'loop',
				autoplay: false,
				arrows: false,
				pagination: false,
				perPage: 1,
				// gap and padding need to be multiples of eachother
				// divisable by 4 in this case.
				gap: '1.5625vw',
				padding: '15%',
			}).mount();
		});
	}
}); // end DOMContentLoaded

//
// cursor
//
const main = document.querySelector('.main');
// Select all cursor elements
const cursor = document.querySelector('.cursor');
const cursorWrap = document.querySelector('.cursor_wrapper');

const handleScroll = () => {
	// Get the current scroll position
	const scrollY = window.scrollY;
	const scrollX = window.scrollX;

	// Update the cursor position considering the scroll position
	cursor.style.transform = `translate3d(${scrollX}px, ${scrollY}px, 0)`;
};

const handleAnchorEnter = () => {
	cursor.classList.add('hover_anchor');
};

// Function to remove class when cursor leaves an anchor tag
const handleAnchorLeave = () => {
	cursor.classList.remove('hover_anchor');
};

// Function to add class when cursor enters a .grid_cell element
const handleGridCellEnter = () => {
	cursor.classList.add('hover_project');
};

// Function to remove class when cursor leaves a .grid_cell element
const handleGridCellLeave = () => {
	cursor.classList.remove('hover_project');
};

// Function to add class when cursor enters a .grid_cell element
const handleFooterMenuEnter = () => {
	cursor.classList.add('hover_white');
};

// Function to remove class when cursor leaves a .grid_cell element
const handleFooterMenuLeave = () => {
	cursor.classList.remove('hover_white');
};

// cursor for carousels

function handleSlideEnter(event) {
	const x = event.clientX;
	const screenWidth = window.innerWidth;
	const isOnRightSide = x >= screenWidth / 2;

	if (isOnRightSide) {
		handleSlideRightEnter();
	} else {
		handleSlideLeftEnter();
	}
}

const handleSlideRightEnter = () => {
	cursor.classList.add('hover_slide_right');
};

const handleSlideLeftEnter = () => {
	cursor.classList.add('hover_slide_left');
};

function handleSlideLeave() {
	cursor.classList.remove('hover_slide_left');
	cursor.classList.remove('hover_slide_right');
}

// cursor event listeners
document.addEventListener('DOMContentLoaded', function () {
	// Your code here
	const slideWraps = document.querySelectorAll(
		'.testimonials_splide_list, #images_carousel_1_slide, #images_carousel_1_slide_2, #images_carousel_3_slides, #images_carousel_3_slides_2, #team_carousel'
	);

	if (slideWraps.length > 0) {
		slideWraps.forEach((slideWrap) => {
			const slideAnchors = slideWrap.querySelectorAll('.btn_simple');

			slideWrap.addEventListener('mouseenter', handleSlideEnter);
			slideWrap.addEventListener('mouseleave', handleSlideLeave);

			slideAnchors.forEach((anchor) => {
				anchor.addEventListener('mouseenter', handleSlideLeave);
				anchor.addEventListener('mouseleave', handleSlideEnter);
				anchor.addEventListener('mouseenter', handleAnchorEnter);
				anchor.addEventListener('mouseleave', handleAnchorLeave);
			});
		});
	}
});

function initialiseCursors() {
	modalNav.addEventListener('mouseenter', handleFooterMenuEnter);
	modalNav.addEventListener('mouseleave', handleFooterMenuLeave);

	footer.addEventListener('mouseenter', handleFooterMenuEnter);
	footer.addEventListener('mouseleave', handleFooterMenuLeave);

	const anchorTags = document.querySelectorAll(
		'.cky-btn-revisit-wrapper, .category_label, .bulletin_title, .toggle_icon_wrap, a, .btn_simple, .handle'
	);
	anchorTags.forEach((anchor) => {
		anchor.addEventListener('mouseenter', handleAnchorEnter);
		anchor.addEventListener('mouseleave', handleAnchorLeave);
	});

	hamburgerWrap.forEach((wrap) => {
		wrap.addEventListener('mouseenter', handleAnchorEnter);
		wrap.addEventListener('mouseleave', handleAnchorLeave);
	});

	const projectGridCells = document.querySelectorAll('.overlay_image_wrapper');
	projectGridCells.forEach((gridCell) => {
		gridCell.addEventListener('mouseenter', handleGridCellEnter);
		gridCell.addEventListener('mouseleave', handleGridCellLeave);
	});

	const accordWraps = document.querySelectorAll('.accord_wrap');
	if (accordWraps) {
		accordWraps.forEach((wrap) => {
			wrap.addEventListener('mouseenter', handleAnchorEnter);
			wrap.addEventListener('mouseleave', handleAnchorLeave);
		});
	}
}
document.addEventListener('DOMContentLoaded', function () {
	initialiseCursors();
});

//
// old cusor
//
$(document).on('mousemove', function (e) {
	$('.cursor').css({
		left: e.clientX,
		top: e.clientY,
	});
});

$(window).on('scroll', function (e) {});

//
// page transitions
//

// init swup
// const swup = new Swup();

document.addEventListener('DOMContentLoaded', function () {
	const swiper = document.querySelector('.transition-swipe');
	swiper.classList.add('on_load');
	setTimeout(() => {
		swiper.classList.add('hide');
		setTimeout(() => {
			swiper.classList.add('reset');
		}, 200);
	}, 2000);
});

// Handle filter click
const filterButtons = document.querySelectorAll('.category_label');
const htmlElement = document.documentElement;

const layoutGridBtn = document.getElementById('layout_grid_button');
const layoutRowsBtn = document.getElementById('layout_rows_button');

// run the animation when clicking the filters
// filterButtons.forEach((filterButton) => {
// 	filterButton.addEventListener('click', function (event) {
// 		// trigger the swup swipe animation
// 		htmlElement.classList.add('is-animating');
// 		swup.loadPage();
// 	});
// });

// run the animation when refreshing the page
window.addEventListener('beforeunload', function (event) {
	// Perform actions before the page is unloaded (e.g., save data, cleanup, etc.)
	// Call your function here
	htmlElement.classList.add('is-animating');
});

function checkURLAndCheckbox() {
	const url = window.location.href;
	// Check if the URL contains "/our-work/" or "/blog/"
	if (url.includes('/our-work') || url.includes('/blog/')) {
		// Check if any checkbox with class '.category_checkbox' is checked
		const checkboxes = document.querySelectorAll('.category_checkbox');

		if (Array.from(checkboxes).some((checkbox) => checkbox.checked)) {
			// Both conditions are met, call your function
			scrollToTopOfPosts();
		}
	}
}

// scroll to the top of posts_layout_wrapper
function scrollToTopOfPosts() {
	const postsLayoutWrapper = document.querySelector('.posts_layout_wrapper');
	const rect = postsLayoutWrapper.getBoundingClientRect();

	// Scroll to the top of posts_layout_wrapper
	window.scrollTo({
		top: window.scrollY + rect.top - 25,
		behavior: 'smooth', // Add smooth scrolling if you prefer
	});
}

// remove the active class on the modal nav element when a new page is nagivated to
const menuAnchorTags = document.querySelectorAll('a');
menuAnchorTags.forEach((link) => {
	link.addEventListener('click', () => {
		setTimeout(() => {
			modalNav.classList.remove('active');
		}, 2000);
	});
});

//
//  symbiotic behaviour for cookies and bulletin bar
//
const cookieConsentBox = document.querySelector('.cky-consent-container');

document.addEventListener('DOMContentLoaded', function () {
	// Assuming you have two elements with IDs "element1" and "element2"
	const ckyButtons = document.querySelectorAll('.cky-btn');
	const bulletinBar = document.querySelector('.bulletin_bar');
	// const ckyContainer = document.querySelector('.cky-consent-container');

	if (
		document
			.querySelector('.cky-consent-container')
			.classList.contains('cky-hide')
	) {
		// If the class is present, call the function to add a class to element2
		bulletinBar.classList.add('full_width');
	}
	// Event listener to detect when a specific class is added to element1
	ckyButtons.forEach((ckyButton) => {
		ckyButton.addEventListener('click', function () {
			if (
				document
					.querySelector('.cky-consent-container')
					.classList.contains('cky-hide')
			) {
				// If the class is present, call the function to add a class to element2
				bulletinBar.classList.add('full_width');
			}
		});
	});
});

//
// AJAX filter - not being used at present (todo:)
//

// $('.category_checkbox').on('click', function () {
// 	var datastring = $('#search_filter_form').serialize();
// 	// Get the chosen post type from data attribute
// 	var chosen_post_type = $('.posts_layout_wrapper').data('post-type-select');

// 	console.log(datastring);
// 	$('.category_checkbox').removeClass('active');

// 	$(this).addClass('active');

// 	// var catValue = $(this).val();
// 	$.ajax({
// 		type: 'POST',
// 		url: '/wp-admin/admin-ajax.php',
// 		dataType: 'html',
// 		data: {
// 			action: 'filter_projects',
// 			category: datastring,
// 			post_type: chosen_post_type, // Pass the chosen post type
// 			// category: catValue
// 		},
// 		success: function (res) {
// 			$('.posts_layout_wrapper').html(res);
// 		},
// 	});
// 	var chosenCategory = 'searchcategory=';
// 	if (datastring.includes(chosenCategory)) {
// 		console.log('Search Category');
// 	} else {
// 		console.log('Search Hidden');
// 	}
// });

// var selectedCategories = [];

// $('.category_checkbox:checked').each(function() {
//     selectedCategories.push($(this).val());
// });

// $.ajax({
//     type: 'POST',
//     url: '/wp-admin/admin-ajax.php',
//     dataType: 'html',
//     data: {
//         action: 'filter_projects',
//         category: selectedCategories, // Send the array of selected category slugs
//     },
//     success: function(res) {
//         $('.posts_layout_wrapper').html(res);
//     }
// });

//
// portfolio image autoslider
//
function initSlideShows() {
	const isDesktop = window.innerWidth >= 1024; // Adjust the threshold as needed
	const cellWindows = document.querySelectorAll('.grid_cell');
	// only using this on desktop view.
	if (isDesktop) {
		if (cellWindows) {
			cellWindows.forEach((gridCell) => {
				let isMouseInside = false;
				const slideshow = gridCell.querySelector('.slideshow');
				const images = slideshow.querySelectorAll('.portfolio_image_wrap');
				let currentIndex = 0;
				let timer;

				const showCurrentImage = () => {
					images.forEach((image) => image.classList.remove('show'));
					images[currentIndex].classList.add('show');
				};

				const showNextImage = () => {
					currentIndex = (currentIndex + 1) % images.length;
					showCurrentImage();
				};

				//  control slides with mouse enters
				gridCell.addEventListener('mouseenter', () => {
					console.log('mouse is entered grid cell');
					isMouseInside = true;
					showCurrentImage();
					function startSlideshow() {
						timer = setInterval(() => {
							if (isMouseInside) {
								showNextImage();
							}
						}, 1000);
					}
					startSlideshow();
				});

				gridCell.addEventListener('mouseleave', () => {
					console.log('mouse is left grid cell');
					isMouseInside = false;
					function stopSlideshow() {
						clearInterval(timer);
					}
					stopSlideshow();
				});
			});
		}
	}
}
document.addEventListener('DOMContentLoaded', function () {
	initSlideShows();
});

//
// function to hide all cats apart from the brand and digital pages when the filter is used
//

// Wait for the DOM to be fully loaded
function onlyBrandDigitalTags() {
	// Check if the current page is the work page
	console.log('start remove cat function');
	var isWorkPage = window.location.href.includes('work');
	// Select all post meta wrap elements
	var metaWraps = document.querySelectorAll('.meta_wrapper');

	// Loop through each meta wrap element
	metaWraps.forEach(function (metaWrap) {
		// Select all category elements within the current meta wrap
		const categories = metaWrap.getElementsByTagName('h6');
		console.log('pick up cats');
		// Loop through each category element
		categories.forEach(function (category) {
			// Get the category name and convert it to lowercase for comparison
			var categoryName = category.textContent.trim().toLowerCase();

			// Check if the category is not 'brand' or 'digital' and it's not the work page
			if (
				!isWorkPage &&
				categoryName !== 'brand' &&
				categoryName !== 'digital'
			) {
				// Hide the category element
				console.log('add display none to cats');
				category.style.display = 'none';
			}
		});
	});
}

//
// clock
//

function currentTime() {
	var clock = document.getElementById('clock');
	let date = new Date();
	let hh = date.getHours();
	let mm = date.getMinutes();
	let ss = date.getSeconds();

	hh = hh < 10 ? '0' + hh : hh;
	mm = mm < 10 ? '0' + mm : mm;
	ss = ss < 10 ? '0' + ss : ss;

	let time = hh + ':' + mm + ':' + ss;

	clock.innerText = time;
	var t = setTimeout(function () {
		currentTime();
	}, 1000);
}
currentTime();

const hourHand = document.querySelector('[data-hour-hand]');
const minHand = document.querySelector('[data-minute-hand]');
const secHand = document.querySelector('[data-second-hand]');

function setAnalogueClock() {
	const currentDate = new Date();
	const secondsRatio = currentDate.getSeconds() / 60;
	const minutesRatio = (secondsRatio + currentDate.getMinutes()) / 60;
	const hoursRatio = (minutesRatio + currentDate.getHours()) / 12;
	setRotation(secHand, secondsRatio);
	setRotation(minHand, minutesRatio);
	setRotation(hourHand, hoursRatio);
}
function setRotation(element, rotationRatio) {
	element.style.setProperty('--rotation', rotationRatio * 360);
}
setInterval(setAnalogueClock, 1000);
setAnalogueClock();

//
// footer and ticker bottom-of-page activity
//

function toggleFooterBackground() {
	const footer = document.querySelector('.footer');
	const pageHeight = document.body.clientHeight; // Height of the entire page
	const middleOfPage = pageHeight / 2; // Half of the page height
	if (window.scrollY > middleOfPage) {
		footer.classList.remove('black');
	} else {
		footer.classList.add('black');
	}
}
// }
// Add an event listener to run the function on scroll
window.addEventListener('scroll', toggleFooterBackground);
window.addEventListener('load', toggleFooterBackground);

// Function to add the "hide" class when the element is within 600px of the bottom of the page
let headerIsHidden = false; // Variable to track the visibility state
let bulletinBarIsHidden = false; // Variable to track the visibility state

function hideElementsAtEnd() {
	const bulletinBar = document.querySelector('.bulletin_bar');
	const backToAllButton = document.querySelector('.back_to_all_wrap_fixed');
	const header = document.getElementById('#header');

	const scrollPosition = window.scrollY;
	const windowHeight = window.innerHeight;
	const documentHeight = document.body.scrollHeight;
	// we want to hide our elements at slightly different points
	const headerTriggerPosition = documentHeight - windowHeight - 250;
	const bulletinBarTriggerPosition = documentHeight - windowHeight - 650;
	// hide the header on mobile viewports
	if (window.innerWidth <= 768) {
		if (scrollPosition >= headerTriggerPosition) {
			if (!headerIsHidden) {
				header.classList.remove('visible');
				headerIsHidden = true;
			}
		} else {
			if (headerIsHidden) {
				header.classList.add('visible');
				headerIsHidden = false;
			}
		}
	}
	// hide the bulletin bar and 'back to posts' button
	if (!bulletinBar) return;
	if (scrollPosition >= bulletinBarTriggerPosition) {
		if (!bulletinBarIsHidden) {
			bulletinBar.classList.add('hide');
			if (backToAllButton) {
				backToAllButton.classList.add('hide');
			}
			bulletinBarIsHidden = true;
		}
	} else {
		if (bulletinBarIsHidden) {
			bulletinBar.classList.remove('hide');
			if (backToAllButton) {
				backToAllButton.classList.remove('hide');
			}
			bulletinBarIsHidden = false;
		}
	}
}
// Add a scroll event listener to continuously check and update the visibility of the element
window.addEventListener('scroll', hideElementsAtEnd);

//
// posts layout toggle and loal storage methods
//

const rowsButton = document.getElementById('layout_rows_button');
const gridButton = document.getElementById('layout_grid_button');

const gridCells = document.getElementsByClassName('grid_cell');
const postRows = document.getElementsByClassName('post_row');
const postsWrapper = document.querySelector('.posts_layout_wrapper');

const showRowsLayout = () => {
	if (postsWrapper) {
		postsWrapper.classList.remove('post_grid');
		postsWrapper.classList.add('post_rows');
		gridButton.classList.remove('active');
		rowsButton.classList.add('active');
		// add this to local storage so that the filter works
		localStorage.setItem('postsLayout', 'rows');
	}
};

const showGridLayout = () => {
	if (postsWrapper) {
		postsWrapper.classList.remove('post_rows');
		postsWrapper.classList.add('post_grid');
		rowsButton.classList.remove('active');
		gridButton.classList.add('active');
		// add this to local storage so that the filter works
		localStorage.setItem('postsLayout', 'grid');
	}
};
// add the active class to the grid toggle by default
if (gridButton) {
	gridButton.classList.add('active');
}

const toggleLayout = (isRowsLayout) => {
	// Toggle the layout class on postsWrapper
	if (isRowsLayout) {
		showRowsLayout();
	} else {
		showGridLayout();
	}
};

if (rowsButton) {
	rowsButton.addEventListener('click', () => {
		// re-initliase these functions
		// initSlideShows();
		// initialiseCursors();
		// fadeInElement();
		// create a transition by adding and remove a body class with a timeout
		document.body.classList.add('layout_toggle_transition');
		setTimeout(() => {
			toggleLayout(true);
			document.body.classList.remove('layout_toggle_transition');
		}, 300);
	});
}
if (gridButton) {
	gridButton.addEventListener('click', () => {
		// re-initliase these functions
		// initialiseCursors();
		initSlideShows();
		fadeInElement();
		// create a transition by adding and remove a body class with a timeout
		document.body.classList.add('layout_toggle_transition');
		setTimeout(() => {
			toggleLayout(false);
			document.body.classList.remove('layout_toggle_transition');
		}, 300);
	});
}

// scroll to the top of the posts when the filter is being used
// this checks what value the postsLayout has inside local storage, then changes it accordingly
document.addEventListener('DOMContentLoaded', function () {
	checkURLAndCheckbox();

	const localStorageData = localStorage.getItem('postsLayout');

	if (localStorageData === 'grid') {
		showGridLayout();
	} else if (localStorageData === 'rows') {
		showRowsLayout();
	}

	// we want to clear this local storage when nagivating away from eith of the archive pages
	// this is so it will default back to grid view on the next visit!
	window.addEventListener('beforeunload', function (event) {
		const currentURL = window.location.href;
		if (currentURL.includes('/our-work/') || currentURL.includes('/blog/')) {
			localStorage.removeItem('postsLayout');
		}
	});
});

//
//  open and close services dropdown on project pages
//

const serviceArrowDown = document.querySelectorAll('.service_arrow_down');
const servicesList = document.querySelectorAll('.services_list');
const servicesTitleWrap = document.querySelectorAll('.glance_box_title_wrap');

const toggleServices = () => {
	// Check if the window width is less than 767px
	if (window.innerWidth < 767) {
		console.log('click');
		// Iterate over each element in servicesList and toggle the 'reveal' class
		servicesList.forEach((servicesList) => {
			servicesList.classList.toggle('reveal');
		});
		serviceArrowDown.forEach((serviceArrow) => {
			serviceArrow.classList.toggle('active');
		});
	}
};

servicesTitleWrap.forEach((servicesTitle) => {
	servicesTitle.addEventListener('click', toggleServices);
});
//
// Function to prevent widows
//
function preventWidows(selector) {
	var elements = document.querySelectorAll(selector);

	elements.forEach(function (element) {
		var content = element.innerHTML;
		var words = content.split(' ');

		if (words.length > 1) {
			// Check for sentences ending with full stop, question mark, or colon
			var lastWordIndex = words.length - 1;
			if (
				(words[lastWordIndex].endsWith('.') ||
					words[lastWordIndex].endsWith('?') ||
					words[lastWordIndex].endsWith(':')) &&
				words.length > 2 &&
				(words[lastWordIndex - 1].endsWith('.') ||
					words[lastWordIndex - 1].endsWith('?') ||
					words[lastWordIndex - 1].endsWith(':')) &&
				(words[lastWordIndex - 2].endsWith('.') ||
					words[lastWordIndex - 2].endsWith('?') ||
					words[lastWordIndex - 2].endsWith(':'))
			) {
				// Concatenate the last three words to prevent widow
				words[lastWordIndex - 2] +=
					' ' + words[lastWordIndex - 1] + ' ' + words.pop();
			} else if (
				(words[lastWordIndex].endsWith('.') ||
					words[lastWordIndex].endsWith('?') ||
					words[lastWordIndex].endsWith(':')) &&
				words.length > 1 &&
				!(
					words[lastWordIndex - 1].endsWith('.') ||
					words[lastWordIndex - 1].endsWith('?') ||
					words[lastWordIndex - 1].endsWith(':')
				)
			) {
				// Replace last space with non-breaking space
				words[lastWordIndex - 1] += '&nbsp;' + words.pop();
			} else if (
				(words[lastWordIndex].endsWith('.') ||
					words[lastWordIndex].endsWith('?') ||
					words[lastWordIndex].endsWith(':')) &&
				words.length === 1
			) {
				// Wrap the single word to the next line
				element.innerHTML = words[0] + '<br>';
				return;
			}
			element.innerHTML = words.join(' ');
		}
	});
}

// Call the function for paragraphs, headings, etc.
preventWidows('p');
preventWidows('h1');
preventWidows('h2');
preventWidows('h3');
preventWidows('h4');
preventWidows('h5');
preventWidows('h6');
preventWidows('em');
