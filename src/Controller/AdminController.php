<?php

namespace App\Controller;

use App\Entity\Medecin;
use App\Entity\Service;
use App\Form\MedecinType;
use App\Form\ServiceType;
use App\Entity\Specialite;
use App\Form\SpecialiteType;
use App\Utils\MatriculeGenerator;
use App\Repository\MedecinRepository;
use App\Repository\ServiceRepository;
use App\Repository\SpecialiteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    //Crud de l'entité Service
    /**
     * @Route("/admin/service", name="admin.service.show")
     */
    public function showService(ServiceRepository $repos)
    {
        $services =$repos->findAll();
        return $this->render('admin/service/index.html.twig', [
            'services' => $services,
        ]);
    }

     /**
     * @Route("/admin/service/add", name="admin.service.add")
     */
    public function addService(Request $request )
    {
        $service = new Service();
        // ...

        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
    
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
         $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($service);
             $entityManager->flush();
    
            return $this->redirectToRoute('admin.service.show');
        }
    
        return $this->render('admin/service/form.html.twig', [
            'form'=>$form->createView(),
        ]);   
      
    }

     /**
     * @Route("/admin/service/edit/{id}", name="admin.service.edit")
     */
    public function editService( $id ,Request $request,ServiceRepository $repos  )
    {
        $service = $repos->find($id);
        // ...

        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
    
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
         $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($service);
             $entityManager->flush();
    
            return $this->redirectToRoute('admin.service.show');
        }
    
        return $this->render('admin/service/form.html.twig', [
            'form'=>$form->createView(),
        ]);   
      
    }

     /**
     * @Route("/admin/service/delete/{id}", name="admin.service.delete")
     */
    public function deleteService($id , ServiceRepository $repos)
    {
        $service = $repos->find($id);
        $entityManager = $this->getDoctrine()->getManager();
             $entityManager->remove($service);
             $entityManager->flush();
    
            return $this->redirectToRoute('admin.service.show');   
    }


    //Crud de l'entité Medecin
     /**
     * @Route("/admin/medecin", name="admin.medecin.show")
     */
    public function showMedecin(MedecinRepository $repos)
    {
        $medecins =$repos->findAll();
        return $this->render('admin/medecin/index.html.twig', [
            'medecins' => $medecins,
        ]);
    }

    /**
     * @Route("/admin/medecin/add", name="admin.medecin.add")
     */
    public function addMedecin(Request $request, MatriculeGenerator $mat_generator, MedecinRepository $repos)
    {
        $medecin = new Medecin();
        // ...

        $form = $this->createForm(MedecinType::class, $medecin);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $matricule = $mat_generator->generate($medecin);
            $medecin->setMatricule($matricule);

            $entityManager->persist($medecin);
            $entityManager->flush();
    
            return $this->redirectToRoute('admin.medecin.show');
        }
    
        return $this->render('admin/medecin/form.html.twig', [
            'form'=>$form->createView(),
            'medecins'=>$repos->findAll(),
        ]);   
      
    }

     /**
     * @Route("/admin/medecin/edit/{id}", name="admin.medecin.edit")
     */
    public function editMedecin(Medecin $medecin ,Request $request)
    {

        $form = $this->createForm(MedecinType::class, $medecin);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
    
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
         $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($medecin);
             $entityManager->flush();
    
            return $this->redirectToRoute('admin.medecin.show');
        }
    
        return $this->render('admin/medecin/form.html.twig', [
            'form'=>$form->createView(),
        ]);   
      
    }

     /**
     * @Route("/admin/medecin/delete/{id}", name="admin.medecin.delete")
     */
    public function deleteMedecin($id, MedecinRepository $repos)
    {
           $medecin=$repos->find($id);
           $entityManager = $this->getDoctrine()->getManager();
             $entityManager->remove($medecin);
             $entityManager->flush();
    
            return $this->redirectToRoute('admin.medecin.show');   
    }
    
    //Crud de l'entité Spécialité
    /**
     * @Route("/admin/specialite", name="admin.specialite.show")
     */
    public function showSpecialite(SpecialiteRepository $repos)
    {
        $specialites =$repos->findAll();
        return $this->render('admin/specialite/index.html.twig', [
            'specialites' => $specialites,
        ]);
    }

     /**
     * @Route("/admin/specialite/add", name="admin.specialite.add")
     */
    public function addSpecialite(Request $request )
    {
        $specialite = new Specialite();
        // ...

        $form = $this->createForm(SpecialiteType::class, $specialite);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
    
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
         $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($specialite);
             $entityManager->flush();
    
            return $this->redirectToRoute('admin.specialite.show');
        }
    
        return $this->render('admin/specialite/form.html.twig', [
            'form'=>$form->createView(),
        ]);   
      
    }

     /**
     * @Route("/admin/specialite/edit/{id}", name="admin.specialite.edit")
     */
    public function editSpecialite( $id ,Request $request,SpecialiteRepository $repos  )
    {
        $specialite = $repos->find($id);
        // ...

        $form = $this->createForm(SpecialiteType::class, $specialite);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
    
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
         $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($specialite);
             $entityManager->flush();
    
            return $this->redirectToRoute('admin.specialite.show');
        }
    
        return $this->render('admin/specialite/form.html.twig', [
            'form'=>$form->createView(),
        ]);   
      
    }

     /**
     * @Route("/admin/specialite/delete/{id}", name="admin.specialite.delete")
     */
    public function deleteSpecialite($id , SpecialiteRepository $repos)
    {
        $specialite = $repos->find($id);
        $entityManager = $this->getDoctrine()->getManager();
             $entityManager->remove($specialite);
             $entityManager->flush();
    
            return $this->redirectToRoute('admin.specialite.show');   
    }
}
