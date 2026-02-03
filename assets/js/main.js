/**
 * TechFlow Solutions - Landing Page
 * Main JavaScript File
 *
 * Features:
 * - Form validation and submission
 * - Scroll animations
 * - FAQ accordion
 * - Phone mask
 * - Smooth scroll
 */

// =============================================
// Utility Functions
// =============================================

/**
 * Debounce function to limit event firing
 */
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

/**
 * Check if element is in viewport
 */
function isInViewport(element) {
  const rect = element.getBoundingClientRect();
  return (
    rect.top >= 0 &&
    rect.left >= 0 &&
    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
  );
}

/**
 * Check if element is partially in viewport
 */
function isPartiallyInViewport(element, offset = 100) {
  const rect = element.getBoundingClientRect();
  const windowHeight = window.innerHeight || document.documentElement.clientHeight;
  return (
    rect.top <= windowHeight - offset &&
    rect.bottom >= offset
  );
}

// =============================================
// Phone Mask
// =============================================

/**
 * Apply phone mask to input
 */
function phoneMask(value) {
  if (!value) return '';
  value = value.replace(/\D/g, '');
  value = value.replace(/(\d{2})(\d)/, '($1) $2');
  value = value.replace(/(\d)(\d{4})$/, '$1-$2');
  return value;
}

// Apply mask to phone input
const phoneInput = document.getElementById('phone');
if (phoneInput) {
  phoneInput.addEventListener('input', (e) => {
    e.target.value = phoneMask(e.target.value);
  });
}

// =============================================
// Form Validation
// =============================================

const contactForm = document.getElementById('contactForm');
const successMessage = document.getElementById('successMessage');
const errorMessageGlobal = document.getElementById('errorMessageGlobal');

/**
 * Validate email format
 */
function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

/**
 * Validate phone format
 */
function isValidPhone(phone) {
  const phoneRegex = /^\(\d{2}\)\s\d{4,5}-\d{4}$/;
  return phoneRegex.test(phone);
}

/**
 * Show error message for a field
 */
function showError(fieldId, errorId) {
  const field = document.getElementById(fieldId);
  const error = document.getElementById(errorId);

  if (field && error) {
    field.classList.add('error');
    error.classList.add('visible');
  }
}

/**
 * Hide error message for a field
 */
function hideError(fieldId, errorId) {
  const field = document.getElementById(fieldId);
  const error = document.getElementById(errorId);

  if (field && error) {
    field.classList.remove('error');
    error.classList.remove('visible');
  }
}

/**
 * Validate form field
 */
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

/**
 * Validate entire form
 */
function validateForm() {
  let isValid = true;

  // Validate name
  if (!validateField('name', 'nameError')) {
    isValid = false;
  }

  // Validate email
  if (!validateField('email', 'emailError', isValidEmail)) {
    isValid = false;
  }

  // Validate phone
  if (!validateField('phone', 'phoneError', isValidPhone)) {
    isValid = false;
  }

  // Validate message
  if (!validateField('message', 'messageError')) {
    isValid = false;
  }

  return isValid;
}

// Add real-time validation
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

    // Remove error on input
    field.addEventListener('input', () => {
      const errorId = `${fieldId}Error`;
      if (field.value.trim()) {
        hideError(fieldId, errorId);
      }
    });
  }
});

// =============================================
// Form Submission
// =============================================

if (contactForm) {
  contactForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    // Hide previous messages
    successMessage.classList.remove('visible');
    errorMessageGlobal.classList.remove('visible');

    // Validate form
    if (!validateForm()) {
      return;
    }

    // Get form data
    const formData = new FormData(contactForm);
    const submitBtn = contactForm.querySelector('.submit-btn');
    const btnText = submitBtn.querySelector('.btn-text');

    // Disable button and show loading
    submitBtn.disabled = true;
    const originalText = btnText.textContent;
    btnText.textContent = 'Enviando...';

    try {
      // Submit form
      const response = await fetch(contactForm.action, {
        method: 'POST',
        body: formData
      });

      const result = await response.json();

      if (result.success) {
        // Show success message
        successMessage.classList.add('visible');

        // Reset form
        contactForm.reset();

        // Hide success message after 5 seconds
        setTimeout(() => {
          successMessage.classList.remove('visible');
        }, 5000);
      } else {
        // Show error message
        errorMessageGlobal.textContent = result.message || 'Ocorreu um erro ao enviar o formulário. Tente novamente.';
        errorMessageGlobal.classList.add('visible');

        // Hide error message after 5 seconds
        setTimeout(() => {
          errorMessageGlobal.classList.remove('visible');
        }, 5000);
      }
    } catch (error) {
      console.error('Error submitting form:', error);
      errorMessageGlobal.textContent = 'Ocorreu um erro ao enviar o formulário. Tente novamente.';
      errorMessageGlobal.classList.add('visible');

      // Hide error message after 5 seconds
      setTimeout(() => {
        errorMessageGlobal.classList.remove('visible');
      }, 5000);
    } finally {
      // Re-enable button
      submitBtn.disabled = false;
      btnText.textContent = originalText;
    }
  });
}

// =============================================
// Scroll Animations
// =============================================

/**
 * Animate elements on scroll
 */
function animateOnScroll() {
  const elements = document.querySelectorAll('.fade-in-up');

  elements.forEach(element => {
    if (isPartiallyInViewport(element, 100)) {
      element.classList.add('visible');
    }
  });
}

// Initialize scroll animations
animateOnScroll();

// Listen to scroll events with debounce
window.addEventListener('scroll', debounce(animateOnScroll, 50));

// =============================================
// FAQ Accordion
// =============================================

const faqQuestions = document.querySelectorAll('.faq-question');

faqQuestions.forEach(question => {
  question.addEventListener('click', () => {
    const isActive = question.classList.contains('active');
    const answer = question.nextElementSibling;

    // Close all other FAQs
    faqQuestions.forEach(q => {
      if (q !== question) {
        q.classList.remove('active');
        q.setAttribute('aria-expanded', 'false');
        q.nextElementSibling.classList.remove('active');
      }
    });

    // Toggle current FAQ
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

// =============================================
// Smooth Scroll
// =============================================

/**
 * Smooth scroll to anchor links
 */
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    const href = this.getAttribute('href');

    // Ignore empty anchors
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

// =============================================
// Header Scroll Effect
// =============================================

/**
 * Add shadow to header on scroll
 */
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

// =============================================
// Performance Optimization
// =============================================

/**
 * Lazy load images when they come into viewport
 */
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

// Initialize lazy loading if images exist
if (document.querySelectorAll('img[data-src]').length > 0) {
  lazyLoadImages();
}

// =============================================
// Initialize on DOM Load
// =============================================

document.addEventListener('DOMContentLoaded', () => {
  console.log('TechFlow Solutions - Landing Page loaded successfully! 🚀');

  // Trigger initial scroll animation
  animateOnScroll();
});

// =============================================
// Page Visibility API - Pause animations when tab is not visible
// =============================================

document.addEventListener('visibilitychange', () => {
  if (document.hidden) {
    // Page is hidden - pause animations if needed
    console.log('Page hidden');
  } else {
    // Page is visible - resume animations
    console.log('Page visible');
    animateOnScroll();
  }
});
