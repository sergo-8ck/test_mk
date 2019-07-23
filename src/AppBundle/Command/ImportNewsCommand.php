<?php

namespace AppBundle\Command;

use AppBundle\Entity\News;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

class ImportNewsCommand extends ContainerAwareCommand
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();

        $this->em = $em;
    }

    protected function configure()
    {
        $this
            ->setName('import:news')
            ->setDescription('Add news')
            ->setHelp('Add news')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Attempting to import the feed...');

        $reader = Reader::createFromPath('%kernel.root_dir%/../src/AppBundle/Data/news.csv');

        $results = $reader->fetchAssoc();

        foreach($results as $row){
            $news = (new News())
                ->setTitle($row['title'])
                ->setDescription($row['description'])
            ;

            $this->em->persist($news);
        }

        $this->em->flush();

        $io->success('Everything went well!');
    }

}
