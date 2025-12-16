<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * PDF Library for CodeIgniter
 * Wrapper for DOMPDF
 */
class Pdf
{
    protected $dompdf;
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'sans-serif');

        $this->dompdf = new Dompdf($options);
    }

    /**
     * Load view and render to PDF
     *
     * @param string $view View file path
     * @param array $data Data to pass to view
     * @param string $paper Paper size (letter, legal, A4, etc)
     * @param string $orientation 'portrait' or 'landscape'
     * @return $this
     */
    public function load($view, $data = [], $paper = 'A4', $orientation = 'portrait')
    {
        $html = $this->CI->load->view($view, $data, true);
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper($paper, $orientation);
        $this->dompdf->render();

        return $this;
    }

    /**
     * Stream PDF to browser (inline view or download)
     *
     * @param string $filename Filename for the PDF
     * @param bool $attachment If true, forces download. If false, inline view.
     */
    public function stream($filename = 'document.pdf', $attachment = true)
    {
        $options = [
            'Attachment' => $attachment
        ];
        $this->dompdf->stream($filename, $options);
    }

    /**
     * Get PDF output as string
     *
     * @return string
     */
    public function output()
    {
        return $this->dompdf->output();
    }

    /**
     * Save PDF to file
     *
     * @param string $filepath Full path to save the file
     * @return bool
     */
    public function save($filepath)
    {
        $output = $this->dompdf->output();
        return file_put_contents($filepath, $output) !== false;
    }
}
