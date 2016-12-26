<?php

namespace Larapi;

trait ResponseTrait
{
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
    protected $errorCode = null;

    /**
     * @var array
     */
    protected $headers = [];

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
     * @param string $message
     * @return self
     */
    public function setStatusMessage($message)
    {
        $message = (string) trim($message);

        if ($message === '') {
            $this->statusMessage = $this->getStatusMessage();
        } else {
            $this->statusMessage = $message;
        }

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
     * Sets the error message
     *
     * @param string|array $message
     * @return self
     */
    public function setErrorMessage($message)
    {
        switch (gettype($message)) {
            case 'string':
                $this->errorMessage = trim($message);
                break;
            case 'array':
                $this->errorMessage = empty($message) ? '' : $message;
                break;
            default:
                $this->errorMessage = '';
                break;
        }

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
        if ($code !== null) {
            $this->errorCode = (int) $code;
        }

        return $this;
    }

    /**
     * Gets the response headers
     *
     * @return array
     */
    protected function getResponseHeaders()
    {
        return $this->headers;
    }

    /**
     * Sets the response headers
     *
     * @param array $headers
     * @return void
     */
    protected function setResponseHeaders(array $headers)
    {
        // reset headers
        $this->headers = [];

        // set response status header
        $this->headers[] = 'HTTP/1.1 ' . $this->getStatusCode() . ' ' . $this->getStatusText();

        // set content type header
        $this->headers['Content-Type'] = 'application/json';

        // set user supplied headers
        foreach ($headers as $key => $value) {
            $this->headers[$key] = $value;
        }
    }

    /**
     * Gets the success response
     *
     * @param array $data
     * @param string $statusText
     * @param array $headers
     * @return json
     */
    protected function getSuccessResponse($data, $statusText, $headers = [])
    {
        return $this->setStatusText($this->statusTexts[$statusText])
                    ->setStatusCode($statusText)
                    ->setStatusMessage(self::SUCCESS_TEXT)
                    ->respondWithSuccessMessage($data, $headers);
    }

    /**
     * Gets the error response
     *
     * @param string $msg
     * @param int $errorCode
     * @param string $statusText
     * @param array $headers
     * @return json
     */
    protected function getErrorResponse($msg, $errorCode, $statusText, $headers = [])
    {
        return $this->setStatusText($this->statusTexts[$statusText])
                    ->setStatusCode($statusText)
                    ->setStatusMessage(self::ERROR_TEXT)
                    ->setErrorCode($errorCode)
                    ->setErrorMessage($msg)
                    ->respondWithErrorMessage($headers);
    }

    /**
     * Returns JSON Encoded Response based on the set HTTP Status Code
     *
     * @param  array $data
     * @param  array $headers
     * @return json
     */
    protected function respondWithSuccessMessage($data = [], $headers = [])
    {
        $response = [];
        $response['success'] = true;

        if (!empty($data)) {
            $response['response'] = $data;
        }

        return $this->respond($response, $headers);
    }

    /**
     * Returns JSON Encoded Response based on the set HTTP Status Code
     *
     * @param array $headers
     * @return json
     */
    protected function respondWithErrorMessage($headers = [])
    {
        $reponse = [];
        $response['success'] = false;


        if ($this->getErrorCode() !== null) {
            $response['error_code'] = (int) $this->getErrorCode();
        }

        if (is_string($this->getErrorMessage()) && $this->getErrorMessage() !== '') {
            $response['error'] = $this->getErrorMessage();
        } else if (is_array($this->getErrorMessage()) && !empty($this->getErrorMessage())) {
            $response['errors'] = $this->getErrorMessage();
        }

        return $this->respond($response, $headers);
    }

    /**
     * Returns JSON Encoded HTTP Reponse
     *
     * @param  array $data
     * @param  array $headers
     * @return json
     */
    protected function respond($data, $headers = [])
    {
        $this->setResponseHeaders($headers);

        return response()->json($data, $this->getStatusCode(), $this->getResponseHeaders());
    }
}
