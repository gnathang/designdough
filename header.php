<!DOCTYPE HTML>
<!--[if IEMobile 7 ]><html class="no-js iem7" manifest="default.appcache?v=1"><![endif]-->
<!--[if lt IE 7 ]><html class="no-js ie6" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="no-js ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="no-js ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <script src="//d2wy8f7a9ursnm.cloudfront.net/v7/bugsnag.min.js"></script>
    <script type="module">
    import BugsnagPerformance from '//d2wy8f7a9ursnm.cloudfront.net/v1/bugsnag-performance.min.js'
    Bugsnag.start({
        apiKey: '63e780bd18ac63a910910bb9237dbd54'
    })
    BugsnagPerformance.start({
        apiKey: '63e780bd18ac63a910910bb9237dbd54'
    })
    </script>
    <script src="https://www.google.com/recaptcha/enterprise.js?render=6LciNbspAAAAAICTzVXvGjkLEKp7pcEUj4RG2444">
    </script>
    <title><?php

            if (defined('WPSEO_VERSION')) {
                wp_title('');
            } else {

                global $page, $paged;

                wp_title('|', true, 'right');

                bloginfo('name');

                $site_description = get_bloginfo('description', 'display');
                if ($site_description && (is_home() || is_front_page()))
                    echo " | $site_description";

                if ($paged >= 2 || $page >= 2)
                    echo ' | ' . sprintf(__('Page %s', 'skeleton'), max($paged, $page));
            }
            ?>
    </title>

    <!-- <meta charset="<?php //bloginfo('charset'); 
                        ?>"> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#181818" />
    <meta name="theme-color" content="#181818" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#222222" media="(prefers-color-scheme: dark)">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="stylesheet" type="text/css"
        href="<?php echo get_template_directory_uri() ?>/assets/js/slick/slick/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="<?php echo get_template_directory_uri() ?>/assets/js/splide/splide.min.css" />
    <link rel="stylesheet" type="text/css"
        href="<?php echo get_template_directory_uri() ?>/assets/js/slick/slick/slick-theme.css" />



    <?php wp_head(); ?>

    <?php
    $url = explode('/', $_SERVER['REQUEST_URI']);
    $dir = $url[1] ? $url[1] : 'home';
    ?>

    <!-- facebook -->
    <meta name=“facebook-domain-verification” content=“y2q7zzwyvhh31u5wn7jh359bbt1bvy” />

    <!-- GA -->
    <?php if (get_field('field_analytics', 'option')) { ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php the_field('field_analytics', 'option') ?>">
    </script>
    <script src="https://code.iconify.design/1/1.0.4/iconify.min.js"> </script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', '<?php the_field('field_analytics', 'option') ?>');

    gtag('config', 'AW-677088283'); // Google Conversion tag

    <?php if ($post->ID == 16034) { ?>
    gtag('event', 'conversion', {
        'send_to': 'AW-677088283/8APtCNj979IBEJuY7sIC'
    });
    <?php } ?>
    </script>
    <?php } ?>


    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-877721386"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'AW-877721386');
    </script>


</head>

<?php

$data_theme = '';
$body_classes = '';
$post_id = get_the_ID();

if (is_single()) {
    $data_theme = 'light';
    $body_classes = 'light-mode-enabled';

    if (get_post_type() === 'project') {
        // Check the value of the ACF field 'dark_or_light' for "single-project" pages
        $dark_or_light = get_field('dark_or_light');
        // For single "single-project" pages with 'dark_or_light' true, set the data-theme attribute to 'light'
        $data_theme = $dark_or_light ? 'light' : 'dark';
        $body_classes = $dark_or_light ? 'light-mode-enabled' : $body_classes;
    }
} elseif (strpos($_SERVER['REQUEST_URI'], '/blog') !== false) {
    $data_theme = 'light';
    $body_classes = 'light-mode-enabled';
}

?>



<body class=" <?php echo esc_attr($body_classes); ?>" id="barba-wrapper" data-barba="wrapper"
    data-theme="<?php echo esc_attr($data_theme); ?>">
    <div class="cursor">
        <span class="view">View</span>
        <span class="slide_right">Slide<img
                src="<?php echo get_template_directory_uri() . '/assets/images/svg/arrow-right-white.svg'; ?>"
                alt="right arrow">
        </span>
        <span class="slide_left"><img
                src="<?php echo get_template_directory_uri() . '/assets/images/svg/arrow-back-white.svg'; ?>"
                alt="left arrow">Slide
        </span>
    </div>

    <!-- <div class="load-container">
        <div class="loading-screen-one"></div>
        <div class="loading-screen-two"></div>
        <div class="loading-screen-three"></div>
    </div> -->

    <div class="transition-swipe swiper"></div>

    <!-- render the ticker on every page except the project inners -->
    <div class="barba_container transition-fade" data-barba="container">
        <?php if (!is_singular('project')) {
            get_template_part('components/includes/bulletin_bar');
        } ?>
        <header id="#header" class="testing-sftp-gabriel-20-11">
            <div class="header_wrap container">

                <div class="logo">
                    <a href="/" aria-label="link to <?php bloginfo('name'); ?> homepage">
                        <img class="icon"
                            src="<?php echo get_template_directory_uri() . '/assets/images/svg/site-logo-white.svg'; ?>"
                            alt="Company logo for <?php bloginfo('name'); ?>" />
                    </a>
                </div>
                <!-- main nav, if using -->
                <?php // get_template_part('components/includes/main_nav'); 
                ?>

                <div class=" menu_icon_wrap">

                    <?php get_template_part('components/includes/clock'); ?>
                    <?php // get_template_part('components/includes/dark_mode_toggle'); 
                    ?>
                    <?php get_template_part('components/includes/nav_icons'); ?>
                </div>

            </div>
            <!-- modal/mobile nav -->
            <!-- todo: are we calling this modal nav or something different? -->
            <?php get_template_part('components/includes/modal_nav'); ?>
        </header>

        <?php get_template_part('components/includes/splash_screen'); ?>

        <main class="main transition-main <?php if (is_page('brand-labs')) {
                                                echo "brandlabs";
                                            } ?>">