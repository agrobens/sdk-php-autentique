<?php

namespace vinicinbgs\Autentique;

use vinicinbgs\Autentique\Utils\Query;

class Folders extends BaseResource
{
    /**
     * @var Query
     */
    private $query;

    /**
     * @var string
     */
    private $token;

    /**
     * Documents constructor.
     *
     * @param $token
     */
    public function __construct(string $token)
    {
        parent::__construct();

        $this->query = new Query($this->resourcesEnum::FOLDERS);
        $this->token = $token ?? $_ENV["AUTENTIQUE_TOKEN"];
    }

    /**
     * List all folders
     *
     * @param int $page
     * @return array
     */
    public function listAll(int $page = 1)
    {
        $graphQuery = $this->query->query(__FUNCTION__);

        $graphQuery = $this->query->setVariables("page", $page, $graphQuery);

        return $this->api->request($this->token, $graphQuery, "json");
    }

    /**
     * List folder by id
     *
     * @param string $folderId
     *
     * @return array
     */
    public function listById(string $folderId)
    {
        $graphQuery = $this->query->query(__FUNCTION__);
        $graphQuery = $this->query->setVariables(
            "folderId",
            $folderId,
            $graphQuery
        );

        return $this->api->request($this->token, $graphQuery, "json");
    }

    /**
     * List folder by id
     *
     * @param string $folderId
     *
     * @return array
     */
    public function listContentsById(string $folderId, int $page = 1)
    {
        $graphQuery = $this->query->query(__FUNCTION__);
        $graphQuery = $this->query->setVariables(
            ["folderId", "page"],
            [$folderId, $page],
            $graphQuery
        );

        return $this->api->request($this->token, $graphQuery, "json");
    }

    /**
     * Create folder
     *
     * @param array $variables
     * @return array
     */
    public function create(array $variables)
    {
        $graphMutation = $this->query->query(__FUNCTION__);
        $graphMutation = $this->query->setVariables(
            ["variables", "sandbox"],
            [json_encode($variables), $this->sandbox],
            $graphMutation
        );

        return $this->api->request($this->token, $graphMutation, "json");
    }

    /**
     * Delete folder by id
     *
     * @param string $folderId
     *
     * @return array
     */
    public function deleteById(string $folderId)
    {
        $graphQuery = $this->query->query(__FUNCTION__);
        $graphQuery = $this->query->setVariables(
            "folderId",
            $folderId,
            $graphQuery
        );

        return $this->api->request($this->token, $graphQuery, "json");
    }
}
