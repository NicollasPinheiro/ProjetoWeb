 <header class="cabecalho">
        <div class="cabecalho__container_logo container" id="container_logo">
            <nav class="cabecalho__cabecalho__container_logo__nav">
                <div class="logo" id="logo">
                    <a class="link" href="<?= getenv('URL_SITE') ?>"> 
                        <img class="logo_img" src="<?= getenv('URL_SITE') ?>/assets/img/logo/Gamerave.png" alt="TecLog - Tecnologia e Inovação"> 
                    </a>
                </div>
                <div class="cabecalho__cabecalho__container_logo__nav__menu d-none  d-md-block d-lg-block">
                    <ul>
                        <li><a class="link" href="/301_estudante_/">Home</a></li><!--Nome da pasta do projeto para redirecionar corretamente para HOME -->
                        <li><a class="link" href="sobre-nos">Sobre nós</a></li>
                        <li><a class="link" href="contato">Contato</a></li>
                        <li><a class="link" href="produtos">Produtos</a></li>
                  <li class="menu-dropdown">
                            <a class="dropdown-toggle" >
                                Login <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu-login">
                                <li>
                                    <a href="<?= getenv('URL_SITE') ?>/login">
                                        Entrar
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= getenv('URL_SITE') ?>/cadastro">
                                        Criar conta</a>
                                </li>
                                <li>
                                    <a href="<?= getenv('URL_SITE') ?>/admin/login">
                                        Área Administrativa</a>
                                </li>
                            </ul>
                        </li>
                </div>

                <div class="btn_mobile d-block d-md-none d-lg-none" id="btn_mobile">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </div>
            </nav>

            <!-- Menu mobile -->
            <nav class="menu_mobile d-lg-none" id="menu_mobile">
                <ul>
                    <li><a class="link" href="/301_estudante_/">Home</a></li><!--Nome da pasta do projeto para redirecionar corretamente para HOME -->
                    <li><a class="link" href="sobre-nos">Sobre nós</a></li>
                    <li><a class="link" href="contato">Contato</a></li>
                    <li><a class="link" href="produtos">Produtos</a></li>
             <li class="menu-dropdown">
                            <a class="dropdown-toggle" >
                                Login <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu-login">
                                <li>
                                    <a href="<?= getenv('URL_SITE') ?>/login">
                                        Entrar
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= getenv('URL_SITE') ?>/cadastro">
                                        Criar conta</a>
                                </li>
                                <li>
                                    <a href="<?= getenv('URL_SITE') ?>/admin/login">
                                        Área Administrativa</a>
                                </li>
                            </ul>
                        </li>
            </nav>
            <div class="overlay"></div>
            <!-- Fim menu mobile  -->
        </div>
    </header>
 