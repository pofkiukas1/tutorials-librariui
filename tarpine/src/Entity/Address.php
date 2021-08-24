<?php

namespace Paysera\Client\TransfersClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class Address extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return string|null
     */
    public function getCountryCode()
    {
        return $this->get('country_code');
    }
    /**
     * @param string $countryCode
     * @return $this
     */
    public function setCountryCode($countryCode)
    {
        $this->set('country_code', $countryCode);
        return $this;
    }
    /**
     * @return string|null
     */
    public function getAddressLine()
    {
        return $this->get('address_line');
    }
    /**
     * @param string $addressLine
     * @return $this
     */
    public function setAddressLine($addressLine)
    {
        $this->set('address_line', $addressLine);
        return $this;
    }
}
