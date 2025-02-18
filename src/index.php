<?php
require_once 'config/database.php';
require_once 'models/Course.php';
require_once 'models/Slideshow.php';

$database = new Database();
$db = $database->getConnection();

// Buscar slides
$slideshow = new Slideshow($db);
$slides = $slideshow->read();

// Buscar cursos
$course = new Course($db);
$courses = $course->read();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEO Learning Platform</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <!-- Modal de Primeiro Acesso -->
    <div class="modal" id="firstAccessModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <button class="modal__close" id="modalClose">
                <img src="https://api.iconify.design/mdi:close.svg" alt="Fechar">
            </button>
            <div class="modal__image">
                <img src="https://picsum.photos/800/400" alt="">
            </div>
            <h2 class="modal__title">EGESTAS TORTOR VULPUTATE</h2>
            <p class="modal__text">Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Donec ullamcorper nulla non metus auctor fringilla. Donec sed odio dui. Cras.</p>
            <button class="button button--block" id="modalButton">INSCREVA-SE</button>
        </div>
    </div>

    <!-- Modal de Adicionar Curso -->
    <div class="modal" id="addCourseModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <button class="modal__close" id="addCourseModalClose">
                <img src="https://api.iconify.design/mdi:close.svg" alt="Fechar">
            </button>
            <h2 class="modal__title">Adicionar Novo Curso</h2>
            <form id="addCourseForm" class="form">
                <div class="form__group">
                    <label for="courseTitle" class="form__label">Título</label>
                    <input type="text" id="courseTitle" name="title" class="form__input" required>
                </div>
                <div class="form__group">
                    <label for="courseDescription" class="form__label">Descrição</label>
                    <textarea id="courseDescription" name="description" class="form__input" required></textarea>
                </div>
                <div class="form__group">
                    <label for="courseImage" class="form__label">URL da Imagem</label>
                    <input type="url" id="courseImage" name="image_url" class="form__input" required>
                </div>
                <div class="form__actions">
                    <button type="button" class="button button--secondary" id="cancelAddCourse">Cancelar</button>
                    <button type="submit" class="button">Adicionar Curso</button>
                </div>
            </form>
        </div>
    </div>

    <header class="header">
        <div class="container header__container">
            <a href="/" class="logo">
                <img src="https://api.iconify.design/mdi:book-education.svg" alt="LEO" class="logo__image">
            </a>
            
            <div class="search">
                <input type="text" class="search__input" placeholder="Pesquisar cursos...">
                <button class="search__button">
                    <img src="https://api.iconify.design/mdi:magnify.svg" alt="Buscar">
                </button>
            </div>

            <div class="user-menu">
                <img src="https://i.pravatar.cc/150" alt="" class="user-menu__avatar">
                <span class="user-menu__name">John Doe</span>
                <button class="user-menu__toggle">
                    <img src="https://api.iconify.design/mdi:chevron-down.svg" alt="Abrir menu">
                </button>
            </div>
        </div>
    </header>

    <main class="main">
        <section class="hero">
            <div class="hero__slider" id="heroSlider">
                <?php 
                $slideIndex = 0;
                while ($slide = $slides->fetch(PDO::FETCH_ASSOC)): 
                ?>
                <div class="hero__slide" style="background-image: url('<?php echo htmlspecialchars($slide['image_url']); ?>');" data-index="<?php echo $slideIndex; ?>">
                    <div class="container">
                        <div class="hero__content">
                            <h1 class="hero__title"><?php echo htmlspecialchars($slide['title']); ?></h1>
                            <p class="hero__text"><?php echo htmlspecialchars($slide['description']); ?></p>
                            <a href="<?php echo htmlspecialchars($slide['button_link']); ?>" class="button">
                                <?php echo htmlspecialchars($slide['button_text']); ?>
                            </a>
                        </div>
                    </div>
                </div>
                <?php 
                $slideIndex++;
                endwhile; 
                ?>
            </div>
            <div class="hero__nav">
                <button class="hero__nav-button" id="prevSlide" aria-label="Slide anterior">
                    <img src="https://api.iconify.design/mdi:chevron-left.svg" alt="Anterior">
                </button>
                <div class="hero__dots" id="heroDots"></div>
                <button class="hero__nav-button" id="nextSlide" aria-label="Próximo slide">
                    <img src="https://api.iconify.design/mdi:chevron-right.svg" alt="Próximo">
                </button>
            </div>
        </section>

        <section class="courses">
            <div class="container">
                <h2 class="section-title">MEUS CURSOS</h2>
                
                <div class="courses__grid">
                    <?php while ($course = $courses->fetch(PDO::FETCH_ASSOC)): ?>
                    <article class="course-card">
                        <div class="course-card__image">
                            <img src="<?php echo htmlspecialchars($course['image_url']); ?>" alt="">
                        </div>
                        <div class="course-card__content">
                            <h3 class="course-card__title"><?php echo htmlspecialchars($course['title']); ?></h3>
                            <p class="course-card__description"><?php echo htmlspecialchars($course['description']); ?></p>
                            <a href="#" class="button button--block">VER CURSO</a>
                        </div>
                    </article>
                    <?php endwhile; ?>

                    <div class="course-card course-card--add">
                        <button class="course-card__add" id="addCourseButton">
                            <img src="https://api.iconify.design/mdi:plus.svg" alt="">
                            <span>ADICIONAR<br>CURSO</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container footer__container">
            <a href="/" class="logo logo--footer">
                <img src="https://api.iconify.design/mdi:book-education.svg" alt="LEO">
            </a>
            
            <p class="footer__description">
                Maecenas faucibus mollis interdum. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
            </p>

            <div class="footer__info">
                <div class="footer__contact">
                    <h4 class="footer__title">CONTATO</h4>
                    <p>(21) 98765-4321</p>
                    <p>contato@leolearning.com</p>
                </div>

                <div class="footer__social">
                    <h4 class="footer__title">REDES SOCIAIS</h4>
                    <div class="social-links">
                        <a href="#" class="social-links__item">
                            <img src="https://api.iconify.design/mdi:twitter.svg" alt="Twitter">
                        </a>
                        <a href="#" class="social-links__item">
                            <img src="https://api.iconify.design/mdi:youtube.svg" alt="YouTube">
                        </a>
                        <a href="#" class="social-links__item">
                            <img src="https://api.iconify.design/mdi:pinterest.svg" alt="Pinterest">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer__copyright">
            <div class="container">
                <p>Copyright 2017 - All right reserved.</p>
            </div>
        </div>
    </footer>

    <script src="assets/js/dist/main.js"></script>
</body>
</html>