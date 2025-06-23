document.addEventListener('DOMContentLoaded', () => {
  const product = document.getElementById('product');
  const color = document.getElementById('color');
  const size = document.getElementById('size');
  const frontTypeRadios = document.querySelectorAll('input[name="frontType"]');
  const frontTextWrap = document.getElementById('frontTextWrap');
  const frontImageWrap = document.getElementById('frontImageWrap');
  const frontText = document.getElementById('frontText');
  const frontImage = document.getElementById('frontImage');
  const backTypeRadios = document.querySelectorAll('input[name="backType"]');
  const backTextWrap = document.getElementById('backTextWrap');
  const backImageWrap = document.getElementById('backImageWrap');
  const backText = document.getElementById('backText');
  const backImage = document.getElementById('backImage');

  const previewFrontText = document.getElementById('previewTextFront');
  const previewFrontImg = document.getElementById('previewImgFront');
  const previewBackText = document.getElementById('previewTextBack');
  const previewBackImg = document.getElementById('previewImgBack');
  const mockups = document.querySelectorAll('#preview .mockup');

  function updateMockupColors() {
    mockups.forEach(m => m.style.background = color.value);
  }

  function toggleFrontInputs() {
    const type = document.querySelector('input[name="frontType"]:checked').value;
    frontTextWrap.classList.toggle('hidden', type !== 'text');
    frontImageWrap.classList.toggle('hidden', type !== 'image');
  }

  function toggleBackInputs() {
    const type = document.querySelector('input[name="backType"]:checked').value;
    backTextWrap.classList.toggle('hidden', type !== 'text');
    backImageWrap.classList.toggle('hidden', type !== 'image');
  }

  function updatePreview() {
    updateMockupColors();
    const frontType = document.querySelector('input[name="frontType"]:checked').value;
    if (frontType === 'text') {
      previewFrontText.textContent = frontText.value;
      previewFrontText.style.display = 'block';
      previewFrontImg.style.display = 'none';
    } else if (frontType === 'image' && frontImage.files[0]) {
      previewFrontImg.src = URL.createObjectURL(frontImage.files[0]);
      previewFrontImg.style.display = 'block';
      previewFrontText.style.display = 'none';
    } else {
      previewFrontText.textContent = '';
      previewFrontImg.style.display = 'none';
    }

    const backType = document.querySelector('input[name="backType"]:checked').value;
    if (backType === 'text') {
      previewBackText.textContent = backText.value;
      previewBackText.style.display = 'block';
      previewBackImg.style.display = 'none';
    } else if (backType === 'image' && backImage.files[0]) {
      previewBackImg.src = URL.createObjectURL(backImage.files[0]);
      previewBackImg.style.display = 'block';
      previewBackText.style.display = 'none';
    } else {
      previewBackText.textContent = '';
      previewBackImg.style.display = 'none';
    }
  }

  frontTypeRadios.forEach(r => r.addEventListener('change', () => { toggleFrontInputs(); updatePreview(); }));
  backTypeRadios.forEach(r => r.addEventListener('change', () => { toggleBackInputs(); updatePreview(); }));
  [frontText, frontImage, backText, backImage, color].forEach(el => el.addEventListener('input', updatePreview));
  [frontImage, backImage].forEach(el => el.addEventListener('change', updatePreview));

  color.addEventListener('change', updateMockupColors);

  toggleFrontInputs();
  toggleBackInputs();
  updatePreview();

  document.getElementById('printForm').addEventListener('submit', e => {
    e.preventDefault();
    const data = {
      produkt: product.value,
      kolor: color.options[color.selectedIndex].text.toLowerCase(),
      rozmiar: size.value,
      nadrukPrzod: {},
      nadrukTyl: {},
      klient: {
        imie: document.getElementById('clientName').value,
        email: document.getElementById('clientEmail').value,
        telefon: document.getElementById('clientPhone').value
      }
    };

    const frontType = document.querySelector('input[name="frontType"]:checked').value;
    if (frontType === 'text') {
      data.nadrukPrzod = { typ: 'tekst', wartosc: frontText.value };
    } else if (frontType === 'image' && frontImage.files[0]) {
      data.nadrukPrzod = { typ: 'grafika', url: frontImage.files[0].name };
    }

    const backType = document.querySelector('input[name="backType"]:checked').value;
    if (backType === 'text') {
      data.nadrukTyl = { typ: 'tekst', wartosc: backText.value };
    } else if (backType === 'image' && backImage.files[0]) {
      data.nadrukTyl = { typ: 'grafika', url: backImage.files[0].name };
    }

    fetch('https://nacotokomu.app.n8n.cloud/webhook/kreator', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    })
    .then(() => {
      document.getElementById('summaryContent').textContent = JSON.stringify(data, null, 2);
      document.getElementById('summary').classList.remove('hidden');
      document.getElementById('printForm').classList.add('hidden');
    })
    .catch(() => alert('Wystąpił błąd. Spróbuj ponownie później.'));
  });
});
