(function () {
  const ajaxForms = document.querySelectorAll('[data-prime-match-form]');
  if (!ajaxForms.length || typeof PrimeMatchData === 'undefined') {
    return;
  }

  ajaxForms.forEach((form) => {
    form.addEventListener('submit', async (event) => {
      event.preventDefault();
      const endpoint = form.getAttribute('data-endpoint');
      const submitButton = form.querySelector('button[type="submit"]');
      if (!endpoint) {
        return;
      }
      const payload = Object.fromEntries(new FormData(form));
      submitButton.disabled = true;
      submitButton.dataset.label = submitButton.textContent;
      submitButton.textContent = 'Enviando...';

      try {
        const response = await fetch(`${PrimeMatchData.restUrl}${endpoint}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-WP-Nonce': PrimeMatchData.nonce
          },
          body: JSON.stringify(payload)
        });
        const result = await response.json();
        if (!response.ok) {
          throw new Error(result?.message || 'Erro ao enviar');
        }
        form.reset();
        submitButton.textContent = 'Recebido ✓';
        submitButton.classList.add('is-success');
        form.dispatchEvent(new CustomEvent('primeMatch:success', { detail: result }));
      } catch (error) {
        submitButton.textContent = 'Tentar novamente';
        alert(error.message);
      } finally {
        setTimeout(() => {
          submitButton.disabled = false;
          submitButton.textContent = submitButton.dataset.label;
        }, 3200);
      }
    });
  });
})();
