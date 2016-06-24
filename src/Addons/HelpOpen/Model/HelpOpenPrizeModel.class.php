<?php
namespace Addons\HelpOpen\Model;

use Think\Model;

/**
 * HelpOpen模型
 */
class HelpOpenPrizeModel extends Model
{

    public function getInfo($id, $update = false)
    {
        $map['id'] = $id;
        return $this->where($map)
            ->field(true)
            ->find();
    }
}
