<?php

namespace mivan\leancloud;

use Curl\Curl;
use yii\base\Component;

/**
 * Lean Cloud Base
 */
class LeanCloud extends Component
{

    public $appId = 'gvjh0sv7hkxfdyj4nrb7pjrv1b5fymi1xln7xkpmrq6i8ldh';

    public $appKey = '9441i3ojnalv28vn17rbfxl6eqn069210c21vdq8nukliy8z';

    public $masterKey = 'fn3ijhq7pcwlfw32ozoukulj23sqwdvpji7jha9dbtmbll0p';

    public $apiUrl = 'https://api.leancloud.cn';

    private $_client;

    public function init()
    {
        parent::init();
//        $this->appId = \Yii::$app->params['leanCloud']['appId'];
//        $this->appKey = \Yii::$app->params['leanCloud']['appKey'];
//        $this->masterKey = \Yii::$app->params['leanCloud']['masterKey'];

        $this->_client = new Curl();
    }
}
