# Get started

- clone the project
- `npm install`

# Create a sandbox account and add your configuration values

- [Register a sandbox account](https://sandbox-app.tilled.com/auth/register)
- Create a secret and publishable api key
- Update line 138 of index.html with your publishable API Key
- Update line 7 of app.js with your secret API key
- Add an Account [here](https://sandbox-app.tilled.com/connected-accounts)
- Note the Account ID and update line 136 of index.html with the Account ID
- run the sample server`node app.js`

# Process your first payment
- Navigate to [http://localhost:5000](http://localhost:5000) in your browser, enter `4037111111000000` as the test card number with a valid expiration date and `123` as the CVV Code and click Pay
- Optional: Look in the browser's developer console to see payment intent creation logs
- Go [here](https://sandbox-app.tilled.com/payments) to see your payment

# What's Next?
[API Docs](api.tilled.com/docs)

You can try out attaching payment methods to customers, adding metadata, including platform fees on payment intents and much, much more via the Tilled API.