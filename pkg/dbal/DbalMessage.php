<?php

declare(strict_types=1);

namespace Enqueue\Dbal;

use Interop\Queue\Message;

class DbalMessage implements Message
{
    /**
     * @var string
     */
    private $body;

    /**
     * @var array
     */
    private $properties;

    /**
     * @var array
     */
    private $headers;

    /**
     * @var bool
     */
    private $redelivered;

    /**
     * @var int
     */
    private $priority;

    /**
     * @var int milliseconds
     */
    private $deliveryDelay;

    /**
     * @var int seconds
     */
    private $redeliverAfter;

    /**
     * @var int milliseconds
     */
    private $timeToLive;

    /**
     * @var null|string
     */
    private $deliveryId;

    /**
     * @var string|null
     */
    private $queue;

    /**
     * Milliseconds, for example 15186054527288.
     *
     * Could be generated by the code: (int) (microtime(true) * 10000)
     *
     * @var int
     */
    private $publishedAt;

    /**
     * @param string $body
     * @param array  $properties
     * @param array  $headers
     */
    public function __construct(string $body = '', array $properties = [], array $headers = [])
    {
        $this->body = $body;
        $this->properties = $properties;
        $this->headers = $headers;
        $this->redelivered = false;
        $this->priority = null;
        $this->deliveryDelay = null;
        $this->deliveryId = null;
        $this->redeliverAfter = null;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setProperties(array $properties): void
    {
        $this->properties = $properties;
    }

    public function setProperty(string $name, $value): void
    {
        $this->properties[$name] = $value;
    }

    public function getProperties(): array
    {
        return $this->properties;
    }

    public function getProperty(string $name, $default = null)
    {
        return array_key_exists($name, $this->properties) ? $this->properties[$name] : $default;
    }

    public function setHeader(string $name, $value): void
    {
        $this->headers[$name] = $value;
    }

    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getHeader(string $name, $default = null)
    {
        return array_key_exists($name, $this->headers) ? $this->headers[$name] : $default;
    }

    public function isRedelivered(): bool
    {
        return $this->redelivered;
    }

    public function setRedelivered(bool $redelivered): void
    {
        $this->redelivered = $redelivered;
    }

    public function setReplyTo(string $replyTo = null): void
    {
        $this->setHeader('reply_to', $replyTo);
    }

    public function getReplyTo(): ?string
    {
        return $this->getHeader('reply_to');
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority = null): void
    {
        $this->priority = $priority;
    }

    public function getDeliveryDelay(): ?int
    {
        return $this->deliveryDelay;
    }

    /**
     * Set delay in milliseconds.
     */
    public function setDeliveryDelay(int $deliveryDelay = null): void
    {
        $this->deliveryDelay = $deliveryDelay;
    }

    /**
     * @return int
     */
    public function getTimeToLive(): ?int
    {
        return $this->timeToLive;
    }

    /**
     * Set time to live in milliseconds.
     */
    public function setTimeToLive(int $timeToLive = null): void
    {
        $this->timeToLive = $timeToLive;
    }

    public function setCorrelationId(string $correlationId = null): void
    {
        $this->setHeader('correlation_id', $correlationId);
    }

    public function getCorrelationId(): ?string
    {
        return $this->getHeader('correlation_id', null);
    }

    public function setMessageId(string $messageId = null): void
    {
        $this->setHeader('message_id', $messageId);
    }

    public function getMessageId(): ?string
    {
        return $this->getHeader('message_id', null);
    }

    public function getTimestamp(): ?int
    {
        $value = $this->getHeader('timestamp');

        return null === $value ? null : $value;
    }

    public function setTimestamp(int $timestamp = null): void
    {
        $this->setHeader('timestamp', $timestamp);
    }

    public function getDeliveryId(): ?string
    {
        return $this->deliveryId;
    }

    public function setDeliveryId(?string $deliveryId = null): void
    {
        $this->deliveryId = $deliveryId;
    }

    public function getRedeliverAfter(): int
    {
        return $this->redeliverAfter;
    }

    public function setRedeliverAfter(int $redeliverAfter = null): void
    {
        $this->redeliverAfter = $redeliverAfter;
    }

    public function getPublishedAt(): ?int
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(int $publishedAt = null): void
    {
        $this->publishedAt = $publishedAt;
    }

    public function getQueue(): ?string
    {
        return $this->queue;
    }

    public function setQueue(?string $queue): void
    {
        $this->queue = $queue;
    }
}
