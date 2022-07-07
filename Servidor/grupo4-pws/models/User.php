<?php

namespace app\models;

use webvimark\modules\UserManagement\models\rbacDB\Role;
use Yii;
use yii\base\InvalidConfigException;
use yii\filters\RateLimitInterface;

class User extends \webvimark\modules\UserManagement\models\User implements RateLimitInterface
{
    private $rateLimit = 5;
    private $allowance = 1;
    private $allowance_updated_at;


    public function __construct($config = []) {
        parent::__construct($config);
        $this->allowance_updated_at = date('U');
    }

    /**
     *
     * {@inheritDoc}
     * @see \yii\filters\RateLimitInterface::getRateLimit()
     */
    public function getRateLimit($request, $action)
    {
        return [$this->rateLimit, 10]; // $rateLimit requests per second
    }

    /**
     *
     * {@inheritDoc}
     * @see \yii\filters\RateLimitInterface::loadAllowance()
     */
    public function loadAllowance($request, $action)
    {
        $allowance = \Yii::$app->cache->get('allowance');
        if ($allowance === false) {
            $allowance = $this->allowance;
        }
        $allowance_updated_at = \Yii::$app->cache->get('allowance_updated_at');
        if ($allowance_updated_at === false) {
            $allowance_updated_at = $this->allowance_updated_at;
        }
        return [$allowance, $allowance_updated_at];
    }

    /**
     *
     * {@inheritDoc}
     * @see \yii\filters\RateLimitInterface::saveAllowance()
     */
    public function saveAllowance($request, $action, $allowance, $timestamp)
    {
        \Yii::$app->cache->set('allowance', $allowance);
        \Yii::$app->cache->set('allowance_updated_at', $timestamp);
    }

}
