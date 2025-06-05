<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="index, follow">
  <meta name="description" content="<?php bloginfo('description'); ?>">
  <?php wp_head(); ?>

<!-- Open Graph / Twitter -->
  <meta property="og:title" content="<?php wp_title(); ?>">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?php echo esc_url(get_permalink()); ?>">
  <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
  <meta property="og:image" content="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?php wp_title(); ?>">


</head>
<body <?php body_class(); ?>>

<header class="site-header header">
  <div class="container header__content">

    <!-- LOGO -->
    <div class="header__logo">
      <a href="https://ecocieplo.pl" aria-label="Strona główna">
        <img src="https://ecocieplo.pl/strefa-wiedzy/wp-content/uploads/2025/06/ecocieplo-logo.webp"
             alt="Eco Ciepło" class="logo-image">
        </a> <br>
             <a href="https://ecocieplo.pl/strefa-wiedzy" class="logo-text">Strefa wiedzy</a>
      </a>
    </div>

    <div class="search-live-wrapper">
  <input type="search" id="live-search" class="search-input" placeholder="Szukaj artykułów..." autocomplete="off">
  <button class="search-btn" aria-label="Szukaj">🔍</button>
  <div id="live-search-results" class="search-results"></div>
</div>

    <!-- PRZYCISK MOBILE MENU -->
    <button id="mobileMenuToggle" class="mobile-menu-toggle" aria-label="Otwórz menu">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </div>
</header>



 



</aside>




