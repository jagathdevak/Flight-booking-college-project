<?php include 'includes/header.php'; ?>

<section class="hero" style="background: linear-gradient(rgba(10, 25, 47, 0.7), rgba(10, 25, 47, 0.7)), url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=1920&q=80') no-repeat center center/cover; height: 85vh; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; color: #fff; padding: 0 1rem;">

    <h1 style="font-size: 3.5rem; font-weight: 700; margin-bottom: 1rem;">
        Fly Beyond Limits
    </h1>

    <p style="font-size: 1.2rem; font-weight: 300; margin-bottom: 2.5rem; max-width: 600px;">
        Experience world-class luxury, unmatched safety, and seamless global connections with Omega Airlines.
    </p>

    <div
        class="booking-container"
        style="background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 15px 30px rgba(0,0,0,0.2); width: 100%; max-width: 1000px; color: var(--text-dark);"
    >

        <form
            action="process_booking.php"
            method="POST"
            class="booking-form"
            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)) 150px; gap: 1rem; align-items: end;"
        >

            <div class="form-group" style="text-align: left;">
                <label style="display: block; font-size: 0.8rem; font-weight: 600; color: #64748b; margin-bottom: 0.4rem; text-transform: uppercase;">
                    From
                </label>

                <input
                    type="text"
                    name="from"
                    style="width: 100%; padding: 0.8rem; border: 1px solid #cbd5e1; border-radius: 4px;"
                    placeholder="City or Airport"
                    required
                >
            </div>

            <div class="form-group" style="text-align: left;">
                <label style="display: block; font-size: 0.8rem; font-weight: 600; color: #64748b; margin-bottom: 0.4rem; text-transform: uppercase;">
                    To
                </label>

                <input
                    type="text"
                    name="to"
                    style="width: 100%; padding: 0.8rem; border: 1px solid #cbd5e1; border-radius: 4px;"
                    placeholder="City or Airport"
                    required
                >
            </div>

            <div class="form-group" style="text-align: left;">
                <label style="display: block; font-size: 0.8rem; font-weight: 600; color: #64748b; margin-bottom: 0.4rem; text-transform: uppercase;">
                    Departure Date
                </label>

                <input
                    type="date"
                    id="departure"
                    name="departure"
                    style="width: 100%; padding: 0.8rem; border: 1px solid #cbd5e1; border-radius: 4px;"
                    required
                >
            </div>

            <div class="form-group" style="text-align: left;">
                <label style="display: block; font-size: 0.8rem; font-weight: 600; color: #64748b; margin-bottom: 0.4rem; text-transform: uppercase;">
                    Passengers
                </label>

                <select
                    name="passengers"
                    style="width: 100%; padding: 0.8rem; border: 1px solid #cbd5e1; border-radius: 4px;"
                >
                    <option value="1">1 Adult</option>
                    <option value="2">2 Adults</option>
                </select>
            </div>

            <button
                type="submit"
                style="background-color: var(--primary); color: #fff; border: none; padding: 0.85rem; border-radius: 4px; font-weight: 600; cursor: pointer; width: 100%;"
            >
                Search Flights
            </button>

        </form>

    </div>

</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const dateInput = document.getElementById("departure");

    const today = new Date();

    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, "0");
    const day = String(today.getDate()).padStart(2, "0");

    const todayString = `${year}-${month}-${day}`;

    // Prevent selecting dates before today
    dateInput.min = todayString;

    // If browser restored an old date, reset it to today
    if (dateInput.value && dateInput.value < todayString) {
        dateInput.value = todayString;
    }
});
</script>

<?php include 'includes/footer.php'; ?>