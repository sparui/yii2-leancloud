<?php

namespace mivan\leancloud;

use Curl\Curl;
use yii\base\Component;
use yii\helpers\Json;

/**
 * Lean Cloud Base
 */
class LeanCloud extends Component
{

    public $appId;

    public $appKey;

    public $masterKey;

    public $env = 'dev';

    public $apiUrl = 'https://api.leancloud.cn';

    /** @var  Curl */
    protected $_client;

    public function init()
    {
        parent::init();
        $this->_client = new Curl();
    }


    /**
     * 推送消息
     * @param string $title    标题
     * @param string $alert    内容
     * @param string $url   链接
     * @param string $where 推送条件
     * @return null
     */
    public function push($title, $alert, $url = '', $where = '')
    {

        if(is_numeric($where)) {
            $data['where'] = [
                'userId' => (string)$where
            ];
        } elseif (is_array($where)) {
            $data['where'] = $where;
        } else {
            return false;
        }

        $data['prod'] = $this->env;

        $data['data'] = [
            'title' => $title,
            'alert' => $alert,
            'sound' => 'cheering.caf',
            'url' => $url,
        ];

        return $this->_request('/1.1/push', $data);
    }


    /**
     * 请求服务器
     * @param string $method
     * @param $path
     * @param $data
     * @return null
     */
    protected function _request($path, $data, $method = 'POST')
    {
        $this->_client->setHeader('X-AVOSCloud-Application-Id', $this->appId);
        $this->_client->setHeader('X-AVOSCloud-Application-Key', $this->appKey);
        $this->_client->setHeader('Content-Type', 'application/json');
        $this->_client->{$method}($this->apiUrl.$path, Json::encode($data));
        return $this->_client->response;
    }

}
