<?php include 'includes/header.php'; ?>
<?php if (isset($_GET['success']) && $_GET['success'] === '1'): ?>

    <div style="
        max-width: 900px;
        margin: 1.5rem auto;
        padding: 1rem 1.5rem;
        background: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
        border-radius: 8px;
        font-weight: 600;
        text-align: center;
    ">
        <i class="fa-solid fa-circle-check"></i>
        Your support request has been submitted successfully. We'll get back to you soon.
    </div>

<?php elseif (isset($_GET['error'])): ?>

    <div style="
        max-width: 900px;
        margin: 1.5rem auto;
        padding: 1rem 1.5rem;
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
        border-radius: 8px;
        font-weight: 600;
        text-align: center;
    ">
        <i class="fa-solid fa-circle-exclamation"></i>
        There was a problem submitting your request. Please check your details and try again.
    </div>

<?php endif; ?>

<main class="support-page">

    <!-- =====================================================
         SUPPORT HERO
         ===================================================== -->

    <section class="support-hero">

        <div class="support-hero-overlay"></div>

        <div class="support-hero-content">

            <span class="support-eyebrow">
                OMEGA CUSTOMER CARE
            </span>

            <h1>
                We're here<br>
                <span>to help.</span>
            </h1>

            <p>
                Whether you need help with a booking, baggage, or your
                journey, our support team is ready to assist.
            </p>

        </div>

    </section>


    <!-- =====================================================
         QUICK HELP
         ===================================================== -->

    <section class="support-quick-help">

        <div class="support-heading">

            <span class="support-label">
                HOW CAN WE HELP?
            </span>

            <h2>
                Find the right support.
            </h2>

            <p>
                Choose a topic below or send our team a message directly.
            </p>

        </div>


        <div class="support-help-grid">


            <div class="support-help-card">

                <div class="support-help-icon">
                    <i class="fa-solid fa-ticket"></i>
                </div>

                <div>

                    <span class="support-card-number">
                        01
                    </span>

                    <h3>
                        Booking & Flights
                    </h3>

                    <p>
                        Questions about reservations, flight details,
                        changes, or cancellations.
                    </p>

                    <span class="support-card-link">
                        Get booking help
                        <i class="fa-solid fa-arrow-right"></i>
                    </span>

                </div>

            </div>


            <div class="support-help-card">

                <div class="support-help-icon">
                    <i class="fa-solid fa-suitcase-rolling"></i>
                </div>

                <div>

                    <span class="support-card-number">
                        02
                    </span>

                    <h3>
                        Baggage
                    </h3>

                    <p>
                        Find assistance with baggage allowances,
                        delayed bags, or lost items.
                    </p>

                    <span class="support-card-link">
                        Baggage assistance
                        <i class="fa-solid fa-arrow-right"></i>
                    </span>

                </div>

            </div>


            <div class="support-help-card">

                <div class="support-help-icon">
                    <i class="fa-solid fa-plane-circle-check"></i>
                </div>

                <div>

                    <span class="support-card-number">
                        03
                    </span>

                    <h3>
                        Travel Assistance
                    </h3>

                    <p>
                        Get help with your journey, airport experience,
                        and general travel questions.
                    </p>

                    <span class="support-card-link">
                        Travel support
                        <i class="fa-solid fa-arrow-right"></i>
                    </span>

                </div>

            </div>


        </div>

    </section>


    <!-- =====================================================
         CONTACT + FORM
         ===================================================== -->

    <section class="support-contact-section">

        <div class="support-contact-inner">


            <!-- LEFT SIDE -->

            <div class="support-contact-info">

                <span class="support-label">
                    CONTACT OMEGA
                </span>

                <h2>
                    Let us take<br>
                    care of it.
                </h2>

                <p>
                    Have a question that isn't covered above?
                    Send us a message and our team will get back
                    to you as soon as possible.
                </p>


                <div class="support-contact-items">


                    <div class="support-contact-item">

                        <div class="contact-icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>

                        <div>
                            <span>
                                CUSTOMER CARE
                            </span>

                            <strong>
                                +1 800 OMEGA 24
                            </strong>
                        </div>

                    </div>


                    <div class="support-contact-item">

                        <div class="contact-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>

                        <div>
                            <span>
                                EMAIL SUPPORT
                            </span>

                            <strong>
                                support@omegaairlines.com
                            </strong>
                        </div>

                    </div>


                    <div class="support-contact-item">

                        <div class="contact-icon">
                            <i class="fa-solid fa-clock"></i>
                        </div>

                        <div>
                            <span>
                                SUPPORT HOURS
                            </span>

                            <strong>
                                24 hours · 7 days a week
                            </strong>
                        </div>

                    </div>


                </div>

            </div>


            <!-- RIGHT SIDE FORM -->

            <div class="support-form-card">

                <div class="support-form-heading">

                    <span>
                        SEND A MESSAGE
                    </span>

                    <h3>
                        How can we help?
                    </h3>

                </div>


                <form action="process_support.php" method="POST">


                    <div class="support-form-group">

                        <label>
                            YOUR NAME
                        </label>

                        <input
                            type="text"
                            name="name"
                            placeholder="Enter your name"
                            required
                        >

                    </div>


                    <div class="support-form-group">

                        <label>
                            EMAIL ADDRESS
                        </label>

                        <input
                            type="email"
                            name="email"
                            placeholder="you@example.com"
                            required
                        >

                    </div>


                    <div class="support-form-group">

                        <label>
                            INQUIRY TYPE
                        </label>

                        <select name="inquiry_type">

                            <option value="">
                                Select a topic
                            </option>

                            <option value="booking">
                                Booking & Flights
                            </option>

                            <option value="baggage">
                                Baggage
                            </option>

                            <option value="travel">
                                Travel Assistance
                            </option>

                            <option value="other">
                                Other
                            </option>

                        </select>

                    </div>


                    <div class="support-form-group">

                        <label>
                            INQUIRY DETAILS
                        </label>

                        <textarea
                            name="message"
                            rows="5"
                            placeholder="Tell us how we can help..."
                            required
                        ></textarea>

                    </div>


                    <button
                        type="submit"
                        class="support-submit-button"
                    >

                        Submit Request

                        <i class="fa-solid fa-arrow-right"></i>

                    </button>


                </form>

            </div>


        </div>

    </section>


    <!-- =====================================================
         FAQ
         ===================================================== -->

    <section class="support-faq">

        <div class="support-heading">

            <span class="support-label">
                FREQUENTLY ASKED QUESTIONS
            </span>

            <h2>
                Quick answers.
            </h2>

            <p>
                Some of the things our passengers ask most often.
            </p>

        </div>


        <div class="faq-grid">


            <div class="faq-item">

                <div class="faq-question">

                    <span>
                        How can I check my booking?
                    </span>

                    <i class="fa-solid fa-plus"></i>

                </div>

                <div class="faq-answer">

                    <p>
                        You can access your booking through the
                        Omega Client Portal using your account details.
                    </p>

                </div>

            </div>


            <div class="faq-item">

                <div class="faq-question">

                    <span>
                        Can I change my flight?
                    </span>

                    <i class="fa-solid fa-plus"></i>

                </div>

                <div class="faq-answer">

                    <p>
                        Flight changes depend on your booking conditions.
                        Contact our support team for assistance with
                        modifying your journey.
                    </p>

                </div>

            </div>


            <div class="faq-item">

                <div class="faq-question">

                    <span>
                        What should I do if my baggage is delayed?
                    </span>

                    <i class="fa-solid fa-plus"></i>

                </div>

                <div class="faq-answer">

                    <p>
                        Contact the Omega baggage assistance team at
                        the airport or send us a support request with
                        your flight information.
                    </p>

                </div>

            </div>


            <div class="faq-item">

                <div class="faq-question">

                    <span>
                        How can I contact Omega Airlines?
                    </span>

                    <i class="fa-solid fa-plus"></i>

                </div>

                <div class="faq-answer">

                    <p>
                        Our customer care team is available 24 hours
                        a day, 7 days a week through our support channels.
                    </p>

                </div>

            </div>


        </div>

    </section>


    <!-- =====================================================
         FINAL CTA
         ===================================================== -->

    <section class="support-final-cta">

        <div>

            <span class="support-label">
                STILL NEED HELP?
            </span>

            <h2>
                We're only a message away.
            </h2>

        </div>

        <a
            href="#"
            class="support-cta-button"
        >
            Contact Support
            <i class="fa-solid fa-arrow-right"></i>
        </a>

    </section>

</main>


<!-- =========================================================
     SUPPORT PAGE STYLES
     ========================================================= -->

<style>

    /* =====================================================
       PAGE
       ===================================================== */

    .support-page {
        background: #f6f7f9;
        color: #172337;
        overflow: hidden;
    }


    /* =====================================================
       HERO
       ===================================================== */

    .support-hero {
        position: relative;

        min-height: 520px;

        display: flex;
        align-items: center;

        background-image:
            url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=2200&q=90');

        background-size: cover;
        background-position: center;
        background-attachment: fixed;

        color: #ffffff;
    }

    .support-hero-overlay {
        position: absolute;
        inset: 0;

        background:
            linear-gradient(
                90deg,
                rgba(6,20,38,0.94) 0%,
                rgba(6,20,38,0.70) 45%,
                rgba(6,20,38,0.25) 100%
            );
    }

    .support-hero-content {
        position: relative;
        z-index: 2;

        width: 100%;
        max-width: 1250px;

        margin: auto;

        padding: 110px 5% 80px;

        animation: supportHeroIn 0.9s ease both;
    }

    .support-eyebrow,
    .support-label {
        display: block;

        margin-bottom: 18px;

        color: #d6ad38;

        font-size: 10px;
        font-weight: 700;

        letter-spacing: 3px;
    }

    .support-hero h1 {
        margin-bottom: 25px;

        font-size: clamp(4rem, 8vw, 6.5rem);

        line-height: 0.95;

        letter-spacing: -4px;

        font-weight: 800;
    }

    .support-hero h1 span {
        color: #d6ad38;
    }

    .support-hero p {
        max-width: 560px;

        color: rgba(255,255,255,0.75);

        font-size: 15px;

        line-height: 1.9;
    }


    /* =====================================================
       SHARED HEADINGS
       ===================================================== */

    .support-heading {
        max-width: 1250px;

        margin: 0 auto 55px;
    }

    .support-heading h2 {
        margin-bottom: 16px;

        color: #061426;

        font-size: clamp(2.5rem, 4vw, 4rem);

        line-height: 1.05;

        letter-spacing: -2px;
    }

    .support-heading p {
        max-width: 550px;

        color: #6d7a8d;

        font-size: 14px;

        line-height: 1.8;
    }


    /* =====================================================
       QUICK HELP
       ===================================================== */

    .support-quick-help {
        padding: 110px 5%;

        background: #ffffff;
    }

    .support-help-grid {
        max-width: 1250px;

        margin: auto;

        display: grid;

        grid-template-columns:
            repeat(3, 1fr);

        gap: 18px;
    }

    .support-help-card {
        display: grid;

        grid-template-columns: auto 1fr;

        gap: 22px;

        padding: 35px;

        background: #f6f7f9;

        border: 1px solid #e1e5ea;

        transition:
            transform 0.4s ease,
            box-shadow 0.4s ease,
            border-color 0.4s ease;
    }

    .support-help-card:hover {
        transform: translateY(-8px);

        border-color: rgba(214,173,56,0.5);

        box-shadow:
            0 25px 50px rgba(6,20,38,0.10);
    }

    .support-help-icon {
        width: 48px;
        height: 48px;

        display: flex;

        align-items: center;
        justify-content: center;

        color: #d6ad38;

        border: 1px solid rgba(214,173,56,0.45);

        border-radius: 50%;

        font-size: 17px;
    }

    .support-card-number {
        display: block;

        margin-bottom: 14px;

        color: #b9c0ca;

        font-size: 10px;
        font-weight: 700;

        letter-spacing: 1px;
    }

    .support-help-card h3 {
        margin-bottom: 12px;

        color: #061426;

        font-size: 20px;
    }

    .support-help-card p {
        margin-bottom: 20px;

        color: #6d7a8d;

        font-size: 12px;

        line-height: 1.8;
    }

    .support-card-link {
        display: inline-flex;

        align-items: center;

        gap: 10px;

        color: #061426;

        font-size: 10px;
        font-weight: 700;

        letter-spacing: 1px;

        text-transform: uppercase;
    }

    .support-card-link i {
        color: #d6ad38;

        transition: transform 0.3s ease;
    }

    .support-help-card:hover
    .support-card-link i {
        transform: translateX(5px);
    }


    /* =====================================================
       CONTACT SECTION
       ===================================================== */

    .support-contact-section {
        padding: 120px 5%;

        background: #f6f7f9;
    }

    .support-contact-inner {
        max-width: 1250px;

        margin: auto;

        display: grid;

        grid-template-columns:
            0.85fr 1.15fr;

        gap: 90px;

        align-items: start;
    }

    .support-contact-info h2 {
        margin-bottom: 25px;

        color: #061426;

        font-size: clamp(2.8rem, 5vw, 4.5rem);

        line-height: 0.98;

        letter-spacing: -2px;
    }

    .support-contact-info > p {
        max-width: 480px;

        margin-bottom: 45px;

        color: #6d7a8d;

        font-size: 14px;

        line-height: 1.9;
    }


    /* =====================================================
       CONTACT ITEMS
       ===================================================== */

    .support-contact-items {
        display: flex;

        flex-direction: column;

        gap: 25px;
    }

    .support-contact-item {
        display: flex;

        align-items: center;

        gap: 17px;
    }

    .contact-icon {
        width: 44px;
        height: 44px;

        display: flex;

        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        color: #d6ad38;

        border: 1px solid rgba(214,173,56,0.4);

        border-radius: 50%;
    }

    .support-contact-item span {
        display: block;

        margin-bottom: 4px;

        color: #9ba5b2;

        font-size: 9px;
        font-weight: 700;

        letter-spacing: 1.5px;
    }

    .support-contact-item strong {
        display: block;

        color: #061426;

        font-size: 13px;

        font-weight: 600;
    }


    /* =====================================================
       FORM CARD
       ===================================================== */

    .support-form-card {
        padding: 45px;

        background: #ffffff;

        border: 1px solid #e1e5ea;

        box-shadow:
            0 25px 60px rgba(6,20,38,0.07);
    }

    .support-form-heading {
        margin-bottom: 30px;
    }

    .support-form-heading > span {
        display: block;

        margin-bottom: 10px;

        color: #d6ad38;

        font-size: 10px;
        font-weight: 700;

        letter-spacing: 2px;
    }

    .support-form-heading h3 {
        color: #061426;

        font-size: 28px;

        letter-spacing: -1px;
    }

    .support-form-group {
        margin-bottom: 20px;
    }

    .support-form-group label {
        display: block;

        margin-bottom: 8px;

        color: #64748b;

        font-size: 9px;
        font-weight: 700;

        letter-spacing: 1.3px;
    }

    .support-form-group input,
    .support-form-group select,
    .support-form-group textarea {
        width: 100%;

        padding: 14px 15px;

        color: #172337;

        background: #f8fafc;

        border: 1px solid #dce2e8;

        border-radius: 0;

        outline: none;

        font-family: 'Montserrat', sans-serif;

        font-size: 12px;

        transition:
            border-color 0.3s ease,
            box-shadow 0.3s ease,
            background 0.3s ease;
    }

    .support-form-group textarea {
        resize: vertical;

        min-height: 130px;
    }

    .support-form-group input:focus,
    .support-form-group select:focus,
    .support-form-group textarea:focus {
        background: #ffffff;

        border-color: #d6ad38;

        box-shadow:
            0 0 0 3px rgba(214,173,56,0.10);
    }

    .support-form-group input::placeholder,
    .support-form-group textarea::placeholder {
        color: #aab2bc;
    }

    .support-submit-button {
        display: inline-flex;

        align-items: center;

        gap: 14px;

        padding: 16px 24px;

        color: #061426;

        background: #d6ad38;

        border: none;

        font-family: 'Montserrat', sans-serif;

        font-size: 11px;

        font-weight: 700;

        cursor: pointer;

        transition:
            transform 0.3s ease,
            background 0.3s ease,
            box-shadow 0.3s ease;
    }

    .support-submit-button:hover {
        background: #e8c85a;

        transform: translateY(-3px);

        box-shadow:
            0 12px 30px rgba(214,173,56,0.22);
    }


    /* =====================================================
       FAQ
       ===================================================== */

    .support-faq {
        padding: 120px 5%;

        background: #ffffff;
    }

    .faq-grid {
        max-width: 1000px;

        margin: auto;

        display: grid;

        grid-template-columns:
            1fr 1fr;

        gap: 1px;

        background: #dfe4e9;

        border: 1px solid #dfe4e9;
    }

    .faq-item {
        background: #ffffff;
    }

    .faq-question {
        min-height: 80px;

        padding: 25px;

        display: flex;

        align-items: center;
        justify-content: space-between;

        gap: 20px;

        color: #061426;

        font-size: 13px;

        font-weight: 600;

        cursor: pointer;
    }

    .faq-question i {
        color: #d6ad38;

        font-size: 12px;

        transition: transform 0.3s ease;
    }

    .faq-item:hover .faq-question i {
        transform: rotate(45deg);
    }

    .faq-answer {
        padding: 0 25px 25px;
    }

    .faq-answer p {
        color: #6d7a8d;

        font-size: 12px;

        line-height: 1.8;
    }


    /* =====================================================
       FINAL CTA
       ===================================================== */

    .support-final-cta {
        padding: 75px 8%;

        display: flex;

        align-items: center;
        justify-content: space-between;

        gap: 35px;

        background: #061426;

        color: #ffffff;
    }

    .support-final-cta .support-label {
        margin-bottom: 12px;
    }

    .support-final-cta h2 {
        color: #ffffff;

        font-size: clamp(2rem, 4vw, 3.3rem);

        line-height: 1.05;

        letter-spacing: -1.5px;
    }

    .support-cta-button {
        display: inline-flex;

        align-items: center;

        gap: 15px;

        padding: 17px 25px;

        color: #061426;

        background: #d6ad38;

        font-size: 11px;

        font-weight: 700;

        text-decoration: none;

        white-space: nowrap;

        transition:
            transform 0.3s ease,
            background 0.3s ease,
            box-shadow 0.3s ease;
    }

    .support-cta-button:hover {
        background: #e8c85a;

        transform: translateY(-3px);

        box-shadow:
            0 12px 30px rgba(214,173,56,0.22);
    }


    /* =====================================================
       ANIMATION
       ===================================================== */

    @keyframes supportHeroIn {

        from {
            opacity: 0;

            transform: translateY(30px);
        }

        to {
            opacity: 1;

            transform: translateY(0);
        }

    }


    /* =====================================================
       RESPONSIVE
       ===================================================== */

    @media (max-width: 1000px) {

        .support-help-grid {
            grid-template-columns:
                1fr;
        }

        .support-contact-inner {
            grid-template-columns:
                1fr;

            gap: 60px;
        }

        .faq-grid {
            grid-template-columns:
                1fr;
        }

    }


    @media (max-width: 650px) {

        .support-hero {
            min-height: 500px;

            background-attachment: scroll;
        }

        .support-hero h1 {
            font-size: 3.8rem;

            letter-spacing: -2px;
        }

        .support-quick-help,
        .support-contact-section,
        .support-faq {
            padding-top: 80px;
            padding-bottom: 80px;
        }

        .support-help-card {
            padding: 28px;
        }

        .support-form-card {
            padding: 28px 22px;
        }

        .support-final-cta {
            flex-direction: column;

            align-items: flex-start;

            padding: 65px 7%;
        }

    }


    @media (prefers-reduced-motion: reduce) {

        .support-hero-content,
        .support-help-card,
        .support-card-link i,
        .support-submit-button,
        .support-cta-button {
            animation: none !important;

            transition: none !important;
        }

    }

</style>


<?php include 'includes/footer.php'; ?>