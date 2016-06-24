<?php
// ---------------------------------------------------------
// 返回xml数据的请求超类
// ---------------------------------------------------------
namespace Addons\Payment\Controller;

require_once ("CommonRequest.class.php");
require_once ("util/HttpClientUtil.php");
require_once ("util/XmlParseUtil.php");

class RetXmlRequest extends CommonRequest
{

    public function RetXmlRequest($secretKey)
    {
        $this->secretKey = $secretKey;
    }
    
    // 获取url
    public function getURL($opposite_address)
    {
        $paraString = $this->genParaStr();
        $domain = $this->getDomain();
        return $domain . $opposite_address . "?" . $paraString;
    }

    public function retXmlHttpCall($opposite_address)
    {
        $queryXml = null;
        $objH = new HttpClientUtil();
        try {
            $queryXml = $objH->httpClientCall($this->getURL($opposite_address), $this->getInputCharset());
        } catch (Exception $e) {
            throw new SDKRuntimeException("http请求失败:" + $e . getMessage());
        } catch (SDKRuntimeException $e) {
            die($e->errorMessage());
        }
        $xmlParse = new XmlParseUtil();
        return $xmlParse->openapiXmlToMap($queryXml, $this->getInputCharset());
    }

    public function httpCallRetXmlStr($opposite_address)
    {
        $objH = new HttpClientUtil();
        return $objH->httpClientCall($this->getURL($opposite_address), $this->getInputCharset());
    }
}
