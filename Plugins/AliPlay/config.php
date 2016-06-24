<?php
return array(
    'group' => array(
        'type' => 'group',
        'options' => array(
            'basicsettings' => array(
                'title' => '基本设置',
                'options' => array(
                    'pay_type' => array( // 配置在表单中的键名 ,这个会是config[random]
                        'title' => '使用类型:', // 表单的文字
                        'type' => 'select', // 表单的类型：text、textarea、checkbox、radio、select等
                        'options' => array( // select 和radion、checkbox的子选项
                            '1' => '担保交易', // 值=>文字
                            '2' => '即时交易'
                        )
                        // '3'=>'网银交易',
                        ,
                        'value' => 1
                    ) // 表单的默认值
,
                    'codelogin' => array(
                        'title' => '是否启用支付宝:',
                        'type' => 'radio',
                        'options' => array(
                            '1' => '开启',
                            '0' => '关闭'
                        ),
                        'value' => 1,
                        'tip' => '必须在这里开启以后才能使用此功能'
                    )
                )
            ),
            'developer' => array(
                'tip' => '这个页面配置的信息都可以在支付宝上获取到，随便填写不起任何作用',
                'title' => '帐户设置',
                'options' => array(
                    'PARTNER' => array(
                        'title' => '合作身份者id:',
                        'type' => 'text',
                        'value' => $partner,
                        'tip' => '合作身份者id，以2088开头的16位纯数字'
                    ),
                    'KEY' => array(
                        'title' => '安全检验码:',
                        'type' => 'text',
                        'value' => $key,
                        'tip' => '安全检验码，以数字和字母组成的32位字符'
                    ),
                    'SELLER_EMAIL' => array(
                        'title' => '收款帐户:',
                        'type' => 'text',
                        'value' => $return_url,
                        'tip' => '卖家支付宝帐户'
                    )
                )
            ),
            'msgset' => array(
                'tip' => '这个页面配置的信息必须符合网站的业务逻辑，随便填写不起任何作用',
                'title' => '高级设置',
                'options' => array(
                    'NOTIFY_URL' => array(
                        'title' => '服务器异步路径:',
                        'type' => 'text',
                        'value' => $notify_url,
                        'tip' => '服务器异步路径'
                    ),
                    'RETURN_URL' => array(
                        'title' => '页面跳转路径:',
                        'type' => 'text',
                        'value' => $return_url,
                        'tip' => '页面跳转同步通知页面路径'
                    ),
                    'out_trade_no' => array(
                        'title' => '商户订单号:',
                        'type' => 'text',
                        'value' => $out_trade_no,
                        'tip' => '商户网站订单系统中唯一订单号，必填'
                    ),
                    'subject' => array(
                        'title' => '订单名称:',
                        'type' => 'text',
                        'value' => $subject,
                        'tip' => '必填'
                    ),
                    'price' => array(
                        'title' => '付款金额:',
                        'type' => 'text',
                        'value' => $price,
                        'tip' => '付款金额'
                    ),
                    'logistics_fee' => array(
                        'title' => '物流费用:',
                        'type' => 'text',
                        'value' => $logistics_fee,
                        'tip' => '必填，即运费'
                    ),
                    'logistics_type' => array(
                        'title' => '物流类型:',
                        'type' => 'text',
                        'value' => $return_url,
                        'tip' => '必填，三个值可选：EXPRESS（快递）、POST（平邮）、EMS（EMS）'
                    ),
                    'logistics_payment' => array(
                        'title' => '物流支付方式:',
                        'type' => 'text',
                        'value' => $logistics_payment,
                        'tip' => '必填，两个值可选：SELLER_PAY（卖家承担运费）、BUYER_PAY（买家承担运费）'
                    ),
                    'body' => array(
                        'title' => '订单描述:',
                        'type' => 'text',
                        'value' => $body,
                        'tip' => '订单描述'
                    ),
                    'show_url' => array(
                        'title' => '商品展示地址:',
                        'type' => 'text',
                        'value' => $show_url,
                        'tip' => '需以http://开头的完整路径，如：http://www.xxx.com/myorder.html'
                    ),
                    'receive_name' => array(
                        'title' => '收货人姓名:',
                        'type' => 'text',
                        'value' => $receive_name,
                        'tip' => '如：张三'
                    ),
                    'receive_address' => array(
                        'title' => '收货人地址:',
                        'type' => 'text',
                        'value' => $receive_address,
                        'tip' => '如：XX省XXX市XXX区XXX路XXX小区XXX栋XXX单元XXX号'
                    ),
                    'receive_zip' => array(
                        'title' => '收货人邮编:',
                        'type' => 'text',
                        'value' => $receive_zip,
                        'tip' => '如：123456'
                    ),
                    'receive_mobile' => array(
                        'title' => '收货人手机号码:',
                        'type' => 'text',
                        'value' => $receive_mobile,
                        'tip' => '如：13312341234'
                    ),
                    'receive_phone' => array(
                        'title' => '收货人电话号码:',
                        'type' => 'text',
                        'value' => $receive_phone,
                        'tip' => '如：13312341234'
                    )
                )
            )
        )
    )
);
