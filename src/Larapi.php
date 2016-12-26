<?php

namespace Larapi;

use Larapi\ResponseTrait;

class Larapi
{
    use ResponseTrait;

    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_ACCEPTED = 202;
    const HTTP_NO_CONTENT = 204;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_PAYMENT_REQUIRED = 402;
    const HTTP_FORBIDDEN = 403;
    const HTTP_NOT_FOUND = 404;
    const HTTP_METHOD_NOT_ALLOWED = 405;
    const HTTP_NOT_ACCEPTABLE = 406;
    const HTTP_PROXY_AUTHENTICATION_REQUIRED = 407;
    const HTTP_REQUEST_TIMEOUT = 408;
    const HTTP_CONFLICT = 409;
    const HTTP_PRECONDITION_FAILED = 412;
    const HTTP_UNPROCESSABLE_ENTITY = 422;
    const HTTP_UPGRADE_REQUIRED = 426;
    const HTTP_PRECONDITION_REQUIRED = 428;
    const HTTP_INTERNAL_SERVER_ERROR = 500;
    const HTTP_NOT_IMPLEMENTED = 501;
    const HTTP_SERVICE_UNAVAILABLE = 503;
    const HTTP_INSUFFICIENT_STORAGE = 507;

    // OTHER CONSTANTS
    const ERROR_TEXT = 'error';
    const SUCCESS_TEXT = 'success';
    const UNKNOWN_ERROR = 'An unknown error occured';

    /**
     * Status codes translation table.
     *
     * @var array
     */
    protected $statusTexts = [
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        204 => 'No Content',     
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        412 => 'Precondition Failed',
        422 => 'Unprocessable Entity',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        503 => 'Service Unavailable',
        507 => 'Insufficient Storage',
    ];

    /**
     * Returns 200 OK Response
     * 
     * @param  array $data
     * @param array $headers
     * @return json
     */
    public function ok($data = [], $headers = [])
    {
        return $this->getSuccessResponse($data, self::HTTP_OK, $headers);
    }

    /**
     * Returns 201 Created Response
     * 
     * @param  array $data
     * @param array $headers
     * @return json
     */
    public function created($data = [], $headers = [])
    {
        return $this->getSuccessResponse($data, self::HTTP_CREATED, $headers);
    }

    /**
     * Returns 202 Accepted Response
     * 
     * @param  array $data
     * @param  string $msg
     * @param array $headers
     * @return Response
     */
    public function accepted($data = [], $headers = [])
    {
        return $this->getSuccessResponse($data, self::HTTP_ACCEPTED, $headers);
    }

    /**
     * Returns 204 No Content
     *
     * @param  array $data
     * @param  string $msg
     * @param array $headers
     * @return Response
     */
    public function noContent($data = [], $headers = [])
    {
        return $this->getSuccessResponse($data, self::HTTP_NO_CONTENT, $headers);
    }

     * Returns 400 Bad Request Response
     * 
     * @param  string $msg
     * @param  int $errorCode
     * @param array $headers
     * @return json
     */
    public function badRequest($msg = '', $errorCode = null, $headers = [])
    {
        return $this->getErrorResponse($msg, $errorCode, self::HTTP_BAD_REQUEST, $headers);
    }

    /**
     * Returns 401 Unauthorized Response
     * 
     * @param  string $msg
     * @param  int $errorCode
     * @param array $headers
     * @return json
     */
    public function unauthorized($msg = '', $errorCode = null, $headers = [])
    {
        return $this->getErrorResponse($msg, $errorCode, self::HTTP_UNAUTHORIZED, $headers);
    }

    /**
     * Returns 403 Forbidden Response
     * 
     * @param string $msg
     * @param int $errorCode
     * @param array $headers
     * @return json
     */
    public function forbidden($msg = '', $errorCode = null, $headers = [])
    {
        return $this->getErrorResponse($msg, $errorCode, self::HTTP_FORBIDDEN, $headers);
    }

    /**
     * Returns 404 Not Found HTTP Response
     *
     * @param string $msg
     * @param int $errorCode
     * @param array $headers
     * @return json
     */
    public function notFound($msg = '', $errorCode = null, $headers = [])
    {
        return $this->getErrorResponse($msg, $errorCode, self::HTTP_NOT_FOUND, $headers);
    }

    /**
     * Returns 405 Method Not Allowed Response
     *
     * @param string $msg
     * @param int $errorCode
     * @param array $headers
     * @return json
     */
    public function methodNotAllowed($msg = '', $errorCode = null, $headers = [])
    {
        return $this->getErrorResponse($msg, $errorCode, self::HTTP_METHOD_NOT_ALLOWED, $headers);        
    }

    /**
     * Returns 409 Conflict Response
     *
     * @param string $msg
     * @param int $errorCode
     * @param array $headers
     * @return json
     */
    public function conflict($msg = '', $errorCode = null, $headers = [])
    {
        return $this->getErrorResponse($msg, $errorCode, self::HTTP_CONFLICT, $headers);        
    }

    /**
     * Returns 422 Unprocessable Entity
     *
     * @param string $msg
     * @param int $errorCode
     * @param array $headers
     * @return json
     */
    public function unprocessableEntity($msg = '', $errorCode = null, $headers = [])
    {
        return $this->getErrorResponse($msg, $errorCode, self::HTTP_UNPROCESSABLE_ENTITY, $headers);
    }

    /**
     * Returns 500 Internal Server HTTP Response
     *
     * @param string $msg
     * @param int $errorCode
     * @param array $headers
     * @return json
     */
    public function internalError($msg = '', $errorCode = null, $headers = [])
    {
        return $this->getErrorResponse($msg, $errorCode, self::HTTP_INTERNAL_SERVER_ERROR, $headers);
    }

    /**
     * Returns 501 Not Implemented HTTP Response
     *
     * @param string $msg
     * @param int $errorCode
     * @param array $headers
     * @return json
     */
    public function notImplemented($msg = '', $errorCode = null, $headers = [])
    {
        return $this->getErrorResponse($msg, $errorCode, self::HTTP_NOT_IMPLEMENTED, $headers);
    }

    /**
     * Returns 503 Not Available HTTP Response
     *
     * @param string $msg
     * @param int $errorCode
     * @param array $headers
     * @return json
     */
    public function notAvailable($msg = '', $errorCode = null, $headers = [])
    {
        return $this->getErrorResponse($msg, $errorCode, self::HTTP_SERVICE_UNAVAILABLE, $headers);
    }

