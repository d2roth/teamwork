<?php  namespace Rossedman\Teamwork;

class Account extends AbstractObject {

    /**
     * Account Details
     * GET /account.json
     *
     * @link http://developer.teamwork.com/account
     * @return mixed
     */
    public function details($args = null)
    {
        return $this->client->get('account', $args)->response();
    }

    /**
     * Authenticate Call
     * GET /authenticate.json
     *
     * @link http://developer.teamwork.com/account
     * @return mixed
     */
    public function authenticate($args = null)
    {
        return $this->client->get('authenticate', $args)->response();
    }

}