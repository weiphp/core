<?php
// ---------------------------------------------------------
// 共享登录状态 获取用户信息 从小钱包跳转到应用时候使用
// ---------------------------------------------------------
namespace Addons\Payment\Controller;

require_once ("common/SDKRuntimeException.class.php");
require_once ("common/CommonResponse.class.php");

class ShareLoginState extends CommonResponse
{
    // 用户ID
    public $USER_ID = "user_id";

    public $TOKEN = "token";

    public function ShareLoginState($secretKey)
    {
        try {
            unset($this->parameters);
            $this->secretKey = $secretKey;
            /* GET */
            foreach ($_GET as $k => $v) {
                $this->setParameter($k, $v);
            }
            /* POST */
            foreach ($_POST as $k => $v) {
                $this->setParameter($k, $v);
            }
            $this->setParameter($this->RETCODE, "0");
            if (! $this->isRetCodeOK()) {
                throw new SDKRuntimeException("服务调用异常:" . $this->getPayInfo() . "<br>");
            }
            if (null == $this->getUserId()) {
                throw new SDKRuntimeException("财付通用户id未传入!<br>");
            }
        } catch (SDKRuntimeException $e) {
            die($e->errorMessage());
        }
        
        $this->setParameter($this->RETCODE, null);
        $this->verifySign();
    }

    public function getUserId()
    {
        return $this->getParameter($this->USER_ID);
    }

    public function getToken()
    {
        return $this->getParameter($this->TOKEN);
    }
}
