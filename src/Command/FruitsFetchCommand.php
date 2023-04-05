<?php

namespace App\Command;

use App\Entity\Fruit;
use App\Repository\FruitRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'fruits:fetch',
    description: 'Gets all fruits and save them into the local DB.',
)]
class FruitsFetchCommand extends Command
{
    public const API_URL = 'https://fruityvice.com/api/fruit/all';
    public function __construct(private HttpClientInterface $httpClient, private FruitRepository $fruitRepository, private ValidatorInterface $validator, private MailerInterface $mailer)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setHelp('This command allows you to gets all fruits and save them into the local DB.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $response = $this->httpClient->request('GET', self::API_URL);

        $this->saveFruits($response);

        // It has been commented in the demo application. You can set "MAILER_DSN" environment variable and send an email.
        // $this->sendEmail();

        $io->success('All fruits successfully have been fetch and store in the local DB.');

        return Command::SUCCESS;
    }

    private function sendEmail(): void
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to('you@example.com')
            ->subject('Fruits fetching status')
            ->text('All fruits successfully have been fetch and store in the local DB.');

        $this->mailer->send($email);
    }

    private function saveFruits($response): bool
    {
        $fruits = $response->toArray();
        foreach ($fruits as $fruitItem) {
            $fruit = new Fruit();

            $fruit->setName($fruitItem['name']);
            $fruit->setFamily($fruitItem['family']);
            $fruit->setCarbohydrates($fruitItem['nutritions']['carbohydrates']);
            $fruit->setProtein($fruitItem['nutritions']['protein']);
            $fruit->setFat($fruitItem['nutritions']['fat']);
            $fruit->setCalories($fruitItem['nutritions']['calories']);
            $fruit->setSugar($fruitItem['nutritions']['sugar']);
            $fruit->setFavorite(false);

            $errors = $this->validator->validate($fruit);
            if (count($errors) > 0) {
                return false;
            }

            $this->fruitRepository->save($fruit, true);
        }

        return true;
    }
}
