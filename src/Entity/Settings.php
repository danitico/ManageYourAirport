<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SettingsRepository")
 */
class Settings
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $slackChannel;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $webhookURL;

    public function getId()
    {
        return $this->id;
    }

    public function getSlackChannel(): ?string
    {
        return $this->slackChannel;
    }

    public function setSlackChannel(?string $slackChannel): self
    {
        $this->slackChannel = $slackChannel;

        return $this;
    }

    public function getWebhookURL(): ?string
    {
        return $this->webhookURL;
    }

    public function setWebhookURL(?string $webhookURL): self
    {
        $this->webhookURL = $webhookURL;

        return $this;
    }

    public function sendSlackMessage(?string $message): self
    {
        $payload = json_encode(
            array(
                "channel" => $this->getSlackChannel(),
                "username" => "newUsersBot",
                "text" => $message,
                "icon_emoji" => ":elephant:"
            )
        );

        $ch = curl_init($this->getWebhookURL());

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);

        return $this;
    }
}