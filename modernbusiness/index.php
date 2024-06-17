<?php get_header(); // load header ?>
<section class="py-5">
    <div class="container px-5">
        <h1 class="fw-bolder fs-5 mb-4"><?php echo single_post_title(); ?></h1>
        <?php
        $args  = array(
			'posts_per_page'      => 1,
			'post__in'            => get_option( 'sticky_posts' ),
		);
		$query = new WP_Query( $args );
        ?>
        <?php
        if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post(); ?>
        <div class="card border-0 shadow rounded-3 overflow-hidden">
            <div class="card-body p-0">
                <div class="row gx-0">
                    <div class="col-lg-6 col-xl-5 py-lg-5">
                        <div class="p-4 p-md-5">
                        	<?php
                        	$categories = get_the_category();
							foreach ($categories as $category) {
								echo '<div class="badge bg-primary bg-gradient rounded-pill mb-2 me-2">'.$category->name.'</div>';
							}
							?>
                            <div class="h2 fw-bolder"><?php the_title(); ?></div>
                            <?php the_excerpt(); ?>
                            <a class="stretched-link text-decoration-none" href="<?php the_permalink(); ?>">
                                Read more
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-7"><div class="bg-featured-blog" style="background-image: url('<?php the_post_thumbnail_url(get_the_ID(), 'mb-blog-hero'); ?>')"></div></div>
                </div>
            </div>
        </div>
    	<?php endwhile; wp_reset_postdata(); endif; ?>
    </div>
</section>
<section class="py-5 bg-light">
    <div class="container px-5">
        <div class="row gx-5">
            <div class="col-xl-8">
                <?php $default_category = get_option('default_category'); ?>
                <h2 class="fw-bolder fs-5 mb-4"><?php echo get_cat_name($default_category); ?></h2>
                <!-- News item-->
                <?php
                $args  = array(
                    'posts_per_page'    => 3,
                    'cat'               => $default_category,
                    'post__not_in'      => get_option( 'sticky_posts' )
                );
                $query = new WP_Query( $args );
                ?>
                <?php
                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="mb-4">
                        <div class="small text-muted"><?php the_time('F jS, Y'); ?></div>
                        <a class="link-dark" href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                    </div>
                    <?php endwhile; wp_reset_postdata(); ?>                
                    <div class="text-end mb-5 mb-xl-0">
                        <a class="text-decoration-none" href="<?php echo get_category_link($default_category); ?>">
                            More <?php echo strtolower(get_cat_name($default_category)); ?>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-xl-4">
                <div class="card border-0 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex h-100 align-items-center justify-content-center" id="sidebar">
                            <?php dynamic_sidebar( 'right-sidebar' ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog preview section-->
<section class="py-5">
    <div class="container px-5">
        <?php $categories = get_categories('exclude='.$default_category); ?>
        <?php foreach ($categories as $category) : ?>
        <h2 class="fw-bolder fs-5 mb-4"><?php echo $category->name; ?></h2>
        <div class="row gx-5">
            <?php
            $args  = array(
                'posts_per_page'    => 3,
                'cat'               => $category->cat_ID,
                'post__not_in'      => get_option( 'sticky_posts' )
            );
            $query = new WP_Query( $args );
            ?>
            <?php
            if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post(); ?>
            <div class="col-lg-4 mb-5">
                <div class="card h-100 shadow border-0">
                    <img class="card-img-top" src="<?php the_post_thumbnail_url(get_the_ID(), 'mb-blog-section'); ?>" alt="..." />
                    <div class="card-body p-4">
                        <div class="badge bg-primary bg-gradient rounded-pill mb-2"><?php echo $category->name; ?></div>
                        <a class="text-decoration-none link-dark stretched-link" href="<?php the_permalink(); ?>"><div class="h5 card-title mb-3"><?php the_title(); ?></div></a>
                        <p class="card-text mb-0"><?php echo get_the_excerpt(); ?></p>
                    </div>
                    <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                        <div class="d-flex align-items-end justify-content-between">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle me-3" src="<?php echo get_avatar_url(get_the_author_meta('ID'), array('size' => 40)); ?>" alt="..." />
                                <div class="small">
                                    <div class="fw-bold"><?php the_author(); ?></div>
                                    <div class="text-muted"><?php the_time('F jS, Y'); ?> &middot; <?php echo round(str_word_count(get_the_content()) / 300); ?> min read</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>
        <div class="text-end mb-5 mb-xl-0">
            <a class="text-decoration-none" href="<?php echo get_category_link($category->cat_ID); ?>">
                More <?php echo strtolower(get_cat_name($category->cat_ID)); ?>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</section>
<?php get_footer(); // load footer ?>
