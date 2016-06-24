<?php
namespace Addons\Payment\Controller;

require_once ('common/CommonRequest.class.php');
require_once ('common/CommonResponse.class.php');

/**
 * Wap回跳财付通<br/>
 * 根据设置参数生成带有登录状态的财付通URL
 *
 * @author marcyli
 *         @date 2011-05-11
 *         @php5
 * @version 1.0
 */
class WapJumpToTenpayRequest extends CommonRequest
{

    public $serialVersionUID = 5867685410743939231;

    public $WAP_JUMP_TO_TENPAY_ADDRESS = 'https://wap.tenpay.com/cgi-bin/wapmainv2.0/wm_clientlogin.cgi';

    public $SANDBOX_WAP_JUMP_TO_TENPAY_ADDRESS = 'http://sandwap.tenpay.com/cgi-bin/wapmainv2.0/wm_clientlogin.cgi';

    /**
     * 构造方法
     *
     * @param
     *            secretKey
     *            加密KEY
     */
    public function WapJumpToTenpayRequest($secretKey)
    {
        // super(secretKey);
        parent::__construct($secretKey);
    }

    /**
     * 获取域名地址
     */
    public function getDomain()
    {
        $domain = null;
        if (parent::isInSandBox()) {
            $domain = $this->SANDBOX_WAP_JUMP_TO_TENPAY_ADDRESS;
        } else {
            $domain = $this->WAP_JUMP_TO_TENPAY_ADDRESS;
        }
        return $domain;
    }

    /**
     * 得到回调财付通URL
     *
     * @param            
     *
     */
    public function getURL()
    {
        $url = $this->getDomain() . '?' . parent::genParaStr();
        return $url;
    }

    public function send()
    {
        // CommonResponse
        return null;
    }
}
