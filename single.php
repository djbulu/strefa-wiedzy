<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<main class="main-content single-post" itemscope itemtype="https://schema.org/BlogPosting">
  <div class="container">

    <!-- HERO -->
    <div class="single-post__hero" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')" itemprop="image">
      <h1 class="single-post__title" itemprop="headline"><?php the_title(); ?></h1>
    </div>

    <!-- METADATA -->
    <header class="single-post__header">
      <?php if (has_category()) : ?>
        <div class="post-category">
          <?php the_category(' '); ?>
        </div>
      <?php endif; ?>
      <div class="post-meta">
        <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date(); ?></time>
        <meta itemprop="dateModified" content="<?php echo get_the_modified_date('c'); ?>" />
        <span class="post-author" itemprop="author" itemscope itemtype="https://schema.org/Person">
          <span itemprop="name"><?php the_author(); ?></span>
        </span>
      </div>
    </header>

    <!-- TREŚĆ WPISU -->
    <article class="single-post__content" itemprop="articleBody">
      <?php the_content(); ?>
    </article>

    <!-- CTA -->
    <section class="cta-section">
      <div class="highlight-box">
        <h2 class="cta-title">Masz pytania dotyczące tego tematu?</h2>
        <p>Skontaktuj się z nami – odpowiemy na wszystkie Twoje wątpliwości.</p>
        <a href="/kontakt" class="btn btn--primary">Skontaktuj się</a>
      </div>
    </section>

    <!-- SEO lokalne -->
    <section class="local-seo">
      <h2>Skontaktuj się z lokalnym ekspertem w Opolu</h2>
      <address itemscope itemtype="https://schema.org/LocalBusiness">
        <strong itemprop="name">Eco Ciepło</strong><br>
        <span itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
          <span itemprop="addressLocality">Opole</span>, Polska
        </span><br>
        Tel: <span itemprop="telephone">+48 123 456 789</span><br>
        <a href="mailto:kontakt@ecocieplo.pl" itemprop="email">kontakt@ecocieplo.pl</a>
      </address>
    </section>

    <!-- Breadcrumbs widoczne -->
    <nav class="breadcrumbs" aria-label="Ścieżka nawigacyjna">
      <a href="<?php echo home_url(); ?>">Strona główna</a> ›
      <?php the_category(' › '); ?> ›
      <span><?php the_title(); ?></span>
    </nav>

  </div>
</main>


<?php endwhile; endif; ?>

<?php get_footer(); ?>
