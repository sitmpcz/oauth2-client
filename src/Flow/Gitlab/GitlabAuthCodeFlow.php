<?php declare(strict_types = 1);

namespace Contributte\OAuth2Client\Flow\Gitlab;

use Contributte\OAuth2Client\Exception\Runtime\UserProbablyDeniedAccessException;
use Contributte\OAuth2Client\Flow\AuthCodeFlow;
use League\OAuth2\Client\Token\AccessTokenInterface;
use Nette\Http\Session;

/**
 * @method GitlabProvider getProvider()
 */
class GitlabAuthCodeFlow extends AuthCodeFlow
{

	public function __construct(GitlabProvider $provider, Session $session)
	{
		parent::__construct($provider, $session);
	}

	/**
	 * @inheritdoc
	 */
	public function getAccessToken(array $parameters, ?string $redirectUri = null): AccessTokenInterface
	{
		if (isset($parameters['error'])) {
			throw new UserProbablyDeniedAccessException($parameters['error']);
		}

		return parent::getAccessToken($parameters, $redirectUri);
	}

}
