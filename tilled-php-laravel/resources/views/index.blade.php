<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Simple Payment Example</title>
  <script src="https://js.tilled.com/v2"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="{{ asset('assets/tailwind.config.js') }}"></script>
  <link rel="icon" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.14/svgs/solid/credit-card.svg">
  <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="bg-tilledBg">
  <div id="main" class="flex justify-center items-center h-screen mx-5 mt-2">
    <div class="bg-white px-6 pb-0 rounded-lg shadow-md">
      <img src="{{ asset('assets/tilled-logo.png') }}" alt="Tilled Logo"
      class="mx-auto w-16 rounded-md border-4 border-white -mt-8 shadow-lg">
      <div class="card-body mt-3 mb-6">
        <ul
          class="nav flex flex-wrap bg-tilledToggle p-1 py-1 divide-x-2 mx-auto divide-tilledTabSelected text-tilledButtonText rounded-t shadow-sm border-b-2"
          role="tablist">
          <li class="flex-1 text-center">
            <a class="nav-link active flex items-center justify-center border-none p-1 mr-1 transition-all duration-300 ease-in-out hover:bg-gray-100 hover:shadow-sm hover:shadow-gray-400 active:bg-gray-50 active:shadow-sm active:shadow-gray-500 rounded-sm"
              data-toggle="pill" href="/#nav-tab-card">
              <i class="fa fa-credit-card px-2"></i> Credit Card
            </a>
          </li>
          <li class="flex-1 text-center">
            <a class="nav-link flex items-center justify-center border-none p-1 ml-1 transition-all duration-300 ease-in-out hover:bg-gray-100 hover:shadow-sm hover:shadow-gray-400 active:bg-gray-50 active:shadow-sm active:shadow-gray-500 rounded-sm"
              data-toggle="pill" href="#nav-tab-ach">
              <i class="fas fa-university px-2"></i> ACH
            </a>
          </li>
        </ul>

        <div class="tab-content">
          <div *ngif="selectedPaymentType === 'card'" class="tab-pane fade show active" id="nav-tab-card">
            <form action="javascript:void(0);" id="payment-form" method="POST">
              <div class="form-group">
                <label class="relative top-2 ml-1 px-1 bg-white w-fit text-gray-500 text-xs"
                  for="card-number-element">Card number</label>
                <div autocomplete="cc-number" class="inputField mb-2 border rounded-sm pl-2 h-12 py-3"
                  id="card-number-element"></div>
                <div class="input-group-text text-muted credit-card-icons hidden">
                  <i class="credit-card-logo fa-brands fa-cc-visa opacity-0"></i><i
                    class="credit-card-logo fa-brands fa-cc-amex opacity-0"></i>
                  <i class="credit-card-logo fa-brands fa-cc-mastercard opacity-0"></i>
                  <i class="credit-card-logo fa-brands fa-cc-diners-club opacity-0"></i>
                  <i class="credit-card-logo fa-brands fa-cc-jcb opacity-0"></i>
                  <i class="credit-card-logo fa-brands fa-cc-discover opacity-0"></i>
                </div>
              </div>
              <div class="flex space-x-2 justify-center">
                <div class="w-1/2">
                  <label class="relative top-2 ml-1 px-1 bg-white w-fit text-gray-500 text-xs"
                    for="card-expiration-element">Expiration</label>
                  <div class="inputField mb-2 border rounded-sm pl-2 h-12 py-3" id="card-expiration-element"></div>
                </div>
                <div class="w-1/2">
                  <label class="relative top-2 ml-1 px-1 bg-white w-fit text-gray-500 text-xs"
                    for="card-cvv-element">CVV</label>
                  <div class="inputField mb-2 border rounded-sm pl-2 h-12 py-3" id="card-cvv-element"></div>
                </div>
              </div>
              <div class="w-full">
                <div class="form-group card-billing-details rounded-sm">
                  <label class="relative top-2 ml-1 px-1 bg-white w-fit text-gray-500 text-xs"
                    for="card-name-element">Full Name</label>
                  <div class="inputField mb-2 border rounded-sm pl-2 h-12 py-3">
                    <input class="form-control w-full outline-none" id="card-name-element" name="name"
                      placeholder="Full Name" required type="text">
                  </div>
                  <label class="mt-3 relative top-2 ml-1 px-1 bg-white w-fit text-gray-500 text-xs"
                    for="card-address-element">Address</label>
                  <div class="inputField mb-2 border rounded-sm pl-2 h-12 py-3">
                    <input class="form-control w-full outline-none" id="card-address-element" name="address"
                      placeholder="Address" required type="text">
                  </div>
                  <div class="flex space-x-2 justify-center">
                    <div class="w-full sm:w-1/2">
                      <label class="relative top-2 ml-1 px-1 bg-white w-fit text-gray-500 text-xs">Country</label>
                      <div class="inputField mb-2 border rounded-sm pl-2 h-12 py-3 text-gray-500">
                        <select class="form-control w-full outline-none -ml-1 text-ellipsis" id="card-country-element"
                          name="country" required>
                          <option value="">Select a Country</option>
                          <option value="US">United States</option>
                        </select>
                      </div>
                      <label class="relative top-2 ml-1 px-1 bg-white w-fit text-gray-500 text-xs"
                        for="card-city-element">City</label>
                      <div class="inputField mb-2 border rounded-sm pl-2 h-12 py-3">
                        <input class="form-control w-full outline-none" id="card-city-element" name="city"
                          placeholder="City" required type="text">
                      </div>
                    </div>
                    <div class="w-full sm:w-1/2">
                      <label class="relative top-2 ml-1 px-1 bg-white w-fit text-gray-500 text-xs">State</label>
                      <div class="inputField mb-2 border rounded-sm pl-2 h-12 py-3 text-gray-500">
                        <select class="form-control w-full outline-none -ml-1 text-ellipsis" id="card-state-element"
                          name="state" required>
                          <option value="">Select a State</option>
                          <option value="CO">Colorado</option>
                          <!-- Add more states here -->
                        </select>
                      </div>
                      <label class="relative top-2 ml-1 px-1 bg-white w-fit text-gray-500 text-xs"
                        for="card-zip-element">Zip</label>
                      <div class="inputField mb-2 border rounded-sm pl-2 h-12 py-3">
                        <input class="form-control w-full outline-none" id="card-zip-element" name="billingZip"
                          placeholder="Zip" required type="text">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="flex justify-center items-center">
                <label class="mb-0 p-2 text-tilledButtonText" for="save-pm-checkbox">Save payment method?</label>
                <label class="text-lg relative inline-block w-12 h-6">
                  <input class="sr-only" id="card-save-pm-checkbox-element" name="save-pm-checkbox" type="checkbox">
                  <span
                    class="slider absolute cursor-pointer top-0 left-0 right-0 bottom-0 bg-tilledToggle transition rounded-full duration-400 before:absolute before:block before:h-4 before:w-4 before:rounded-full before:bg-white before:transition-transform before:duration-200 before:ease-in-out before:top-1 before:left-1"></span>
                </label>
              </div>
              <button
                class="w-full h-10 rounded-md text-white font-bold bg-tilledButtonText shadow-sm mt-1 transition-all duration-300 ease-in-out hover:shadow-lg hover:bg-tilledButtonHover"
                id="submit" type="submit">
                Pay
              </button>
              <button
                class="w-full h-10 rounded-md text-white font-bold bg-tilledButtonText shadow-sm mt-1 transition-all duration-300 ease-in-out hover:shadow-lg hover:bg-tilledButtonHover hidden"
                id="submitPM" type="submit">
                Save
              </button>
            </form>
          </div>
          <div *ngif="selectedPaymentType === 'ach_debit'" class="tab-pane fade hidden" id="nav-tab-ach">
            <div class="form-group">
              <label class="relative top-2 ml-1 px-1 bg-white w-fit text-gray-500 text-xs">Account Type</label>
              <div class="inputField mb-2 border rounded-sm pl-2 h-12 py-3">
                <select class="form-control w-full outline-0 mb-2 text-gray-500 -ml-1 text-ellipsis"
                  id="ach_account_type" name="ach_account_type">
                  <option value="">Select Account Type</option>
                  <option value="checking">Checking</option>
                  <option value="savings">Savings</option>
                </select>
              </div>
              <div class="flex space-x-2">
                <div class="w-1/2">
                  <label class="relative top-2 ml-1 px-1 bg-white w-fit text-gray-500 text-xs">Account Number</label>
                  <div class="inputField mb-2 border rounded-sm pl-2 h-12 py-3" id="bank-account-number-element"></div>
                </div>
                <div class="w-1/2">
                  <label class="relative top-2 ml-1 px-1 bg-white w-fit text-gray-500 text-xs">Routing Number</label>
                  <div class="inputField mb-2 border rounded-sm pl-2 h-12 py-3" id="bank-routing-number-element"></div>
                </div>
              </div>
              <div class="w-full">
                <div class="form-group ach-billing-details rounded-sm">
                  <label class="relative top-2 ml-1 px-1 bg-white w-fit text-gray-500 text-xs"
                    for="ach-name-element">Full Name</label>
                  <div class="inputField mb-2 border rounded-sm pl-2 h-12 py-3">
                    <input class="w-full outline-0" id="ach-name-element" name="name" placeholder="Full Name" required
                      type="text">
                  </div>
                  <label class="relative top-2 ml-1 px-1 bg-white w-fit text-gray-500 text-xs"
                    for="ach-address-element">Address</label>
                  <div class="inputField mb-2 border rounded-sm pl-2 h-12 py-3">
                    <input class="w-full outline-0" id="ach-address-element" name="address" placeholder="Address"
                      required type="text">
                  </div>
                  <div class="flex space-x-2 justify-center">
                    <div class="w-full sm:w-1/2">
                      <label class="relative top-2 ml-1 px-1 bg-white w-fit text-gray-500 text-xs">Country</label>
                      <div class="inputField mb-2 border rounded-sm pl-2 h-12 py-3 text-gray-500">
                        <select class="form-control w-full outline-none -ml-1 text-ellipsis" id="ach-country-element"
                          name="country" required>
                          <option value="">Select a Country</option>
                          <option value="US">United States</option>
                        </select>
                      </div>
                      <label class="relative top-2 ml-1 px-1 bg-white w-fit text-gray-500 text-xs"
                        for="ach-city-element">City</label>
                      <div class="inputField mb-2 border rounded-sm pl-2 h-12 py-3">
                        <input class="w-full outline-0" id="ach-city-element" name="city" placeholder="City" required
                          type="text">
                      </div>
                    </div>
                    <div class="w-full sm:w-1/2">
                      <label class="relative top-2 ml-1 px-1 bg-white w-fit text-gray-500 text-xs">State</label>
                      <div class="inputField mb-2 border rounded-sm pl-2 h-12 py-3 text-gray-500">
                        <select class="form-control w-full outline-none -ml-1 text-ellipsis" id="ach-state-element"
                          name="state" required>
                          <option value="">Select a State</option>
                          <option value="CO">Colorado</option>
                          <!-- Add more states here -->
                        </select>
                      </div>
                      <label class="relative top-2 ml-1 px-1 bg-white w-fit text-gray-500 text-xs"
                        for="ach-zip-element">Zip</label>
                      <div class="inputField mb-2 border rounded-sm pl-2 h-12 py-3">
                        <input class="w-full outline-0" id="ach-zip-element" name="billingZip" placeholder="Zip"
                          required type="text">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="flex justify-center items-center">
                <label class="mb-0 p-2 text-tilledButtonText" for="save-pm-checkbox">Save payment method?</label>
                <label class="text-lg relative inline-block w-12 h-6">
                  <input class="sr-only" id="ach-save-pm-checkbox-element" name="save-pm-checkbox" type="checkbox">
                  <span
                    class="slider absolute cursor-pointer top-0 left-0 right-0 bottom-0 bg-tilledToggle transition rounded-full duration-400 before:absolute before:block before:h-4 before:w-4 before:rounded-full before:bg-white before:transition-transform before:duration-200 before:ease-in-out before:top-1 before:left-1"></span>
                </label>
              </div>
              <button
                class="w-full h-10 rounded-md text-white font-bold bg-tilledButtonText shadow-sm mt-1 transition-all duration-300 ease-in-out hover:shadow-lg hover:bg-tilledButtonHover"
                id="submit2" type="submit">
                Pay
              </button>
              <button
                class="w-full h-10 rounded-md text-white font-bold bg-tilledButtonText shadow-sm mt-1 transition-all duration-300 ease-in-out hover:shadow-lg hover:bg-tilledButtonHover hidden"
                id="submitPM2" type="submit">
                Save
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Included here for simplicity of example -->
    <script>
      // Replace with your own account ID and publishable key, these should be defined in your .env file
      const accountId = "{{ env('TILLED_ACCOUNT_ID') }}"; || "acct_...";
      const publishableKey = "{{ env('TILLED_PUBLISHABLE_KEY') }}" || "pk_...";

      // DOM elements for card and ACH payment method save checkboxes
      const cardSaveCheckboxElement = document.getElementById("card-save-pm-checkbox-element");
      const achSaveCheckboxElement = document.getElementById("ach-save-pm-checkbox-element");

      // Payment method element IDs, used for retrieving values from the DOM in generatePayload()
      const paymentMethodIds = {
        card: {
          name: "card-name-element",
          country: "card-country-element",
          zip: "card-zip-element",
          state: "card-state-element",
          city: "card-city-element",
          street: "card-address-element",
        },
        ach: {
          name: "ach-name-element",
          country: "ach-country-element",
          zip: "ach-zip-element",
          state: "ach-state-element",
          city: "ach-city-element",
          street: "ach-address-element",
        },
      };

      // Styling Options for card and ACH payment method fields. Placeholders are set for each field when the field is created. (See above cardForm.createField and achForm.createField calls)
      const fieldOptions = {
        styles: {
          base: {
            fontFamily: "Helvetica Neue, Arial, sans-serif",
            color: "#757575",
            fontWeight: "400",
            fontSize: "16px",
          },
          invalid: {
            ":hover": {
              textDecoration: "underline dotted #EA4628",
              color: "#EA4628",
            },
            ":focus": {
              textDecoration: "underline dotted #EA4628",
            },
          },
          valid: {
            color: "#59C288",
          },
        },
      };

      // Toggle Pay vs Save Payment Method functionality for card and ACH payment methods
      toggleSavePayment(cardSaveCheckboxElement, "submit", "submitPM", ".form-group.card-billing-details");
      toggleSavePayment(achSaveCheckboxElement, "submit2", "submitPM2", ".form-group.ach-billing-details");

      // Adds event listeners for toggling Pay vs Save Payment Method
      function toggleSavePayment(checkboxElement, submitBtnId, submitPMBtnId, billingDetailsSelector) {
        checkboxElement.addEventListener("change", () => {
          document.getElementById(submitBtnId).classList.toggle("hidden");
          document.getElementById(submitPMBtnId).classList.toggle("hidden");
        });
      }

      // Retrieves values from the DOM elements, cleans up empty values, and returns the paymentPayload object used for creating payment methods and confirming payments
      function generatePayload(paymentMethodType) {
        const paymentMethodElements = paymentMethodIds[paymentMethodType];
        const billingDetails = {};

        for (const key in paymentMethodElements) {
          const element = document.getElementById(paymentMethodElements[key]);
          billingDetails[key] = element.value.trim();
        }

        const accountType = paymentMethodType === "ach" ? document.getElementById("ach_account_type").value.trim() : undefined;

        // Payment payload for creating payment methods. This is used for both card and ACH payment methods
        const paymentPayload = {
          payment_method: {
            billing_details: {
              name: billingDetails.name,
              address: {
                country: billingDetails.country,
                zip: billingDetails.zip,
                state: billingDetails.state,
                city: billingDetails.city,
                street: billingDetails.street,
              },
            },
          },
        };

        if (paymentMethodType === "ach") {
          paymentPayload.payment_method.ach_debit = {
            account_type: accountType,
          };
        }

        // Remove empty properties from payment payload before creating payment method.
        Object.keys(paymentPayload.payment_method.billing_details.address).forEach((key) => {
          if (!paymentPayload.payment_method.billing_details.address[key]) {
            delete paymentPayload.payment_method.billing_details.address[key];
          }
        });
        if (!paymentPayload.payment_method.billing_details.name) {
          delete paymentPayload.payment_method.billing_details.name;
        }
        if (paymentMethodType === "card") {
          delete paymentPayload.payment_method.ach_debit;
        }

        return paymentPayload;
      }

      document.addEventListener("DOMContentLoaded", async () => {
        // Initialize Tilled.js and create card form
        const tilled = new Tilled(publishableKey, accountId, {
          sandbox: true,
          log_level: 0,
        });

        const cardForm = await tilled.form({
          payment_method_type: "card",
        });

        const cardNumberElement = {
          ...fieldOptions,
          placeholder: "Card Number",
        };

        const cardCvvElement = {
          ...fieldOptions,
          placeholder: "CVV",
        };

        cardForm.createField("cardNumber", cardNumberElement).inject("#card-number-element");
        cardForm.createField("cardExpiry", fieldOptions).inject("#card-expiration-element");
        cardForm.createField("cardCvv", cardCvvElement).inject("#card-cvv-element");

        await cardForm.build();
        // DOM elements for card submit buttons
        const cardSubmitButton = document.getElementById("submit");
        const cardSavePMButton = document.getElementById("submitPM");
        // Update UI to reflect form validation
        function handleCardValidation(event) {
          if (event.field) {
            event.field.element.classList.remove("success", "error");
            event.field.element.classList.add(event.field.valid ? "success" : "error");
          }

          cardSubmitButton.disabled = cardForm.invalid;
          cardSavePMButton.disabled = cardForm.invalid;
        }
        // Update UI to reflect card brand
        function handleCardBrandChange(evt) {
          const cardBrand = evt.brand;
          const icons = document.querySelectorAll(".credit-card-logo");
          // highlight and show card brand icon when card brand is detected
          const highlight = (icon) => {
            icons.forEach((icon) => icon.classList.add("hidden"));
            icon.style = "color: #59C288";
            icon.classList.remove("hidden");
          };
          // unhide card brand wrapper when card brand is detected
          const cardBrandElement = document.querySelector("form#payment-form div .credit-card-icons ");
          cardBrandElement.classList.remove("hidden");
          icons.forEach((icon) => icon.classList.remove("opacity-0"));
          // hide card brand wrapper and icons when card brand is not detected, 
          if (cardBrand === "unknown") {
            cardBrandElement.classList.add("hidden");
            icons.forEach((icon) => icon.classList.add("opacity-0"));
          }

          switch (cardBrand) {
            case "amex":
              highlight(document.querySelector(".fa-cc-amex"));
              break;
            case "mastercard":
              highlight(document.querySelector(".fa-cc-mastercard"));
              break;
            case "visa":
              highlight(document.querySelector(".fa-cc-visa"));
              break;
            case "diners":
              highlight(document.querySelector(".fa-cc-diners-club"));
              break;
            case "jcb":
              highlight(document.querySelector(".fa-cc-jcb"));
              break;
            case "discover":
              highlight(document.querySelector(".fa-cc-discover"));
              break;
            default:
              icons.forEach((icon) => icon.removeAttribute("style"));
          }
        }

        function handleFormSubmit() {
          cardSubmitButton.disabled = true;
          // Asks server to generate PaymentIntent
          // it will send back clientSecret, which is used to confirm the payment
          fetch("/secret/" + accountId)
            .then((response) => response.json())
            .then(async (secretData) => {
              const clientSecret = secretData.client_secret;
              console.log("PaymentIntent clientSecret: " + clientSecret);

              try {
                const cardPayload = generatePayload("card");
                const payment = await tilled.confirmPayment(clientSecret, cardPayload);
                console.log("Successful payment.");
                console.log(payment);
                window.alert("Successful payment");
              } catch (error) {
                console.log("Failed to confirm payment.");
                console.log(error);
                window.alert(error);
              }
            });
        }

        // Creates a payment method and does not confirm the payment
        function handleSavePaymentMethod() {
          cardSavePMButton.disabled = true;
          const cardPayload = generatePayload("card");
          tilled.createPaymentMethod({ type: "card", ...cardPayload.payment_method }).then(
            (paymentMethod) => {
              console.log(`Successful paymentMethod! The paymentMethod id is ${paymentMethod.id}`);
              console.log(paymentMethod);
              window.alert(`Successful paymentMethod! The paymentMethod id is ${paymentMethod.id}`);
            },
            (error) => {
              console.log("Failed to confirm paymentMethod.");
              console.log(error);
              window.alert(error);
            }
          );
        }

        cardForm.on("validation", handleCardValidation);
        cardForm.fields.cardNumber.on("change", handleCardBrandChange);
        cardSubmitButton.addEventListener("click", handleFormSubmit);
        cardSavePMButton.addEventListener("click", handleSavePaymentMethod);
      });

      document.addEventListener("DOMContentLoaded", async () => {
        // Initialize Tilled.js and create ach form
        const tilled = new Tilled(publishableKey, accountId, {
          sandbox: true,
          log_level: 0,
        });

        const achForm = await tilled.form({
          payment_method_type: "ach_debit",
        });

        const routingNumberElement = {
          ...fieldOptions,
          placeholder: "Routing Number",
        };

        const accountNumberElement = {
          ...fieldOptions,
          placeholder: "Account Number",
        };

        achForm.createField("bankRoutingNumber", routingNumberElement).inject("#bank-routing-number-element");
        achForm.createField("bankAccountNumber", accountNumberElement).inject("#bank-account-number-element");

        await achForm.build();
        // Get DOM elements for ach submit buttons
        const achSubmitButton = document.getElementById("submit2");
        const achSavePMButton = document.getElementById("submitPM2");

        // Update UI to reflect field validation
        function handleACHValidation(event) {
          if (event.field) {
            event.field.element.classList.remove("success", "error");
            event.field.element.classList.add(event.field.valid ? "success" : "error");
          }

          achSubmitButton.disabled = achForm.invalid;
          achSavePMButton.disabled = achForm.invalid;
        }

        function handleACHFormSubmit() {
          achSubmitButton.disabled = true;
          // Asks server to generate PaymentIntent
          // it will send back clientSecret, which is used to confirm the payment
          fetch("/secret/" + accountId)
            .then((response) => response.json())
            .then(async (secretData) => {
              const clientSecret = secretData.client_secret;
              console.log("PaymentIntent clientSecret: " + clientSecret);

              try {
                const achPayload = generatePayload("ach");
                const payment = await tilled.confirmPayment(clientSecret, achPayload);
                console.log("Successful payment.");
                console.log(payment);
                window.alert("Successful payment");
              } catch (error) {
                console.log("Failed to confirm payment.");
                console.log(error);
                window.alert(error);
              }
            });
        }

        // Creates a payment method and does not confirm the payment
        function handleSaveACHPaymentMethod() {
          achSavePMButton.disabled = true;
          const achPayload = generatePayload("ach");
          tilled.createPaymentMethod({ type: "ach_debit", ...achPayload.payment_method }).then(
            (paymentMethod) => {
              console.log(`Successful paymentMethod! The paymentMethod id is ${paymentMethod.id}`);
              console.log(paymentMethod);
              window.alert(`Successful paymentMethod! The paymentMethod id is ${paymentMethod.id}`);
            },
            (error) => {
              console.log("Failed to confirm paymentMethod.");
              console.log(error);
              window.alert(error);
            }
          );
        }

        achForm.on("validation", handleACHValidation);
        achSubmitButton.addEventListener("click", handleACHFormSubmit);
        achSavePMButton.addEventListener("click", handleSaveACHPaymentMethod);
      });

      // Switch between card and ach payment methods
      const cardTab = document.querySelector("div#main li:nth-child(1) > a");
      const achTab = document.querySelector("div#main li:nth-child(2) > a");
      const cardFormDiv = document.querySelector("div#nav-tab-card");
      const achFormDiv = document.querySelector("div#nav-tab-ach");

      function switchTab(clickedTab, tabToShow, tabToHide) {
        clickedTab.addEventListener("click", function (event) {
          event.preventDefault();
          tabToShow.classList.remove("hidden");
          clickedTab.classList.add("active", "show");
          tabToHide.classList.add("hidden");
          (clickedTab === cardTab ? achTab : cardTab).classList.remove("active");
        });
      }
      switchTab(cardTab, cardFormDiv, achFormDiv);
      switchTab(achTab, achFormDiv, cardFormDiv);
    </script>
  </div>
</body>

</html>