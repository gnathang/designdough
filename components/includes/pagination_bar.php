<!-- pagination  -->

<!-- // Check where you are -->
<?php 
	$dd_uri_check = $_SERVER['REQUEST_URI'];
	$what_am_i = '';
	if(str_contains($dd_uri_check, '/cym/')) {
		$what_am_i = 'cym';
	} else {
		$what_am_i = 'eng';
	}
	$what_am_i = trim($what_am_i);
?>


<?php if($what_am_i == 'cym'){ ?>
<?php echo '
                    <div id="wp_pagination" class="wp_pagination">
                        <a class="first page button" href="'.get_pagenum_link(1).'">Y dudalen gyntaf</a>
                        <a class="previous page button" href="'.get_pagenum_link(($curpage-1 > 0 ? $curpage-1 : 1)).'">
                            <img src="'.get_template_directory_uri().'/assets/images/svg/arrow-back.svg" alt="prev-arrow">
                        </a>';
                        for($i=1;$i<=$query->max_num_pages;$i++)
                            echo '<a class="'.($i == $curpage ? 'active ' : '').'page button" href="'.get_pagenum_link($i).'">'.$i.'</a>';
                        echo '
                        <a class="next page button" href="'.get_pagenum_link(($curpage+1 <= $query->max_num_pages ? $curpage+1 : $query->max_num_pages)).'">
                        <img src="'.get_template_directory_uri().'/assets/images/svg/arrow-next.svg" alt="prev-arrow">
                        </a>
                        <a class="last page button" href="'.get_pagenum_link($query->max_num_pages).'">Y dudalen olaf</a>
                    </div>
                    '; ?>

<?php } else { ?>
<?php echo '
            <div id="wp_pagination" class="wp_pagination">
                <a class="first page button" href="'.get_pagenum_link(1).'">First Page</a>
                <a class="previous page button" href="'.get_pagenum_link(($curpage-1 > 0 ? $curpage-1 : 1)).'"><img src="'.get_template_directory_uri().'/assets/images/svg/arrow-back.svg" alt="prev-arrow">
                </a>';
                for($i=1;$i<=$query->max_num_pages;$i++)
                    echo '<a class="'.($i == $curpage ? 'active ' : '').'page button" href="'.get_pagenum_link($i).'">'.$i.'</a>';
                echo '
                <a class="next page button" href="'.get_pagenum_link(($curpage+1 <= $query->max_num_pages ? $curpage+1 : $query->max_num_pages)).'"><img src="'.get_template_directory_uri().'/assets/images/svg/arrow-next.svg" alt="prev-arrow">
                </a>
                <a class="last page button" href="'.get_pagenum_link($query->max_num_pages).'">Last Page</a>
            </div>
            '; ?>
<?php } ?>