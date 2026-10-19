<?php include 'includes/header.php'; ?>

<main class="destinations-page">

    <!-- PAGE HERO -->
    <section class="destinations-hero">

        <div class="destinations-hero-overlay"></div>

        <div class="destinations-hero-content">

            <span class="destinations-eyebrow">
                OMEGA JOURNEYS
            </span>

            <h1>
                Global Destinations
            </h1>

            <p>
                Discover extraordinary cities, unforgettable cultures,
                and seamless connections across the world.
            </p>

        </div>

    </section>


    <!-- DESTINATIONS -->
    <section class="destinations-content">

        <div class="destinations-heading">

            <div>
                <span class="section-label">
                    EXPLORE THE WORLD
                </span>

                <h2>
                    Where will you go next?
                </h2>
            </div>

            <p>
                Explore our premier destinations and experience
                the world with Omega Airlines.
            </p>

        </div>


        <div class="destination-cards">


            <!-- TOKYO -->
            <article class="destination-card-new">

                <div class="destination-image">

                    <img
                        src="https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?auto=format&fit=crop&w=1200&q=85"
                        alt="Tokyo city skyline at night"
                    >

                    <div class="destination-image-overlay"></div>

                    <span class="destination-code">
                        HND
                    </span>

                </div>

                <div class="destination-details">

                    <div class="destination-title-row">

                        <div>
                            <span class="destination-country">
                                JAPAN
                            </span>

                            <h3>
                                Tokyo
                            </h3>
                        </div>

                        <i class="fa-solid fa-arrow-up-right-from-square"></i>

                    </div>

                    <p>
                        Experience the intersection of ancient tradition
                        and futuristic innovation.
                    </p>

                    <div class="destination-footer">

                        <span>
                            <i class="fa-solid fa-plane"></i>
                            Daily direct flights
                        </span>

                        <span class="explore-text">
                            Explore
                            <i class="fa-solid fa-arrow-right"></i>
                        </span>

                    </div>

                </div>

            </article>


            <!-- PARIS -->
            <article class="destination-card-new">

                <div class="destination-image">

                    <img
                        src="https://images.unsplash.com/photo-1502602898657-3e91760cbb34?auto=format&fit=crop&w=1200&q=85"
                        alt="Eiffel Tower in Paris"
                    >

                    <div class="destination-image-overlay"></div>

                    <span class="destination-code">
                        CDG
                    </span>

                </div>

                <div class="destination-details">

                    <div class="destination-title-row">

                        <div>
                            <span class="destination-country">
                                FRANCE
                            </span>

                            <h3>
                                Paris
                            </h3>
                        </div>

                        <i class="fa-solid fa-arrow-up-right-from-square"></i>

                    </div>

                    <p>
                        Immerse yourself in world-class art, culinary
                        mastery, and timeless architecture.
                    </p>

                    <div class="destination-footer">

                        <span>
                            <i class="fa-solid fa-plane"></i>
                            Daily direct flights
                        </span>

                        <span class="explore-text">
                            Explore
                            <i class="fa-solid fa-arrow-right"></i>
                        </span>

                    </div>

                </div>

            </article>


            <!-- NEW YORK -->
            <article class="destination-card-new">

                <div class="destination-image">

                    <img
                        src="https://images.unsplash.com/photo-1485871981521-5b1fd3805eee?auto=format&fit=crop&w=1200&q=85"
                        alt="New York City skyline"
                    >

                    <div class="destination-image-overlay"></div>

                    <span class="destination-code">
                        JFK
                    </span>

                </div>

                <div class="destination-details">

                    <div class="destination-title-row">

                        <div>
                            <span class="destination-country">
                                UNITED STATES
                            </span>

                            <h3>
                                New York
                            </h3>
                        </div>

                        <i class="fa-solid fa-arrow-up-right-from-square"></i>

                    </div>

                    <p>
                        Fly directly into the heart of the city that
                        never sleeps with our luxury fleet.
                    </p>

                    <div class="destination-footer">

                        <span>
                            <i class="fa-solid fa-plane"></i>
                            Multiple daily flights
                        </span>

                        <span class="explore-text">
                            Explore
                            <i class="fa-solid fa-arrow-right"></i>
                        </span>

                    </div>

                </div>

            </article>


        </div>

    </section>


    <!-- BOTTOM CTA -->
    <section class="destination-cta">

        <div>

            <span class="section-label">
                YOUR NEXT ADVENTURE
            </span>

            <h2>
                The world is waiting.
            </h2>

            <p>
                From Tokyo's energy to Parisian elegance and
                New York's endless possibilities.
            </p>

        </div>

        <a href="index.php" class="destination-cta-button">
            Plan Your Journey
            <i class="fa-solid fa-arrow-right"></i>
        </a>

    </section>

</main>


<!-- DESTINATION PAGE STYLES -->
<style>

    /* =====================================================
       DESTINATIONS PAGE
       ===================================================== */

    .destinations-page {
        background: #f6f7f9;
        color: #172337;
    }


    /* =====================================================
       HERO
       ===================================================== */

    .destinations-hero {
        position: relative;

        min-height: 480px;

        display: flex;
        align-items: center;
        justify-content: center;

        text-align: center;

        background-image:
            url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=2000&q=85');

        background-size: cover;
        background-position: center;

        overflow: hidden;
    }

    .destinations-hero-overlay {
        position: absolute;
        inset: 0;

        background:
            linear-gradient(
                180deg,
                rgba(6, 20, 38, 0.62),
                rgba(6, 20, 38, 0.78)
            );
    }

    .destinations-hero-content {
        position: relative;
        z-index: 2;

        max-width: 850px;

        padding: 120px 25px 60px;

        color: #ffffff;

        animation: destinationHeroIn 0.8s ease both;
    }

    .destinations-eyebrow {
        display: inline-block;

        margin-bottom: 18px;

        color: #d6ad38;

        font-size: 12px;
        font-weight: 700;

        letter-spacing: 4px;
    }

    .destinations-hero h1 {
        margin-bottom: 20px;

        font-size: clamp(3rem, 6vw, 5rem);
        font-weight: 800;

        letter-spacing: -2px;

        line-height: 1.05;
    }

    .destinations-hero p {
        max-width: 650px;

        margin: auto;

        color: rgba(255,255,255,0.82);

        font-size: 17px;
        line-height: 1.8;
    }


    /* =====================================================
       CONTENT
       ===================================================== */

    .destinations-content {
        max-width: 1250px;

        margin: auto;

        padding: 110px 5%;
    }

    .destinations-heading {
        display: flex;

        justify-content: space-between;
        align-items: end;

        gap: 50px;

        margin-bottom: 55px;
    }

    .section-label {
        display: block;

        margin-bottom: 12px;

        color: #d6ad38;

        font-size: 11px;
        font-weight: 700;

        letter-spacing: 3px;
    }

    .destinations-heading h2 {
        color: #061426;

        font-size: clamp(2.2rem, 4vw, 3.5rem);

        line-height: 1.1;

        letter-spacing: -1.5px;
    }

    .destinations-heading > p {
        max-width: 420px;

        color: #6d7a8d;

        font-size: 14px;

        line-height: 1.8;
    }


    /* =====================================================
       CARDS
       ===================================================== */

    .destination-cards {
        display: grid;

        grid-template-columns:
            repeat(3, minmax(0, 1fr));

        gap: 22px;
    }

    .destination-card-new {
        overflow: hidden;

        background: #ffffff;

        border: 1px solid #e1e5ea;

        box-shadow:
            0 10px 35px rgba(6, 20, 38, 0.06);

        transition:
            transform 0.4s cubic-bezier(.2,.7,.2,1),
            box-shadow 0.4s ease;
    }

    .destination-card-new:hover {
        transform: translateY(-10px);

        box-shadow:
            0 25px 55px rgba(6, 20, 38, 0.14);
    }


    /* =====================================================
       IMAGE
       ===================================================== */

    .destination-image {
        position: relative;

        height: 310px;

        overflow: hidden;
    }

    .destination-image img {
        width: 100%;
        height: 100%;

        display: block;

        object-fit: cover;

        transition:
            transform 0.8s cubic-bezier(.2,.7,.2,1);
    }

    .destination-card-new:hover
    .destination-image img {
        transform: scale(1.08);
    }

    .destination-image-overlay {
        position: absolute;
        inset: 0;

        background:
            linear-gradient(
                180deg,
                rgba(6,20,38,0.05),
                rgba(6,20,38,0.55)
            );
    }

    .destination-code {
        position: absolute;

        top: 20px;
        right: 20px;

        padding: 7px 11px;

        color: #ffffff;

        background: rgba(6,20,38,0.72);

        border: 1px solid rgba(255,255,255,0.25);

        backdrop-filter: blur(8px);

        font-size: 11px;
        font-weight: 700;

        letter-spacing: 1px;
    }


    /* =====================================================
       CARD DETAILS
       ===================================================== */

    .destination-details {
        padding: 28px;
    }

    .destination-title-row {
        display: flex;

        align-items: flex-start;
        justify-content: space-between;

        gap: 15px;

        margin-bottom: 15px;
    }

    .destination-country {
        display: block;

        margin-bottom: 5px;

        color: #d6ad38;

        font-size: 10px;
        font-weight: 700;

        letter-spacing: 2px;
    }

    .destination-title-row h3 {
        color: #061426;

        font-size: 29px;

        line-height: 1.1;
    }

    .destination-title-row > i {
        color: #d6ad38;

        font-size: 15px;

        transition: transform 0.3s ease;
    }

    .destination-card-new:hover
    .destination-title-row > i {
        transform: translate(3px, -3px);
    }

    .destination-details > p {
        min-height: 58px;

        margin-bottom: 22px;

        color: #6d7a8d;

        font-size: 13px;

        line-height: 1.8;
    }


    /* =====================================================
       CARD FOOTER
       ===================================================== */

    .destination-footer {
        display: flex;

        align-items: center;
        justify-content: space-between;

        gap: 15px;

        padding-top: 18px;

        border-top: 1px solid #e8ebef;

        color: #7b8797;

        font-size: 11px;
        font-weight: 600;
    }

    .destination-footer i {
        margin-right: 5px;

        color: #d6ad38;
    }

    .explore-text {
        color: #061426;

        white-space: nowrap;
    }

    .explore-text i {
        margin-left: 5px;
        margin-right: 0;

        transition: transform 0.3s ease;
    }

    .destination-card-new:hover
    .explore-text i {
        transform: translateX(5px);
    }


    /* =====================================================
       CTA
       ===================================================== */

    .destination-cta {
        display: flex;

        align-items: center;
        justify-content: space-between;

        gap: 40px;

        padding: 85px 8%;

        color: #ffffff;

        background: #061426;
    }

    .destination-cta h2 {
        margin-bottom: 10px;

        font-size: clamp(2rem, 4vw, 3.2rem);

        line-height: 1.1;

        letter-spacing: -1px;
    }

    .destination-cta p {
        color: rgba(255,255,255,0.58);

        font-size: 14px;
    }

    .destination-cta-button {
        display: inline-flex;

        align-items: center;

        gap: 15px;

        padding: 16px 24px;

        color: #061426;

        background: #d6ad38;

        font-size: 12px;
        font-weight: 700;

        white-space: nowrap;

        transition:
            transform 0.3s ease,
            background 0.3s ease,
            box-shadow 0.3s ease;
    }

    .destination-cta-button:hover {
        background: #e8c85a;

        transform: translateY(-3px);

        box-shadow:
            0 10px 30px rgba(214,173,56,0.2);
    }


    /* =====================================================
       ANIMATION
       ===================================================== */

    @keyframes destinationHeroIn {

        from {
            opacity: 0;
            transform: translateY(25px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }

    }


    /* =====================================================
       RESPONSIVE
       ===================================================== */

    @media (max-width: 900px) {

        .destination-cards {
            grid-template-columns: 1fr;
        }

        .destination-image {
            height: 360px;
        }

        .destinations-heading {
            flex-direction: column;

            align-items: flex-start;
        }

        .destination-cta {
            flex-direction: column;

            align-items: flex-start;
        }

    }


    @media (max-width: 600px) {

        .destinations-hero {
            min-height: 420px;
        }

        .destinations-hero h1 {
            font-size: 2.8rem;
        }

        .destinations-hero p {
            font-size: 14px;
        }

        .destinations-content {
            padding: 75px 5%;
        }

        .destinations-heading h2 {
            font-size: 2.3rem;
        }

        .destination-image {
            height: 280px;
        }

        .destination-details {
            padding: 22px;
        }

        .destination-cta {
            padding: 70px 7%;
        }

    }


    @media (prefers-reduced-motion: reduce) {

        .destinations-hero-content,
        .destination-card-new,
        .destination-image img,
        .destination-cta-button {
            animation: none !important;

            transition: none !important;
        }

    }

</style>


<?php include 'includes/footer.php'; ?>