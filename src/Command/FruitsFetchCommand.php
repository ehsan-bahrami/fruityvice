<?php

namespace App\Command;

use App\Entity\Fruit;
use App\Repository\FruitRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'fruits:fetch',
    description: 'Gets all fruits and save them into the local DB.',
)]
class FruitsFetchCommand extends Command
{
    const API_URL = 'https://fruityvice.com/api/fruit/all';
    public function __construct(private HttpClientInterface $httpClient, private FruitRepository $fruitRepository, private ValidatorInterface $validator)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        // $this
        //     ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
        //     ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        // ;
        $this
            ->setHelp('This command allows you to gets all fruits and save them into the local DB.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        // $arg1 = $input->getArgument('arg1');

        // if ($arg1) {
        //     $io->note(sprintf('You passed an argument: %s', $arg1));
        // }

        // if ($input->getOption('option1')) {
        //     // ...
        // }

        $response = $this->httpClient->request('GET', Self::API_URL);
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

            $errors = $this->validator->validate($fruit);
            if (count($errors) > 0) {
                $io->error((string) $errors);
                return Command::FAILURE;
            }

            $this->fruitRepository->save($fruit, true);
        }

        $io->success('All fruits successfully have been fetch and store in the local DB.');

        return Command::SUCCESS;
    }
}
