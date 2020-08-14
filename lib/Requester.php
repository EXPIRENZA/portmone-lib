<?php


namespace Expirenza\portmone;


use Expirenza\portmone\entities\RequestForStatus;
use Expirenza\portmone\entities\Request;


class Requester
{

    const API_URL = 'https://www.portmone.com.ua/gateway/';

    public $request;

    public $responseBody;
    public $responseCode;
    public $responseUrl;

    protected $debug;

    public function __construct($request, $debug = false)
    {
        $this->request = $request;
        $this->debug = $debug;
    }

    public function getForm($buttonId = null, $formId = null)
    {
        $form = str_replace('{JSON}', $this->request->generateRequestData(), $this->baseHtml());
        $form = str_replace('{API_URL}', self::API_URL, $form);

        if (empty($buttonId)) {
            $buttonId = 'payment-form-button';
        }

        if (empty($formId)) {
            $formId = 'payment-form-id';
        }

        $form = str_replace('{BUTTON_ID}', $buttonId, $form);
        $form = str_replace('{FORM_ID}', $formId, $form);

        return $form;
    }

    private function baseHtml()
    {
        $html = " 
          <form action=\"{API_URL}\" method=\"post\" id=\"{FORM_ID}\" target=\"_blank\">
             <input type=\"hidden\" name=\"bodyRequest\" value='{JSON}' />
             <input type=\"hidden\" name=\"typeRequest\" value='json' />
             <input type=\"submit\" value=\"button\" id=\"{BUTTON_ID}\" />
          </form>
        ";

        return $html;

    }

    protected function getFormFields()
    {
        $body = $this->request->generateRequestData();

        $fields = [
            'bodyRequest' => $body,
            'typeRequest' => 'json',
        ];

        return $fields;
    }

    public function send()
    {
        if ($this->request instanceof RequestForStatus) {
            $body = $this->request->generateRequestData();
            return $this->phpPostRequest(self::API_URL, $body);
        } else {

            return $this->phpPostRequest(self::API_URL, $this->getFormFields());
        }
    }

    protected function phpPostRequest($url, $data)
    {
        $result = file_get_contents(
            $url,
            false,
            stream_context_create([
                'http' => [
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/x-www-form-urlencoded',
                    'content' => http_build_query($data),
                    'ignore_errors' => true // to suppress a warnings
                ],
            ])
        );
        $this->responseBody = $result;
        $this->responseCode = (int)substr($http_response_header[0], 9, 3); // e.g. 403 from "HTTP/1.1 403 Forbidden"
        if (200 !== intval($this->responseCode) && 302 !== intval($this->responseCode)) {
            return false;
        }
        return $result;
    }

    public function responseUrl()
    {
        $match = [];
        preg_match('<link href="(.+)" hreflang="x-default" rel="alternate" >', $this->responseBody, $match);
        $url =  $match[1] ?? false;

        return str_replace('&amp;', '&', $url);
    }
}
