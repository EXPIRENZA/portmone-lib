<?php

namespace Expirenza\portmone;

use Expirenza\portmone\entities\Actor;
use Expirenza\portmone\entities\Auth;
use Expirenza\portmone\entities\Card;
use Expirenza\portmone\entities\Client;
use Expirenza\portmone\entities\Order;
use Expirenza\portmone\entities\Request;
use Expirenza\portmone\entities\RequestForPayment;
use Expirenza\portmone\entities\RequestForStatus;
use Expirenza\portmone\entities\RequestForToken;
use Expirenza\portmone\entities\Response;
use Expirenza\portmone\entities\ResponseOrderStatus;
use Expirenza\portmone\entities\ResponseReturn;

class Portmone implements PortmoneInterface
{
    const DEFAULT_CURRENCY = 'UAH';
    const DEFAULT_LANG = 'uk';

    protected $seller;
    protected $order;
    protected $auth;
    protected $returnUrl;

    public function __construct(Auth $auth, $returnUrl)
    {
        $this->auth = $auth;
        $this->returnUrl = $returnUrl;
    }

    /**
     * Get token card page url
     *
     * @param null $returnUrl
     * @return bool|string URL
     */
    public function cardTokenPage()
    {
        $requester = new Requester(new RequestForToken($this->auth->getPayeeId(), $this->returnUrl));
        if ($requester->send()) {
            return $requester->responseUrl();
        }
        return false;
    }

    /**
     * Get default payment page url
     *
     * @param Client $client
     * @return bool|mixed
     */

    public function paymentPage(Client $client)
    {
        $requester = new Requester(new RequestForPayment(
            $this->auth->getPayeeId(),
            $this->returnUrl,
            $client->getOrder(),
            null,
            $this->auth->getLogin()
        ));
        if ($requester->send()) {
            return $requester->responseUrl();
        }
        return false;

    }

    /**
     * Get token payment page url
     *
     * @param Client $client
     * @return bool|mixed
     */
    public function paymentToCardPage(Client $client)
    {
        $requester = new Requester(new RequestForPayment(
            $this->auth->getPayeeId(),
            $this->returnUrl,
            $client->getOrder(),
            $client->getCard(),
            $this->auth->getLogin()
        ));

        if ($requester->send()) {
            return $requester->responseUrl();
        }
        return false;

    }


    /**
     * Response parser for getting response as object
     *
     * @param string $responseString
     * @return ResponseReturn
     */
    public function parseResponseReturn(string $responseString)
    {
        $response = new ResponseReturn();
        $bits = explode('&', $responseString);
        foreach ($bits as &$bit) {
            $parts = explode('=', $bit);
            $key = $parts[0] ?? false;
            $value = $parts[1] ?? false;

            if ($key == 'SHOPBILLID') {
                $response->setShopBillId($value);
            }

            if ($key == 'SHOPORDERNUMBER') {
                $response->setShopOrderNumber($value);
            }

            if ($key == 'APPROVALCODE') {
                $response->setApprovalCode($value);
            }

            if ($key == 'BILL_AMOUNT') {
                $response->setBillAmount($value);
            }

            if ($key == 'TOKEN') {
                $response->setToken($value);
            }

            if ($key == 'RESULT') {
                $response->setResult($value);
            }

            if ($key == 'CARD_MASK') {
                $response->setCardMask($value);
            }

            if ($key == 'ATTRIBUTE1') {
                $response->setAttribute1($value);
            }

            if ($key == 'ATTRIBUTE2') {
                $response->setAttribute2($value);
            }

            if ($key == 'ATTRIBUTE3') {
                $response->setAttribute3($value);
            }

            if ($key == 'ATTRIBUTE4') {
                $response->setAttribute4($value);
            }

            if ($key == 'RECEIPT_URL') {
                $response->setReceiptUrl(urldecode($value));
            }

            if ($key == 'LANG') {
                $response->setLang($value);
            }

            if ($key == 'DESCRIPTION') {
                $response->setDescription($value);
            }

            if ($key == 'IPSTOKEN') {
                $response->setIpsToken($value);
            }

            if ($key == 'ERRORIPSCODE') {
                $response->setErrorIpsCode($value);
            }

            if ($key == 'ERRORIPSMESSAGE') {
                $response->setErrorIpsMessage($value);
            }
        }

        return $response;
    }

    public function parseResponseOrderStatus($xmlResponseString)
    {

        $response = new ResponseOrderStatus();
        $xml = new \SimpleXMLElement($xmlResponseString);

        if (isset($xml[0]->orders->order) && !empty($xml[0]->orders->order)) {

            foreach (get_object_vars($xml[0]->orders->order) as $key => $value) {

                if ($key == 'shop_bill_id') {
                    $response->setShopBillId($value);
                }

                if ($key == 'shop_order_number') {
                    $response->setShopOrderNumber($value);
                }

                if ($key == 'status') {
                    $response->setStatus($value);
                }

                if ($key == 'description') {
                    $response->setDescription($value);
                }

                if ($key == 'bill_date') {
                    $response->setBillDate($value);
                }

                if ($key == 'pay_date') {
                    $response->setPayDate($value);
                }

                if ($key == 'bill_amount') {
                    $response->setBillAmount($value);
                }

                if ($key == 'auth_code') {
                    $response->setAuthCode($value);
                }

                if ($key == 'attribute1') {
                    $response->setAttribute1($value);
                }

                if ($key == 'attribute2') {
                    $response->setAttribute2($value);
                }

                if ($key == 'error_code') {
                    $response->setErrorCode($value);
                }
            }

        }
        return $response;
    }

    /**
     * Get optional data for order
     *
     * @param Order $order
     * @return bool|false|string
     */
    public function getOrderStatus(Order $order)
    {
        $requester = new Requester(new RequestForStatus(
                $this->auth->getPayeeId(),
                $this->auth->getLogin(),
                $this->auth->getPassword(),
                $order->getNumber()
            )
        );

        if ($result = $requester->send()) {
            return $result;
        }
        return false;
    }


    /**
     * Get HTML form token page
     *
     * @return mixed
     */
    public function createTokenForm()
    {
        $requester = new Requester(new RequestForToken($this->auth->getPayeeId(), $this->returnUrl));

        $form = $requester->getForm();

        return $form;
    }

    /**
     * Get HTML form token page
     *
     * @param Client $client
     * @param null $formId
     * @param null $buttonId
     * @return mixed
     */
    public function createPaymentToCardForm(Client $client, $formId = null, $buttonId = null)
    {
        $requester = new Requester(new RequestForPayment(
            $this->auth->getPayeeId(),
            $this->returnUrl,
            $client->getOrder(),
            $client->getCard(),
            $this->auth->getLogin()
        ));

        return $requester->getForm($buttonId, $formId);
    }

    /**
     * @return mixed
     */
    public function getSeller()
    {
        return $this->seller;
    }

    /**
     * @param mixed $seller
     */
    public function setSeller($seller)
    {
        $this->seller = $seller;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return Auth
     */
    public function getAuth(): Auth
    {
        return $this->auth;
    }

    /**
     * @param Auth $auth
     */
    public function setAuth(Auth $auth): void
    {
        $this->auth = $auth;
    }

    /**
     * @return mixed
     */
    public function getReturnUrl()
    {
        return $this->returnUrl;
    }

    /**
     * @param mixed $returnUrl
     */
    public function setReturnUrl($returnUrl): void
    {
        $this->returnUrl = $returnUrl;
    }


}
