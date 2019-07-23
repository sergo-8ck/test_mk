<?php

namespace AppBundle\Command;

use AppBundle\Entity\News;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class AddNewsCommand extends ContainerAwareCommand
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
            ->setName('add:news')
            ->setDescription('Add news')
            ->setHelp('Add news')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $question_title = new Question("Enter title: ", "Default title");
        $question_description = new Question("Enter description: ", "Default description");

        $title = $helper->ask($input, $output, $question_title);
        $description = $helper->ask($input, $output, $question_description);

        $news = (new News())
            ->setTitle($title)
            ->setDescription($description)
        ;

        $this->em->persist($news);
        $this->em->flush();
    }

}
