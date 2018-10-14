namespace BolCom\RetailerApi\Model\Customer {

    data CustomerDetails = CustomerDetails {
        string $salutationCode,
        string $firstName,
        string $surName,
        string $streetName,
        string $houseNumber,
        string $houseNumberExtended,
        string $addressSupplement,
        string $extraAddressInformation,
        string $zipCode,
        string $city,
        string $countryCode,
        string $email,
        string $deliveryPhoneNumber,
        string $company,
        string $vatNumber,
    } deriving (FromArray);

}
