// =============================
// main.js – EcoBlog Pro
// =============================

document.addEventListener('DOMContentLoaded', () => {
  // 🔽 Mobilne menu toggle
  const menuToggle = document.getElementById('menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');

  if (menuToggle && mobileMenu) {
    menuToggle.addEventListener('click', () => {
      const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
      menuToggle.setAttribute('aria-expanded', !isExpanded);
      mobileMenu.hidden = isExpanded;
    });
  }

  // 🔝 Scroll to top
  const scrollBtn = document.createElement('button');
  scrollBtn.innerText = '↑';
  scrollBtn.setAttribute('aria-label', 'Wróć na górę');
  scrollBtn.className = 'scroll-to-top';
  document.body.appendChild(scrollBtn);

  window.addEventListener('scroll', () => {
    if (window.scrollY > 400) {
      scrollBtn.classList.add('visible');
    } else {
      scrollBtn.classList.remove('visible');
    }
  });

  scrollBtn.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  // 🐌 Lazy-load fade-in
  const lazyImages = document.querySelectorAll('img[loading="lazy"]');
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('lazyloaded');
        observer.unobserve(entry.target);
      }
    });
  }, {
    rootMargin: '0px 0px 200px 0px',
    threshold: 0.1
  });

  lazyImages.forEach(img => observer.observe(img));

  // 📱 GA4 kliknięcia menu – (opcjonalnie)
  /*
  document.querySelectorAll('.menu a').forEach(link => {
    link.addEventListener('click', () => {
      gtag('event', 'click', {
        event_category: 'menu',
        event_label: link.href
      });
    });
  });
  */
});


document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.getElementById('live-search');
  const resultsBox = document.getElementById('live-search-results');

  if (searchInput) {
    searchInput.addEventListener('input', () => {
      const query = searchInput.value.trim();

      if (query.length < 2) {
        resultsBox.style.display = 'none';
        return;
      }

      fetch(`${window.wp_ajax_url}?action=live_search&q=${encodeURIComponent(query)}`)
        .then(res => res.json())
        .then(data => {
          if (data.length) {
            resultsBox.innerHTML = `<ul>${data.map(post =>
              `<li><a href="${post.url}">${post.title}</a></li>`
            ).join('')}</ul>`;
            resultsBox.style.display = 'block';
          } else {
            resultsBox.innerHTML = '<p style="padding:10px;">Brak wyników</p>';
            resultsBox.style.display = 'block';
          }
        });
    });
  }
});
