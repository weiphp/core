<?php
// ---------------------------------------------------------
// 通知查询请求
// ---------------------------------------------------------
namespace Addons\Payment\Controller;

require_once ("common/RetXmlRequest.class.php");
require_once ("NotifyQueryResponse.class.php");

class NotifyQueryRequest extends RetXmlRequest
{

    /**
     * 构造方法
     *
     * @param
     *            secretKey
     */
    public function NotifyQueryRequest($secretKey)
    {
        parent::RetXmlRequest($secretKey);
    }

    public function send()
    {
        $respone = new NotifyQueryResponse($this->retXmlHttpCall($this->VERIFY_NOTIFY_OPPOSITE_ADDRESS), $this->getSecretKey());
        return $respone;
    }
}
