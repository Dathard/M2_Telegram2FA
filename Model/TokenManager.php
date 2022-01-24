<?php

declare(strict_types=1);

namespace Dathard\Telegram2FA\Model;

use Dathard\Telegram2FA\Model\Token\RegistrationFactory;
use Magento\Backend\Model\Auth\Session;

/**
 * @since 1.0.0
 */
class TokenManager
{
    /**
     * @var RegistrationFactory
     */
    private $registrationTokenFactory;

    /**
     * @var ResourceModel\Token\Registration
     */
    private $registrationTokenResource;

    /**
     * @var Session
     */
    private $authSession;

    /**
     * @param RegistrationFactory $registrationTokenFactory
     * @param ResourceModel\Token\Registration $registrationTokenResource
     * @param Session $authSession
     */
    public function __construct(
        RegistrationFactory $registrationTokenFactory,
        \Dathard\Telegram2FA\Model\ResourceModel\Token\Registration $registrationTokenResource,
        Session $authSession
    ) {
        $this->registrationTokenFactory = $registrationTokenFactory;
        $this->registrationTokenResource = $registrationTokenResource;
        $this->authSession = $authSession;
    }

    /**
     * Get registration token code for current user
     *
     * @return string
     */
    public function getRegistrationToken(): string
    {
        $registrationToken = $this->_getRegistrationToken();

        if (null === $registrationToken->getId()) {
            $this->_createRegistrationToken();
            $registrationToken = $this->_getRegistrationToken();
        }

        return $registrationToken->getToken();
    }

    /**
     * Get registration token code for current user
     *
     * @return mixed
     */
    private function _getRegistrationToken()
    {
        return $this->registrationTokenFactory->create()
            ->getCollection()
            ->addFieldToFilter('user_id', $this->getCurrentUser()->getId())
            ->getFirstItem();
    }

    /**
     * Create new registration token for current customer
     *
     * @return void
     */
    private function _createRegistrationToken()
    {
        do {
            $token = (string) rand(100000, 999999);
        } while ($this->tokenExists($token));

        $registrationToken = $this->registrationTokenFactory->create()
            ->setData([
                'token' => $token,
                'user_id' => $this->getCurrentUser()->getId()
            ]);
        $this->registrationTokenResource->save($registrationToken);
    }

    /**
     * Check if registration token exists
     *
     * @param string $token
     * @return bool
     */
    private function tokenExists(string $token): bool
    {
        return (bool) $this->registrationTokenFactory->create()
            ->getCollection()
            ->addFieldToFilter('token', $token)
            ->getSize();
    }

    /**
     * @return UserInterface|null
     */
    private function getCurrentUser()
    {
        return $this->authSession->getUser();
    }
}
