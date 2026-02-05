<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="TechFlow Solutions - Transforme seu negócio com soluções digitais inovadoras">
    <meta name="keywords" content="transformação digital, consultoria, tecnologia, soluções digitais">
    <meta name="author" content="TechFlow Solutions">

    <title>TechFlow Solutions - Transformação Digital para o seu Negócio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="assets/css/style.css">

    <script src="https://unpkg.com/lucide@latest"></script>

    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%232563eb' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><polygon points='13 2 3 14 12 14 11 22 21 10 12 10 13 2'/></svg>">
</head>
<body>
    <header class="header">
        <div class="container">
            <a href="#" class="logo">
                <i data-lucide="zap"></i>
                <span>TechFlow</span>
            </a>
            <a href="https://api.whatsapp.com/send/?phone=5511912345678&text&type=phone_number&app_absent=0" class="contact-phone">
                <i data-lucide="phone"></i>
                <span>(11) 91234-5789</span>
            </a>
        </div>
    </header>

    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <h1>Transforme seu negócio com tecnologia de ponta</h1>
                <p>Oferecemos soluções digitais completas para impulsionar sua empresa rumo ao futuro. Nossa expertise em transformação digital garante resultados mensuráveis e crescimento sustentável.</p>
            </div>

            <div class="hero-form">
                <h3>Solicite uma Consultoria Gratuita</h3>

                <div id="successMessage" class="success-message">
                    Mensagem enviada com sucesso! Entraremos em contato em breve.
                </div>

                <div id="errorMessageGlobal" class="error-message-global">
                    Ocorreu um erro ao enviar o formulário. Tente novamente.
                </div>

                <form id="contactForm" method="POST" action="api/submit-form.php">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            placeholder="Seu nome completo"
                            required
                            autocomplete="name"
                        >
                        <span class="error-message" id="nameError">Por favor, insira seu nome</span>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="seu@email.com"
                            required
                            autocomplete="email"
                        >
                        <span class="error-message" id="emailError">Por favor, insira um e-mail válido</span>
                    </div>

                    <div class="form-group">
                        <label for="phone">Telefone</label>
                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            placeholder="(11) 91234-5789"
                            required
                            autocomplete="tel"
                        >
                        <span class="error-message" id="phoneError">Por favor, insira um telefone válido</span>
                    </div>

                    <div class="form-group">
                        <label for="message">Como podemos te ajudar?</label>
                        <textarea
                            id="message"
                            name="message"
                            placeholder="Descreva suas necessidades..."
                            required
                        ></textarea>
                        <span class="error-message" id="messageError">Por favor, descreva como podemos ajudar</span>
                    </div>

                    <button type="submit" class="submit-btn">
                        <span class="btn-text">Solicitar Consultoria</span>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <section class="about section" id="about">
        <div class="container">
            <div class="about-image fade-in-up">
                <img src="assets/images/image1.png" alt="TechFlow Solutions - Transformação Digital">
            </div>
            <div class="about-content fade-in-up">
                <h2>Quem Somos</h2>
                <p>
                    Somos a TechFlow Solutions, uma empresa especializada em transformação digital
                    com mais de 10 anos de experiência no mercado. Nossa missão é ajudar empresas
                    de todos os portes a alcançarem seu máximo potencial através da tecnologia.
                </p>
                <p>
                    Com uma equipe altamente qualificada e processos ágeis, entregamos soluções
                    personalizadas que geram resultados reais para nossos clientes. Conte conosco
                    para levar seu negócio ao próximo nível.
                </p>
            </div>
        </div>
    </section>

    <section class="services section" id="services">
        <div class="container">
            <div class="section-header">
                <h2>Soluções completas para transformar seu negócio</h2>
                <p>Com nossos serviços você</p>
            </div>

            <div class="services-grid">
                <div class="service-card fade-in-up">
                    <div class="service-icon"><i data-lucide="rocket"></i></div>
                    <h4>Acelera o Crescimento</h4>
                    <p>Implementamos estratégias digitais que impulsionam suas vendas e expandem sua presença no mercado de forma escalável.</p>
                </div>

                <div class="service-card fade-in-up">
                    <div class="service-icon"><i data-lucide="lightbulb"></i></div>
                    <h4>Inova Processos</h4>
                    <p>Modernizamos sua operação com tecnologias de ponta, aumentando eficiência e reduzindo custos operacionais.</p>
                </div>

                <div class="service-card fade-in-up">
                    <div class="service-icon"><i data-lucide="bar-chart-3"></i></div>
                    <h4>Toma Decisões Baseadas em Dados</h4>
                    <p>Fornecemos análises detalhadas e dashboards intuitivos para decisões estratégicas mais assertivas.</p>
                </div>

                <div class="service-card fade-in-up">
                    <div class="service-icon"><i data-lucide="shield-check"></i></div>
                    <h4>Garante Segurança</h4>
                    <p>Protegemos seus dados e sistemas com as melhores práticas de segurança da informação do mercado.</p>
                </div>

                <div class="service-card fade-in-up">
                    <div class="service-icon"><i data-lucide="zap"></i></div>
                    <h4>Otimiza Performance</h4>
                    <p>Aumentamos a velocidade e confiabilidade de suas aplicações para uma experiência superior do usuário.</p>
                </div>

                <div class="service-card fade-in-up">
                    <div class="service-icon"><i data-lucide="target"></i></div>
                    <h4>Alcança Resultados</h4>
                    <p>Focamos em entregas com impacto real no seu negócio, com métricas claras de sucesso e ROI positivo.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="faq section" id="faq">
        <div class="container">
            <div class="section-header">
                <h2>Perguntas Frequentes</h2>
            </div>

            <div class="faq-list">
                <div class="faq-item fade-in-up">
                    <button class="faq-question" type="button" aria-expanded="false">
                        Quanto tempo leva para ver resultados da transformação digital?
                    </button>
                    <div class="faq-answer">
                        <br>
                        <p>Os primeiros resultados podem ser observados já nas primeiras semanas, com ganhos de eficiência operacional. Resultados estratégicos mais profundos geralmente aparecem entre 3 e 6 meses, dependendo do escopo do projeto e da maturidade digital da empresa.</p>
                    </div>
                </div>

                <div class="faq-item fade-in-up">
                    <button class="faq-question" type="button" aria-expanded="false">
                        Quais são os custos envolvidos na consultoria?
                    </button>
                    <div class="faq-answer">
                        <br>
                        <p>Os custos variam conforme o tamanho da empresa e complexidade do projeto. Oferecemos uma consultoria inicial gratuita para entender suas necessidades e apresentar um orçamento personalizado. Nossos planos são flexíveis e adaptados ao seu orçamento.</p>
                    </div>
                </div>

                <div class="faq-item fade-in-up">
                    <button class="faq-question" type="button" aria-expanded="false">
                        Vocês oferecem suporte após a implementação?
                    </button>
                    <div class="faq-answer">
                        <br>
                        <p>Sim! Oferecemos diferentes planos de suporte contínuo, incluindo monitoramento, manutenção, atualizações e treinamento da equipe. Nossa parceria não termina na implementação, estamos ao seu lado durante toda a jornada.</p>
                    </div>
                </div>

                <div class="faq-item fade-in-up">
                    <button class="faq-question" type="button" aria-expanded="false">
                        É possível começar com um projeto piloto?
                    </button>
                    <div class="faq-answer">
                        <br>
                        <p>Absolutamente! Recomendamos começar com um projeto piloto para validar a abordagem e demonstrar valor antes de uma transformação completa. Isso reduz riscos e permite ajustes conforme necessário.</p>
                    </div>
                </div>

                <div class="faq-item fade-in-up">
                    <button class="faq-question" type="button" aria-expanded="false">
                        Como funciona o processo de consultoria?
                    </button>
                    <div class="faq-answer">
                        <section>
                            <ol>
                                <li>
                                    <strong>Diagnóstico</strong><br>
                                    Analisamos seu negócio a fundo para compreender objetivos, desafios e oportunidades.
                                </li>
                                <li>
                                    <strong>Planejamento</strong><br>
                                    Desenvolvemos uma estratégia personalizada, alinhada às suas necessidades e metas.
                                </li>
                                <li>
                                    <strong>Implementação</strong><br>
                                    Colocamos as soluções em prática com foco em eficiência e qualidade.
                                </li>
                                <li>
                                    <strong>Acompanhamento</strong><br>
                                    Monitoramos os resultados continuamente e realizamos ajustes para garantir a evolução constante.
                                </li>
                            </ol>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta section">
        <div class="container">
            <h2>Pronto para transformar seu negócio?</h2>
            <p>
                Agende uma chamada gratuita com nossos especialistas e descubra como
                podemos ajudar sua empresa a alcançar novos patamares de sucesso.
            </p>
            <a href="#home" class="btn">Solicitar Consultoria Gratuita</a>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2026 TechFlow Solutions. Todos os direitos reservados.</p>
            <p>CNPJ: 00.000.000/0001-00 | Fone: (11) 91234-5789</p>
        </div>
    </footer>

    <script src="assets/js/main.js"></script>

    <!-- Initialize Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
