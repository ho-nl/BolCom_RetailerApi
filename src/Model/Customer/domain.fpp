namespace BolCom\RetailerApi\Model\Customer {
    data CustomerDetails = CustomerDetails {
        ?string $salutation,
        ?string $firstName,
        ?string $surname,
        ?string $streetName,
        ?string $houseNumber,
        ?string $houseNumberExtention,
        ?string $extraAddressInformation,
        string $zipCode,
        ?string $city,
        string $countryCode,
        ?string $email,
        ?string $company,
        ?string $kvkNumber,
        ?string $deliveryPhoneNumber
    } deriving (FromArray);
}
