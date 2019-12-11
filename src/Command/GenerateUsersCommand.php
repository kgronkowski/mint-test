<?php

namespace App\Command;

use Faker\Factory;
use FOS\UserBundle\Util\UserManipulator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GenerateUsersCommand extends Command
{
    protected static $defaultName = 'app:generate-users';

    private $userManipulator;

    private $faker;

    public function __construct(UserManipulator $userManipulator)
    {
        parent::__construct(self::$defaultName);
        $this->userManipulator = $userManipulator;
        $this->faker = Factory::create('pl');
    }

    protected function configure()
    {
        $this
            ->setDescription('Generate random users')
            ->addArgument('count', InputArgument::REQUIRED, 'Count of users to generate')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $count = $input->getArgument('count');

        if (!$count || $count < 1) {
            $io->error('You need to specify how many users you want added');
            return 0;
        }

        for ($i=0;$i<$count;$i++) {
            $this->userManipulator->create(
                $this->faker->userName,
                $this->faker->password,
                $this->faker->freeEmail,
                $this->faker->boolean,
                false
            );
        }

        return 0;
    }
}
