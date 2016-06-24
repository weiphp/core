<?php
namespace Addons\Payment\Controller;

class ResponseHandler
{

    /**
     * 密钥
     */
    public $key;

    /**
     * 应答的参数
     */
    public $parameters;

    /**
     * debug信息
     */
    public $debugInfo;

    public function __construct()
    {
        $this->ResponseHandler();
    }

    public function ResponseHandler()
    {
        $this->key = "";
        $this->parameters = array();
        $this->debugInfo = "";
        
        /* GET */
        foreach ($_GET as $k => $v) {
            $this->setParameter($k, $v);
        }
        /* POST */
        foreach ($_POST as $k => $v) {
            $this->setParameter($k, $v);
        }
    }

    /**
     * 获取密钥
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * 设置密钥
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * 获取参数值
     */
    public function getParameter($parameter)
    {
        return $this->parameters[$parameter];
    }

    /**
     * 设置参数值
     */
    public function setParameter($parameter, $parameterValue)
    {
        $this->parameters[$parameter] = $parameterValue;
    }

    /**
     * 获取所有请求的参数
     * 
     * @return array
     */
    public function getAllParameters()
    {
        return $this->parameters;
    }

    /**
     * 是否财付通签名,规则是:按参数名称a-z排序,遇到空值的参数不参加签名。
     * true:是
     * false:否
     */
    public function isTenpaySign($keyArr = '')
    {
        $signPars = "";
        ksort($this->parameters);
        foreach ($this->parameters as $k => $v) {
            if ("sign" != $k && "" != $v && ! $keyArr) {
                $signPars .= $k . "=" . $v . "&";
            } elseif ("sign" != $k && "" != $v && $keyArr) {
                if (in_array($k, $keyArr)) {
                    $signPars .= $k . "=" . $v . "&";
                }
            }
        }
        $signPars .= "key=" . $this->getKey();
        
        $sign = strtolower(md5($signPars));
        
        $tenpaySign = strtolower($this->getParameter("sign"));
        
        // debug信息
        $this->_setDebugInfo($signPars . " => sign:" . $sign . " tenpaySign:" . $this->getParameter("sign"));
        
        return $sign == $tenpaySign;
    }

    /**
     * 获取debug信息
     */
    public function getDebugInfo()
    {
        return $this->debugInfo;
    }

    /**
     * 显示处理结果。
     * 
     * @param $show_url 显示处理结果的url地址,绝对url地址的形式(http://www.xxx.com/xxx.php)。            
     */
    public function doShow($show_url)
    {
        $strHtml = "<html><head>\r\n" . "<meta name=\"TENCENT_ONLINE_PAYMENT\" content=\"China TENCENT\">" . "<script language=\"javascript\">\r\n" . "window.location.href='" . $show_url . "';\r\n" . "</script>\r\n" . "</head><body></body></html>";
        
        echo $strHtml;
        
        exit();
    }

    /**
     * 是否财付通签名
     * 
     * @param
     *            signParameterArray 签名的参数数组
     * @return boolean
     */
    public function _isTenpaySign($signParameterArray)
    {
        $signPars = "";
        foreach ($signParameterArray as $k) {
            $v = $this->getParameter($k);
            if ("sign" != $k && "" != $v) {
                $signPars .= $k . "=" . $v . "&";
            }
        }
        $signPars .= "key=" . $this->getKey();
        
        $sign = strtolower(md5($signPars));
        
        $tenpaySign = strtolower($this->getParameter("sign"));
        
        // debug信息
        $this->_setDebugInfo($signPars . " => sign:" . $sign . " tenpaySign:" . $this->getParameter("sign"));
        
        return $sign == $tenpaySign;
    }

    /**
     * 设置debug信息
     */
    public function _setDebugInfo($debugInfo)
    {
        $this->debugInfo = $debugInfo;
    }
}
