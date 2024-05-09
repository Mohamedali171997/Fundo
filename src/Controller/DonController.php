<?php

namespace App\Controller;

use App\Entity\Don;
use App\Form\DonType;
use App\Repository\DonRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

// for sending emails
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

// for sendin sms
use Symfony\Component\Notifier\Message\SmsMessage;
// use Symfony\Component\Notifier\TexterInterface;

class DonController extends AbstractController
{

    public function __construct(MailerInterface $mailer)
    {

        $this->mailer = $mailer;
        // $this->texter = $texter;

    }



    #[Route('/don', name: 'app_don')]
    public function index(DonRepository $repository): Response
    {
     // $this->denyAccessUnlessGranted('ROLE_ADMIN');

     $this->denyAccessUnlessGranted('ROLE_USER');

     $dons = $repository->findAll();
     return $this->render('don/index.html.twig', ['dons' => $dons]);
 }

    #[Route('/don/ajouter', name: 'don_ajouter')]
 public function ajouter(ManagerRegistry $doctrine, Request $request): Response
 {
    $don = new Don();
    $form = $this->createForm(DonType::class, $don);

    $form->handleRequest($request);

    

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $doctrine->getManager();
        $entityManager->persist($don);
        $entityManager->flush();

        
        // send email, parameter in form emails
        $this->sendEmail($don->getDonateur());

          // send sms,
        // $this->sendSms();



        return $this->redirectToRoute('app_don');
    }

    return $this->render('don/new.html.twig', ['form' => $form->createView()]);
}

    #[Route('/don/{id}', name: 'don_voir')]
public function voir(Don $don): Response
{
    return $this->render('don/show.html.twig', ['don' => $don]);
}

    #[Route('/don/{id}/modifier', name: 'don_modifier')]
public function modifier(Don $don, Request $request): Response
{
    $form = $this->createForm(DonType::class, $don);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('app_don');
    }

    return $this->render('don/edit.html.twig', [
        'form' => $form->createView(),
            'button_label' => 'Update' // Définir le libellé du bouton
        ]);
}

    #[Route('/don/{id}/supprimer', name: 'don_supprimer')]
public function supprimer(Don $don): Response
{
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($don);
    $entityManager->flush();

    return $this->redirectToRoute('app_don');
}


//funcion sendmails
public function sendEmail($emaildon)
{

    // dd($emaildon);

    $email = (new Email())
    ->from('yourweb@test.com')
    ->to($emaildon)          
    ->subject('Donation Success!')
    ->text('Donation Success! Text')
    ->html('<p>Html example</p>');

    // $mailer->send($email);

    $this->mailer->send($email);

}

//funcion send sms, you need phone number in your entity
public function sendSms($phonedon, TexterInterface $texter)
{
    $options = (new ProviderOptions())
    ->setPriority('high')
    ;

    $sms = new SmsMessage(
            // the phone number to send the SMS message to
            // '+21622222222',
        $phonedon,
            // the message
        'A new sms for your phone!',
            // optionally, you can override default "from" defined in transports
            // '+21622222222',
            // you can also add options object implementing MessageOptionsInterface
        $options
    );

        // $sentMessage = $texter->send($sms);
    $sentMessage = $this->texter->send($sms);
}

}
