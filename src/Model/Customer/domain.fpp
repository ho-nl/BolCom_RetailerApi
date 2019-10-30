namespace BolCom\RetailerApi\Model\Customer {
    data CustomerDetails = CustomerDetails {
        string $salutationCode,
        ?string $firstName,
        ?string $surname,
        ?string $streetName,
        ?string $houseNumber,
        ?string $houseNumberExtended,
        ?string $addressSupplement,
        ?string $extraAddressInformation,
        string $zipCode,
        ?string $city,
        string $countryCode,
        ?string $email,
        ?string $company,
        ?string $vatNumber,
        ?string $deliveryPhoneNumber
    } deriving (FromArray);
}
