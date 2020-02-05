<?php  namespace Rossedman\Teamwork;

use Rossedman\Teamwork\Traits\TimeTrait;
use Rossedman\Teamwork\Traits\RestfulTrait;

class Project extends AbstractObject {

    use RestfulTrait, TimeTrait;

    protected $wrapper  = 'project';

    protected $endpoint = 'projects';

    /**
     * Get Project Activity
     * GET /projects/{project_id}/activity.json
     *
     * @return  mixed
     */
    public function activity($args = null)
    {
        $this->areArgumentsValid($args, ['maxItems']);

        return $this->client->get("$this->endpoint/$this->id/latestActivity", $args)->response();
    }

    /**
     * Get Companies In Project
     * GET /projects/{project_id}/companies.json
     *
     * @retun mixed
     */
    public function companies()
    {
        return $this->client->get("$this->endpoint/$this->id/companies")->response();
    }

    /**
     * Get People On Project
     * GET /projects/{project_id}/people.json
     *
     * @return mixed
     */
    public function people()
    {
        return $this->client->get("$this->endpoint/$this->id/people")->response();
    }

    /**
     * Add People To a Project
     * POST /projects/{project_id}/people.json
     *
     * @return mixed
     */
    public function addPerson($user_id = null, $args = null)
    {
        // get all people on the project, we only add if they are not already on the project
        $people = $this->client->get("$this->endpoint/$this->id/people")->response();
        $people_on_project = [];
        foreach($people->people as $person){
            $people_on_project[] = $person->id;
        }
        if(!is_null($user_id) && !in_array($user_id, $people_on_project))
            return $this->client->post("$this->endpoint/$this->id/people/$user_id", $args)->response();
        else
            return false;
    }
    
    public function removePeople($user_ids = '')
    {
        return $this->client->post("$this->endpoint/$this->id/people.json", [
            'remove' => $user_ids
        ])->response();
    }

    /**
     * Add People Permissions To a Project
     * POST /projects/{project_id}/people.json
     *
     * @return mixed
     */
    public function updatePersonPermissions($user_id = null, $args = [])
    {
        if(!is_null($user_id))
            return $this->client->put("$this->endpoint/$this->id/people/$user_id", $args)->response();
        else
            return false;
    }

    /**
     * Get Starred Projects
     * GET /projects/starred.json
     *
     * @return mixed
     */
    public function starred()
    {
        return $this->client->get("$this->endpoint/starred")->response();
    }

    /**
     * Star A Project
     * PUT /projects/{$id}/star.json
     *
     * @return mixed
     */
    public function star()
    {
        return $this->client->put("$this->endpoint/$this->id/star", [])->response();
    }

    /**
     * Unstar A Project
     * PUT /projects/{$id}/unstar.json
     *
     * @return mixed
     */
    public function unstar()
    {
        return $this->client->put("$this->endpoint/$this->id/unstar", [])->response();
    }

    /**
     * All Project Links
     * GET /projects/{id}/links.json
     *
     * @return mixed
     */
    public function links()
    {
        return $this->client->get("$this->endpoint/$this->id/links")->response();
    }

    /**
     * Time Totals
     * GET /projects/{id}/time/total.json
     *
     * @return mixed
     */
    public function timeTotal()
    {
        return $this->client->get("$this->endpoint/$this->id/time/total")->response();
    }

    /**
     * Latest Messages
     * GET /projects/{project_id}/posts.json
     *
     * @return mixed
     */
    public function latestMessages()
    {
        return $this->client->get("$this->endpoint/$this->id/posts")->response();
    }

    /**
     * Archived Messages
     * GET /projects/{project_id}/posts/archive.json
     *
     * @return mixed
     */
    public function archivedMessages()
    {
        return $this->client->get("$this->endpoint/$this->id/posts/archive")->response();
    }

    /**
     * List Milestones
     * GET /projects/{project_id}/milestones.json
     *
     * @param null $args
     *
     * @return mixed
     */
    public function milestones($args = null)
    {
        $this->areArgumentsValid($args, ['getProgress']);

        return $this->client->get("$this->endpoint/$this->id/milestones", $args)->response();
    }

    /**
     * Create milestone associated with this project
     * POST /projects/{project_id}/milestones.json
     *
     * @param $args
     *
     * @return mixed
     */
    public function createMilestone($args) {
        return $this->client->post("$this->endpoint/$this->id/milestones", ['milestone' => $args])->response();
    }

    /**
     * Create tasklist associated with this project
     * POST /projects/{project_id}/tasklists.json
     *
     * @param $args
     *
     * @return mixed
     */
    public function createTasklist($args) {
        return $this->client->post("$this->endpoint/$this->id/tasklists", ['todo-list' => $args])->response();
    }

    /**
     * Tasklists
     * GET /projects/{project_id}/tasklists.json
     *
     * @return [type] [description]
     */
    public function tasklists($args = null)
    {
        return $this->client->get("$this->endpoint/$this->id/tasklists", $args)->response();
    }

    /**
     * Emailaddresses
     * GET /projects/{project_id}/emailaddress.json
     *
     * @return [type] [description]
     */
    public function emailAddress($args = null)
    {
        return $this->client->get("$this->endpoint/$this->id/emailaddress", $args)->response();
    }

    /**
     * Get All projects
     * GET /projects.json
     *
     * @param null $args
     *
     * @return mixed
     */
    public function all($args = null)
    {
        $this->areArgumentsValid($args, ['status', 'updatedAfterDate', 'orderby', 'createdAfterDate', 'createdAfterTime',
            'catId', 'includePeople', 'includeProjectOwner', 'page', 'pageSize',  'orderMode', 'onlyStarredProjects',
            'companyId', 'projectOwnerIds', 'searchTerm', 'getDeleted', 'includeTags', 'userId', 'updatedAfterDateTime']);

        return $this->client->get($this->endpoint, $args)->response();
    }

}
