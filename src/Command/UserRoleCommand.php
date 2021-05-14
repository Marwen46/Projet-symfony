<?php

namespace App\Command;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class UserRoleCommand extends Command
{
    protected static $defaultName = 'user:role';
    protected static $defaultDescription = 'Adding roles to users';
    private $om;

    public function __construct(EntityManagerInterface $om)
    {
        $this->om = $om;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('email', InputArgument::REQUIRED, 'Email of the user to be promoted')
            ->addArgument('roles', InputArgument::REQUIRED, 'Roles to be added to the user')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');
        $roles = $input->getArgument('roles');

        $userRepository = $this->om->getRepository(User::class);
        $user = $userRepository->findOneBy(['email'=>$email]);
        if ($user) {
            $user->addRoles($roles);
            $this->om->flush();

            $io->success('Role added successfully !! :D');
        } else{
            $io->error('No existing user with that email');
        }

        

        return 0;
    }
}
