<? get_header() ?>

    <div class="container-fluid p-0">
    <h3>Search Results</h3>
    <?php
        if (have_posts()) :
            while (have_posts()) :
            the_post();

            get_template_part('partials/page/content','search');
                    
            endwhile;
        endif;
    ?>

    </div>

<? get_footer() ?>