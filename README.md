:warning: This repository contains a standalone example to be used as a reference to help our partners integrate with Tilled. It is **not** intended to be implemented in a production environment nor is it intended to be installed as a dependency in any way.

# Dependencies

- [Node.js](https://nodejs.org)

# Get started

- Clone the project
- Install dependencies:
  ```
  $ npm install
  ```

# Retrieve your configuration values

Before you can run this example, you will need to create a sandbox account and add your configuration values.

- Retrieve your **`Secret`** and **`Publishable`** API keys
  - If you don't have a Secret and Publishable API key, you can create them **[here](https://sandbox-app.tilled.com/api-keys)**.
- Retrieve the Merchant Account ID. To do this, you can go to the **[Merchants](https://sandbox-app.tilled.com/merchants)** page and click on the Merchant you want to use. The Merchant Account ID will be located on the **Company Overview** box under the **Account ID** field.
  - By default, you should already have a Merchant account named `Shovel Shop (demo)`.
    - Optionally, you can create a new Merchant by following the instructions **[here](https://docs.tilled.com/docs/account-management/onboarding/)**
      - _Note: Prefix the name of the account with an asterisk (ex. `*The Surf Shop`) to bypass needing to submit an onboarding form_.

# Add your configuration values

- Create a `.env` file in this project's root directory (`simple-payment-example/.env`) with your Secret API Key:

  ```env
  TILLED_SECRET_KEY=sk_...
  ```

- Add your Merchant Account ID and Publishable API Key to [`index.html`](/simple-payment-example/index.html) (Lines 238-239)

  ```javascript
  const accountId = "acct_...";
  const publishableKey = "pk_...";
  ```

# Run the server

- Enter the following command from this project's root:

  ```bash
  $ node app.js
  ```

# Process your first payment

<p align="center">
  <img src="/img/Simple-Payment-Example.png" alt="Simple Payment Example">
</p>

- Open your web browser and go to [http://localhost:3000](http://localhost:3000/)
  - Enter `4037111111000000` as the card number, use a valid expiration date for the card, and enter `123` as the CVV code.
  - Fill out the billing details section.
  - Click the **Pay** to complete the payment.
    - Optionally, you can use your browser's developer console to review the logs related to the creation of the payment intent.
- To view the payment in the Tilled Console, go **[here](https://sandbox-app.tilled.com/payments)**.

- You can utilize the **[Testing](https://docs.tilled.com/docs/testing)** page in our Tilled Docs for Test Card Numbers and ACH routing numbers, Simulating Errors, and more.
  - For test cards to use in the Sandbox environment, see the **[Basic Test Card Numbers](https://docs.tilled.com/docs/testing#basic-test-cards)** section.
  - For ACH payments, the **Account Number** can be any 4 or 17-digit number, but the **Routing Number** must a valid test routing number. See the **[ACH Debit Testing](https://docs.tilled.com/docs/testing#ach-debit-testing)** section.

# Manually create payment methods

<p align="center">
  <img src="/img/Create-Payment-Method.png" alt="Create Payment Method Example">
</p>

- In the browser, toggle the **Save payment method?** switch, make sure to fill out the billing details, and then click the **Save** button.
  - This will create a payment method without processing a payment.
- View the paymentMethod ID in the alert or the console.

# What's Next?

- [Tilled Docs](https://docs.tilled.com/docs)
- [Tilled.js Docs](https://docs.tilled.com/docs/payment-methods/tilledjs/)
- [API Docs](https://docs.tilled.com/api)
- [Partner Help Center](https://tilledpartners.zendesk.com/hc/en-us)
- The [tilled-example-monorepo](https://github.com/gettilled/tilled-example-monorepo) which contains more advanced examples of how to use the Tilled API and Tilled.js.

You can try out attaching payment methods to customers, adding metadata, including platform fees on payment intents and much, much more via the Tilled API.
