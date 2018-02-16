<?php

namespace Knash94\Seo\Services;

use Illuminate\Http\Request;
use Knash94\Seo\Contracts\AgentContract;

class Agent implements AgentContract
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * Agent constructor.
     * @param Request $request
     */
    function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Returns an array of agent information
     *
     * @return array
     */
    public function getAgentInformation()
    {
        return [
            'user_agent' => $this->request->header('USER_AGENT', 'N/A'),
            'ip_address' => $this->request->getClientIp(),
            'previous_url' => $this->request->server('HTTP_REFERER') ?: $this->request->header('referer')
        ];
    }
}
