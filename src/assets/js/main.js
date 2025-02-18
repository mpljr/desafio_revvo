// First Access Modal
class FirstAccessModal {
    constructor() {
      this.modal = document.getElementById('firstAccessModal');
      this.closeButton = document.getElementById('modalClose');
      this.actionButton = document.getElementById('modalButton');
      this.storageKey = 'leo_first_access';
      
      this.init();
    }
  
    init() {
      if (!this.hasVisited()) {
        this.show();
        this.setVisited();
      }
  
      this.closeButton.addEventListener('click', () => this.hide());
      this.actionButton.addEventListener('click', () => this.hide());
    }
  
    hasVisited() {
      return localStorage.getItem(this.storageKey) === 'true';
    }
  
    setVisited() {
      localStorage.setItem(this.storageKey, 'true');
    }
  
    show() {
      this.modal.classList.add('modal--visible');
      document.body.style.overflow = 'hidden';
    }
  
    hide() {
      this.modal.classList.remove('modal--visible');
      document.body.style.overflow = '';
    }
  }
  
  // Hero Slider
  class HeroSlider {
    constructor() {
      this.slider = document.getElementById('heroSlider');
      this.slides = Array.from(this.slider.querySelectorAll('.hero__slide'));
      this.dots = document.getElementById('heroDots');
      this.prevButton = document.getElementById('prevSlide');
      this.nextButton = document.getElementById('nextSlide');
      this.totalSlides = this.slides.length;
      this.currentSlide = 0;
      this.isAnimating = false;
      this.autoplayInterval = 5000;
  
      this.init();
    }
  
    init() {
      // Configurar slides iniciais
      this.slides.forEach((slide, index) => {
        if (index === 0) {
          slide.style.opacity = '1';
          slide.style.transform = 'translateX(0)';
          slide.style.visibility = 'visible';
          slide.style.zIndex = '2';
        } else {
          slide.style.opacity = '0';
          slide.style.transform = 'translateX(100%)';
          slide.style.visibility = 'hidden';
          slide.style.zIndex = '1';
        }
      });
  
      // Criar dots
      this.slides.forEach((_, index) => {
        const dot = document.createElement('button');
        dot.classList.add('hero__dot');
        if (index === 0) dot.classList.add('hero__dot--active');
        dot.setAttribute('aria-label', `Ir para slide ${index + 1}`);
        dot.addEventListener('click', () => this.goToSlide(index));
        this.dots.appendChild(dot);
      });
  
      // Adicionar event listeners
      this.prevButton.addEventListener('click', () => this.prevSlide());
      this.nextButton.addEventListener('click', () => this.nextSlide());
  
      // Adicionar navegação por teclado
      document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') this.prevSlide();
        if (e.key === 'ArrowRight') this.nextSlide();
      });
  
      // Adicionar suporte a touch
      let touchStartX = 0;
      this.slider.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
      }, { passive: true });
  
      this.slider.addEventListener('touchend', (e) => {
        const touchEndX = e.changedTouches[0].screenX;
        const diff = touchStartX - touchEndX;
  
        if (Math.abs(diff) > 50) { // Threshold para swipe
          if (diff > 0) {
            this.nextSlide();
          } else {
            this.prevSlide();
          }
        }
      }, { passive: true });
  
      // Iniciar autoplay
      this.startAutoplay();
  
      // Pausar autoplay no hover
      this.slider.addEventListener('mouseenter', () => this.stopAutoplay());
      this.slider.addEventListener('mouseleave', () => this.startAutoplay());
    }
  
    updateSlides() {
      if (this.isAnimating) return;
  
      this.isAnimating = true;
  
      // Atualizar slides
      this.slides.forEach((slide, index) => {
        slide.style.visibility = 'visible';
        
        if (index === this.currentSlide) {
          slide.style.transform = 'translateX(0)';
          slide.style.opacity = '1';
          slide.style.zIndex = '2';
        } else {
          const direction = index > this.currentSlide ? 100 : -100;
          slide.style.transform = `translateX(${direction}%)`;
          slide.style.opacity = '0';
          slide.style.zIndex = '1';
        }
      });
  
      // Atualizar dots
      const dots = this.dots.querySelectorAll('.hero__dot');
      dots.forEach((dot, index) => {
        dot.classList.toggle('hero__dot--active', index === this.currentSlide);
      });
  
      // Reset animating flag
      setTimeout(() => {
        this.isAnimating = false;
        this.slides.forEach((slide, index) => {
          if (index !== this.currentSlide) {
            slide.style.visibility = 'hidden';
          }
        });
      }, 500);
    }
  
    goToSlide(index) {
      if (this.isAnimating || index === this.currentSlide) return;
      this.currentSlide = index;
      this.updateSlides();
    }
  
    nextSlide() {
      if (this.isAnimating) return;
      this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
      this.updateSlides();
    }
  
    prevSlide() {
      if (this.isAnimating) return;
      this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
      this.updateSlides();
    }
  
    startAutoplay() {
      this.stopAutoplay();
      this.autoplayTimer = setInterval(() => this.nextSlide(), this.autoplayInterval);
    }
  
    stopAutoplay() {
      if (this.autoplayTimer) {
        clearInterval(this.autoplayTimer);
        this.autoplayTimer = null;
      }
    }
  }
  
  // User Menu
  class UserMenu {
    constructor() {
      this.toggle = document.querySelector('.user-menu__toggle');
      this.menu = document.querySelector('.user-menu');
      
      this.init();
    }
  
    init() {
      this.toggle.addEventListener('click', () => {
        this.menu.classList.toggle('user-menu--open');
      });
  
      // Close menu when clicking outside
      document.addEventListener('click', (event) => {
        if (!this.menu.contains(event.target)) {
          this.menu.classList.remove('user-menu--open');
        }
      });
    }
  }
  
  // Initialize components
  document.addEventListener('DOMContentLoaded', () => {
    new FirstAccessModal();
    new HeroSlider();
    new UserMenu();
  });