<?php

declare(strict_types=1);

namespace XcomMarketplace\Client\Request;

use XcomMarketplace\Client\Contracts\InputInterface;
use XcomMarketplace\Client\Contracts\RequestInterface;

/**
 * @author Vladimir Solovyov <vsolovyov@wattdev.ru>
 */
abstract class AbstractMutationRequest implements RequestInterface
{
    /**
     * @var InputInterface
     */
    protected $input;

    public function __construct(InputInterface $input)
    {
        $this->input = $input;
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getHeaders(): array
    {
        return ['Content-Type' => 'application/json'];
    }

    public function getBody(): ?string
    {
        return json_encode($this->input->toArray());
    }

    abstract public function getPath(): string;
}
