<?php

    function enqueue_function() {
        wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/vendor/bootstrap/css/bootstrap.min.css' );
        // wp_enqueue_style( 'font1', 'https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700' );
        wp_enqueue_style( 'font2', 'https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i' );
        wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/vendor/fontawesome-free/css/all.min.css' );
        wp_enqueue_style( 'resume', get_template_directory_uri() . '/css/resume.min.css' );
        wp_enqueue_style( 'my-style', get_stylesheet_uri());

        wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/vendor/bootstrap/js/bootstrap.bundle.min.js', array('jquery'), '1.0.0', true );
        wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/vendor/jquery-easing/jquery.easing.min.js', array('jquery'), '1.0.0', true );
        wp_enqueue_script( 'resume-js', get_template_directory_uri() . '/js/resume.min.js', array('jquery'), '1.0.0', true );
        wp_enqueue_script( 'myscript', get_template_directory_uri() . '/js/myscript.js', array('jquery'), '1.0.0', true );
    }
    add_action( 'wp_enqueue_scripts', 'enqueue_function' );

    function admin_enqueue_function( $hook ) {
        wp_enqueue_style( 'font1', 'https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700' );
        // wp_enqueue_style( 'resume', get_template_directory_uri() . '/css/resume.min.css' );
    }
    add_action( 'admin_enqueue_scripts', 'admin_enqueue_function' );


    function register_resources() { 
        register_nav_menu('header-menu','Header Menu');

        $args = array(
            'public' => true,
            'label'  => 'Sections',
            //gutenburg block
            'show_in_rest' => true,
            'supports' => array('editor')
          );
        register_post_type( 'section', $args );
        
        //taxonomy
        $args = array(
            'label' => 'Type',
            'rewrite' => array('slug' => 'type'),
            'hierarchical' => true,
        );
        register_taxonomy( 'type', 'section', $args );

        $args = array(
            'public' => true,
            'label'  => 'Experiences'
          );
        register_post_type( 'experience', $args );

        $args = array(
            'public' => true,
            'label'  => 'Education'
          );
        register_post_type( 'education', $args );
    }

    add_action( 'init', 'register_resources' );

    function add_class_to_li( $classes, $item, $args, $depth ) { 
        $classes[] = 'nav-item';
        return $classes;
     }
 
    add_filter( 'nav_menu_css_class', 'add_class_to_li', 10, 4 ); 

    function add_class_to_anchors( $atts ) {
        $atts['class'] = 'nav-link';
     
        return $atts;
    }
    add_filter( 'nav_menu_link_attributes', 'add_class_to_anchors', 10 );

    function social_media_func( $atts ){

        ob_start();

        get_template_part('shortcode/social_media');
        // return $html;
        return ob_get_clean();

    }
    add_shortcode( 'social-media', 'social_media_func' );

    function section_func( $atts ){

    ob_start();

    // The Query
    $args = array(
        'name' => $atts['slug'],
        'post_type' => 'section',
    );
    $the_query = new WP_Query( $args );
                
    // The Loop
    while ( $the_query->have_posts() ) {
        $the_query->the_post();

        $extra = 'default';

        //to find section by type
        $types = get_the_terms(get_the_ID(),'type');

        if($types != false){
            $type = $types[0];
            $slug = $type->slug;

            if(locate_template(array('partials/section/content-'.$slug.'.php'))){
                $extra = $slug;
            }
        }

        //to find section by section-slug
        $section_slug = get_post_field('post_name');
        if(locate_template(array('partials/section/content-'.$section_slug.'.php'))){
            $extra = $section_slug;
        }


        get_template_part('partials/section/content',$extra);
    }
    //restore original post data
    wp_reset_postdata();

    return ob_get_clean();

    }
    add_shortcode( 'section', 'section_func' );
    
?>