<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface {

	public function checkPostAuth( UserInterface $user ) {
		if ( ! $user instanceof User ) {
			return;
		}

		// user account is expired, the user may be notified
		if ( !$user->isActive()) {
			throw new AccountExpiredException( '...' );
		}
	}

	/**
	 * Checks the user account before authentication.
	 *
	 * @param UserInterface $user
	 */
	public function checkPreAuth( UserInterface $user ) {
		if ( ! $user instanceof User ) {
			return;
		}
	}
}