<?php
namespace Addons\Guess\Model;

use Home\Model\WeixinModel;

/**
 * Guess的微信模型
 */
class WeixinAddonModel extends WeixinModel
{

    public function reply($dataArr, $keywordArr = array())
    {
        $config = getAddonConfig('Guess'); // 获取后台插件的配置参数
                                               // dump($config);
    }
}
