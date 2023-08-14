:warning: This repository contains a standalone example to be used as a reference to help our partners integrate with Tilled. It is **not** intended to be implemented in a production environment nor is it intended to be installed as a dependency in any way.

# Getting Started

This Simple Payment Example serves as a self-contained demonstration of how to utilize the Tilled API and Tilled.js for creating and processing payments. Two example servers are provided: one created in Node.js and the other in PHP Laravel. These servers share identical functionality and are designed to provide guidance for our partners during the integration with Tilled.

For both the Node.js and PHP Laravel servers, you will need the following:

- **A Tilled Sandbox account**
- A **`Secret`** and **`Publishable`** API key.
  - If you don't have a secret and publishable API key, you can create them **[here](https://sandbox-app.tilled.com/api-keys)**.
- **A Merchant Account**
  - To retrieve a Merchant Account ID, you can go to the **[Merchants](https://sandbox-app.tilled.com/merchants)** page and click on the Merchant you want to use. The Merchant Account ID will be located on the **Company Overview** box under the **Account ID** field.
    - By default, you should already have a Merchant account name `Shovel Shop (demo)`.
      - You can optionally create a new Merchant by following the instructions **[here](https://docs.tilled.com/docs/account-management/onboarding/)**
        - _Note: Prefix the name of the account with an asterisk (ex. `*The Surf Shop`) to bypass needing to submit an onboarding form_.

After you have the completed the steps above, follow the instructions for the server you intend to use:

- For the Node.js server, navigate to the **[Node.js](#nodejs)** section.
- For the PHP Laravel server, navigate to the **[PHP Laravel](#php-laravel)** section.

## Node.js

### Dependencies (Node.js)

- [Node.js](https://nodejs.org)

### Get started (Node.js)

- If you haven't already, ensure that you have completed the [Getting Started](#getting-started) section, as you will need a **`Secret`** and **`Publishable`** API key along with the Account ID of one of your Merchants.
- Clone the project
- Install dependencies:

  ```bash
  $ npm install
  ```

### Environment Variables (Node.js)

- Create a `.env` file in this project's root directory (`simple-payment-example/.env`) with your Secret API Key:

    ```env
    TILLED_SECRET_KEY=sk_...
    ```

- Add your Merchant Account ID and Publishable API Key to [`index.html`](/simple-payment-example/index.html) (Lines 238-239)

    ```javascript
    const accountId = "acct_...";
    const publishableKey = "pk_...";
    ```

### Run the server (Node.js)

- Enter the following command from this project's root:

  ```bash
  $ npm run node-server
  ```

### Process your first payment (Node.js)

Navigate to the **[Process your first payment](#process-your-first-payment)** section.

---

# PHP Laravel

## Dependencies (PHP Laravel)

- [PHP](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org/download/)
- [Laravel](https://laravel.com/docs/installation)

### Get started (PHP Laravel)

- If you haven't already, ensure that you have completed the [Getting Started](#getting-started) section, as you will need a `Secret` and `Publishable` API key along with the Account ID of one of your Merchants.
- Clone the project
- Install dependencies (be sure to run this command from the (`simple-payment-example/tilled-php-laravel`) directory):

  ```bash
  $ composer install
  ```

### Environment Variables (PHP Laravel)

- Navigate to the `tilled-php-laravel` directory (`simple-payment-example/tilled-php-laravel`) and create a .env file with your Secret and Publishable API Keys, your Merchant Account ID, and a blank key for `APP_KEY`:

  ```env
  # Leave this blank, it will be generated for you when `php artisan key:generate` is run
  APP_KEY =

  # Tilled Merchant Account ID
  TILLED_ACCOUNT_ID=acct_...
  # Tilled Secret API Key
  TILLED_SECRET_KEY=sk_...
  # Tilled Publishable API Key
  TILLED_PUBLISHABLE_KEY=pk_...
  ```

- After creating the .env file, run the following command to generate the value for `APP_KEY`:

  ```bash
  $ php artisan key:generate
  ```

### Run the server (PHP Laravel)

- Enter the following command from this project's root:

  ```bash
  $ npm run php-server
  ```

  <br />

  **OR**

  <br />

- If you do not have NPM installed, in the (`simple-payment-example/tilled-php-laravel`) path, run the following command:

  ```bash
  $ php artisan serve
  ```

### Process your first payment (PHP Laravel)

Navigate to the **[Process your first payment](#process-your-first-payment)** section.

---

# Process your first payment

<p align="center">
  <img src="/img/Simple-Payment-Example.png" alt="Simple Payment Example">
</p>

- Open your web browser and go to [http://localhost:3000](http://localhost:3000/) for the Node.js server or [http://localhost:8000](http://localhost:8000/) for the PHP Laravel server.
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
