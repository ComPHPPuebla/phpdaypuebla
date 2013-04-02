<?php
/**
 * Simple EventBrite Client
 *
 * The client's default (and only) response format is JSON
 *
 * PHP version 5.3
 *
 * @author     LMV <montealegreluis@gmail.com>
 * @copyright  Comunidad PHP Puebla 2013
 * @license    MIT
 */
namespace ComPHPPuebla\EventBrite;

use \Guzzle\Http\Client;

/**
 * Simple EventBrite Client
 *
 * The client's default (and only) response format is JSON
 */
class EventBriteClient
{
    /**
     * @var string
     */
    const URL = 'https://www.eventbrite.com/json';

    /**
     * @var string
     */
    protected $userKey;

    /**
     * @var string
     */
    protected $appKey;

    /**
     * @var string
     */
    protected $eventId;

    /**
     * @var \Guzzle\Http\Client
     */
    protected $client;

    /**
     * @var array
     */
    protected $methods;

    /**
     * @param string $appKey
     * @param string $eventId
     */
    public function __construct(array $options)
    {
        $this->setAppKey($options['appKey']);
        $this->setEventId($options['eventId']);
        $this->setUserKey($options['userKey']);

        $this->setMethods(array(
            'event_get' => sprintf('%s/event_get?app_key=%s', self::URL, $this->getAppKey()),
            'event_list_attendees' => sprintf('%s/event_list_attendees?app_key=%s', self::URL, $this->getAppKey()),
        ));
    }

    /**
     * @param array $methods
     */
    protected function setMethods(array $methods)
    {
        $this->methods = $methods;
    }

    /**
     * @param string $key
     * @return string
     */
    protected function getMethod($key)
    {
        return $this->methods[$key];
    }

    /**
     * @return string
     */
    public function getUserKey()
    {
        return $this->userKey;
    }

    /**
     * @param string $userKey
     */
    public function setUserKey($userKey)
    {
        $this->userKey = $userKey;
    }


    /**
     * @return string
     */
    public function getAppKey()
    {
        return $this->appKey;
    }

    /**
     * @param string $appKey
     */
    public function setAppKey($appKey)
    {
        $this->appKey = $appKey;
    }

    /**
     * @return string
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * @param string $eventId
     */
    public function setEventId($eventId)
    {
        $this->eventId = $eventId;
    }


    /**
     * @return \Guzzle\Http\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param \Guzzle\Http\Client $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @param string $eventId
     * @return string
     */
    public function getEventDetails()
    {
        $uri = sprintf(
            '%s&id=%s', $this->getMethod('event_get'), $this->getEventId()
        );
        $request = $this->getClient()->get($uri);
        $response = $request->send();
        return json_decode($response->getBody());
    }

    /**
     * @param string $eventId
     * @return string
     */
    public function getEventAttendees()
    {
        $uri = sprintf(
            '%s&user_key=%s&id=%s',
             $this->getMethod('event_list_attendees'), $this->getUserKey(), $this->getEventId()
        );
        $request = $this->getClient()->get($uri);
        $response = $request->send();
        return json_decode($response->getBody());
    }

    /**
     * @return int
     */
    public function getEventAttendeesCount()
    {
        return count($this->getEventAttendees()->attendees);
    }
}