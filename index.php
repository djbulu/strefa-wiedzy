<?php get_header(); ?>

<main class="main-content">
  <div class="container">
    <div class="content-grid">
      <!-- Sidebar -->
      <aside class="sidebar">
        <!-- Kategorie -->
        <div class="sidebar-section">
          <h3 class="sidebar-section__title">Kategorie</h3>
          <ul class="categories-list">
            <?php
              $categories = get_categories();
              foreach ($categories as $category) {
                echo '<li><a class="category-link" href="'.get_category_link($category->term_id).'">'.$category->name.' <span class="category-count">'.$category->count.'</span></a></li>';
              }
            ?>
          </ul>
        </div>
        <!-- Archiwum -->
        <div class="sidebar-section">
          <h3 class="sidebar-section__title">Archiwum</h3>
          <ul class="archives-list">
            <?php wp_get_archives(['type' => 'monthly', 'show_post_count' => true]); ?>
          </ul>
        </div>
      </aside>

      <!-- Główna treść -->
      <div class="content-area">
        <div class="page-header">
          <h2 class="page-title">Ostatnie artykuły</h2>
          <p class="page-description">Odkryj najnowsze artykuły z różnych dziedzin</p>
        </div>

        
       <?php if ( have_posts() ) : ?>
      <div class="posts-grid">

        <?php while ( have_posts() ) : the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>

            <?php if ( has_post_thumbnail() ) : ?>
              <div class="post-card__image-wrapper">
                <?php the_post_thumbnail( 'large', ['class' => 'post-card__image'] ); ?>
              </div>
            <?php endif; ?>

            <div class="post-card__header">

              <?php
              $categories = get_the_category();
              if ( ! empty( $categories ) ) :
              ?>
                <div class="post-card__category">
                  <?php echo esc_html( $categories[0]->name ); ?>
                </div>
              <?php endif; ?>

              <div class="post-card__meta">
                <span class="post-card__date"><?php echo get_the_date(); ?></span>
                <span class="post-card__read-time">
                  ~<?php echo ceil( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 200 ); ?> min czytania
                </span>
              </div>

              <h2 class="post-card__title"><?php the_title(); ?></h2>

              <p class="post-card__excerpt"><?php echo get_the_excerpt(); ?></p>
            </div>

            <div class="post-card__footer">
              <span class="post-card__author">Autor: <?php the_author(); ?></span>
            </div>

            <!-- Cała karta jako link -->
            <a href="<?php the_permalink(); ?>" class="post-card" aria-label="<?php the_title_attribute(); ?>"></a>
          </article>
        <?php endwhile; ?>

      </div>

      <div class="pagination">
        <?php the_posts_pagination(); ?>
      </div>

    <?php else : ?>
      <div class="no-results">
        <h3>Brak wpisów</h3>
        <p>Nie znaleziono żadnych treści. Spróbuj ponownie później.</p>
      </div>
    <?php endif; ?>

  </div>
</main>

<?php get_footer(); ?>