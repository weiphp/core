<?php
namespace Addons\Payment\Controller;

class ResponseHandler
{

    /**
     * ��Կ
     */
    public $key;

    /**
     * Ӧ��Ĳ���
     */
    public $parameters;

    /**
     * debug��Ϣ
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
     * ��ȡ��Կ
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * ������Կ
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * ��ȡ����ֵ
     */
    public function getParameter($parameter)
    {
        return $this->parameters[$parameter];
    }

    /**
     * ���ò���ֵ
     */
    public function setParameter($parameter, $parameterValue)
    {
        $this->parameters[$parameter] = $parameterValue;
    }

    /**
     * ��ȡ��������Ĳ���
     * 
     * @return array
     */
    public function getAllParameters()
    {
        return $this->parameters;
    }

    /**
     * �Ƿ�Ƹ�ͨǩ��,������:����������a-z����,������ֵ�Ĳ������μ�ǩ����
     * true:��
     * false:��
     */
    public function isTenpaySign()
    {
        $signPars = "";
        ksort($this->parameters);
        foreach ($this->parameters as $k => $v) {
            if ("sign" != $k && "" != $v) {
                $signPars .= $k . "=" . $v . "&";
            }
        }
        $signPars .= "key=" . $this->getKey();
        
        $sign = strtolower(md5($signPars));
        
        $tenpaySign = strtolower($this->getParameter("sign"));
        
        // debug��Ϣ
        $this->_setDebugInfo($signPars . " => sign:" . $sign . " tenpaySign:" . $this->getParameter("sign"));
        
        return $sign == $tenpaySign;
    }

    /**
     * ��ȡdebug��Ϣ
     */
    public function getDebugInfo()
    {
        return $this->debugInfo;
    }

    /**
     * ��ʾ��������
     * 
     * @param $show_url ��ʾ��������url��ַ,����url��ַ����ʽ(http://www.xxx.com/xxx.php)��            
     */
    public function doShow($show_url)
    {
        $strHtml = "<html><head>\r\n" . "<meta name=\"TENCENT_ONLINE_PAYMENT\" content=\"China TENCENT\">" . "<script language=\"javascript\">\r\n" . "window.location.href='" . $show_url . "';\r\n" . "</script>\r\n" . "</head><body></body></html>";
        
        echo $strHtml;
        
        exit();
    }

    /**
     * �Ƿ�Ƹ�ͨǩ��
     * 
     * @param
     *            signParameterArray ǩ���Ĳ�������
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
        
        // debug��Ϣ
        $this->_setDebugInfo($signPars . " => sign:" . $sign . " tenpaySign:" . $this->getParameter("sign"));
        
        return $sign == $tenpaySign;
    }

    /**
     * ����debug��Ϣ
     */
    public function _setDebugInfo($debugInfo)
    {
        $this->debugInfo = $debugInfo;
    }
}
