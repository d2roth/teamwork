<?php  namespace Rossedman\Teamwork;

use Rossedman\Teamwork\Traits\TimeTrait;
use Rossedman\Teamwork\Traits\RestfulTrait;

class File extends AbstractObject {

    use RestfulTrait, TimeTrait;

    protected $wrapper  = 'pendingfile';

    protected $endpoint = 'pendingfiles';

    /**
     * Upload a file
     * POST /pendingfiles.json
     *
     * @param null $args
     *
     * @return mixed
     */
    public function uploadFile($args = null)
    {
        $this->areArgumentsValid($args, ['file']);

        return $this->client->post($this->endpoint, $args)->response();
    }
}
