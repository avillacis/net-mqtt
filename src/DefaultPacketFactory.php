<?php

namespace BinSoul\Net\Mqtt;

use BinSoul\Net\Mqtt\Exception\UnknownPacketTypeException;
use BinSoul\Net\Mqtt\Packet\ConnectRequestPacket;
use BinSoul\Net\Mqtt\Packet\ConnectResponsePacket;
use BinSoul\Net\Mqtt\Packet\DisconnectRequestPacket;
use BinSoul\Net\Mqtt\Packet\PingRequestPacket;
use BinSoul\Net\Mqtt\Packet\PingResponsePacket;
use BinSoul\Net\Mqtt\Packet\PublishAckPacket;
use BinSoul\Net\Mqtt\Packet\PublishCompletePacket;
use BinSoul\Net\Mqtt\Packet\PublishReceivedPacket;
use BinSoul\Net\Mqtt\Packet\PublishReleasePacket;
use BinSoul\Net\Mqtt\Packet\PublishRequestPacket;
use BinSoul\Net\Mqtt\Packet\SubscribeRequestPacket;
use BinSoul\Net\Mqtt\Packet\SubscribeResponsePacket;
use BinSoul\Net\Mqtt\Packet\UnsubscribeRequestPacket;
use BinSoul\Net\Mqtt\Packet\UnsubscribeResponsePacket;

/**
 * Provides a default implementation of the {@see PacketFactory} interface.
 */
class DefaultPacketFactory implements PacketFactory
{
    /**
     * Map of packet types to packet classes.
     *
     * @var string[]
     */
    private static $mapping = [
        Packet::TYPE_CONNECT => 'BinSoul\Net\Mqtt\Packet\ConnectRequestPacket',
        Packet::TYPE_CONNACK => 'BinSoul\Net\Mqtt\Packet\ConnectResponsePacket',
        Packet::TYPE_PUBLISH => 'BinSoul\Net\Mqtt\Packet\PublishRequestPacket',
        Packet::TYPE_PUBACK => 'BinSoul\Net\Mqtt\Packet\PublishAckPacket',
        Packet::TYPE_PUBREC => 'BinSoul\Net\Mqtt\Packet\PublishReceivedPacket',
        Packet::TYPE_PUBREL => 'BinSoul\Net\Mqtt\Packet\PublishReleasePacket',
        Packet::TYPE_PUBCOMP => 'BinSoul\Net\Mqtt\Packet\PublishCompletePacket',
        Packet::TYPE_SUBSCRIBE => 'BinSoul\Net\Mqtt\Packet\SubscribeRequestPacket',
        Packet::TYPE_SUBACK => 'BinSoul\Net\Mqtt\Packet\SubscribeResponsePacket',
        Packet::TYPE_UNSUBSCRIBE => 'BinSoul\Net\Mqtt\Packet\UnsubscribeRequestPacket',
        Packet::TYPE_UNSUBACK => 'BinSoul\Net\Mqtt\Packet\UnsubscribeResponsePacket',
        Packet::TYPE_PINGREQ => 'BinSoul\Net\Mqtt\Packet\PingRequestPacket',
        Packet::TYPE_PINGRESP => 'BinSoul\Net\Mqtt\Packet\PingResponsePacket',
        Packet::TYPE_DISCONNECT => 'BinSoul\Net\Mqtt\Packet\DisconnectRequestPacket',
    ];

    public function build($type)
    {
        if (!isset(self::$mapping[$type])) {
            throw new UnknownPacketTypeException(sprintf('Unknown packet type %d.', $type));
        }

        $class = self::$mapping[$type];

        return new $class();
    }
}
