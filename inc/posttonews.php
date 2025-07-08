<?php /**
* @title: Change news post object
* @description: Will change any mention of "Post" in WordPress Admin to "News" instead - source: http://revelationconcept.com/wordpress-rename-default-posts-news-something-else/
*/
function change_news_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'News';
    $labels->singular_name = 'News';
    $labels->add_new = 'Add news';
    $labels->add_new_item = 'Add news';
    $labels->edit_item = 'Edit news';
    $labels->new_item = 'News';
    $labels->view_item = 'View news';
    $labels->search_items = 'Search news';
    $labels->not_found = 'No news found';
    $labels->not_found_in_trash = 'No news found in trash';
    $labels->all_items = 'All news';
    $labels->menu_name = 'News';
    $labels->name_admin_bar = 'News';
}

add_action("init", "change_news_post_object");
