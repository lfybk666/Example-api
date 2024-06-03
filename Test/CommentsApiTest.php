<?php
declare(strict_types=1);

namespace Test;

use Danil\Api\Client\ApiClient;
use Danil\Api\Model\Comment;
use Danil\Api\Auth\Auth;
use PHPUnit\Framework\TestCase;

class CommentsApiTest extends TestCase
{
    private function getAccessToken(): string
    {
        $auth = new Auth();

        return $auth->getAccessToken('example_api_key');
    }

    public function testGetComments()
    {
        $accessToken = $this->getAccessToken();
        $apiClient = new ApiClient();
        $comments = $apiClient->comments()->get($accessToken);
        foreach ($comments as $comment) {
            $this->assertInstanceOf(Comment::class, $comment);
        }
    }

    public function testPostComment()
    {
        $accessToken = $this->getAccessToken();
        $apiClient = new ApiClient();
        $newComment = new Comment();
        $newComment
            ->setText('newText')
            ->setName('newName');

        $comment = $apiClient->comments()->post($newComment, $accessToken);
        $this->assertSame($newComment->getName(), $comment->getName());
        $this->assertSame($newComment->getText(), $comment->getText());
    }

    public function testPutComment()
    {
        $accessToken = $this->getAccessToken();
        $apiClient = new ApiClient();
        $oldComment = $apiClient->comments()->get($accessToken)[0];/** @var Comment $oldComment */
        $oldComment
            ->setText('newText')
            ->setName('newName');

        $comment = $apiClient->comments()->put($oldComment, $oldComment->getId(), $accessToken);
        $this->assertSame($oldComment, $comment);
    }
}