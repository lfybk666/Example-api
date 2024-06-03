<?php
declare(strict_types=1);

namespace Danil\Api\Action;

use Danil\Api\Client\Action\ActionInterface;
use Danil\Api\Client\ApiRequest;
use Danil\Api\Model\Comment;

class Comments implements ActionInterface
{
    private const COLLECTION_METHOD_NAME = 'comments';

    private const SINGLE_OBJECT_METHOD_NAME = 'comment';

    private ApiRequest $request;

    public function __construct(ApiRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @return Comments[]
     */
    public function get(string $accessToken, array $params = [])
    {
        return $this->request->get(self::COLLECTION_METHOD_NAME, $accessToken, $params);
    }

    public function post(Comment $comment, string $accessToken, array $params = []): Comment
    {
        return $this->request->post($comment, self::SINGLE_OBJECT_METHOD_NAME, $accessToken, $params);
    }

    public function put(Comment $comment, int $id, string $accessToken, array $params = []): Comment
    {
        return $this->request->put($comment, $id, self::SINGLE_OBJECT_METHOD_NAME, $accessToken, $params);
    }
}
