<?php

namespace App\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiscordController extends AbstractController
{
    /*
		Link to this controller to start the "connect" process
	*/
	#[Route('/connect/discord', name: 'connect_discord_start')]
    public function connectAction(ClientRegistry $clientRegistry): Response
    {
        // will redirect to Discord!
        return $clientRegistry
            ->getClient('discord') // key used in config/packages/knpu_oauth2_client.yaml
            ->redirect([
                'identify', 'email' // the scopes you want to access
            ]);
    }

    /*
		After going to Discord, you're redirected back here
		because this is the "redirect_route" you configured
		in config/packages/knpu_oauth2_client.yaml
    */
	#[Route('/connect/discord/check', name: 'connect_discord_check')]
    public function connectCheckAction(Request $request, ClientRegistry $clientRegistry): Response
    {
        // ** if you want to *authenticate* the user, then
        // leave this method blank and create a Guard authenticator
        // (read below)

        // /** @var \KnpU\OAuth2ClientBundle\Client\Provider\DiscordClient $client */
        // $client = $clientRegistry->getClient('discord');

        // try {
            // the exact class depends on which provider you're using
            // /** @var \League\OAuth2\Client\Provider\DiscordUser $user */
            // $user = $client->fetchUser();

            // do something with all this new power!
            // e.g. $name = $user->getFirstName();
            // var_dump($user); die;
            // ...
        // } catch (IdentityProviderException $e) {
            // something went wrong!
            // probably you should return the reason to the user
            // var_dump($e->getMessage()); die;
        // }
    }
}