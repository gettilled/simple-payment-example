const express = require('express')
const axios = require('axios')
const app = express()
const path = require('path')
const open = require('open')
const port = process.env.port || 3000
const env = require('dotenv').config()
const secretKey = process.env.TILLED_SECRET_KEY;

const tilledSecretApiKey = secretKey

app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, '/index.html'))
})

// load local files and serve them as static assets
app.use('/assets', express.static(path.join(__dirname, '/assets')));

app.get('/secret/:id', (req, res) => {
  const tilledAccountId = req.params.id
  const headers = {
    'Content-Type': 'application/json',
    Authorization: 'Bearer ' + tilledSecretApiKey,
    'Tilled-Account': tilledAccountId,
  }
  axios.post('https://sandbox-api.tilled.com/v1/payment-intents',
    {
      amount: 500,
      currency: 'usd',
      payment_method_types: ['card','ach_debit'],
    },
    {
      headers: headers,
    })
    .then((response) => {
      console.log('Successfully created payment intent:')
      console.log(response.data)
      res.json({ client_secret: response.data.client_secret })
    })
    .catch((error) => {
      let errorMsg = 'Unable to create and return paymentIntent'

      if (error.response) {
      // Request made and server responded
        console.log(error.response.data)
        errorMsg = error.response.data.message
      } else if (error.request) {
      // The request was made but no response was received
        console.log(error.request)
      } else {
      // Something happened in setting up the request that triggered an Error
        console.log('Error', error.message)
      }

      res.status(400).send({ message: errorMsg })
    })
})

app.listen(port, () => {
  console.log(`Example app listening at http://localhost:${port}`)
  open(`http://localhost:${port}`)
})
