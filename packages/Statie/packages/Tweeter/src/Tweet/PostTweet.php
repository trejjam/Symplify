<?php declare(strict_types=1);

namespace Symplify\Statie\Tweeter\Tweet;

use DateTimeInterface;
use Nette\Utils\Strings;

final class PostTweet
{
    /**
     * @var string
     */
    private $text;

    /**
     * @var string|null
     */
    private $image;

    /**
     * @var DateTimeInterface
     */
    private $postDateTime;

    public function __construct(string $text, DateTimeInterface $postDateTime, ?string $image)
    {
        $this->text = htmlspecialchars_decode($text);
        $this->postDateTime = $postDateTime;
        $this->image = $image;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getPostDateTime(): DateTimeInterface
    {
        return $this->postDateTime;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function isSimilarToPublishedTweet(PublishedTweet $publishedTweet): bool
    {
        return Strings::startsWith(
            $this->text,
            // published tweet is usually modified by Twitter API, so we just use starting part of it
            Strings::substring($publishedTweet->getText(), 0, 50)
        );
    }
}
