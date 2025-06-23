<?php
/*
Template Name: Personalizowany nadruk
*/
get_header();
?>

<div id="customizer" class="customizer">
  <h1>Na co to komu? Tobie – jeśli chcesz wyglądać, jakbyś miał własny merch… bo możesz!</h1>
  <form id="printForm">
    <div class="customizer-section">
      <label>Produkt
        <select id="product" name="product">
          <option value="koszulka">Koszulka</option>
          <option value="bluza">Bluza</option>
          <option value="torba">Torba</option>
          <option value="czapka">Czapka</option>
        </select>
      </label>
      <label>Kolor
        <select id="color" name="color">
          <option value="#000">Czarny</option>
          <option value="#fff">Biały</option>
          <option value="#007BFF">Niebieski</option>
        </select>
      </label>
      <label>Rozmiar
        <select id="size" name="size">
          <option value="S">S</option>
          <option value="M">M</option>
          <option value="L">L</option>
          <option value="XL">XL</option>
          <option value="XXL">XXL</option>
        </select>
      </label>
    </div>

    <div class="customizer-section">
      <h3>Nadruk przód</h3>
      <label><input type="radio" name="frontType" value="text" checked> Tekst</label>
      <label><input type="radio" name="frontType" value="image"> Grafika</label>
      <div id="frontTextWrap">
        <input type="text" id="frontText" placeholder="Twój tekst">
      </div>
      <div id="frontImageWrap" class="hidden">
        <input type="file" id="frontImage" accept="image/png,image/jpeg,image/svg+xml">
      </div>

      <h3>Nadruk tył</h3>
      <label><input type="radio" name="backType" value="none" checked> Brak</label>
      <label><input type="radio" name="backType" value="text"> Tekst</label>
      <label><input type="radio" name="backType" value="image"> Grafika</label>
      <div id="backTextWrap" class="hidden">
        <input type="text" id="backText" placeholder="Tekst na plecach">
      </div>
      <div id="backImageWrap" class="hidden">
        <input type="file" id="backImage" accept="image/png,image/jpeg,image/svg+xml">
      </div>
    </div>

    <div class="customizer-section">
      <h3>Podgląd</h3>
      <div id="preview">
        <div class="mockup">
          <span id="previewTextFront" class="preview-text"></span>
          <img id="previewImgFront" class="preview-image" alt="Podgląd przód" />
        </div>
        <div class="mockup">
          <span id="previewTextBack" class="preview-text"></span>
          <img id="previewImgBack" class="preview-image" alt="Podgląd tył" />
        </div>
      </div>
    </div>

    <div class="customizer-section">
      <h3>Twoje dane</h3>
      <input type="text" id="clientName" placeholder="Imię i nazwisko" required>
      <input type="email" id="clientEmail" placeholder="E-mail" required>
      <input type="tel" id="clientPhone" placeholder="Numer telefonu (opcjonalnie)">
      <button type="submit" class="btn btn--primary">Wyślij zapytanie</button>
    </div>
  </form>

  <div id="summary" class="hidden">
    <h3>Podsumowanie</h3>
    <pre id="summaryContent"></pre>
    <p>Dziękujemy! Skontaktujemy się wkrótce.</p>
  </div>
</div>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/customizer.js"></script>
<?php
get_footer();
