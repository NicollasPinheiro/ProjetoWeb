  // js do menu
        const btn = document.querySelector('.btn_mobile');
        const menu = document.querySelector('.menu_mobile');
        const overlay = document.querySelector('.overlay');

        function openMenu() {
            menu.classList.add('open');
            overlay.classList.add('show');
        }

        function closeMenu() {
            menu.classList.remove('open');
            overlay.classList.remove('show');
        }

        function toggleMenu() {
            menu.classList.contains('open') ? closeMenu() : openMenu();
        }

        btn.addEventListener('click', toggleMenu);
        overlay.addEventListener('click', closeMenu);
        //Fim js menu

        //js do carousel
        const carousel = document.getElementById('carousel');
        const track = carousel.querySelector('.carousel-track');
        const slides = Array.from(track.children);
        const prevBtn = carousel.querySelector('.prev');
        const nextBtn = carousel.querySelector('.next');
        const dotsContainer = carousel.querySelector('.carousel-dots');

        let currentIndex = 0;
        let autoPlay;

        slides.forEach((_, index) => {
            const dot = document.createElement("button");
            dot.classList.add("dot");
            if (index === 0) dot.classList.add("active");
            dot.addEventListener("click", () => goToSlide(index));
            dotsContainer.appendChild(dot);
        });

        const dots = Array.from(dotsContainer.children);

        function updateCarousel() {
            track.style.transform = `translateX(-${currentIndex * 100}%)`;

            dots.forEach(dot => dot.classList.remove("active"));
            dots[currentIndex].classList.add("active");
        }

        function goToSlide(index) {
            currentIndex = index;
            updateCarousel();
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            updateCarousel();
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
            updateCarousel();
        }

        nextBtn.addEventListener("click", nextSlide);
        prevBtn.addEventListener("click", prevSlide);

        function startAutoPlay() {
            autoPlay = setInterval(nextSlide, 4000);
        }

        function stopAutoPlay() {
            clearInterval(autoPlay);
        }

        carousel.addEventListener("mouseenter", stopAutoPlay);
        carousel.addEventListener("mouseleave", startAutoPlay);

        // Swipe no mobile
        let startX = 0;
        let endX = 0;

        carousel.addEventListener("touchstart", (e) => {
            startX = e.touches[0].clientX;
        });

        carousel.addEventListener("touchmove", (e) => {
            endX = e.touches[0].clientX;
        });

        carousel.addEventListener("touchend", () => {
            const distance = startX - endX;

            if (distance > 50) {
                nextSlide();
            } else if (distance < -50) {
                prevSlide();
            }
        });

        updateCarousel();
        startAutoPlay();
        //fim js carousel

        //Valida form newlistter
        const formContato = document.getElementById('formContato');
        const btnEnviar = document.getElementById('btnEnviar');
        const statusEnvio = document.getElementById('statusEnvio');

        const erroNome = document.getElementById('erroNome');
        const erroEmail = document.getElementById('erroEmail');
        const erroMensagem = document.getElementById('erroMensagem');

        formContato.addEventListener('submit', async function(e) {
            e.preventDefault();

            erroNome.textContent = '';
            erroEmail.textContent = '';
            erroMensagem.textContent = '';
            statusEnvio.textContent = '';
            statusEnvio.style.color = '';

            const nome = document.getElementById('nome').value.trim();
            const email = document.getElementById('email').value.trim();
            const mensagem = document.getElementById('mensagem').value.trim();

            let erro = false;

            if (nome === '') {
                erroNome.textContent = 'Informe seu nome.';
                erro = true;
            }

            if (email === '') {
                erroEmail.textContent = 'Informe seu e-mail.';
                erro = true;
            }

            if (mensagem === '') {
                erroMensagem.textContent = 'Informe sua mensagem.';
                erro = true;
            }

            if (erro) return;

            btnEnviar.disabled = true;
            btnEnviar.value = 'Enviando...';

            try {
                const formData = new FormData(formContato);

                const response = await fetch(formContato.action, {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (data.status === 'success') {
                    statusEnvio.style.color = 'green';
                    statusEnvio.textContent = data.message;
                    formContato.reset();
                } else {
                    statusEnvio.style.color = '#d40000';
                    statusEnvio.textContent = data.message;
                }

            } catch (error) {
                statusEnvio.style.color = '#d40000';
                statusEnvio.textContent = 'Erro inesperado ao enviar o formulário.';
            } finally {
                btnEnviar.disabled = false;
                btnEnviar.value = 'Enviar';
            }
        });