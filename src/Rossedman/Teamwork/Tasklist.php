<?php  namespace Rossedman\Teamwork;

use Rossedman\Teamwork\Traits\RestfulTrait;

class Tasklist extends AbstractObject {

    protected $wrapper  = 'todo-list';

    protected $endpoint = 'tasklists';

    /**
     * GET /tasklists/{$id}.json
     * @return mixed
     */
    public function find($args = null)
    {
        return $this->client->get("$this->endpoint/$this->id", $args)->response();
    }

    /**
     * PUT /todo_lists/{$id}.json
     * @return mixed
     */
    public function update($data)
    {
        return $this->client->put("$this->endpoint/$this->id", [$this->wrapper => $data])->response();
    }

    /**
     * DELETE /todo_lists/{$id}.json
     * @return mixed
     */
    public function delete()
    {
        return $this->client->delete("$this->endpoint/$this->id")->response();
    }

    /**
     * GET /tasklists/templates.json
     * @return [type] [description]
     */
    public function templates($args = null)
    {
        return $this->client->get("$this->endpoint/templates", $args)->response();
    }

    /**
     * Time Totals
     * GET /projects/{id}/time/total.json
     *
     * @return mixed
     */
    public function timeTotal($args = null)
    {
        return $this->client->get("$this->endpoint/$this->id/time/total", $args)->response();
    }

    /**
     * Tasks
     * GET /tasklists/{id}/tasks.json
     *
     * @param null $args
     *
     * @return mixed
     */
    public function tasks($args = null)
    {
        $this->areArgumentsValid($args, ['filter', 'page', 'pageSize', 'startdate', 'enddate', 'updatedAfterDate', 'completedAfterDate', 'completedBeforeDate', 'showDeleted', 'includeCompletedTasks', 'includeCompletedSubtasks', 'creator-ids', 'include', 'responsible-party-ids', 'sort', 'getSubTasks', 'nestSubTasks', 'getFiles', 'dataSet', 'includeToday', 'ignore-start-date']);

        return $this->client->get("$this->endpoint/$this->id/tasks", $args)->response();
    }

    /**
     * Create Task
     * GET /tasklists/{id}/tasks.json
     *
     * @return mixed
     */
    public function createTask($data)
    {
        $task = $this->client->post("tasklists/$this->id/tasks", ['todo-item' => $data])->response();
        $task->request = (object) $data;
        return $task;
    }
}
