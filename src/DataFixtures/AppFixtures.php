<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Contractor;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $this->loadContractors($manager);
        $this->loadClients($manager);
        $this->loadUsers($manager);
        $manager->flush();
    }

    private function loadUsers(ObjectManager $manager)
    {
        foreach ($this->getUserData() as [
                $email,
                $login,
                $password,
                $is_verified,
                $phone,
                $first_name,
                $middle_name,
                $last_name
            ]) {
            $user = new User();
            $user->setEmail($email)
                ->setLogin($login)
                ->setPassword($this->passwordHasher->hashPassword($user, $password))
                ->setVerified($is_verified)
                ->setPhone($phone)
                ->setFirstName($first_name)
                ->setMiddleName($middle_name)
                ->setLastName($last_name)
                ->setClientId($this->getReference('client'));

            $manager->persist($user);
        }
    }

    private function getUserData()
    {
        return [
            ['test@test.ru', 'idleo', '123456', true, '79636068177', 'leo', '_', 'vilisov']
        ];
    }

    private function loadClients(ObjectManager $manager)
    {
        foreach ($this->getClientData() as [
                 $system_id,
                 $system_password,
                 $name,
                 $multysign_traffik_available,
                 $international_traffik_available
        ]) {
            $client = new Client();
            $client->setSystemId($system_id)
                ->setSystemPassword($system_password)
                ->setName($name)
                ->setMultysignTraffikAvailable($multysign_traffik_available)
                ->setInternationalTraffikAvailable($international_traffik_available)
                ->setContractorId($this->getReference('contractor'));

            $manager->persist($client);
            $this->addReference('client', $client);
        }

        $manager->flush();
    }

    private function getClientData(): array
    {
        return [
            ['system1', 'system1', 'ООО Первый Партнер', false, false]
        ];
    }

    private function loadContractors(ObjectManager $manager)
    {
        foreach ($this->getContractorData() as [
                 $legal_type,
                 $inn,
                 $name,
                 $address,
                 $contact
        ]) {
            $contractor = new Contractor();
            $contractor->setLegalType($legal_type)
                ->setInn($inn)
                ->setName($name)
                ->setAddress($address)
                ->setContact($contact);

            $manager->persist($contractor);
            $this->addReference('contractor', $contractor);
        }

        $manager->flush();
    }

    private function getContractorData()
    {
        return [
            ['OOO', '123123123123', 'ООО Первый Партнер', 'город, улица, дом', '123-123-123-123 звонить после шести']
        ];
    }
}
