<?php 
namespace Phphub\Core;

use Config;
use JPush\JPushClient;

class Jpush
{
    private $client;
    private $payload;
    private $extras;
    private $notification;
    private $sound = 'default';

    /**
     * 初始化.
     */
    public function __construct()
    {
        $app_key       = Config::get('services.jpush.app_key');
        $master_secret = Config::get('services.jpush.secret');

        $this->client  = new JPushClient($app_key, $master_secret);
        $this->payload = $this->client->push();

        $this->payload->setOptions([
            'apns_production' => Config::get('services.jpush.apns_production'),
        ]);
    }

    /**
     * 指定推送的平台.
     *
     * @param $platform
     *
     * @return $this
     */
    public function platform($platform)
    {
        if (!in_array($platform, ['ios', 'android', 'winphone', 'all'])) {
            throw new \InvalidArgumentException('Invalid device type: '.$platform);
        }

        $this->payload->setPlatform($platform);

        return $this;
    }

    /**
     * 推送消息.
     *
     * @param $msg
     *
     * @return $this
     */
    public function message($msg)
    {
        $this->notification = $msg;

        return $this;
    }

    /**
     * 通过别名推送.
     *
     * @param array $alias
     *
     * @return $this
     */
    public function toAlias($alias)
    {
        $alias = (array) $alias;
        $this->payload->setAudience(['alias' => $alias]);

        return $this;
    }

    /**
     * 通知全部用户.
     *
     * @return $this
     */
    public function toAll()
    {
        $this->payload->setAudience('all');

        return $this;
    }

    /**
     * 开始发布.
     */
    public function send()
    {
        $this->payload->setNotification([
            'ios' => [
                'alert'  => $this->notification,
                'extras' => $this->extras,
                'sound'  => $this->sound,
            ],
            'android' => [
                'alert'  => $this->notification,
                'extras' => $this->extras,
            ],
        ]);

        $this->payload->send();
    }

    /**
     * 附带信息.
     *
     * @param array $extras
     *
     * @return $this
     */
    public function extras(Array $extras)
    {
        $this->extras = $extras;

        return $this;
    }
}
