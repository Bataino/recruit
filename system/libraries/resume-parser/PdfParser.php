<?php

/**
 * @file
 * Class PdfParser
 * 
 * @author : Sebastien MALOT <sebastien@malot.fr>
 * @date : 2013-08-08
 *
 * References :
 * - http://www.mactech.com/articles/mactech/Vol.15/15.09/PDFIntro/index.html
 * - http://framework.zend.com/issues/secure/attachment/12512/Pdf.php
 * - http://www.php.net/manual/en/ref.pdf.php#74211
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Pdfparser
{
  /**
   * Parse PDF file.
   *
   * @param string $filename
   *
   * @return string
   */
  public static function parseFile($filename)
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.apilayer.com/resume_parser/url?url=" . $filename,
      CURLOPT_HTTPHEADER => array(
        "Content-Type: text/plain",
        "apikey: 5W7lLTqms7MqRBbFqXzFDtEDlMrejaj7"
      ),
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET"
    ));
    try {
      $response = curl_exec($curl);
      curl_close($curl);

      return $response;
    } catch (Exception $err) {
      return $err;
    }
  }
}
