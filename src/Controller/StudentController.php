<?php

namespace App\Controller;

use App\Entity\Classroom;

use App\Entity\Student ;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('student', name : 'app_student' )]
    public function index() : Response
    {
        return $this->render("student/index.html.twig");
    }
    #[Route('readstudent', name : 'read_student' )]
    public function read(StudentRepository $rep) : Response
    { $students = $rep->findAll();
        return $this->render("student/read.html.twig",
            ["students"=>$students]);
    }
    #[Route('/addstudent', name: 'adds')]
    public function  add(ManagerRegistry $doctrine, Request  $request) : Response
    { $student = new Student() ;
        $form = $this->createForm(StudentType::class, $student);

        $form->handleRequest($request);
        if ($form->isSubmitted()  && $form->isValid())
        { $em = $doctrine->getManager();
            $em->persist($student);
            $em->flush();


            return $this->redirectToRoute('read_student');
        }
        return $this->renderForm("student/add.html.twig",
            ["f"=>$form]) ;
    }
    #[Route('about', name : 'app_about' )]
    public function about() : Response
{
    return new Response('Welcome to Fundoo, your premier destination for professional financial project support! 🚀 Our platform is dedicated to empowering your ideas and elevating your success in the world of finance.

At Fundoo, we offer a comprehensive range of services designed to meet your unique needs and help you achieve your financial goals. Whether you\'re a startup seeking funding, an established company exploring investment opportunities, or an individual investor looking to diversify your portfolio, Fundoo has you covered.

Our platform provides access to a wide range of financial resources, including investment opportunities, crowdfunding campaigns, and expert advice. We specialize in connecting entrepreneurs with investors, fostering collaboration and growth.

Join our vibrant community of like-minded individuals who share your passion for finance and entrepreneurship. 💼 Our team of experts is dedicated to guiding you through the complexities of finance, empowering you to make informed decisions that drive your success.

Take the next step towards achieving your financial goals with Fundoo! Let us empower your ideas and elevate your success today! 💡');
}




}