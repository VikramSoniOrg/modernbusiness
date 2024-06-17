<?php get_header(); // load header ?>
<section class="py-5">
    <div class="container px-5">
        <h2 class="fw-bolder fs-5 mb-4"><?php the_archive_title(); ?></h2>
        <div class="row gx-5">
            <?php while (have_posts()) : the_post(); ?>
            <div class="col-lg-4 mb-5">
                <div class="card h-100 shadow border-0">
                    <img class="card-img-top" src="<?php the_post_thumbnail_url(get_the_ID(), 'mb-blog-section'); ?>" alt="..." />
                    <div class="card-body p-4">
                        <div class="badge bg-primary bg-gradient rounded-pill mb-2"><?php single_term_title(); ?></div>
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
            <?php endwhile; ?>
        <div class="row gx-5"><?php wp_pagenavi(); ?></div>
        </div>
    </div>
</section>
<?php get_footer(); // load footer ?>
