<?php  namespace Rossedman\Teamwork;

use Rossedman\Teamwork\Traits\RestfulTrait;

class Company extends AbstractObject {

    use RestfulTrait;

    protected $wrapper  = 'company';

    protected $endpoint = 'companies';

    /**
     * Get People Associated With Company
     * GET /companies/{company_id}/people.json
     *
     * @link http://developer.teamwork.com/people#get_people_(withi
     *
     * @return mixed
     */
    public function people($args = null)
    {
        return $this->client->get("$this->endpoint/$this->id/people", $args)->response();
    }

    /**
     * Get Projects Associated With Company
     * GET /companies/{company_id}/projects.json
     *
     * @link http://developer.teamwork.com/projectsapi#retrieve_projects
     *
     * @return mixed
     */
    public function projects($args = null)
    {
        return $this->client->get("$this->endpoint/$this->id/projects", $args)->response();
    }
}