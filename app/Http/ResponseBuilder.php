<?php

namespace App\Http;

use Illuminate\Contracts\Support\Responsable;

abstract class ResponseBuilder implements Responsable
{
    abstract public function toArray();

    protected $status = 200;

    protected $headers = [];

    public function headers($headers = [])
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @param $status
     *
     * @return ResponseBuilder
     */
    public function status($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return Response|\Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        return new Response($this->toArray(), $this->status, $this->headers);
    }

    public function getStatusCode()
    {
        return $this->status;
    }

    public function getHeaders()
    {
        return $this->headers;
    }
}
