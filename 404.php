<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

        <div class="full-width snap-flex manifesto_page_header_wrapper bg-offblack">

            <div class="container">

                <div class="manifesto_page_header">
                    <div class="content content-primary">
                    <h1>Okay, move it along people, <em>nothing to see here.</em></h1></div>
                    <div class="content content-secondary">
                    <h2>Oops — we can’t seem to find what you’re looking for. Maybe try one of the menu links or go back to <em><a href="<?php get_site_url() ?>/" class="f-grey-1">homepage</a></em>.</h2>
                    </div>
                </div>

            </div>
            <div class="triangle-manifesto-header">
                <?php get_template_part('/assets/images/svg/dd-triangle-2.svg') ?>
            </div>

            </div>
            

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>