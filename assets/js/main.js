function debounce(func, wait) {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
}

function isInViewport(element) {
  const rect = element.getBoundingClientRect();
  return (
    rect.top >= 0 &&
    rect.left >= 0 &&
    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
  );
}

function isPartiallyInViewport(element, offset = 100) {
  const rect = element.getBoundingClientRect();
  const windowHeight = window.innerHeight || document.documentElement.clientHeight;
  return (
    rect.top <= windowHeight - offset &&
    rect.bottom >= offset
  );
}

function phoneMask(value) {
  if (!value) return '';
  value = value.replace(/\D/g, '');
  value = value.replace(/(\d{2})(\d)/, '($1) $2');
  value = value.replace(/(\d)(\d{4})$/, '$1-$2');
  return value;
}

const phoneInput = document.getElementById('phone');
if (phoneInput) {
  phoneInput.addEventListener('input', (e) => {
    e.target.value = phoneMask(e.target.value);
  });
}

const contactForm = document.getElementById('contactForm');
const successMessage = document.getElementById('successMessage');
const errorMessageGlobal = document.getElementById('errorMessageGlobal');

function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function isValidPhone(phone) {
  const phoneRegex = /^\(\d{2}\)\s\d{4,5}-\d{4}$/;
  return phoneRegex.test(phone);
}

function showError(fieldId, errorId) {
  const field = document.getElementById(fieldId);
  const error = document.getElementById(errorId);

  if (field && error) {
    field.classList.add('error');
    error.classList.add('visible');
  }
}

function hideError(fieldId, errorId) {
  const field = document.getElementById(fieldId);
  const error = document.getElementById(errorId);

  if (field && error) {
    field.classList.remove('error');
    error.classList.remove('visible');
  }
}

function validateField(fieldId, errorId, validationFn = null) {
  const field = document.getElementById(fieldId);
  if (!field) return false;

  const value = field.value.trim();

  if (!value) {
    showError(fieldId, errorId);
    return false;
  }

  if (validationFn && !validationFn(value)) {
    showError(fieldId, errorId);
    return false;
  }

  hideError(fieldId, errorId);
  return true;
}

function validateForm() {
  let isValid = true;

  if (!validateField('name', 'nameError')) {
    isValid = false;
  }

  if (!validateField('email', 'emailError', isValidEmail)) {
    isValid = false;
  }

  if (!validateField('phone', 'phoneError', isValidPhone)) {
    isValid = false;
  }

  if (!validateField('message', 'messageError')) {
    isValid = false;
  }

  return isValid;
}

['name', 'email', 'phone', 'message'].forEach(fieldId => {
  const field = document.getElementById(fieldId);
  if (field) {
    field.addEventListener('blur', () => {
      const errorId = `${fieldId}Error`;

      if (fieldId === 'email') {
        validateField(fieldId, errorId, isValidEmail);
      } else if (fieldId === 'phone') {
        validateField(fieldId, errorId, isValidPhone);
      } else {
        validateField(fieldId, errorId);
      }
    });

    field.addEventListener('input', () => {
      const errorId = `${fieldId}Error`;
      if (field.value.trim()) {
        hideError(fieldId, errorId);
      }
    });
  }
});

if (contactForm) {
  contactForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    successMessage.classList.remove('visible');
    errorMessageGlobal.classList.remove('visible');

    if (!validateForm()) {
      return;
    }

    const formData = new FormData(contactForm);
    const submitBtn = contactForm.querySelector('.submit-btn');
    const btnText = submitBtn.querySelector('.btn-text');

    submitBtn.disabled = true;
    const originalText = btnText.textContent;
    btnText.textContent = 'Enviando...';

    try {
      const response = await fetch(contactForm.action, {
        method: 'POST',
        body: formData
      });

      const result = await response.json();

      if (result.success) {
        successMessage.classList.add('visible');

        contactForm.reset();

        setTimeout(() => {
          successMessage.classList.remove('visible');
        }, 5000);
      } else {
        errorMessageGlobal.textContent = result.message || 'Ocorreu um erro ao enviar o formulário. Tente novamente.';
        errorMessageGlobal.classList.add('visible');

        setTimeout(() => {
          errorMessageGlobal.classList.remove('visible');
        }, 5000);
      }
    } catch (error) {
      console.error('Error submitting form:', error);
      errorMessageGlobal.textContent = 'Ocorreu um erro ao enviar o formulário. Tente novamente.';
      errorMessageGlobal.classList.add('visible');

      setTimeout(() => {
        errorMessageGlobal.classList.remove('visible');
      }, 5000);
    } finally {
      submitBtn.disabled = false;
      btnText.textContent = originalText;
    }
  });
}

function animateOnScroll() {
  const elements = document.querySelectorAll('.fade-in-up');

  elements.forEach(element => {
    if (isPartiallyInViewport(element, 100)) {
      element.classList.add('visible');
    }
  });
}

animateOnScroll();

window.addEventListener('scroll', debounce(animateOnScroll, 50));

const faqQuestions = document.querySelectorAll('.faq-question');

faqQuestions.forEach(question => {
  question.addEventListener('click', () => {
    const isActive = question.classList.contains('active');
    const answer = question.nextElementSibling;

    faqQuestions.forEach(q => {
      if (q !== question) {
        q.classList.remove('active');
        q.setAttribute('aria-expanded', 'false');
        q.nextElementSibling.classList.remove('active');
      }
    });

    if (isActive) {
      question.classList.remove('active');
      question.setAttribute('aria-expanded', 'false');
      answer.classList.remove('active');
    } else {
      question.classList.add('active');
      question.setAttribute('aria-expanded', 'true');
      answer.classList.add('active');
    }
  });
});

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    const href = this.getAttribute('href');

    if (href === '#' || href === '#!') {
      e.preventDefault();
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
      return;
    }

    const target = document.querySelector(href);

    if (target) {
      e.preventDefault();

      const headerOffset = 80;
      const elementPosition = target.getBoundingClientRect().top;
      const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

      window.scrollTo({
        top: offsetPosition,
        behavior: 'smooth'
      });
    }
  });
});

let lastScroll = 0;
const header = document.querySelector('.header');

window.addEventListener('scroll', debounce(() => {
  const currentScroll = window.pageYOffset;

  if (currentScroll > 50) {
    header.style.boxShadow = '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)';
  } else {
    header.style.boxShadow = '0 1px 2px 0 rgba(0, 0, 0, 0.05)';
  }

  lastScroll = currentScroll;
}, 50));

function lazyLoadImages() {
  const images = document.querySelectorAll('img[data-src]');

  const imageObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const img = entry.target;
        img.src = img.dataset.src;
        img.removeAttribute('data-src');
        observer.unobserve(img);
      }
    });
  });

  images.forEach(img => imageObserver.observe(img));
}

if (document.querySelectorAll('img[data-src]').length > 0) {
  lazyLoadImages();
}

function initTheme() {
  const savedTheme = localStorage.getItem('theme');
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

  if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
    document.documentElement.setAttribute('data-theme', 'dark');
  } else {
    document.documentElement.setAttribute('data-theme', 'light');
  }
}

function toggleTheme() {
  const currentTheme = document.documentElement.getAttribute('data-theme');
  const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

  document.documentElement.setAttribute('data-theme', newTheme);
  localStorage.setItem('theme', newTheme);
}

initTheme();

const themeToggle = document.getElementById('themeToggle');
if (themeToggle) {
  themeToggle.addEventListener('click', toggleTheme);
}

window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
  if (!localStorage.getItem('theme')) {
    document.documentElement.setAttribute('data-theme', e.matches ? 'dark' : 'light');
  }
});

document.addEventListener('DOMContentLoaded', () => {
  console.log('TechFlow Solutions - Landing Page loaded successfully!');

  animateOnScroll();

  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }
});

document.addEventListener('visibilitychange', () => {
  if (document.hidden) {
    console.log('Page hidden');
  } else {
    console.log('Page visible');
    animateOnScroll();
  }
});
