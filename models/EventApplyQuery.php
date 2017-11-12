<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[EventApply]].
 *
 * @see EventApply
 */
class EventApplyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return EventApply[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return EventApply|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
