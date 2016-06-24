<?php
namespace Addons\Payment\Controller;

require_once ("common/CommonResponse.class.php");

/**
 * Wap支付初始化相应对象
 *
 * @author reymondtu
 *         @date 2010-12-06
 * @since php5
 * @version 1.1.0
 *         
 */
class WapPayInitResponse extends CommonResponse
{

    public $serialVersionUID = - 6343534412212614956;

    public function WapPayInitResponse($paraMap, $secretKey)
    {
        parent::CommonResponse($paraMap, $secretKey);
    }

    public function isRetCodeOK()
    {
        return parent::isRetCodeOK();
    }

    public function getURL()
    {
        return parent::getParameter("url");
    }

    public function getMessage()
    {
        return parent::getParameter("message");
    }
}
