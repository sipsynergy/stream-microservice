<?php

namespace App\Controller;

use App\Resource\ActivityResource;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class ActivityController
 *
 * @SWG\Swagger(
 *   schemes={"http"},
 *   basePath="/api",
 *   @SWG\Info(title="Stream Activity Api", version="0.1")
 * )
 */
class ActivityController
{
    /** @var ActivityResource */
    private $activityResource;


    /**
     * Constructor.
     *
     * @param ActivityResource $activityResource
     */
    public function __construct(ActivityResource $activityResource)
    {
        $this->activityResource = $activityResource;
    }


    /**
     * @SWG\Get(
     *     path="/api/activities",
     *     summary="List activities",
     *     @SWG\Response(response="200", description="Activity resources")
     * )
     */
    public function fetchAllAction(Request $request, Response $response, $args)
    {
        if ($reference = $request->getQueryParam('reference')) {
            $activities = $this->activityResource->findStreamsByReference($reference);
        } else {
            $activities = $this->activityResource->getAll();
        }

        return $response->withJSON($activities, 200);
    }


    /**
     * @SWG\Patch(
     *     path="/api/activities",
     *     summary="Create activity",
     *     @SWG\Response(response="201", description="Created resource")
     * )
     */
    public function addActivityAction(Request $request, Response $response, $args)
    {
        $data = json_decode($request->getBody());

        $actor = $data->actor;
        $verb  = $data->verb;

        $action = isset($data->action) ? $data->action : null;
        $target = isset($data->target) ? $data->target : null;

        $this->activityResource->create($actor, $verb, $action, $target);

        return $response->withStatus(201);
    }

}