<?php

namespace Larapi;

class Larapi {

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
    const SUCCESS_TEXT = 'succes';
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
     * @var string
     */
    protected $statusText = 'OK';

    /**
     * @var int
     */
    protected $statusCode = 200;

    /**
     * @var string
     */
    protected $statusMessage = 'success';

    /**
     * @var int
     */
    protected $errorCode = 0;

    /**
     * Instantiate a new class instance
     * 
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Gets the HTTP response status text.
     *
     * @return string
     */
    public function getStatusText()
    {
        return $this->statusText;
    }

    /**
     * Sets the HTTP response status text.
     *
     * @param string $text
     *
     * @return self
     */
    public function setStatusText($text)
    {
        $this->statusText = trim($text);

        return $this;
    }

    /**
     * Gets the HTTP Status Code
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Sets the HTTP Status Code
     *
     * @param int $statusCode
     * @return self
     */
    public function setStatusCode($code)
    {
        $this->statusCode = $code;

        return $this;
    }

    /**
     * Gets the HTTP response message
     *
     * @return string
     */
    public function getStatusMessage()
    {
        return $this->statusMessage;
    }

    /**
     * Sets the HTTP response message
     *
     * @param string $msg
     * @return self
     */
    public function setStatusMessage($msg)
    {	
        $msg = (string) trim($msg);

    	if($msg === '')
    		$this->statusMessage = $this->getStatusMessage();
    	else
    		$this->statusMessage = $msg;
        
        return $this;
    }

    /**
     * Gets the error code
     * 
     * @return int
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * Sets error message
     * 
     * @param string $msg
     * @return self
     */
    public function setErrorMessage($msg)
    {
        $msg = (string) trim($msg);
        $this->errorMessage = ($msg === '')? self::UNKNOWN_ERROR: $msg;

        return $this;
    }

    /**
     * Gets the error message
     * 
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * Set application error code
     *
     * @param int $code
     * @return self
     */
    public function setErrorCode($code)
    {
        $this->errorCode = (int) $code;

        return $this;
    }

    /**
     * Returns 200 OK Response
     * 
     * @param  array $data
     * @return json
     */
    public function respondOk($data = [])
    {
        return $this->getSuccessResponse($data, self::HTTP_OK);
    }

    /**
     * Returns 201 Created Response
     * 
     * @param  array $data
     * @return json
     */
    public function respondCreated($data = [])
    {
        return $this->getSuccessResponse($data, self::HTTP_CREATED);
    }

    /**
     * Returns 202 Accepted Response
     * 
     * @param  array $data
     * @param  string $msg
     * @return Response
     */
    public function respondAccepted($data = [])
    {
        return $this->getSuccessResponse($data, self::HTTP_ACCEPTED);
    }

    /**
     * Returns 400 Bad Request Response
     * 
     * @param  string $msg
     * @param int $errorCode
     * @return json
     */
    public function respondBadRequest($msg = '', $errorCode = 0)
    {
        return $this->getErrorResponse($msg, $errorCode, self::HTTP_BAD_REQUEST);
    }

    /**
     * Returns 401 Unauthorized Response
     * 
     * @param string $msg
     * @param int $errorCode
     * @return json
     */
    public function respondUnauthorized($msg = '', $errorCode = 0)
    {
        return $this->getErrorResponse($msg, $errorCode, self::HTTP_UNAUTHORIZED);
    }

    /**
     * Returns 403 Forbidden Response
     * 
     * @param string $msg
     * @param int $errorCode
     * @return json
     */
    public function respondForbidden($msg = '', $errorCode = 0)
    {
        return $this->getErrorResponse($msg, $errorCode, self::HTTP_FORBIDDEN);
    }

    /**
     * Returns 404 Not Found HTTP Response
     *
     * @param string $msg
     * @param int $errorCode
     * @return json
     */
    public function respondNotFound($msg = '', $errorCode = 0)
    {
        return $this->getErrorResponse($msg, $errorCode, self::HTTP_NOT_FOUND);
    }

    /**
     * Returns 405 Method Not Allowed Response
     *
     * @param string $msg
     * @param int $errorCode
     * @return json
     */
    public function respondMethodNotAllowed($msg = '', $errorCode = 0)
    {
        return $this->getErrorResponse($msg, $errorCode, self::HTTP_METHOD_NOT_ALLOWED);        
    }

    /**
     * Returns 500 Internal Server HTTP Response
     *
     * @param string $msg
     * @param int $errorCode
     * @return json
     */
    public function respondInternalError($msg = '', $errorCode = 0)
    {
        return $this->getErrorResponse($msg, $errorCode, self::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Returns 501 Not Implemented HTTP Response
     *
     * @param string $msg
     * @param int $errorCode
     * @return json
     */
    public function respondNotImplemented($msg = '', $errorCode = 0)
    {
        return $this->getErrorResponse($msg, $errorCode, self::HTTP_NOT_IMPLEMENTED);
    }

    /**
     * Returns 503 Rate Limit Exceeded HTTP Response
     *      
     * @param string $msg
     * @param int $errorCode
     * @return json
     */
    public function respondRateLimitExceeded($msg = '', $errorCode = 0)
    {
        return $this->getErrorResponse($msg, $errorCode, self::HTTP_SERVICE_UNAVAILABLE);
    }

    /**
     * Returns 503 Not Available HTTP Response
     *
     * @param string $msg
     * @param int $errorCode
     * @return json
     */
    public function respondNotAvailable($msg = '', $errorCode = 0)
    {
        return $this->getErrorResponse($msg, $errorCode, self::HTTP_SERVICE_UNAVAILABLE);
    }

    /**
     * Sets the success response
     *
     * @return json 
     */
    protected function getSuccessResponse($data, $statusText)
    {
        return $this->setStatusText($this->statusTexts[$statusText])
                    ->setStatusCode($statusText)
                    ->setStatusMessage(self::SUCCESS_TEXT)
                    ->respondWithSuccessMessage($data);
    }

    /**
     * Sets the error response
     *
     * @return json 
     */
    protected function getErrorResponse($msg, $errorCode, $statusText)
    {
        return $this->setStatusText($this->statusTexts[$statusText])
                    ->setStatusCode($statusText)
                    ->setStatusMessage(self::ERROR_TEXT)
                    ->setErrorCode($errorCode)
                    ->setErrorMessage($msg)
                    ->respondWithErrorMessage();
    }

    /**
     * Returns JSON Encoded Response based on the set HTTP Status Code
     * 
     * @param  string $msg
     * @param  array $data
     * @return Response
     */
    protected function respondWithSuccessMessage($data)
    {
        return $this->respond([
            'code'      => $this->getStatusCode(),
            'status'    => $this->getStatusText(),
            'message'   => $this->getStatusMessage(),
            'response'  => $data
        ]);
    }

    /**
     * Returns JSON Encoded Response based on the set HTTP Status Code
     * 
     * @return json
     */
    protected function respondWithErrorMessage()
    {
        if($this->getErrorCode() === 0)
        {
            return $this->respond([
                'code'      => $this->getStatusCode(),
                'status'    => $this->getStatusText(),
                'message'   => $this->getStatusMessage()
            ]);
        }
        else
        {
            return $this->respond([
                'code'      => $this->getStatusCode(),
                'status'    => $this->getStatusText(),
                'message'   => $this->getStatusMessage(),
                'response'  => [
                    'error-code'    => $this->getErrorCode(),
                    'error-message' => $this->getErrorMessage()
                ]
            ]);
        }
    }

    /**
     * Returns JSON Encoded HTTP Reponse
     * 
     * @param  array $body
     * @param  array $headers
     * @return json
     */
    protected function respond($body, $headers = [])
    {
        $headers[] = 'HTTP/1.1 ' . $this->getStatusCode() . ' ' . $this->getStatusText();
        return response()->json($body, $this->getStatusCode(), $headers);
    }

}