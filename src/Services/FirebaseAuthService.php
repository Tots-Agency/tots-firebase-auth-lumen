<?php

namespace Tots\FirebaseAuth\Services;

use Kreait\Firebase\Factory;

class FirebaseAuthService
{
    /**
     *
     * @var string
     */
    protected $keyFile = '';

    public function __construct($config)
    {
        $this->processConfig($config);
    }
    /**
     * Get user by ID token validated
     *
     * @param string $idTokenString
     * @return \Kreait\Firebase\Auth\UserRecord
     * 
     * @throws UserNotFound
     * @throws Exception\AuthException
     * @throws Exception\FirebaseException
     */
    public function getUserByIdToken($idTokenString)
    {
        // Init Firebase Auth
        $auth = $this->getAuth();
        // Verify the ID token
        $verifiedIdToken = $auth->verifyIdToken($idTokenString);
        // Get the user's ID
        $uid = $verifiedIdToken->claims()->get('sub');
        // Return user
        return $auth->getUser($uid);
    }

    protected function getAuth()
    {
        return (new Factory)->withServiceAccount($this->keyFile)->createAuth();
    }

    protected function processConfig($config)
    {
        if(array_key_exists('key_file', $config)){
            $this->keyFile = $config['key_file'];
        }
    }
}
