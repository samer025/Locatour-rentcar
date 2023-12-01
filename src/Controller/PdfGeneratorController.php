<?php
 
namespace App\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
 
class PdfGeneratorController extends AbstractController
{
    /**
     * @Route("/pdf/generator", name="pdf_generator")
     */
    public function index(): Response
    {
         
        $data = [
            'imageSrc'  => $this->imageToBase64($this->getParameter('kernel.project_dir') . '/public/img/profile.png'),
            'nom'         => 'ahmed mohsen',
            'cin'      => '9958320',
            'date' => '1/12/2023',
            'prix'        => '15'
        ];
        $html =  $this->renderView('pdf_generator/index.html.twig', $data);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
        return new Response (
            $dompdf->stream('Contrat de vente', ["Attachment" => false]),
            Response::HTTP_OK,
            ['Content-Type' => 'application/pdf']
        );
    }
 
    private function imageToBase64($path) {
        $path = $path;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }
   
 
}