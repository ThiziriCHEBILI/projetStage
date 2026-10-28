<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\UserProgress;

#[AsCommand(
    name: 'app:clean-progress',
    description: 'Supprime les progressions de plus de 30 jours',
)]
class CleanProgressCommand extends Command
{

    public function __construct(private EntityManagerInterface $em)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $limit = new \DateTimeImmutable('-' . UserProgress::DAYS_BEFORE_REMOVE . ' days');

        $allProgress = $this->em->getRepository(UserProgress::class)->findAll();
        $count = 0;

        foreach ($allProgress as $userProgress) {
            if ($userProgress->getLastWatched() < $limit) {
                $this->em->remove($userProgress);
                $count++;
            }
        }

        $this->em->flush();

        $io->success($count . ' progression(s) supprimée(s).');

        return Command::SUCCESS;
    }
}
