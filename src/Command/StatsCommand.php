<?php

namespace App\Command;

use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:stats',
    description: 'ce sont les statistiques de mon site',
)]
class StatsCommand extends Command
{
    public function __construct(
        private ProductRepository $productRepository,
        private EntityManagerInterface $entityManager,
        private UserRepository $userRepository,
        )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        // $this
        //     ->addArgument('nbProduit', InputArgument::OPTIONAL, 'nombres de produits')
        //     ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        //     ->addArgument('nbUtilisateurs', InputArgument::OPTIONAL,"nombres d'utilisateurs")
        // ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
  
        $products = $this->productRepository->findAll();
        $products = $this->entityManager->getRepository('App\Entity\Product');
        $totalProduct = $products->count([]);

        $users = $this->userRepository->findAll();
        $users = $this->entityManager->getRepository('App\Entity\User');
        $totalUser = $users->count([]);
       
        
        // dump($products);

        $io->writeln('voici le nombre total de produits:'. $totalProduct);
        $io->writeln("voici le nombre total d'utilisateurs: " . $totalUser);
        $io->writeln('voici les statistiques.');
        $io->success('voici les statistiques.');

        return Command::SUCCESS;
    }
}
 