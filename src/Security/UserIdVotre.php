<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserIdVoter extends Voter
{
  protected function supports(string $attribute, $subject): bool
  {
    return $attribute === 'ACCESS_APP';
  }

  protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
  {
    $user = $token->getUser();
    
    if (!$user instanceof User) {
      return false;
    }
    
    // Check if the user is an admin (ignore vs code error)
    if ($user->isAdmin()) {
      return true;
    }

    // Check if the user ID matches the subject ID
    return $user->getId() === $subject->getId();
  }
}
