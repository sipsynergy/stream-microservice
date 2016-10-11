<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Action entity describing the actor acting out a verb (on an optional target).
 *
 * Generalized Format:
 *
 *   <actor> <verb> <time>
 *   <actor> <verb> <target> <time>
 *   <actor> <verb> <action_object> <target> <time>
 *
 * Examples:
 *
 *   <justquick> <reached level 60> <1 minute ago>
 *   <brosner> <commented on> <pinax/pinax> <2 hours ago>
 *   <washingtontimes> <started follow> <justquick> <8 minutes ago>
 *   <mitsuhiko> <closed> <issue 70> on <mitsuhiko/flask> <about 3 hours ago>
 *
 * __toString() Representation:
 *
 *   justquick reached level 60 1 minute ago
 *   mitsuhiko closed issue 70 on mitsuhiko/flask 3 hours ago
 *
 * @ORM\Table(name="app_activity_stream_actions")
 * @ORM\Entity()
 */
class Action
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="verb", type="string")
     */
    private $verb;

    /**
     * @var integer
     *
     * @ORM\Column(name="actor_reference", type="string")
     */
    private $actor;

    /**
     * @var integer
     *
     * @ORM\Column(name="target_reference", type="string", nullable=true)
     */
    private $target;

    /**
     * @var integer
     *
     * @ORM\Column(name="action_reference", type="string", nullable=true)
     */
    private $action;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_added", type="datetime")
     */
    private $date_added;


    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->date_added = new \DateTime;
    }


    /**
     * To string.
     *
     * @return string
     */
    public function __toString()
    {
        if ($this->hasTarget()) {
            if ($this->hasAction()) {
                return sprintf('%s %s %s on %s %s', $this->getActor(), $this->getVerb(), $this->getAction(), $this->getTarget(), $this->getDateAddedInWords());
            } else {
                return sprintf('%s %s %s %s', $this->getActor(), $this->getVerb(), $this->getTarget(), $this->getDateAddedInWords());
            }
        }
        return sprintf('%s %s %s', $this->getActor(), $this->getVerb(), $this->getDateAddedInWords());
    }


    /**
     * Explicit to string.
     *
     * @return string
     */
    public function toString()
    {
        return $this->__toString();
    }


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Get actor.
     *
     * @return int
     */
    public function getActor()
    {
        return $this->actor;
    }


    /**
     * Get verb.
     *
     * @return string
     */
    public function getVerb()
    {
        return $this->verb;
    }


    /**
     * Get target.
     *
     * @return int
     */
    public function getTarget()
    {
        return $this->target;
    }


    /**
     * Get action.
     *
     * @return int
     */
    public function getAction()
    {
        return $this->action;
    }


    /**
     * Set actor.
     *
     * @param $actor
     *
     * @return $this
     */
    public function setActor($actor)
    {
        $this->actor = $actor;

        return $this;
    }


    /**
     * Set verb.
     *
     * @param $verb
     *
     * @return $this
     */
    public function setVerb($verb)
    {
        $this->verb = $verb;

        return $this;
    }


    /**
     * Set target.
     *
     * @param $target
     *
     * @return $this
     */
    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }


    /**
     * Set action.
     *
     * @param $action
     *
     * @return $this
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }


    /**
     * Has target.
     *
     * @return bool
     */
    public function hasTarget()
    {
        return (bool)$this->getTarget();
    }


    /**
     * Has action.
     *
     * @return bool
     */
    public function hasAction()
    {
        return (bool)$this->getAction();
    }


    /**
     * Get date added.
     *
     * @return \DateTime
     */
    public function getDateAdded()
    {
        return $this->date_added;
    }


    /**
     * Get date added in words.
     *
     * @return string
     */
    public function getDateAddedInWords()
    {
        $timeAgo = new \TimeAgo();
        return $timeAgo->inWords($this->getDateAdded()->format('Y-m-d H:i:s'));
    }
}