<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Notify\V1\Service;

use Twilio\Deserialize;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 * 
 * @property string sid
 * @property string accountSid
 * @property string serviceSid
 * @property \DateTime dateCreated
 * @property string identities
 * @property string tags
 * @property string segments
 * @property string priority
 * @property integer ttl
 * @property string title
 * @property string body
 * @property string sound
 * @property string action
 * @property array data
 * @property array apn
 * @property array gcm
 * @property array fcm
 * @property array sms
 * @property array facebookMessenger
 * @property array alexa
 */
class NotificationInstance extends InstanceResource {
    /**
     * Initialize the NotificationInstance
     * 
     * @param \Twilio\Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $serviceSid The service_sid
     * @return \Twilio\Rest\Notify\V1\Service\NotificationInstance 
     */
    public function __construct(Version $version, array $payload, $serviceSid) {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = array(
            'sid' => Values::array_get($payload, 'sid'),
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'serviceSid' => Values::array_get($payload, 'service_sid'),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'identities' => Values::array_get($payload, 'identities'),
            'tags' => Values::array_get($payload, 'tags'),
            'segments' => Values::array_get($payload, 'segments'),
            'priority' => Values::array_get($payload, 'priority'),
            'ttl' => Values::array_get($payload, 'ttl'),
            'title' => Values::array_get($payload, 'title'),
            'body' => Values::array_get($payload, 'body'),
            'sound' => Values::array_get($payload, 'sound'),
            'action' => Values::array_get($payload, 'action'),
            'data' => Values::array_get($payload, 'data'),
            'apn' => Values::array_get($payload, 'apn'),
            'gcm' => Values::array_get($payload, 'gcm'),
            'fcm' => Values::array_get($payload, 'fcm'),
            'sms' => Values::array_get($payload, 'sms'),
            'facebookMessenger' => Values::array_get($payload, 'facebook_messenger'),
            'alexa' => Values::array_get($payload, 'alexa'),
        );

        $this->solution = array('serviceSid' => $serviceSid);
    }

    /**
     * Magic getter to access properties
     * 
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get($name) {
        if (array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (property_exists($this, '_' . $name)) {
            $method = 'get' . ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        return '[Twilio.Notify.V1.NotificationInstance]';
    }
}