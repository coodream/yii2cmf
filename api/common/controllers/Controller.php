<?php
/**
 * Created by PhpStorm.
 * User: yidashi
 * Date: 16/3/2
 * Time: 下午2:07
 */

namespace api\common\controllers;

use yii\filters\Cors;

class Controller extends \yii\rest\Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['contentNegotiator']['formats']['application/xml']);
        $behaviors['cors'] = [
            'class' => Cors::className(),
            'cors' => [
                'Origin' => ['http://127.0.0.1'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age' => 86400,
                'Access-Control-Expose-Headers' => ['Set-Cookie', 'X-Pagination-Current-Page']
            ]
        ];
        return $behaviors;
    }
}