<div class="form_container">

    <!-- this counts the seach paramenters. 
            We can use this if we want to posts to shoe unless search or filtered for. -->
    <?php $is_search = count( $_GET ); ?>

    <?php
            $categories = get_terms([
                    'taxonomy' => 'category',
                    'hide_empty' => false,
                ]);
            ?>

    <!-- todo: make this dynamic -->
    <form id="search_filter_form" class="search_filter_form" action="<?php echo home_url('/search-filter-test'); ?>">

        <!-- original dropdown category search -->
        <!--<div class="form_group_dropdowns">
                    <input type="text" name="keyword"
                        value="<?php // echo isset($_GET['keyword']) ? $_GET['keyword'] : '';?>">
                    <select name="category" id="">
                        <option value="">Choose a category</option>
                        <?php //foreach($categories as $category):?>
                        <option <?php //if(  isset($_GET['category']) && ( $_GET['category'] == $category->slug)  ):?>
                            selected <?php// endif;?> value="<?php //echo $category->slug;?>">
                            <?php // echo $category->name;?>
                        </option>
                        <?php //endforeach;?>
                    </select>
                </div> -->

        <!-- use clickable categories instead, with checkboxes -->
        <div class="form_group_checkbox">
            <input type="text" name="keyword" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">

            <div class="category-list">
                <?php 
                        $catList = "";
                        foreach ($categories as $category) : 
                            $catList .= '#' . $category->slug;
                        ?>
                <label>
                    <input class="category_checkbox" type="checkbox" name="searchcategory"
                        value="<?php echo $category->slug; ?>"
                        <?php if (isset($_GET['category']) && in_array($category->slug, $_GET['category'])) : ?>checked<?php endif; ?>>
                    <?php echo $category->name; ?>
                </label>
                <?php endforeach; ?>
            </div>
        </div>

        <input type="hidden" name="hidden" value="<?php echo $catList; ?>">

        <!-- clickable category names, no dropdowns (best way!) -->
        <!-- <div class="form_group">
                    <input type="text" name="keyword"
                        value="<?php //echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
                    <div class="category-list">
                        <?php //foreach ($categories as $category) : ?>
                        <a
                            href="<?php //echo add_query_arg('category', $category->slug, home_url('/search-filter-test')); ?>">
                            <?php// echo $category->name; ?>
                        </a>
                        <?php //endforeach; ?>
                    </div>
                </div> -->

        <button type="submit" class="btn_default">Search</button>

        <!-- another filter we can addd -->
        <!-- <div class="form_group">

                    <div>
                        <label for="">From</label>
                        <select name="" id=""></select>
                    </div>
                    <div>
                        <label for="">From</label>
                        <select name="" id=""></select>
                    </div>

                </div> -->
    </form>

    <?php 
                $args = [
                    'paged' => $paged,
                    'post_type' => $post_type_select,
                    'posts_per_page' => 6,
                    'tax_query' => [],
                    'meta_query' => [
                            'relation' => 'AND',
                    ],
                ];

                if( isset($_GET['keyword']) )
                {
                    if(!empty($_GET['keyword']))
                    {
                            $args['s'] = sanitize_text_field($_GET['keyword']);
                    }
                }

                // this is for the dropdown category search method
                // if( isset($_GET['category']) )
                // {
                //     if(!empty($_GET['category']) )
                //     {
                //         $args['tax_query'][] = [
                //             'taxonomy' => 'category',
                //             // search the slug
                //             'field' => 'slug',
                //             'terms' => array( sanitize_text_field($_GET['category']) )
                //         ];
                //     }
                // }


                //this is for checkbox category search method
                if (isset($_GET['category']) && is_array($_GET['category']) && !empty($_GET['category'])) {
                    $category_slugs = array_map('sanitize_text_field', $_GET['category']);

                    $args['tax_query'][] = array(
                        'taxonomy' => 'category',
                        'field'    => 'slug',
                        'terms'    => $category_slugs,
                        'operator' => 'IN', // Use 'IN' to match any of the selected categories.
                    );
                }



                // this is for the a tag, (no checkboxes or dropdowns) method
                // doesn't quite work yet
                // if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
                //     $args['s'] = sanitize_text_field($_GET['keyword']);
                // }

                // if (isset($_GET['category']) && is_array($_GET['category']) && !empty($_GET['category'])) {
                //     $category_slugs = array_map('sanitize_text_field', $_GET['category']);
                //     $args['tax_query'][] = [
                //         'taxonomy' => 'category',
                //         'field'    => 'slug',
                //         'terms'    => $category_slugs,
                //         'operator' => 'IN', // Use 'IN' to match any of the selected categories.
                //     ];
                // }



                // use this if we want no post to show on default
                // if($is_search) { 
                //   $query = new WP_Query($args);
                // } ?>

    <?php $query = new WP_Query($args); ?>

</div>