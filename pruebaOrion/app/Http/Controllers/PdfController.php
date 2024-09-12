<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    //
    public function pdfDiploma()
    {
        $cursos = Cursos::get();
        $data = [
            'titulo' => 'Cursos',
            'cursos' => $cursos
        ];
        $pdf = Pdf::loadView('pdf.diploma-especialidades', $data);
        return $pdf->download('invoice.pdf');
        $pdf->render();



        // Output the generated PDF to Browser
        // $pdf->stream();
        $pdfContent = $pdf->output();

        // Return the PDF content with appropriate headers for inline display
        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="example.pdf"');
    }
}
