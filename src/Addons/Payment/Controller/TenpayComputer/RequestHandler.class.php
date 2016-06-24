<?php
/**
 * ������
 * ============================================================================
 * api˵����
 * init(),��ʼ��������Ĭ�ϸ�һЩ������ֵ����cmdno,date�ȡ�
 * getGateURL()/setGateURL(),��ȡ/������ڵ�ַ,����������ֵ
 * getKey()/setKey(),��ȡ/������Կ
 * getParameter()/setParameter(),��ȡ/���ò���ֵ
 * getAllParameters(),��ȡ���в���
 * getRequestURL(),��ȡ������������URL
 * doSend(),�ض��򵽲Ƹ�֧ͨ��
 * getDebugInfo(),��ȡdebug��Ϣ
 * 
 * ============================================================================
 *
 */
namespace Addons\Payment\Controller;

class RequestHandler
{

    /**
     * ����url��ַ
     */
    public $gateUrl;

    /**
     * ��Կ
     */
    public $key;

    /**
     * ����Ĳ���
     */
    public $parameters;

    /**
     * debug��Ϣ
     */
    public $debugInfo;

    public function __construct()
    {
        $this->RequestHandler();
    }

    public function RequestHandler()
    {
        $this->gateUrl = "https://www.tenpay.com/cgi-bin/v1.0/service_gate.cgi";
        $this->key = "";
        $this->parameters = array();
        $this->debugInfo = "";
    }

    /**
     * ��ʼ��������
     */
    public function init()
    {
        // nothing to do
    }

    /**
     * ��ȡ��ڵ�ַ,����������ֵ
     */
    public function getGateURL()
    {
        return $this->gateUrl;
    }

    /**
     * ������ڵ�ַ,����������ֵ
     */
    public function setGateURL($gateUrl)
    {
        $this->gateUrl = $gateUrl;
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
     * ��ȡ������������URL
     */
    public function getRequestURL()
    {
        $this->createSign();
        
        $reqPar = "";
        ksort($this->parameters);
        foreach ($this->parameters as $k => $v) {
            $reqPar .= $k . "=" . urlencode($v) . "&";
        }
        
        // ȥ�����һ��&
        $reqPar = substr($reqPar, 0, strlen($reqPar) - 1);
        
        $requestURL = $this->getGateURL() . "?" . $reqPar;
        
        return $requestURL;
    }

    /**
     * ��ȡdebug��Ϣ
     */
    public function getDebugInfo()
    {
        return $this->debugInfo;
    }

    /**
     * �ض��򵽲Ƹ�֧ͨ��
     */
    public function doSend()
    {
        header("Location:" . $this->getRequestURL());
        exit();
    }

    /**
     * ����md5ժҪ,������:����������a-z����,������ֵ�Ĳ������μ�ǩ����
     */
    public function createSign()
    {
        $signPars = "";
        ksort($this->parameters);
        foreach ($this->parameters as $k => $v) {
            if ("" != $v && "sign" != $k) {
                $signPars .= $k . "=" . $v . "&";
            }
        }
        $signPars .= "key=" . $this->getKey();
        $sign = strtolower(md5($signPars));
        $this->setParameter("sign", $sign);
        
        // debug��Ϣ
        $this->_setDebugInfo($signPars . " => sign:" . $sign);
    }

    /**
     * ����debug��Ϣ
     */
    public function _setDebugInfo($debugInfo)
    {
        $this->debugInfo = $debugInfo;
    }
}
