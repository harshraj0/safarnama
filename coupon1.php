<!DOCTYPE html>
<html>
<head>
    <title>Coupon Page</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <h1>Coupon Page</h1>
    </header>
    <main>
        <section id="coupons">
            <h2>Coupons</h2>
            <ul id="coupon-list">
                <!-- Coupons will be displayed here -->
            </ul>
        </section>
        <section id="credit">
            <h2>Your Credit</h2>
            <p id="credit-amount">Loading...</p>
        </section>
    </main>
    <section id="redeem">
        <h2>Redeem a Coupon</h2>
        <form id="redeem-form">
            <label for="coupon-code">Coupon Code:</label>
            <input type="text" id="coupon-code" name="coupon-code" required>
            <button type="submit">Redeem</button>
        </form>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Fetch user's credit amount
            fetchCredit();

            // Fetch and display coupons
            fetchCoupons();

            // Redeem coupon form submission
            const redeemForm = document.getElementById("redeem-form");
            redeemForm.addEventListener("submit", function (e) {
                e.preventDefault();
                redeemCoupon();
            });
        });

        function fetchCredit() {
            const creditAmountElement = document.getElementById("credit-amount");

    // Make an AJAX request to the PHP script
        const xhr = new XMLHttpRequest();
    xhr.open("GET", "fetch_credit.php", true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            const credit = xhr.responseText;
            creditAmountElement.textContent = `Your Credit: $${credit}`;
        } else {
            console.error("Error fetching credit");
        }
    };


    xhr.send();
            // Implement code to fetch user's credit from the database using PHP and AJAX
            // Update the credit-amount element with the fetched value
            // Example:
            // const creditAmountElement = document.getElementById("credit-amount");
            // creditAmountElement.textContent = "Your Credit: $100"; // Replace with the actual credit value
        }
        function fetchCoupons() {
    const couponListElement = document.getElementById("coupon-list");

    // Make an AJAX request to the PHP script
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "fetch_coupons.php", true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            const coupons = JSON.parse(xhr.responseText);

            // Loop through the fetched coupons and create list items
            coupons.forEach((coupon, index) => {
                const couponItem = document.createElement("li");
                couponItem.textContent = `Coupon ${index + 1}: ${coupon.description} - $${coupon.credit_required} off`;
                couponListElement.appendChild(couponItem);
            });
        } else {
            console.error("Error fetching coupons");
        }
    };

    xhr.send();
}
        
        function redeemCoupon() {
            const couponCodeInput = document.getElementById("coupon-code").value;
            const couponCodeInput = document.getElementById("coupon-code").value;

    // Make an AJAX request to the PHP script to redeem the coupon
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "redeem_coupon.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (xhr.status === 200) {
            const response = xhr.responseText;
            alert(response); // Display the redemption result
        } else {
            console.error("Error redeeming coupon");
        }
    };

    // Send the coupon code as POST data
    const params = "coupon-code=" + encodeURIComponent(couponCodeInput);
    xhr.send(params);

            
        }
    </script>
</body>
</html>
