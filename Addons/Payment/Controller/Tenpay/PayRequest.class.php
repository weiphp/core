<?php
// ---------------------------------------------------------
// 支付请求
// ---------------------------------------------------------
namespace Addons\Payment\Controller;

require_once ("common/CommonRequest.class.php");

class PayRequest extends CommonRequest
{

    /**
     * secretKey
     * 
     * @param
     *            secretKey
     */
    public function PayRequest($secretKey)
    {
        parent::__construct($secretKey);
    }

    /**
     * 生成支付跳转链接
     */
    public function getURL()
    {
        $paraString = $this->genParaStr();
        $domain = $this->getDomain();
        return $domain . $this->PAY_OPPOSITE_ADDRESS . "?" . $paraString;
    }

    public function send()
    {
        return null;
    }
}
