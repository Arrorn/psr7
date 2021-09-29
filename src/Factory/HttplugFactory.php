<?php

declare(strict_types=1);

namespace Nyholm\Psr7\Factory;

use Http\Message\{MessageFactory, StreamFactory, UriFactory};
use Nyholm\Psr7\{Request, Response, Stream, Uri};
use Psr\Http\Message\UriInterface;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 * @author Martijn van der Ven <martijn@vanderven.se>
 *
 * @final This class should never be extended. See https://github.com/Nyholm/psr7/blob/master/doc/final.md
 */
class HttplugFactory implements MessageFactory, StreamFactory, UriFactory
{
    /**
     * @param string $method HTTP method
     * @param string|UriInterface $uri URI
     * @param array $headers Request headers
     * @param string|resource|StreamInterface|null $body Request body
     * @param string $protocolVersion Protocol version
     * @return Request
     */
    public function createRequest($method, $uri, array $headers = [], $body = null, $protocolVersion = '1.1')
    {
        return new Request($method, $uri, $headers, $body, $protocolVersion);
    }

    /**
     * @param  integer $statusCode
     * @param  string|null  $reasonPhrase
     * @param  array   $headers
     * @param  string|resource|StreamInterface|null  $body
     * @param  string  $version
     * @return Response
     */
    public function createResponse($statusCode = 200, $reasonPhrase = null, array $headers = [], $body = null, $version = '1.1')
    {
        return new Response((int) $statusCode, $headers, $body, $version, $reasonPhrase);
    }

    /**
     * @param  string|resource|StreamInterface $body
     * @return Stream
     */
    public function createStream($body = null)
    {
        return Stream::create($body ?? '');
    }

    /**
     * @param  string|UriInterface       $uri
     * @return UriInterface
     */
    public function createUri($uri = '')
    {
        if ($uri instanceof UriInterface) {
            return $uri;
        }

        return new Uri($uri);
    }
}
