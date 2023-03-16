<?php

namespace Omnipay\Vindicia;

/**
 * Vindicia PayPal Gateway
 *
 * Vindicia also supports purchases via PayPal Express. This gateway provides
 * that functionality. Note that PayPal Express is an offsite gateway.
 *
 * You use the same username and password as you do with the regular Vindicia
 * gateway.
 *
 * NOTE: PayPal transactions cannot be voided/canceld and should be refunded instead.
 *
 * Example:
 * <code>
 *   // set up the gateway
 *   $gateway = \Omnipay\Omnipay::create('Vindicia_PayPal');
 *   $gateway->setUsername('your_username');
 *   $gateway->setPassword('y0ur_p4ssw0rd');
 *   $gateway->setTestMode(false);
 *
 *   // now we start the purchase process
 *   $purchaseResponse = $gateway->purchase(array(
 *       'amount' => '9.99',
 *       'currency' => 'USD',
 *       'customerId' => '123456', // will be created if it doesn't already exist
 *       'card' => array(
 *           'postcode' => '12345'
 *       ),
 *       'paymentMethodId' => 'pp-123456', // this ID will be assigned to the PayPal account
 *       'returnUrl' => 'http://www.example.com/order_summary,
 *       'cancelUrl' => 'http://www.example.com/cart
 *   ))->send();
 *
 *   if ($purchaseResponse->isSuccessful()) {
 *       echo "Transaction id: " . $purchaseResponse->getTransactionId() . PHP_EOL;
 *       echo "Transaction reference: " . $purchaseResponse->getTransactionReference() . PHP_EOL;
 *       echo "Redirecting to: " . $purchaseResponse->getRedirectUrl();
 *       $purchaseResponse->redirect();
 *   } else {
 *       // error handling
 *   }
 *
 *   // ... now the user is filling out info on PayPal's site. Then they get redirected back
 *   // to your site, where you will complete the purchase ...
 *
 *   // get the PayPal transaction reference from the URL
 *   $payPalTransactionReference = $_GET['vindicia_vid'];
 *
 *   // complete the purchase
 *   $completeResponse = $gateway->completePurchase(array(
 *       'success' => true,
 *       'payPalTransactionReference' => $payPalTransactionReference
 *   ))->send();
 *
 *   if ($completeResponse->isSuccessful()) {
 *       // these are the same transaction ids you saw after the purchase call
 *       echo "Transaction id: " . $completeResponse->getTransactionId() . PHP_EOL;
 *       echo "Transaction reference: " . $completeResponse->getTransactionReference() . PHP_EOL;
 *   }
 * </code>
 */
class PayPalGateway extends AbstractVindiciaGateway
{
    /**
     * Get the gateway name.
     *
     * @return string
     */
    public function getName()
    {
        return 'Vindicia PayPal';
    }

    /**
     * Authorize a transaction. No money will actually be transferred.
     * 
     * @return PayPalAuthorizeRequest
     */
    public function authorize($parameters = array())
    {
        /**
         * @var \Omnipay\Vindicia\Message\PayPalAuthorizeRequest
         */
        return $this->createRequest('\Omnipay\Vindicia\Message\PayPalAuthorizeRequest', $parameters);
    }

    /**
     * Begin a PayPal purchase. A redirect URL will be returned to send the user to PayPal's
     * website.
     *
     * See Message\PayPalPurchaseRequest for more details.
     *
     * @param array $parameters
     * @return \Omnipay\Vindicia\Message\PayPalPurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        /**
         * @var \Omnipay\Vindicia\Message\PayPalPurchaseRequest
         */
        return $this->createRequest('\Omnipay\Vindicia\Message\PayPalPurchaseRequest', $parameters);
    }

    /**
     * Complete a PayPal purchase.
     *
     * See Message\CompletePayPalPurchaseRequest for more details.
     *
     * @param array $parameters
     * @return \Omnipay\Vindicia\Message\CompletePayPalPurchaseRequest
     */
    public function completePurchase(array $parameters = array())
    {
        /**
         * @var \Omnipay\Vindicia\Message\CompletePayPalPurchaseRequest
         */
        return $this->createRequest('\Omnipay\Vindicia\Message\CompletePayPalPurchaseRequest', $parameters);
    }

    /**
     * Create a subscription through PayPal. A redirect URL will be returned to send
     * the user to PayPal's website.
     *
     * See Message\CreatePayPalSubscriptionRequest for more details.
     *
     * @param array $parameters
     * @return \Omnipay\Vindicia\Message\CreatePayPalSubscriptionRequest
     */
    public function createSubscription(array $parameters = array())
    {
        /**
         * @var \Omnipay\Vindicia\Message\CreatePayPalSubscriptionRequest
         */
        return $this->createRequest('\Omnipay\Vindicia\Message\CreatePayPalSubscriptionRequest', $parameters);
    }

    /**
     * Update a subscription through PayPal. A redirect URL will be returned to send
     * the user to PayPal's website.
     *
     * See Message\CreatePayPalSubscriptionRequest for more details.
     *
     * @param array $parameters
     * @return \Omnipay\Vindicia\Message\CreatePayPalSubscriptionRequest
     */
    public function updateSubscription(array $parameters = array())
    {
        /**
         * @var \Omnipay\Vindicia\Message\CreatePayPalSubscriptionRequest
         */
        return $this->createRequest('\Omnipay\Vindicia\Message\CreatePayPalSubscriptionRequest', $parameters, true);
    }

    /**
     * Complete a subscription creation through PayPal.
     *
     * See Message\CompleteCreatePayPalSubscriptionRequest for more details.
     *
     * @param array $parameters
     * @return \Omnipay\Vindicia\Message\CompleteCreatePayPalSubscriptionRequest
     */
    public function completeCreateSubscription(array $parameters = array())
    {
        /**
         * @var \Omnipay\Vindicia\Message\CompleteCreatePayPalSubscriptionRequest
         */
        return $this->createRequest('\Omnipay\Vindicia\Message\CompleteCreatePayPalSubscriptionRequest', $parameters);
    }

    /**
     * Complete a subscription update through PayPal.
     *
     * See Message\CompleteCreatePayPalSubscriptionRequest for more details.
     *
     * @param array $parameters
     * @return \Omnipay\Vindicia\Message\CompleteCreatePayPalSubscriptionRequest
     */
    public function completeUpdateSubscription(array $parameters = array())
    {
        /**
         * @var \Omnipay\Vindicia\Message\CompleteCreatePayPalSubscriptionRequest
         */
        return $this->createRequest(
            '\Omnipay\Vindicia\Message\CompleteCreatePayPalSubscriptionRequest',
            $parameters,
            true
        );
    }

    /**
     * Update a payment method.
     *
     * See Message\CreatePaymentMethodRequest for more details.
     *
     * @param array $parameters
     * @return \Omnipay\Vindicia\Message\CreatePaymentMethodRequest
     */
    public function updatePaymentMethod(array $parameters = array())
    {
        /**
         * @var \Omnipay\Vindicia\Message\CreatePaymentMethodRequest
         */
        return $this->createRequest('\Omnipay\Vindicia\Message\CreatePaymentMethodRequest', $parameters, true);
    }

    // see AbstractVindiciaGateway for more functions and documentation
}
