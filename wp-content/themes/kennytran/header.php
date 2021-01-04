<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

        <title><?php wp_title(); ?></title>
        <meta name="description" content="">

        <!-- Icons -->
        <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
        <link rel="manifest" href="/favicons/site.webmanifest">
        <link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#080808">
        <link rel="shortcut icon" href="/favicons/favicon.ico">
        <meta name="msapplication-TileColor" content="#080808">
        <meta name="msapplication-config" content="/favicon/browserconfig.xml">
        <meta name="theme-color" content="#080808">

        <!-- Prevent FOUC -->
        <style>
            .is-dom-loading body {
                opacity: 0;
                visibility: hidden;
            }

            .is-dom-loading * {
                -webkit-transition: none!important;
                -moz-transition: none!important;
                -ms-transition: none!important;
                -o-transition: none!important;
                transition: none!important;
            }
        </style>
        <script>
            document.documentElement.className = 'js is-dom-loading';
        </script>
        <!-- END Prevent FOUC -->

        <!-- Analytics -->
        <?php if(!is_user_logged_in()) : ?>
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-133972208-1"></script>

            <script>
                window.dataLayer = window.dataLayer || [];

                function gtag() { dataLayer.push(arguments); }
                gtag('js', new Date());
                gtag('config', 'UA-133972208-1');
            </script>
        <?php endif; ?>

        <?php wp_head(); ?>
    </head>
    <body data-barba="wrapper">
        <a href="#main" class="c-skip-to-content c-button">Skip To Content</a>
        <header class="c-header">
            <div class="o-container">
                <div class="o-grid">
                    <div class="o-grid__row">
                        <div class="o-grid__column u-d-flex u-items-center">
                            <a href="/" class="c-header__logo">
                                <svg class="svg-logo-kenny-tran" xmlns="http://www.w3.org/2000/svg" width="129.23" height="18.71"><path d="M3.21 18.71H0V0h3.21v6.92h.06L6.63 0h3.22L6.38 6.97l3.91 11.74H7.02L4.41 10h-.06l-1.14 2.08v6.63zm19.9 0h-8.97V0h8.6v2.8h-5.39v4.82h4.15v2.8h-4.15v5.49h5.76v2.8zm6.75 0h-2.91V0h2.98l3.92 10.7h.05V0h2.9v18.71H34L29.91 7.02h-.05v11.69zm13.69 0h-2.9V0h2.98l3.91 10.7h.05V0h2.9v18.71H47.7L43.6 7.02h-.05v11.69zm17.89-7.77v7.77h-3.21v-7.77L54.34 0h3.26l2.26 7.13h.05L62.06 0h3.27l-3.89 10.94zm19.31 7.77V2.8h-3.11V0h9.43v2.8h-3.11v15.91h-3.21zM95.43 0c3.6 0 5.44 1.53 5.44 5.52 0 3-1.17 4.22-2.26 4.72l2.72 8.47h-3.26L95.79 11a16 16 0 01-1.66.08v7.67h-3.21V0zm-.16 2.64h-1.14V8.4h1.14c1.74 0 2.38-.65 2.38-2.88S97 2.64 95.27 2.64zM112.2 0l3.45 18.71h-3.11l-.54-4.14h-3.53l-.57 4.14h-3.11L108.21 0zm-2 3.73l-1.27 8h2.59zm12.08 14.98h-2.9V0h2.98l3.91 10.7h.05V0h2.91v18.71h-2.8l-4.1-11.69h-.05v11.69z"/></svg>
                            </a>
                            <button class="js-header-nav-trigger c-header__nav-trigger" aria-controls="header-nav" aria-expanded="false">Menu<span></span></button>
                            <nav id="header-nav" class="c-header__nav" hidden>
                                <ul class="c-header__menu">
                                    <li><a href="/projects/" >Projects</a></li>
                                    <li class="c-header__menu-seperator">&middot;</li>
                                    <li><a href="/posts/">Posts</a></li>
                                    <li class="c-header__menu-seperator">&boxv;</li>
                                    <li>
                                        <label class="c-header__theme-toggle" for="js-theme-toggle-input" id="js-theme-toggle">
                                            <input class="u-screen-reader" id="js-theme-toggle-input" type="checkbox" />
                                            <span class="c-header__theme-toggle-text" id="js-theme-toggle-text">Light Mode</span>
                                        </label>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div data-barba="container">
            <!-- #TODO: Find a better way than to set variables -->
            <?php
                $jumbotron_heading = '';
                $jumbotron_statement = '';

                if(is_page('Home')) :
                    $jumbotron_heading = '01 - I Code So You Don\'t Have To';
                    $jumbotron_statement = '<div>Web Engineer</div><div>& Consultant</div>';
                elseif(is_home()) :
                    $jumbotron_heading = '01 - My Thoughts';
                    $jumbotron_statement = '<div>Posts</div>';
                elseif(is_page('Projects')) :
                    $jumbotron_heading = '01 - What I\'ve Worked On';
                    $jumbotron_statement = '<div>Projects</div>';
                elseif(is_singular()) :
                    $jumbotron_heading = '01 - Post Title';
                    $jumbotron_statement = '<div>' . get_the_title() . '</div>';
                elseif(is_category()) :
                    $jumbotron_heading = '01 - Archive Title';
                    $jumbotron_statement = '<div>Categories</div>';
                elseif(is_tag()) :
                    $jumbotron_heading = '01 - Archive Title';
                    $jumbotron_statement = '<div>Tags</div>';
                endif;
            ?>
            <section class="c-jumbotron">
                <div class="c-jumbotron__content">
                    <div class="c-jumbotron__main">
                        <div class="o-container">
                            <h1 class="o-section-heading">
                                <?php echo $jumbotron_heading; ?>
                            </h1>
                            <div class="o-grid">
                                <div class="o-grid__row">
                                    <div class="o-grid__column">
                                        <div class="c-jumbotron__statement">
                                        <?php echo $jumbotron_statement; ?>
                                        </div>
                                        <div class="c-jumbotron__scroll-prompt"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="c-jumbotron__footer">
                        <div class="o-container">
                            <div class="o-grid">
                                <div class="o-grid__row">
                                    <div class="o-grid__column u-d-md-flex u-items-md-center u-text-center u-text-md-left">
                                        <p class="u-font-din u-mb-xs u-mb-md-none">Available for new projects from January 2021</p>
                                        <?php get_template_part('template-parts/social-icons'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </section>
            <div class="c-viewport">
                <div class="c-container">
                    <main class="c-main" id="main">
                        <div class="c-content">
