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
